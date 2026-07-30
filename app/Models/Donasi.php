<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    protected $table = 'donasi';

    protected $fillable = [
        'user_id',
        'jenis_donasi',
        'nominal',
        'nama_barang',
        'jumlah_barang',
        'deskripsi',
        'bukti_transfer',
        'status',
        'agenda_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agenda()
    {
        return $this->belongsTo(Agenda::class);
    }
}
