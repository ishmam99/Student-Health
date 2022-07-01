<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function view(): JsonResponse
    {
        return $this->apiResponseResourceCollection(200, 'User profile.', UserResource::make(auth()->user()));
    }

    public function update(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'profile_picture' => ['nullable', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric'],
            'email' => ['required', 'email', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(422, 'The given data was invalid.', ['errors' => $validator->errors()]);
        }

        auth()->user()->update($validator->validated());
        if ($request->has('profile_picture')) {
            auth()->user()->addMediaFromBase64($request->input('profile_picture'))->toMediaCollection('profile_picture');
        }

        return $this->apiResponseResourceCollection(200, 'User profile updated.', UserResource::make(auth()->user()->load('package')));
    }

    /*public function getChildren($username): JsonResponse
    {
        $user = User::with('children')->where('uid', $username)->firstOrFail();
        return $this->apiResponseResourceCollection(200, 'Children List.', UserResource::collection($user->children));
    }*/
}
