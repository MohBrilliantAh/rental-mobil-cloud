<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Wajib import ini untuk menelepon API

class LandingPageController extends Controller
{
    public function index()
    {
        // 1. API GOLANG KEMARIN (localhost:8081/mobil)
        // Laravel bertindak sebagai 'client' untuk mengambil data
        $response = Http::get('http://localhost:8081/mobil');

        // 2. TANGKAP HASILNYA & UBAH JADI ARRAY PHP
        if ($response->successful()) {
            $dataFromApi = $response->json()['data']; // Ambil array 'data'-nya saja
        } else {
            $dataFromApi = []; // Jika gagal, kirim array kosong agar UI tidak crash
        }

        // 3. KIRIM DATA KE VIEW BLADE
        return view('welcome', compact('dataFromApi'));
    }
}