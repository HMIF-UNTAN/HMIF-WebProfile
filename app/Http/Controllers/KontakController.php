<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        return view('kontak');
    }

    public function indexDapur()
    {
        $kontak = Kontak::first();
        return view('dapur.kontak.index', compact('kontak'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'alamat' => 'required|string',
            'narahubung_nama' => 'required|string',
            'narahubung_kontak' => 'required|string',
            'email' => 'required|email',
        ]);

        $kontak = Kontak::findOrFail($id);
        $kontak->update($request->all());

        return redirect()->route('dapurkontak')->with('success', 'Kontak HMIF berhasil diperbarui.');
    }
}
