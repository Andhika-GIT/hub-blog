<?php

use App\Http\Controllers\AdminCategoryController;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home', [
        'title' => 'Home',
        'active' => 'home'
    ]);
});
Route::get('/about', function () {
    return view('about', [
        'title' => 'About',
        'active' => 'about',
        "nama" => 'Andhika',
        "email" => "andhika@gmail.com"
    ]);
});

Route::get('/posts', [PostController::class, 'index']);

// halaman single posts
Route::get('posts/{post:slug}', [PostController::class, 'show']);

// halaman info kategori
Route::get('/categories', function() {
    return view('categories', [
        'title' => 'Post Categories',
        'active' => 'categories',
        'categories' => Category::all()    
    ]);
});

// halaman login
// terapkan middleware dengan nama 'guest'-> artinya halaman login hanya bisa diakses oleh user yang belom login(jika sudah login, halamannya tidak bisa diakses) 
// ganti route default di App\providers\routeserviceprovider
// namakan route dengan nama 'login' [ name('nama route') ]
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login',  [LoginController::class, 'auth']);
// logout post
Route::post('logout', [LoginController::class, 'logout']);

// halaman register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

// halaman dashboard(setelah Login)
// terapkan middleware dengan nama 'auth'-> artinya halaman dashboard hanya bisa diakses oleh user yang sudah login(jika belom login, tidak bisa akses)
Route::get('/dashboard', function() {
    return view('dashboard.index');
})->middleware('auth');

Route::get('/dashboard/posts/createSlug', [DashboardPostController::class, 'createSlug'])->middleware('auth');
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

// halaman category admin
// memakai except untuk method show (karena method show tidak dipakai)
// atur Authorization di controller
Route::resource('/dashboard/categories', AdminCategoryController::class)->middleware('admin')->except('show');






// routes dibawah tidak digunakan, karena sudah ditangani dengan request scope di model Post

// halaman ke info kategory
// Route::get('/categories/{category:slug}', function(Category $category){
//     return view('posts', [
//         'title' => "Post by Category : $category->name",
//         'active' => 'categories',
//         'posts' => $category->posts->load('category','author'),
//     ]);
// });

// Route::get('authors/{author:username}', function(User $author) {
//     return view('posts', [
//         'title' => "Post by Author : $author->name",
//         'posts' => $author->posts->load('category','author')
//     ]);
// });
