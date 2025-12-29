<?php

namespace App\Http\Controllers;

use App\Models\Gambar;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;

class GambarController extends Controller
{
    //
    public function index(){
        return view('galeri');
    }
    public function add(Request $request){
     $validate = $request->validate([
        'path'=>'required|file|mimes:jpg,png,jpeg,mp4,mov,avi',
        'tipe'=>'required',
     ]);
        if ($request->hasFile('path')){
            $file = $request->file('path');
            $filename = time() .'-'. $validate['tipe'].'.'.$file->getClientOriginalExtension();
            $file->storeAs('galeri', $filename, 'public');
        }
        Gambar::create([
            'path'=>$filename,
            'tipe'=>$request->tipe,
        ]);
        return redirect()->route('admin.galeri')->with('success','Gambar berhasil ditambahkan');
    }
    public function delete ($id){
        try{
            $id = decrypt($id);
        }catch (DecryptException $e){
            return redirect()->route('admin.galeri')->with('error','ID tidak valid');
        }
        $gambar = Gambar::findOrFail($id);
        if ($gambar->path && file_exists(storage_path('app/public/galeri/' . $gambar->path))) {
            unlink(storage_path('app/public/galeri/' . $gambar->path));
        }
        $gambar->delete();
        return redirect()->route('admin.galeri')->with('success','Gambar berhasil dihapus');
    }
    public function edit (Request $request, $id){
        try{
            $id = decrypt($id);
        }catch (DecryptException $e){
            return redirect()->route('admin.galeri')->with('error','ID tidak valid');
        }
        $gambar = Gambar::findOrFail($id);
        $validate = $request->validate([
            'path'=>'file|mimes:jpg,png,jpeg,mp4,mov,avi',
            'tipe'=>'required',
        ]);
        if ($request->hasFile('path')){
            if ($gambar->path && file_exists(storage_path('app/public/galeri/' . $gambar->path))) {
                unlink(storage_path('app/public/galeri/' . $gambar->path));
            }
            $file = $request->file('path');
            $filename = time() .'-'. $validate['tipe'].'.'.$file->getClientOriginalExtension();
            $file->storeAs('galeri', $filename, 'public');
            $gambar->path = $filename;
        }
        $gambar->tipe = $request->tipe;
        $gambar->save();
        return redirect()->route('admin.galeri')->with('success','Gambar berhasil diupdate');
    }
}
