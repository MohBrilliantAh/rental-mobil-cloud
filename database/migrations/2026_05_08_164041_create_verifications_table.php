<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('verifications', function (Blueprint $table) {
            $table->id();
            // Menghubungkan dokumen ini dengan siapa pemiliknya di tabel users
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('document_type', ['ktp', 'sim_a', 'stnk']);
            // Di sini kita hanya menyimpan URL (link) ke Cloud Object Storage nantinya
            $table->string('file_url'); 
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('verifications');
    }
};