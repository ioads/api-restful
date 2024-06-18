<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function login(AuthUserRequest $request): JsonResponse
    {
        $data = $request->validated();

        if (!Auth::attempt($data)){
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user = User::where('email', $request->email)->first();

        $token = $user->createToken('token-name')->plainTextToken;

        return response()->json(['token' => $token], 200);
    }
}
