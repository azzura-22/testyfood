<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Gambar;
use App\Models\Gambartentang;
use App\Models\Kontak;
use App\Models\Tentang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminConteroller extends Controller
{
    //
    public function index(){
        $data['jmlBerita'] = Berita::count();
        $data['jmlGambar'] = Gambar::count();
        $data['jmlMasukan'] = Kontak::count();
        $data['beritaTerbaru'] = Berita::latest()->take(5)->get();
        $data['masukanTerbaru'] = Kontak::latest()->take(5)->get();
        return view('admin.home',$data);
    }
    public function berita(){
        $data['berita'] = Berita::all();
        $data['ratingSum'] = Berita::withSum('komentars', 'rating')->get();
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
        $data['gambartentang'] = Gambartentang::all();
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

            if (Auth::user()->role == 'admin') {
                return redirect()->intended('/admin');
            }

            return redirect()->intended('/');
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
    public function user(Request $request)
{
    $query = User::query();

    if ($request->search) {
        $query->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('email', 'like', '%' . $request->search . '%');
    }

    $users = $query->paginate(10);

    return view('admin.user', compact('users'));
}

}
