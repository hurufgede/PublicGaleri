<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Galeri extends Model
{
    protected $table = 'galeris';

    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
    ];
}
