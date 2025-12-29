<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Gambar;
use App\Models\Kontak;
use App\Models\Tentang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminConteroller extends Controller
{
    //
    public function index(){
        return view('admin.home');
    }
    public function berita(){
        $data['berita'] = Berita::all();
        return view('admin.berita',$data);
    }
    public function kontak()
    {
        $data['masukan'] = Kontak::orderByRaw("
            CASE
                WHEN status = 'belum terbaca' THEN 1
                ELSE 2
            END
        ")->get();

        return view('admin.masukan', $data);
    }
    public function perusahaan(){
        $data['perusahaan'] = Tentang::all();
        return view('admin.perusahaan',$data);
    }
    public function login (){
        return view('login');
    }
    public function Authlogin (Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    public function logout (Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    public function galeri(){
        $data['galeri'] = Gambar::all();
        return view('admin.galeri',$data);
    }
}
