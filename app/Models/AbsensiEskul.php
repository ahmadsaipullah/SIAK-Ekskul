<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiEskul extends Model
{
    use HasFactory;

     protected $table = 'absensi_eskuls';

     protected $fillable = [
        'user_id', 'pertemuan_id', 'status', 'lokasi', 'foto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pertemuan()
    {
        return $this->belongsTo(PertemuanEskul::class, 'pertemuan_id');
    }
}
