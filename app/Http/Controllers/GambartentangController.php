<?php

namespace App\Http\Controllers;

use App\Models\Gambartentang;
use Illuminate\Http\Request;

class GambartentangController extends Controller
{
    //
    public function add ( Request $request , $id){
        $validate = $request->validate ([
            'nama_file' => 'required|file|mimes:jpg,jpeg,png|max:5120',
            'tipe' => 'required|in:profil,visi,misi',
        ]);
        if ( $request->hasFile('nama_file')){
            $file = $request->file('nama_file');
            $filename = time() .'-'. $validate['tipe'].'.'.$file->getClientOriginalExtension();
            $file->storeAs('tentang', $filename, 'public');
        }
        Gambartentang::create([
            'nama_file'=>$filename,
            'tipe'=>$request->tipe,
            'tentang_id'=>$id,
        ]);
        return redirect()->route('admin.perusahaan')->with('success','Gambar Tentang Perusahaan Berhasil Ditambahkan');
    }
    public function delete($id){
        $gambartentang = Gambartentang::findOrFail($id);
        if (file_exists(storage_path('app/public/tentang/'.$gambartentang->nama_file))){
            unlink(storage_path('app/public/tentang/'.$gambartentang->nama_file));
        }
        $gambartentang->delete();
        return redirect()->route('admin.perusahaan')->with('success','Gambar Tentang Perusahaan Berhasil Dihapus');
    }
}
