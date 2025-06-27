<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarouselEskul extends Model
{
    use HasFactory;

    protected $table = 'carousel_eskuls';

    protected $fillable = [
        'judul',
        'deskripsi',
        'image'
    ];
}
