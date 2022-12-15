<?php

namespace App\Http\Controllers;

// request untuk menangkap isi url (get atau Post)
use Illuminate\Http\Request;
// ambil model untuk input data user
use App\Models\User;
// ambil class hash untuk password
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            'title' => 'Register',
            'active' => 'register'
        ]);
    }

    public function store(Request $request)
    {
        // validasi (baca dokumentasi laravel)
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required','min:3','max:255','unique:users'],
            // email:dns -> memastikan email mempunyai ('.com') dibelakang ( ex : dhika@gmail.com)
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        // jika validasi berhasil jalankan fungsi dibawah

        // untuk test
        // dd('registrasi berhasil');

        // enkripsi password
        $validatedData['password'] = Hash::make($validatedData['password']);


        // masukkan semua ke database
        User::create($validatedData);

        // buat session flash message ( flash('nama pesan','isi pesan') )
        // $request->session()->flash('success','Registration successfull, please login');

        // atau bikin flash message sambil redirect (CARA KEDUA)
        // alihkan ke halaman login dengan membawa flash message { ->with('nama pesan','isi pesan') }
        return redirect('/login')->with('success','Registration successfull, please login');
    }
}
