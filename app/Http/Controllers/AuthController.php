<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create($request->all());
            $token = $user->createToken('api_token')->plainTextToken;
            $responseData = [
                'user' => $user,
                'token' => $token
            ];

            return $this->handleResponse($responseData, 'Your account has successfully created.');
        } catch (\Exception $e) {
            return $this->handleError($e->getMessage());
        }
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
        try {
            $authenticate = auth()->attempt($request->all());

            if (!$authenticate) {
                return $this->handleError('Your credentials is invalid.');
            }

            $user = auth()->user();
            $token = $user->createToken('api_token')->plainTextToken;
            $responseData = [
                'user' => $user,
                'token' => $token
            ];

            return $this->handleResponse($responseData, 'The user was successfully authenticated.');
        } catch (\Exception $e) {
            return $this->handleError($e->getMessage());
        }
    }

    /**
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        try {
            auth()->user()->tokens()->delete();
            return $this->handleResponse([], 'The user was successfully sign out.');
        } catch (\Exception $e) {
            return $this->handleError($e->getMessage());
        }
    }
}
