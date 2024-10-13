<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

   // Melihat semua postingan (Admin dan User bisa mengakses)
    public function index()
    {
        $posts = Post::all();

        // Kembalikan dalam format JSON yang sesuai
        return response()->json([
            'data' => $posts, // Pastikan untuk mengemas data dalam objek
        ], 200);
    }

    
    public function show($id)
    {
        $post = Post::findOrFail($id); 
        return view('posts_show', compact('post'));
    }

    // Menambah postingan baru (Hanya Admin)
    public function store(Request $request)
        {
            $validatedData = $request->validate([
                'produk_name' => 'required|string|max:255',
                'descripsi' => 'required|string',
                'price' => 'required|numeric',
                'stock' => 'required|integer',
                'path' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048', // Validasi untuk gambar
            ]);

            $post = new Post();
            $post->user_id = auth()->id();
            $post->produk_name = $validatedData['produk_name'];
            $post->descripsi = $validatedData['descripsi'];
            $post->price = $validatedData['price'];
            $post->stock = $validatedData['stock'];

            // Mengupload gambar
            if ($request->hasFile('path')) {
                $filePath = $request->file('path')->store('images', 'public');
                $post->path = $filePath;
            }

            $post->save();

            return response()->json($post);
        }
        

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('update', $post);

        // Validasi input
        $validatedData = $request->validate([
            'produk_name' => 'sometimes|string|max:255',
            'descripsi' => 'sometimes|string',
            'price' => 'sometimes|numeric|min:0',
            'stock' => 'sometimes|integer|min:0',
            'new_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        // Mengupdate data postingan
        $post->produk_name = $validatedData['produk_name'] ?? $post->produk_name;
        $post->descripsi = $validatedData['descripsi'] ?? $post->descripsi;
        $post->price = $validatedData['price'] ?? $post->price;
        $post->stock = $validatedData['stock'] ?? $post->stock;

        // Periksa apakah ada gambar baru yang diunggah
        if ($request->hasFile('new_image')) { 
            // Menghapus gambar lama jika ada
            if ($post->path && file_exists(public_path('storage/' . $post->path))) {
                unlink(public_path('storage/' . $post->path));
            }
            // Menyimpan gambar baru
            $filePath = $request->file('new_image')->store('images', 'public'); 
            $post->path = $filePath; 
        }

        $post->save();

        // Cek apakah permintaan menginginkan respons JSON
        if ($request->wantsJson()) {
            // Respons JSON saat berhasil mengupdate
            return response()->json([
                'message' => 'Post updated successfully!',
                'post' => [
                    'id' => $post->id,
                    'produk_name' => $post->produk_name,
                    'descripsi' => $post->descripsi,
                    'price' => $post->price,
                    'stock' => $post->stock,
                    'path' => $post->path,
                    'updated_at' => $post->updated_at,
                ]
            ], 200);
        } else {
            // Jika tidak menginginkan JSON, kembalikan ke halaman index
            return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully!');
        }
    }



        public function edit($id)
    {
        // Ambil postingan berdasarkan ID
        $post = Post::findOrFail($id);
        return view('update_produk', [
            'post' => $post,
            'current_image' => asset('storage/' . $post->path), // Path untuk menampilkan gambar yang sudah ada
        ]);
    }

   public function destroy($id, Request $request)
    {
        try {
            $post = Post::findOrFail($id);
            $this->authorize('delete', $post); // Cek otorisasi

            // Menghapus postingan
            $post->delete();

            // Cek apakah permintaan menginginkan respons JSON
            if ($request->wantsJson()) {
                // Respons JSON saat berhasil menghapus
                return response()->json([
                    'message' => 'Post deleted successfully!'
                ], 200); // Mengembalikan kode status 200 untuk sukses
            } else {
                // Redirect ke halaman yang diinginkan dengan pesan sukses
                return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully!');
            }

        } catch (\Exception $e) {
            // Jika terjadi kesalahan (misalnya tidak ditemukan atau kesalahan database)

            // Cek apakah permintaan menginginkan respons JSON
            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Error deleting post: ' . $e->getMessage()
                ], 500); // Mengembalikan kode status 500 untuk kesalahan server
            } else {
                // Redirect ke halaman dengan pesan error
                return redirect()->route('admin.posts.index')->with('error', 'Error deleting post: ' . $e->getMessage());
            }
        }
    }


  // Mencari post berdasarkan nama produk atau deskripsi
    public function searchPosts(Request $request)
    {
        $query = $request->input('query');
        
        // Cari postingan
        $posts = Post::where('produk_name', 'like', "%{$query}%")
                    ->orWhere('descripsi', 'like', "%{$query}%")
                    ->get();

        // Cek apakah ada hasil
        if ($posts->isEmpty()) {
            return response()->json([
                'message' => 'Tidak ada postingan yang ditemukan.',
                'data' => []
            ], 404); // Mengembalikan kode status 404 jika tidak ada hasil
        }

        // Jika ada hasil, kembalikan postingan dengan pesan sukses
        return response()->json([
            'message' => 'Postingan ditemukan.',
            'data' => $posts
        ], 200); // Mengembalikan kode status 200 jika ada hasil
    }

}