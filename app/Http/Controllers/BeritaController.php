<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;

class BeritaController extends Controller
{
    //
    public function add(Request $request){
       $validate = $request->validate([
            'judul'=>'required',
            'isi'=>'required',
            'gambar'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'author'=>'required',
            'tanggal'=>'required',
            'kategori'=>'required',
        ]);

        if ($request->hasFile('gambar')){
            $foto = $request->file('gambar');
            $filename = time() .'-'.$validate['judul'].'.'.$foto->getClientOriginalExtension();
            $foto->storeAs('fotoE', $filename, 'public');
        }

        Berita::create([
            'judul'=>$request->judul,
            'isi'=>$request->isi,
            'gambar'=>$filename,
            'author'=>$request->author,
            'tanggal'=>$request->tanggal,
            'kategori'=>$request->kategori,
        ]);
        return redirect()->route('admin.berita')->with('success','Berita berhasil ditambahkan');
    }

    public function delete ($id){
        try{
            $id = decrypt($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('admin.berita')->with('error','ID tidak valid');
        }
        $berita = Berita::findOrFail($id);
        $berita->delete();
        return redirect()->route('admin.berita')->with('success','Berita berhasil dihapus');
    }

    public function edit (Request $request, $id)
    {
        $berita = Berita::findOrFail($id);
        $validate = $request->validate([
            'judul'=>'required',
            'isi'=>'required',
            'gambar'=>'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'author'=>'required',
            'tanggal'=>'required',
            'kategori'=>'required',
        ]);

        if ($request->hasFile('gambar')){
            $foto = $request->file('gambar');
            $filename = time() .'-'.$validate['judul'].'.'.$foto->getClientOriginalExtension();
            $foto->storeAs('fotoE', $filename, 'public');
            $berita->gambar = $filename;
        }

        $berita->judul = $request->judul;
        $berita->isi = $request->isi;
        $berita->author = $request->author;
        $berita->tanggal = $request->tanggal;
        $berita->kategori = $request->kategori;
        $berita->save();

        return redirect()->route('admin.berita')->with('success','Berita berhasil diupdate');
    }
    public function show($id)
    {
        try{
            $id = decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->route('berita')->with('error','ID tidak valid');
        }
        $berita = Berita::findOrFail($id);

        $komentar = Komentar::where('berita_id',$berita->id)
            ->orderBy('created_at','desc')
            ->get();

        $ratingSum = Komentar::where('berita_id',$berita->id)
            ->sum('rating');
        $ratingCount = Komentar::where('berita_id',$berita->id)
            ->count();
        return view('detail', compact('berita','komentar'));
    }
}
