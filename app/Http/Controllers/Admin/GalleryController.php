<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->paginate(9);
        return view('admin.gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|max:4096',
        ]);

        $imageName = 'gallery_' . time() . '.' . $request->gambar->extension();
        $request->gambar->move(public_path('gallery'), $imageName);

        Gallery::create([
            'judul' => $request->judul,
            'gambar' => $imageName,
        ]);

        return redirect('/backoffice/gallery')->with('success', 'Foto berhasil diunggah ke Galeri.');
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        $oldPath = public_path('gallery/' . $gallery->gambar);
        if (File::exists($oldPath)) {
            File::delete($oldPath);
        }
        $gallery->delete();

        return redirect('/backoffice/gallery')->with('success', 'Foto galeri berhasil dihapus.');
    }
}
