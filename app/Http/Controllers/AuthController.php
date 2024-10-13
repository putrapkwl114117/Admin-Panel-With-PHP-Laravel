<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Register (Hanya untuk admin)
    public function register(Request $request)
    {
        // Memastikan hanya admin yang bisa mengakses pendaftaran
        $this->authorize('register', User::class); 
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:user,admin',
        ]);

        // Buat pengguna baru
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => $validatedData['role'], 
        ]);
        
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
        ], 201); // HTTP status code 201 untuk Created
    }


     public function login(Request $request)
    {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'The provided credentials do not match our records.'
        ], 401);
    }

    // Membuat token untuk pengguna
    $token = $user->createToken('auth_token')->plainTextToken;

    // Jika request berasal dari Postman atau aplikasi lain, kembalikan JSON
    if ($request->expectsJson()) {
        return response()->json([
            'message' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ]
        ]);
    }

    // Melakukan login untuk sesi web
    Auth::login($user);

    // Jika admin, redirect ke halaman admin
    if ($user->role === 'admin') {
        return redirect()->route('admin.panel');
    }

    // Jika user biasa, redirect ke halaman home (bisa diubah sesuai kebutuhan)
    return redirect()->route('home');
    }


    // Logout
    // public function logout(Request $request)
    // {
    //     // Menghapus semua token untuk pengguna yang sedang login
    //     $request->user()->tokens()->delete();

    //     // Mengembalikan respons JSON
    //     return response()->json(['message' => 'Logged out successfully'], 200);
    // }

    // // Logout
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return redirect()->route('login');
        return response()->json(['message' => 'Logged out successfully']);
    }
}