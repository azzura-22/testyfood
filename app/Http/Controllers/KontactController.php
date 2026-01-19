<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kontact;

class KontactController extends Controller
{
    //
    public function index()
    {
        $data['kontact'] = Kontact::first();
        return view('admin.kontak',$data);
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);

        Kontact::create([
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->back()->with('success', 'Kontak berhasil ditambahkan.');
    }
    public function edit(Request $request, $id)
    {
        $kontak = Kontact::findOrFail($id);

        $validated = $request->validate([
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);

        $kontak->update([
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->back()->with('success', 'Kontak berhasil diperbarui.');
    }
    public function delete($id)
    {
        $kontak = Kontact::findOrFail($id);
        $kontak->delete();

        return redirect()->back()->with('success', 'Kontak berhasil dihapus.');
    }
}
