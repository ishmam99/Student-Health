<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Transaction;
use App\Models\User;
use App\Traits\LoginTrait;
use App\Traits\RegistrationTrait;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    use RegistrationTrait, LoginTrait;

    public function index()
    {
        $users = User::latest('id')->paginate(10);
        return view('backend.user.index', compact('users'));
    }

    public function view(string $username)
    {
        $user = User::where('uid', $username)->first();
        return view('backend.user.view', compact('user'));
    }
    public function create()
    {
        return view('backend.user.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
             'name' => ['required', 'string', 'max:255','min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone'     =>['required','string','min:11','unique:users']
        ]);
       // $validated['referred_by'] = User::where('uid', $request->input('sponsor'))->first()->id;
        $validated['password'] = Hash::make($request->input('password'));
        $validated['referred_by'] =Auth::user()->id;
        $validated['uid'] = rand(1000000000, 9999999999);
        // $validated['uid'] = 222222;
            while (User::where('uid', $validated['uid'])->first()) { 
                $validated['uid'] = rand(1000000000, 9999999999); //check if random referred id is match with uid then create new one
            }
        User::create($validated);
        // DB::beginTransaction();
        // try {
        //     $image = [];
        //     if ($image[0]) {
        //         $validated = array_merge($validated, $image[0]);
        //     }
           
        //     $validated['point'] = 0;
        //     $validated['status'] = 1;
           
        //     $user = User::create($validated);

        //     Transaction::create([
        //         'user_id' => $user->id,
        //         'amount' => $request->input('amount'),
        //         'from' => $request->input('from') ?? 0,
        //         'to' => $request->input('to') ?? 0,
        //         'type' => 'deposit',
        //         'txn_id' => $request->input('txn_id'),
        //         'status' => $request->input('status') ?? 'pending'
        //     ]);

        //     if ($request->input('type') == 'dps') {
        //         $this->DPS($request, $image[1], $user);
        //     }

        //     if ($user) {
        //         $this->distributeGenerationIncome($user);
        //     }

        //     DB::commit();
        // } catch (Exception $e) {
        //     DB::rollBack();
        //     return back()->with('error', 'error creating new user.');
        // }
      //  dd($validated);
        return redirect()->route('user.index')->with('success', 'New User created successfully.');
    }
     public function edit($id)
    {
        $user=User::findorfail($id);
        return view('backend.user.edit',compact('user'));
    }

    public function update(Request $request, $id)
    {
         $validated = $request->validate([
            'name' => [ 'string', 'max:255','min:3'],
            'email' => ['email',
            Rule::unique('users')->ignore($id)],
            'password' => [ 'nullable','string', 'min:8', 'confirmed'],
            'phone'     =>['string','min:11']
        ]);
       // $validated['referred_by'] = User::where('uid', $request->input('sponsor'))->first()->id;
        $validated['password'] = Hash::make($request->input('password'));
       User::findorfail($id)->update($validated);
    return redirect()->back()->with('success','User Updated Successfully');
    }

    public function destroy($id)
    {
         User::findorfail($id)->delete();
         return redirect()->back()->with('success','User Deleted Successfully');
    }

    public function cancelRequest(User $user): RedirectResponse
    {
        $user->status = 2;
        $user->update();
        return back()->with('success', 'User request canceled.');
    }

    public function userBalanceUpdate(Request $request): RedirectResponse
    {
        $request->validate([
            'user_id' => ['required', 'integer'],
            'amount' => ['required', 'string']
        ]);
        $user = User::findOrFail($request->input('user_id'));
        $user->increment('balance', $request->input('amount'));
        Transaction::newTransaction($user->id, Transaction::TYPE_CREDITED_BY_ADMIN, Transaction::STATUS_CREDITED, $request->get('amount'));
        return back()->with('success', 'User balance updated.');
    }
}
