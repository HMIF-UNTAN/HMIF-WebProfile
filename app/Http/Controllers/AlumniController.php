<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\AlumniTerverifikasiMail;
use App\Mail\NotifikasiAlumniBaru;

class AlumniController extends Controller
{
    public function index()
    {
        $angkatans = Alumni::select('angkatan')->where('status_verifikasi', 'diterima')->distinct()->orderBy('angkatan', 'desc')->pluck('angkatan');

        $alumniByAngkatan = Alumni::where('status_verifikasi', 'diterima')
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
            // A. Data Pribadi
            'nama_lengkap'       => 'required|string',
            'nama_panggilan'     => 'nullable|string',
            'jenis_kelamin'      => 'required|in:L,P',
            'no_hp'              => 'required|string',
            'email'              => 'required|email|unique:alumni',
            'website_pribadi'    => 'nullable|url',

            // B. Data Akademik
            'nim'                => 'required|string|unique:alumni',
            'angkatan'           => 'required|integer',
            'judul_tugas_akhir'  => 'nullable|string',

            // C. Pekerjaan
            'pekerjaan'          => 'nullable|string',
            'nama_perusahaan'    => 'nullable|string',
            'website_perusahaan' => 'nullable|url',

            // D. Lain-lain
            'facebook'           => 'nullable|url',
            'linkedin'           => 'nullable|url',
            'instagram'          => 'nullable|url',
            'twitter'            => 'nullable|url',
            'minat_motto'        => 'nullable|string',
            'foto'               => 'nullable|image|max:35840',
        ]);

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('alumni/foto', 'public');
        }

        // Set nilai default status_verifikasi
        $validated['status_verifikasi'] = 'pending';

        // Simpan ke database
        $alumni = Alumni::create($validated);

        // Kirim email notifikasi ke admin
        Mail::to('hmif@informatika.untan.ac.id')->send(new NotifikasiAlumniBaru($alumni));

        return redirect()->back()->with('success', 'Pendaftaran berhasil! Tunggu verifikasi dari admin.');
    }


    public function indexDapur()
    {
        $alumniBelumVerifikasi = Alumni::where('status_verifikasi', 'pending')->latest()->get();

        return view('dapur.alumni.index', compact('alumniBelumVerifikasi'));
    }

    public function verifikasi($id)
    {
        $alumni = Alumni::findOrFail($id);
        $alumni->status_verifikasi = 'diterima';
        $alumni->save();

        Mail::to($alumni->email)->send(new AlumniTerverifikasiMail($alumni));
        return redirect()->route('dapuralumni')->with('success', 'Alumni berhasil diverifikasi.');
    }
}
