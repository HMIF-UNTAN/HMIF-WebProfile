<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Kepengurusan;
use App\Models\Pengurus;
use App\Models\TentangKami;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KepengurusanController extends Controller
{
    public function index()
    {
        $daftarDivisi = TentangKami::where('tipe_informasi', 'Divisi')->get();
        $kepengurusan = Kepengurusan::with(['pengurus', 'divisi'])->get();
        $semuaDivisi = Divisi::all();

        // Buat mapping berdasarkan nama divisi
        $pengurusPerDivisiNama = $kepengurusan->groupBy(fn($item) => $item->divisi->nama);

        return view('kepengurusan.index', [
            'daftarDivisi' => $daftarDivisi,
            'pengurusPerDivisiNama' => $pengurusPerDivisiNama,
            'semuaDivisi' => $semuaDivisi,
        ]);
    }

    public function indexDapur()
    {
        $pengurus = Pengurus::with('kepengurusan.divisi')->get();
        return view('dapur.kepengurusan.index', compact('pengurus'));
    }

    public function tambahpengurus()
    {
        $divisiList = Divisi::all();
        return view('dapur.kepengurusan.store', compact('divisiList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'divisi_id' => 'required|exists:divisi,id',
            'jenis_jabatan' => 'required|in:Inti,Anggota',
            'periode' => 'required|string|max:225',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:35840',
        ]);
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoPath = $foto->store('foto_pengurus', 'public');
        }

        $pengurus = Pengurus::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->nim.'@student.untan.ac.id',
            'jenis_jabatan' => $request->jenis_jabatan,
            'foto' => $fotoPath,
        ]);

        Kepengurusan::create([
            'pengurus_id' => $pengurus->id,
            'divisi_id' => $request->divisi_id,
            'jabatan' => $request->jenis_jabatan,
            'periode' => $request->periode,
        ]);

        Pengurus::updatePengurusSeeder();

        return redirect()->route('tambahpengurus')->with('success', 'Pengurus berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pengurus = Pengurus::with('kepengurusan.divisi')->findOrFail($id);
        $divisiList = Divisi::all();

        return view('dapur.kepengurusan.edit', compact('pengurus', 'divisiList'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'jenis_jabatan' => 'required|in:Inti,Anggota',
            'divisi_id' => 'required|exists:divisi,id',
            'periode' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:35840',
        ]);

        $pengurus = Pengurus::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($pengurus->foto && Storage::disk('public')->exists($pengurus->foto)) {
                Storage::disk('public')->delete($pengurus->foto);
            }

            $foto = $request->file('foto');
            $fotoPath = $foto->store('foto_pengurus', 'public');
            $pengurus->foto = $fotoPath;
        }

        $pengurus->update([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'jenis_jabatan' => $request->jenis_jabatan,
            'email' => $request->nim.'@student.untan.ac.id',
        ]);

        $pengurus->kepengurusan->update([
            'divisi_id' => $request->divisi_id,
            'jabatan' => $request->jenis_jabatan,
            'periode' => $request->periode,
        ]);

        Pengurus::updatePengurusSeeder();

        return redirect()->route('dapurpengurus')->with('success', 'Data pengurus berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $pengurus = Pengurus::findOrFail($id);
        $pengurus->kepengurusan()->delete();
        $pengurus->delete();

        Pengurus::updatePengurusSeeder();

        return redirect()->route('dapurartikel')->with('success', 'Artikel berhasil dihapus.');
    }
}
