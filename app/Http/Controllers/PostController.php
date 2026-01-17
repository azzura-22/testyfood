<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Symfony\Component\Clock\now;

class PostController extends Controller
{
    //
    public function index($id){
        $data['profile']= Post::where('user_id',$id)->first();
        return view('postingUser',$data);
    }
    public function store(Request $request){
        $validate = $request->validate([
            'bio'=>'required',
            'image_path'=>'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'usia'=>'required',
            'gender'=>'required|in:laki-laki,perempuan',
        ]);
        if ($request->hasFile('image_path')){
            $foto = $request->file('image_path');
            $filename = time() .'-'.$request->user()->id.'.'.$foto->getClientOriginalExtension();
            $foto->storeAs('postImages', $filename, 'public');
        } else {
            $filename = null;
        }
        Post::create([
            'user_id'=>$request->user()->id,
            'bio'=>$request->bio,
            'image_path'=>$filename,
            'usia'=>$request->usia
        ]);
        return redirect()->route('posting.index')->with('success','Postingan berhasil dibuat');
    }
    public function edit(Request $request, $id){
        $post = Post::findOrFail($id);
        $validate = $request->validate([
            'bio'=>'required',
            'image_path'=>'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'usia'=>'required',
            'gender'=>'required|in:laki-laki,perempuan',
        ]);
        if ($request->hasFile('image_path')){
            $foto = $request->file('image_path');
            $filename = time() .'-'.$request->user()->id.'.'.$foto->getClientOriginalExtension();
            $foto->storeAs('postImages', $filename, 'public');
            $post->image_path = $filename;
        }else {
            $filename = $post->image_path;
        }
        Post::where('id',$id)->update([
            'bio'=>$request->bio,
            'image_path'=>$filename,
            'usia'=>$request->usia
        ]);
        return redirect()->back()->with('success','Postingan berhasil diupdate');
    }
    public function add(){
        $data = Berita::where('author',Auth::User()->name)->get();

        return view('kelolaPost',compact('data'));
    }

    public function profile($id){
        $post = Post::where('user_id',$id)->first();
        return view('editProfile',compact('post'));
    }
    public function berita(Request $request){
       $validate = $request->validate([
            'judul'=>'required',
            'isi'=>'required',
            'gambar'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
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
            'author'=>Auth::User()->name,
            'tanggal'=> now(),
            'kategori'=>$request->kategori,
        ]);
        return redirect()->back()->with('success','Berita berhasil ditambahkan');
    }

    public function ubah (Request $request, $id)
    {
        $berita = Berita::findOrFail($id);
        $validate = $request->validate([
            'judul'=>'required',
            'isi'=>'required',
            'gambar'=>'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
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
        $berita->author = Auth::User()->name;
        $berita->tanggal = now();
        $berita->kategori = $request->kategori;
        $berita->save();

        return redirect()->back()->with('success','Berita berhasil diupdate');
    }

        public function destroy($id)
    {
        Berita::findOrFail($id)->delete();
        return back()->with('success', 'Postingan berhasil dihapus');
    }
}
