<?php

namespace App\Http\Controllers;
use App\Models\TentangKami;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $himpunanInfo = TentangKami::where('judul', 'Himpunan Mahasiswa Informatika')->first();

        return view('index', compact('himpunanInfo'));
    }
}
