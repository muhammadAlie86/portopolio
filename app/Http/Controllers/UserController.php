<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\ApiResponder;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    use ApiResponder;

    /**
     * Menampilkan daftar semua user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Ambil semua user, eager load created_by dan updated_by jika ada
        $users = User::with(['updater:id,name'])->latest()->get();
        return $this->successResponse($users, 'Users fetched successfully');
    }

    /**
     * Menyimpan user baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => ['required', Rule::in(['admin', 'user'])], // Role harus admin atau user
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role'],
            'created_by' => Auth::id(), // Simpan ID admin yang membuat user ini
        ]);

        // Kirim response sukses
        return $this->successResponse($user, 'User created successfully', 201);
    }

    /**
     * Mengaktifkan atau menonaktifkan user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleActive(User $user)
    {
        // Admin tidak bisa menonaktifkan dirinya sendiri
        if (Auth::id() === $user->id) {
            return $this->errorResponse('You cannot deactivate your own account.', 403);
        }

        $user->is_active = !$user->is_active;
        $user->updated_by = Auth::id(); // Catat siapa yang mengubah
        $user->save();

        $message = $user->is_active ? 'User activated successfully.' : 'User deactivated successfully.';
        return $this->successResponse($user, $message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'username' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['sometimes', 'required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'sometimes|nullable|string|min:8',
            'role' => ['sometimes', 'required', Rule::in(['admin', 'user'])],
        ]);

        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        return $this->successResponse($user, 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user)
    {
        if (Auth::id() === $user->id) {
            return $this->errorResponse('You cannot delete your own account.', 403);
        }

        $user->delete();

        return $this->successResponse(null, 'User deleted successfully');
    }
}
