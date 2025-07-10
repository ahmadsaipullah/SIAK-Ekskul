<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalEskul extends Model
{
    use HasFactory;

     protected $table = 'jadwal_eskuls';
    protected $fillable = [
        'eskul_id', 'hari', 'jam_mulai', 'jam_selesai', 'lokasi',
    ];

    public function eskul()
    {
        return $this->belongsTo(Eskul::class);
    }
}
