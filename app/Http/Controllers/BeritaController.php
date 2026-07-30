<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::where('is_active', 'publish')->orderBy('tanggal', 'desc')->paginate(9);
        return view('berita', compact('beritas'));
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->where('is_active', 'publish')->firstOrFail();
        
        // Fetch recent news for sidebar/widget
        $recentBeritas = Berita::where('is_active', 'publish')
            ->where('id', '<>', $berita->id)
            ->orderBy('tanggal', 'desc')
            ->take(5)
            ->get();

        return view('berita-detail', compact('berita', 'recentBeritas'));
    }
}
