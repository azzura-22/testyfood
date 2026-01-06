<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Gambar;
use App\Models\Gambartentang;
use App\Models\Tentang;
use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    //
    public function index(){
        $data['utama'] = Berita::latest()->first();
        $data['lainnya'] = Berita::latest()->skip(1)->take(4)->get();
        $data['gambar'] = Gambar::latest()->take(6)->get();
        $data['tentang'] = Tentang::with('gambartentangs')->get();
        return view('home',$data);
    }
    public function kontakKami(){
        return view('kontakKami');
    }
    public function berita(){
        $data ['utama'] = Berita::latest()->first();
        $data ['lainnya'] = Berita::latest()->skip(1)->take(8)->get();
        $data ['ratingSum'] = Berita::withSum('komentars', 'rating')->get();
        return view('berita',$data);
    }

    // register
    public function register (){
        return view('register');
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:3|confirmed',
        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'role'=>'user',
        ]);

        return redirect()->route('login')->with('success','Akun berhasil dibuat. Silakan login.');
    }
}
