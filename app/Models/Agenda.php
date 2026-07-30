<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agenda';

    protected $fillable = [
        'judul',
        'gambar',
        'deskripsi',
        'lokasi',
        'tanggal',
        'tanggal_akhir',
        'is_donasi',
    ];

    public function peserta()
    {
        return $this->belongsToMany(User::class, 'agenda_peserta', 'agenda_id', 'user_id');
    }
}
