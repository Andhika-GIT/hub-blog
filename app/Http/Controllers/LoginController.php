<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function auth(Request $request)
    {
        // buat validasi login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // check jika login sesuai
        // check config\auth.php untuk default model autentikasinya (default model sekarang adalah model user)
        if(Auth::attempt($credentials)) {

            // generate ulang session, untuk mencegah penyerangan session sama
            $request->session()->regenerate();

            // alihkan ke intended(middleware) kemudian ke halaman dashboard
            return redirect()->intended('/dashboard');
        }

        // jika salah, kembali ke halaman login dengan flashmeessage(with)
        return back()->with('loginError','Login Failed!');
    }

    public function logout(Request $request)
    {
        // jalankan fungsi logout lewat link yang sudah di impor
        Auth::logout();

        // invalidate session agar sudah tidak dipakai ulang
        $request->session()->invalidate();

        // bikin baru session agar tidak dibajak
        $request->session()->regenerateToken();

        // kembalikan ke halaman awal
        return redirect('/');
    }
}
