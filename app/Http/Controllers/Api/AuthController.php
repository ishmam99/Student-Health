<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Models\Package;
use App\Models\User;
use App\Traits\RegistrationTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Validation\Rule;
use Throwable;

class AuthController extends Controller
{
    use RegistrationTrait;

    public function register(UserRegisterRequest $request): JsonResponse
    {
        // try {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        if (!empty($request->input('referred_by'))) {
            $referredBy = User::where('uid', $request->input('referred_by'))->first();
            $validated['referred_by'] = $referredBy->id;
            $referredBy->increment('count_referred_user');
            $referredBy->save();
        }
        $validated['uid'] = rand(1000000000, 9999999999);
        // $validated['uid'] = 222222;
        while (User::where('uid', $validated['uid'])->first()) {
            $validated['uid'] = rand(1000000000, 9999999999); //check if random referred id is match with uid then create new one
        }
        // dd($validated);
        // DB::beginTransaction();
        // $referredBy->increment('count_referred_user');
        // $validated['account_expire_on'] = Carbon::now()->addDays(365);
        $user = User::create($validated);
        // dd($user);
        // // $percentagePrice = ($user->package->cost / 100) * 1;

        // $this->distributeReferralIncome($referredBy, $percentagePrice);
        // // $this->distributeGenerationIncome($user);
        // $packageChargeStatus = $this->packageMigrationCharge($user);
        // if (!$packageChargeStatus) {
        //     DB::rollBack();
        //     return $this->apiResponse(
        //         406,
        //         "Registration failed. Insufficient Balance."
        //     );
        // }
        // DB::commit();
        return $this->apiResponse(201,'success' ,'Registration Successful.', ['uid' => $user->uid]);
        // return $this->apiResponse(201, 'Registration Successful.', ['uid' => $validated['uid']]);
        // } catch (Throwable $throwable) {
        //     // dd($throwable);
        //     DB::rollBack();
        //     return $this->apiResponse(406, 'Somethings wrong! try again.');
        // }
    }

    public function login(Request $request): JsonResponse
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'phone'      => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(422,'error', 'The given data was invalid.', ['errors' => $validator->errors()]);
        }

        $user = User::where('phone', $request->input('phone'))->first();
        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            return $this->apiResponse(422,'error', 'The provided credentials are incorrect.');
        }

        if ($user->account_expire_on && $user->account_expire_on->toDate() <= now()->toDate()) {
            return $this->apiResponse(422,'error', 'Account expired.');
        }

        $token = $user->createToken($request->input('phone'))->plainTextToken;

        return $this->apiResponse(200, 'success','Login Successful.', [
            'token' => $token,
            'data'  => [
                'user_id' => $user->id,
                'phone'     => $user->uid,
                'image'   => setImage($user->image),
            ]
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        // delete specific access token
        $request->user()->tokens()->where('id', $request->user()->currentAccessToken()->id)->delete();

        return $this->apiResponse(200, 'success','Logout successful.');
    }

    public function changePassword(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'old_password' => ['required', 'string'],
            'password'     => ['required', 'string'],
        ]);
        $data['error']='';
        if ($validator->fails()) {
            return $this->apiResponse(422, 'The given data was invalid.','error' ,['errors' => $validator->errors()]);
        }

        if (!Hash::check($request->input('old_password'), auth()->user()->password)) {
            return $this->apiResponse(422,'error', 'Old Password is incorrect.');
        }
        auth()->user()->update([
            'password' => Hash::make($request->input('password'))
        ]);

        return $this->apiResponse(201,'success', 'Password changed successfully.');
    }

    public function forgetPassword(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'max:255']
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(422,'error', 'The given data was invalid.', ['errors' => $validator->errors()]);
        }

        if (!User::where('email', $request->input('email'))->first()) {
            return $this->apiResponse(404,'error', 'We can\'t find a user with that email address.');
        }
        //        Password::sendResetLink($validator->validated());

        return $this->apiResponse(200, 'success','We send a password reset link to your email.');
    }

    public function destroy(Request $request)
    {
        $request->user()->tokens()->delete();
        return $this->apiResponse(200, 'success','Logout successful!');
    }
}
