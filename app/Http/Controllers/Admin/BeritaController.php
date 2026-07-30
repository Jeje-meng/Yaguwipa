<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->paginate(9);
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'body' => 'required|string',
            'tanggal' => 'required|date',
            'gambar_berita' => 'required|image|max:4096',
            'is_active' => 'required|in:draft,publish',
        ]);

        $imageName = 'news_' . time() . '.' . $request->gambar_berita->extension();
        $request->gambar_berita->move(public_path('news'), $imageName);

        Berita::create([
            'judul' => $request->judul,
            'body' => $request->body,
            'tanggal' => $request->tanggal,
            'gambar_berita' => $imageName,
            'is_active' => $request->is_active,
        ]);

        return redirect('/backoffice/berita')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'body' => 'required|string',
            'tanggal' => 'required|date',
            'gambar_berita' => 'nullable|image|max:4096',
            'is_active' => 'required|in:draft,publish',
        ]);

        $data = [
            'judul' => $request->judul,
            'body' => $request->body,
            'tanggal' => $request->tanggal,
            'is_active' => $request->is_active,
        ];

        if ($request->hasFile('gambar_berita')) {
            // Delete old file
            $oldPath = public_path('news/' . $berita->gambar_berita);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $imageName = 'news_' . time() . '.' . $request->gambar_berita->extension();
            $request->gambar_berita->move(public_path('news'), $imageName);
            $data['gambar_berita'] = $imageName;
        }

        $berita->update($data);

        return redirect('/backoffice/berita')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        $oldPath = public_path('news/' . $berita->gambar_berita);
        if (File::exists($oldPath)) {
            File::delete($oldPath);
        }
        $berita->delete();

        return redirect('/backoffice/berita')->with('success', 'Berita berhasil dihapus.');
    }
}
