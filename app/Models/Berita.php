<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'slug',
        'tanggal',
        'body',
        'gambar_berita',
        'is_active',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($berita) {
            $berita->slug = static::generateUniqueSlug($berita->judul);
        });

        static::updating(function ($berita) {
            $berita->slug = static::generateUniqueSlug($berita->judul, $berita->id);
        });
    }

    private static function generateUniqueSlug($title, $id = 0)
    {
        $slug = Str::slug($title);
        $allSlugs = static::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();

        if (! $allSlugs->contains('slug', $slug)) {
            return $slug;
        }

        $i = 1;
        while (true) {
            $newSlug = $slug . '-' . $i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
            $i++;
        }
    }
}
