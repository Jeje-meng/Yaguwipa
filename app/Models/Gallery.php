<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'galeri';

    protected $fillable = [
        'judul',
        'gambar',
    ];
}
