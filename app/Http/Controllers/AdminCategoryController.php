<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // atur Authorization cara manual
        // jika auth merupakan guest (user belum login) atau jika user yang sudah login usernamenya bukan andhikaprasetya
        // if(auth()->guest() || auth()->user()->username !== 'andhikaprasetya'){
        //     // tampilkan forbidden
        //     abort(403);
        // }


        // atur authorization otomatis dengan membuat middleware sendiri(php artisan make middleware) -> lalu masukkan ke kernel

        // atur authorization dengan gates (gerbang akses) 
        // buat gates di App/providers/AppServiceProviders 
        // gunakan gates di sidebar
        // $this->authorize('admin');
        
        // belajar laravel 8 wpu part 23-> tambahkan field baru isAdmin pada tabel user dengan membuat migrasi baru, agar mempermudah auhtorization ketika ada user yang akan dijadikan admin baru

        return view('dashboard.categories.index', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
