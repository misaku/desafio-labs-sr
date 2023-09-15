<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/auth",
     *     summary="Authenticate user and generate JWT token",
     *
     *     @OA\RequestBody(
     *
     *           @OA\JsonContent(
     *              required={"email", "password", "device_name"},
     *
     *              @OA\Property(property="email", type="string", format="email", example="usuario@example.com"),
     *              @OA\Property(property="password", type="string", format="password", example="senha123"),
     *              @OA\Property(property="device_name", type="string", format="device_name", example="device_name")
     *          ),
     *      ),
     *
     *     @OA\Response(response="200", description="Login successful"),
     *     @OA\Response(response="401", description="Invalid credentials")
     * )
     */
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        $isValidPassword = Hash::check($request->password, $user->password);

        if (! $user || ! $isValidPassword) {
            throw ValidationException::withMessages(['auth' => 'email ou senha invalido(s)'])->status(Response::HTTP_UNAUTHORIZED);
        }

        $user->tokens()->delete();

        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json([
            'token' => $token,
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/auth/logout",
     *     summary="Authenticate user and generate JWT token",
     *
     *     @OA\Response(response="200", description="Login successful"),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->noContent(Response::HTTP_OK);
    }

    /**
     * @OA\Get(
     *     path="/api/auth/user",
     *     summary="Get logged-in user details",
     *
     *     @OA\Response(response="200", description="Success"),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function user(Request $request)
    {
        return $request->user();
    }
}
