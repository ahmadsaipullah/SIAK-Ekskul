<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranEskul extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_eskuls';

    protected $fillable = [
        'user_id',
        'eskul_id',
        'status',
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

// app/Models/PendaftaranEskul.php

public function nilaiEskul()
{
    return $this->hasOne(NilaiEskul::class, 'user_id', 'user_id');
}



}
