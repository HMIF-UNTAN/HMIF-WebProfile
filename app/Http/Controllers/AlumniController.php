<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlumniTerverifikasiMail;
use App\Mail\NotifikasiAlumniBaru;

class AlumniController extends Controller
{   
    public function index()
    {
        // Ambil semua angkatan unik dari tabel alumni
        $angkatans = Alumni::select('angkatan')->where('status_verifikasi', true)->distinct()->orderBy('angkatan', 'desc')->pluck('angkatan');

        // Ambil semua alumni dan kelompokkan berdasarkan angkatan
        $alumniByAngkatan = Alumni::where('status_verifikasi', true)
            ->orderBy('nama_lengkap')
            ->get()
            ->groupBy('angkatan');

        return view('alumni.index', compact('angkatans', 'alumniByAngkatan'));
    }


    public function form()
    {
        return view('alumni.daftar');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required',
            'nim' => 'required|unique:alumni',
            'angkatan' => 'required|integer',
            'email' => 'required|email|unique:alumni',
            'no_hp' => 'required',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nim.required' => 'NIM wajib diisi.',
            'nim.unique' => 'NIM ini sudah terdaftar.',
            'angkatan.required' => 'Angkatan wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah digunakan.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
        ]);

        $alumni = \App\Models\Alumni::create($validated);

        // Kirim email notifikasi ke admin HMIF
        Mail::to('hmif@informatika.untan.ac.id')->send(new NotifikasiAlumniBaru($alumni));

        return redirect()->back()->with('success', 'Pendaftaran berhasil! Tunggu verifikasi dari admin.');
    }

    public function indexDapur()
    {
       $alumniBelumVerifikasi = Alumni::where('status_verifikasi', false)->latest()->get();

        return view('dapur.alumni.index', compact('alumniBelumVerifikasi'));
    }

    public function verifikasi($id)
    {
        $alumni = Alumni::findOrFail($id);
        $alumni->status_verifikasi = true;
        $alumni->save();

        Mail::to($alumni->email)->send(new AlumniTerverifikasiMail($alumni));
        return redirect()->route('dapuralumni')->with('success', 'Alumni berhasil diverifikasi.');
    }
}

