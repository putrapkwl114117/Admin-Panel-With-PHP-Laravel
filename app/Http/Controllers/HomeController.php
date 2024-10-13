<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
   public function index(Request $request)
    {
        // Cek apakah ada query pencarian
        $query = $request->input('query');
        
        if ($query) {
            $posts = Post::where('produk_name', 'like', "%{$query}%")
                        ->orWhere('descripsi', 'like', "%{$query}%")
                        ->get();
        } else {
            $posts = Post::all();
        }

        // Cek apakah permintaan menginginkan respons JSON
        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Posts retrieved successfully!',
                'posts' => $posts
            ], 200);
        }

        // Mengembalikan tampilan view jika tidak menginginkan JSON
        return view('home', compact('posts'));
    }

    public function searchRedirect(Request $request)
    {
        $query = $request->input('query');

        // Cek apakah permintaan menginginkan respons JSON
        if ($request->wantsJson()) {
            $posts = Post::where('produk_name', 'like', "%{$query}%")
                        ->orWhere('descripsi', 'like', "%{$query}%")
                        ->get();
            
            // Jika permintaan adalah JSON, kembalikan respons JSON
            return response()->json([
                'message' => 'Search results retrieved successfully!',
                'query' => $query,
                'posts' => $posts
            ], 200);
        }

        // Jika permintaan bukan JSON, lakukan pengalihan (redirect)
        return redirect()->route('home', ['query' => $query]);
    }

}