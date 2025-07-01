<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eskul extends Model
{
    use HasFactory;

        protected $lable = 'eskuls';
        protected $fillable = [
        'nama_eskul',
        'deskripsi',
        'pelatih_id',
        'tahun_ajaran',
        'no_hp',
        'logo',
        'jumlah_pertemuan',
];


    public function pelatih()
    {
        return $this->belongsTo(User::class, 'pelatih_id');
    }

    public function pendaftarans()
    {
        return $this->hasMany(PendaftaranEskul::class);
    }

    public function jadwals()
    {
        return $this->hasMany(JadwalEskul::class);
    }

    public function pertemuans()
    {
        return $this->hasMany(PertemuanEskul::class);
    }

    public function nilais()
    {
        return $this->hasMany(NilaiEskul::class);
    }
}
