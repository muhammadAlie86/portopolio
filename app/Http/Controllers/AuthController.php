<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponder; // <-- 1. Impor Trait
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use ApiResponder; // <-- 2. Gunakan Trait

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            // Gunakan errorResponse dari Trait (contoh)
            return $this->errorResponse('The provided credentials do not match our records.', 401);
        }

        $user = $request->user();

        // Tambahkan pengecekan is_active
        if (!$user->is_active) {
            Auth::logout(); // Pastikan user logout jika tidak aktif
            return $this->errorResponse('Your account is inactive. Please contact support.', 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        // 3. Ubah response sukses menggunakan method dari Trait
        $data = [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ];

        return $this->successResponse($data, 'Login successful');
    }
}