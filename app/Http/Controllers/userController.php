<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Gambar;
use App\Models\Gambartentang;
use App\Models\Tentang;
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
        return view('berita',$data);
    }
}
