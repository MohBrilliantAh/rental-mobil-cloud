<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Verification;

class AdminController extends Controller
{
    public function index()
    {
        $verifications = Verification::with('user')->where('status', 'pending')->get();
        return view('admin.dashboard', compact('verifications')); 
    }

    public function updateStatus(Request $request, $id)
    {
        // Cari dokumen yang diklik berdasarkan ID
        $verification = Verification::findOrFail($id);

        // Ubah statusnya (menjadi 'approved' atau 'rejected')
        $verification->update([
            'status' => $request->status
        ]);

        // Kembalikan ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Status dokumen berhasil diperbarui!');
    }
}