<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiEskul extends Model
{
    use HasFactory;

    protected $table = 'nilai_eskuls';

    protected $fillable = [
        'user_id', 'eskul_id', 'nilai', 'catatan',
    ];

    // Relasi ke tabel users
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke tabel eskuls
    public function eskul()
    {
        return $this->belongsTo(Eskul::class);
    }

    // Tambahan relasi opsional jika ingin hubungkan ke pendaftaran eskul
    public function pendaftaranEskul()
    {
        return $this->belongsTo(PendaftaranEskul::class, 'user_id');
    }
}

