<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Userjwt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponseTrait;

class AuthController extends Controller
{
    use ApiResponseTrait;

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|integer|exists:roles,id'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(false, 'Validation Error!', $validator->errors(), 422);
        }

        $user = Userjwt::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return $this->apiResponse(true, 'User registered successfully', $user, 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (! $token = auth('api')->attempt($credentials)) {
            return $this->apiResponse(false, 'Unauthorized!', null, 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        $data = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ];

        return $this->apiResponse(true, 'Login Successfull', $data, 200);
    }

    public function getCurrentUser()
    {
        if (!auth('api')->check()) {
            return $this->apiResponse(false, 'User is not authenticated.', null, 401);
        }

        $user = auth('api')->user();
        return $this->apiResponse(true, 'User profile fetched successfully.', $user, 200);
    }

    public function logout()
    {
        auth('api')->logout();
        return $this->apiResponse(true, 'Successfully logged out', null, 200);
    }
}
