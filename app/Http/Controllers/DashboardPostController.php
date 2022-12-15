<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.posts.index', [
            // ambil post berdasarkan id yang sudah login(gunakan session global auth() untuk mengambil id login)
            'posts' => Post::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    // mengambil view create halaman
    public function create()
    {
        return view('dashboard.posts.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // mengambil data dari view create halaman
    public function store(Request $request)
    {

        // test upload file(gambar)
        // return $request->file('image')->store('post-images');

        // atur penyimpnan gambar di config/filesystem.php, kemudian di .env
        // hubungkan store public dengan folder public di aplikasi kita, agar gambar bisa diakses dengan php artisan storage:link

        // buat validasi untuk form create post
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            'image' => 'image|file|max:10024',
            'body' => 'required'
        ]);


        // mengecheck apakah ada gambar
        if($request->file('image')) {
            // jika ada gambar, upload ke public/storage
            $validatedData['image'] = $request->file('image')->store('post-image');
        }

        // isi field user id dengan session auth 
        $validatedData['user_id'] = auth()->user()->id;
        // isi excerpt dengan memotong string dari body(baca dokumentasi)
        // strip_tags agar tag html didalam body hilang(untuk masuk database)
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 120);

        Post::create($validatedData);

        // kembali ke halaman post, dengan membawa session flash
        return redirect('/dashboard/posts')->with('success','Post has been added!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */

    //  mengarahkan ke view edit post
    public function edit(Post $post)
    {
        // mengambil slug yang dikirim dari halaman create atau show ke dalam variabel $post
        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */

    //  untuk mengambil data yang diupdate dari halaman edit post
    public function update(Request $request, Post $post)
    {
        // variabel request untuk menangani isi dari form(request data yang disi)
        // variabel post merupakan model dari post


         // buat validasi untuk form edit post
         $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => "required|unique:posts,slug,$post->id",
            'category_id' => 'required',
            'image' => 'image|file|max:10024',
            'body' => 'required'
        ]);

        // mengecheck apakah ada gambar
        if($request->file('image')) {
            // jika ada gambar lama
            if($request->oldImage){
                // hapus gambar lama, agar tidak menumpuk di storage
                Storage::delete($request->oldImage);
            }
             // upload ke public/storage
            $validatedData['image'] = $request->file('image')->store('post-image');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 120);

        // update post dimana id nya yang sudah diterima pada halaman edit
        Post::where('id', $post->id)
            ->update($validatedData);

        // kembali ke halaman post, dengan membawa session flash
        return redirect('/dashboard/posts')->with('success','Post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->oldImage){
            // hapus gambar lama, agar tidak menumpuk di storage
            Storage::delete($post->oldImage);
        }

        // setelah menangkap slug yg dikirim, maka akan dicari id dari slug yang dikirim, lalu menghapus data dari id yang ditemukan
        Post::destroy($post->id);

        // kembali ke halaman post, dengan membawa session flash
        return redirect('/dashboard/posts')->with('success','Post has been deleted!');
    }


    // method untuk menangani fetch data dari halaman create post
    public function createSlug(Request $request)
    {
        // ambil request bernama title yang dikirim dari fetch pada halaman create
        // lalu masukkan ke slug service
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        // kembalikan hasil response dalam bentuk json
        // dengan membawa data bernama 'slug' yang isinya adalah $slug yang sudah terbentuk
        return response()->json(['slug' => $slug]);
    }
}
