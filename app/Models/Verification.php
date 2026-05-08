<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi: Satu dokumen verifikasi dimiliki oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}