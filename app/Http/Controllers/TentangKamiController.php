<?php

namespace App\Http\Controllers;

use App\Models\TentangKami;
use Illuminate\Http\Request;

class TentangKamiController extends Controller
{
    public function indexDapur(Request $request)
    {
        $query = TentangKami::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $tentangkamis = $query->paginate(4);
        return view('dapur.tentangkami.index', compact('tentangkamis'));
    }

    public function tambahtentangkami(){
        return view('dapur.tentangkami.store');
    }

    public function store(Request $request)
    {
    $request->validate([
        'judul' => 'required|string|max:255',
        'konten' => 'required',
    ]);

    $kontenArray = array_filter(array_map('trim', explode("\n", $request->konten)));

    TentangKami::create([
        'judul' => $request->judul,
        'konten' => $kontenArray,
    ]);

    TentangKami::updateTentangKamiSeeder();

    return redirect()->route('dapurtentangkami')->with('success', 'Data berhasil diunggah.');
    }


    public function edit(string $id)
    {
        $tentangkami = TentangKami::findOrFail($id);
        return view('dapur.tentangkami.edit', compact('tentangkami'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required',
        ]);

        $tentangkami = TentangKami::findOrFail($id);
        $kontenArray = array_filter(array_map('trim', explode("\n", $request->konten)));
        $tentangkami->update([
            'judul' => $request->judul,
            'konten' => $kontenArray,
        ]);

        TentangKami::updateTentangKamiSeeder();
        $tentangkami->save();

        return redirect()->route('dapurtentangkami')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
    $tentangkami = TentangKami::findOrFail($id);

    $tentangkami->delete();
    TentangKami::updateTentangKamiSeeder();
    
    return redirect()->route('dapurtentangkami')->with('success', 'Data berhasil dihapus.');
    }
}