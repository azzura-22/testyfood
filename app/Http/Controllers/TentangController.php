<?php

namespace App\Http\Controllers;

use App\Models\Gambartentang;
use App\Models\Tentang;
use Illuminate\Http\Request;

class TentangController extends Controller
{
    //
    public function add (Request $request){
        $request->validate([
            'nama' => 'required|string',
            'deskripsi' => 'required|string',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'gmail' => 'required|string',
            'no_hp' => 'required|string',
        ]);

        Tentang::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'gmail' => $request->gmail,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('admin.perusahaan')->with('success','Data Tentang Perusahaan Berhasil Ditambahkan');
    }
    public function index(){
        $data['tentang'] = Tentang::all();
        $data['gambartentang'] = Gambartentang::all();
        return view('tentang',$data);
    }
    public function edit(Request $request, $id){
        $tentang = Tentang::findOrFail($id);
        $request->validate([
            'nama' => 'required|string',
            'deskripsi' => 'required|string',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'gmail' => 'required|string',
            'no_hp' => 'required|string',
        ]);

        $tentang->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'gmail' => $request->gmail,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('admin.perusahaan')->with('success','Data Tentang Perusahaan Berhasil Diperbarui');
    }
}
