<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    //
    public function komentar(Request $request){
        $request->validate([
            'berita_id'=>'required|exists:beritas,id',
            'rating' => 'required|numeric',
            'komentar'=>'required|string',
        ]);
        Komentar::create([
            'berita_id'=>$request->berita_id,
            'nama'=> Auth::user()->name,
            'email'=> Auth::user()->email,
            'rating'=>$request->rating,
            'komentar'=>$request->komentar,
        ]);
        return redirect()->back()->with('success','Komentar berhasil ditambahkan');
    }
}
