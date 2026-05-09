<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Verification;
use Illuminate\Support\Facades\Hash;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat 1 Pemilik Mobil
        $owner = User::create([
            'name' => 'Budi Pemilik',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'car_owner'
        ]);

        // Masukkan dokumen KTP Budi ke antrean (Status: Pending)
        Verification::create([
            'user_id' => $owner->id,
            'document_type' => 'ktp',
            'file_url' => 'https://dummyimage.com/600x400/2563eb/fff&text=KTP+Budi', // Ini seolah-olah URL dari Cloud Object Storage
            'status' => 'pending'
        ]);

        // 2. Buat 1 Penyewa
        $renter = User::create([
            'name' => 'Siti Penyewa',
            'email' => 'siti@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'renter'
        ]);

        // Masukkan dokumen SIM Siti ke antrean (Status: Pending)
        Verification::create([
            'user_id' => $renter->id,
            'document_type' => 'sim_a',
            'file_url' => 'https://dummyimage.com/600x400/16a34a/fff&text=SIM+Siti',
            'status' => 'pending'
        ]);
    }
}
