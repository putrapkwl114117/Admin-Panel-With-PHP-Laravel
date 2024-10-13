<?php

namespace App\Http\Controllers;

use App\Models\User; 
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function showAdminPanel()
    {
        $uniqueId = Str::random(8); // Membuat ID acak sepanjang 8 karakter
        return view('admin', compact('uniqueId')); // Kirim ke view
    }
     // Menampilkan semua pengguna (hanya untuk admin)
    public function index()
    {
        $this->authorize('viewAny', User::class); 
        return response()->json(User::all(), 200); 
    }

    public function create()
    {
        return view('admin'); 
    }
    
    // Menambah pengguna baru (hanya untuk admin)
    public function store(Request $request)
    {
        $this->authorize('create', User::class); 

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // Validasi password minimal 8 karakter dan harus sama dengan konfirmasi
            'role' => 'required|string|in:user,admin',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']); // Enkripsi password

        try {
        // Membuat pengguna baru
        $user = User::create($validatedData); 

        // Mengembalikan respons JSON
        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ], 201); // Mengembalikan status 201 Created
        } catch (\Exception $e) {
            // Mengembalikan respons JSON jika gagal
            return response()->json([
                'error' => 'Failed to create user: ' . $e->getMessage()
            ], 500); // Mengembalikan status 500 Internal Server Error
        }
    }


    public function show($id)
    {
        $user = User::findOrFail($id); // Temukan pengguna berdasarkan ID
        $this->authorize('view', $user); // Cek otorisasi

        // Cek apakah permintaan menginginkan respons JSON
        if (request()->wantsJson()) {
            // Kembalikan respons JSON dengan detail pengguna
            return response()->json([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ], 200);
        } else {
            // Jika permintaan bukan JSON, lakukan pengalihan ke halaman profil pengguna atau halaman lain
            return redirect()->route('admin.users.index')->with('user', $user);
        }
    }

 // Mengupdate pengguna (pengguna dapat mengupdate dirinya sendiri atau admin dapat mengupdate pengguna lain)
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id); 
        // Jika pengguna bukan admin, pastikan dia hanya bisa mengupdate datanya sendiri
        if (auth()->user()->id !== $user->id) {
            $this->authorize('update', $user);
        }

        // Validasi data yang diterima
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|string|in:user,admin',
        ]);

        // Mengupdate data pengguna
    $user->update($validatedData);

    // Cek apakah permintaan datang dari API
    if ($request->wantsJson()) {
        return response()->json([
            'message' => 'User updated successfully!',
            'user' => $user // Kembalikan data pengguna yang telah diperbarui
        ], 200); // Mengembalikan status 200 OK
    }

    // Jika bukan permintaan API, alihkan ke view
    return redirect()->route('admin.panel')->with('success', 'User updated successfully!'); 
    }
 
    // Menghapus pengguna
    public function destroy($id)
    {
        $user = User::findOrFail($id); 

        // Jika pengguna bukan admin, pastikan dia hanya bisa menghapus dirinya sendiri
        if (auth()->user()->isAdmin()) {
            $this->authorize('delete', $user); 
        } else {
            if (auth()->user()->id !== $user->id) {
                abort(403); 
            }
        }

        $user->delete(); 
        // Cek jika permintaan datang dari API
        if (request()->expectsJson()) {
            return response()->json(['message' => 'User deleted successfully.'], 200);
        }
        return redirect()->route('admin.panel')->with('success', 'User deleted successfully.'); 
    }


// Mencari pengguna berdasarkan nama
    public function search(Request $request)
    {
        $query = $request->query('query'); 

        if (auth()->user()->isAdmin()) {
            $users = User::where('name', 'LIKE', "%{$query}%")->get();

            // Cek jika permintaan datang dari API
            if ($request->expectsJson()) {
                return response()->json($users, 200); // Mengembalikan daftar pengguna dalam format JSON
            }

            return view('admin', compact('users')); // Jika bukan dari API, kembalikan view
        } else {
            return response()->json(['error' => 'Unauthorized'], 403); // Akses ditolak untuk pengguna biasa
        }
    }


}