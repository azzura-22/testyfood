<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class userController extends Controller
{
    //
    public function index(){
        return view('user.home');
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
