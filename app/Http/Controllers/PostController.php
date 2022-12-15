<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
class PostController extends Controller
{
    public function index()
    {

        $title = '';
        if(request('category')) {
            $category=Category::firstWhere('slug', request('category'));
            $title = ' in ' . $category->name;
        }

        if(request('authors')) {
           $author=User::firstWhere('username', request('authors'));
            $title = ' by ' .$author->name;
        }
        return view('posts', [
            'title' => 'All Posts' . $title,
            'active' => 'posts',
            // 'posts' => Post::all()

            // cara biasa (pastikan solve N+1 ada di model post)
            // kirim request([search]) ke method filter(scopeFilter) di model
            // 'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->get()

            // dengan halaman
            'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(7)

            // menghindari N+1 problem
            // 'posts' => Post::with(['category','author'])->latest()->get()
        ]);
    }

    // baca dokumentasi route model binging
    // public function show (nama_model $nama_variabel_yang_dipassing_diroute_web.php)
    public function show(Post $post)
    {
        return view('post', [
            'title' => 'Single post',
            'active' => 'posts',
            'post' => $post
        ]);
    }
}
