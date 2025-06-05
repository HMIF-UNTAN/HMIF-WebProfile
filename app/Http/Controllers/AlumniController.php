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
            'nama_lengkap'       => 'required|string|max:255',
            'nama_panggilan'     => 'nullable|string|max:100',
            'jenis_kelamin'      => 'required|in:L,P',
            'no_hp'              => 'required|string|max:20',
            'email'              => 'required|email|unique:alumni,email',
            'website_pribadi'    => 'nullable|url|max:255',

            // B. Data Akademik
            'nim'                => 'required|string|unique:alumni,nim|max:50',
            'angkatan'           => 'required|integer|min:1900|max:' . date('Y'),
            'judul_tugas_akhir'  => 'nullable|string|max:255',

            // C. Pekerjaan
            'pekerjaan'          => 'nullable|string|max:255',
            'nama_perusahaan'    => 'nullable|string|max:255',
            'website_perusahaan' => 'nullable|url|max:255',

            // D. Lain-lain
            'facebook'           => 'nullable|url|max:255',
            'linkedin'           => 'nullable|url|max:255',
            'instagram'          => 'nullable|url|max:255',
            'twitter'            => 'nullable|url|max:255',
            'minat_motto'        => 'nullable|string|max:500',
            'foto'               => 'nullable|image|max:35840', // max 35MB

            // E. Pendidikan Terakhir
            'pendidikan'                         => 'nullable|array|min:1',
            'pendidikan.*.jenjang'               => 'nullable|in:D3,D4,S1,S2,S3',
            'pendidikan.*.universitas'           => 'nullable|string|max:255',
            'pendidikan.*.tahun_masuk'           => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
            'pendidikan.*.tahun_lulus'           => 'nullable|digits:4|integer|min:1900|max:' . (date('Y') + 5),
            'pendidikan.*.judul_karya_akhir'    => 'nullable|string|max:255',
        ]);

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('alumni/foto', 'public');
        } else {
            $fotoPath = null;
        }

        // Simpan data alumni tanpa pendidikan dulu
        $alumni = Alumni::create([
            'nama_lengkap'       => $validated['nama_lengkap'],
            'nama_panggilan'     => $validated['nama_panggilan'] ?? null,
            'jenis_kelamin'      => $validated['jenis_kelamin'],
            'no_hp'              => $validated['no_hp'],
            'email'              => $validated['email'],
            'website_pribadi'    => $validated['website_pribadi'] ?? null,
            'nim'                => $validated['nim'],
            'angkatan'           => $validated['angkatan'],
            'judul_tugas_akhir'  => $validated['judul_tugas_akhir'] ?? null,
            'pekerjaan'          => $validated['pekerjaan'] ?? null,
            'nama_perusahaan'    => $validated['nama_perusahaan'] ?? null,
            'website_perusahaan' => $validated['website_perusahaan'] ?? null,
            'facebook'           => $validated['facebook'] ?? null,
            'linkedin'           => $validated['linkedin'] ?? null,
            'instagram'          => $validated['instagram'] ?? null,
            'twitter'            => $validated['twitter'] ?? null,
            'minat_motto'        => $validated['minat_motto'] ?? null,
            'foto'               => $fotoPath,
            'status_verifikasi'  => 'pending',
        ]);

        // Simpan data pendidikan (multiple)
        foreach ($validated['pendidikan'] as $pendidikan) {
            // Cek apakah entri benar-benar diisi
            if (
                !empty($pendidikan['universitas']) &&
                !empty($pendidikan['tahun_masuk']) &&
                !empty($pendidikan['tahun_lulus'])
            ) {
                $alumni->pendidikan()->create([
                    'jenjang'           => $pendidikan['jenjang'],
                    'universitas'       => $pendidikan['universitas'],
                    'tahun_masuk'       => $pendidikan['tahun_masuk'],
                    'tahun_lulus'       => $pendidikan['tahun_lulus'],
                    'judul_karya_akhir' => $pendidikan['judul_karya_akhir'] ?? null,
                ]);
            }
        }


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
