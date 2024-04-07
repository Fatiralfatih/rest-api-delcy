<?php

namespace App\Http\Controllers\api;

use App\Action\Authenticated\Register;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthenticatedResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticatedController extends Controller
{

    function login(LoginRequest $request): JsonResponse
    {

        $user = User::where('username', $request->username)->firstOrFail();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->errorResponse('Invalid credentials', 401);
        }

        $token = $user->createToken($request->username)->plainTextToken;

        return $this->successResponse('login', (object) [
            'status' => 'success',
            'message' => 'Login success',
            'token' => $token,
        ], 200);

    }

    function register(RegisterRequest $request): JsonResponse
    {
        $user = app(Register::class)->execute($request);

        $response = new AuthenticatedResource($user);

        return $this->successResponse('create users', $response, 201);
    }

    function logout(): JsonResponse
    {
        $user = Auth::user();
        $user->tokens()->delete();

        return response()->json([
            'status' => 'success',
            'messages' => 'berhasil logout',
        ], 200);

    }
}
