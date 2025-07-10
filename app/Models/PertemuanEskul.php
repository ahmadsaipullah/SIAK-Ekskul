<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PertemuanEskul extends Model
{
    use HasFactory;

    protected $table = 'pertemuan_eskuls';

    protected $fillable = [
        'eskul_id', 'tanggal', 'materi',
    ];

    public function eskul()
    {
        return $this->belongsTo(Eskul::class, 'eskul_id');
    }

    public function absensi()
    {
        return $this->hasMany(AbsensiEskul::class, 'pertemuan_id');
    }


}
