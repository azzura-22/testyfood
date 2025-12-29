<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    //
    public function markAsRead($id){
        $kontak = Kontak::findOrFail($id);
        $kontak->status = 'terbaca';
        $kontak->save();
        return redirect()->route('admin.masukan')->with('success','Pesan telah ditandai sebagai terbaca');
    }
    public function masukan ( Request $request){

        $request->validate([
            'Name'=>'required|string',
            'Email'=>'required|email',
            'Subject'=>'required|string',
            'Message'=>'required|string',
        ]);

        Kontak::create([
            'nama'=>$request->Name,
            'email'=>$request->Email,
            'subject'=>$request->Subject,
            'pesan'=>$request->Message,
            'status'=>'belum terbaca',
        ]);

        return redirect()->route('kontakKami')->with('success','Pesan Anda telah terkirim');
    }
}
