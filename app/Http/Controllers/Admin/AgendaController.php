<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::latest()->paginate(15);
        return view('admin.agenda.index', compact('agendas'));
    }

    public function create()
    {
        return view('admin.agenda.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'tanggal_akhir' => 'nullable|date|after_or_equal:tanggal',
            'gambar' => 'required|image|max:4096',
            'is_donasi' => 'required|in:0,1',
        ]);

        $imageName = 'agenda_' . time() . '.' . $request->gambar->extension();
        $request->gambar->move(public_path('gallery'), $imageName);

        Agenda::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'tanggal' => $request->tanggal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'gambar' => $imageName,
            'is_donasi' => $request->is_donasi,
        ]);

        return redirect('/backoffice/agenda')->with('success', 'Agenda berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $agenda = Agenda::findOrFail($id);
        return view('admin.agenda.edit', compact('agenda'));
    }

    public function update(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'tanggal_akhir' => 'nullable|date|after_or_equal:tanggal',
            'gambar' => 'nullable|image|max:4096',
            'is_donasi' => 'required|in:0,1',
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'tanggal' => $request->tanggal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'is_donasi' => $request->is_donasi,
        ];

        if ($request->hasFile('gambar')) {
            // Delete old file if exists
            $oldPath = public_path('gallery/' . $agenda->gambar);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $imageName = 'agenda_' . time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('gallery'), $imageName);
            $data['gambar'] = $imageName;
        }

        $agenda->update($data);

        return redirect('/backoffice/agenda')->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);
        $oldPath = public_path('gallery/' . $agenda->gambar);
        if (File::exists($oldPath)) {
            File::delete($oldPath);
        }
        $agenda->delete();

        return redirect('/backoffice/agenda')->with('success', 'Agenda berhasil dihapus.');
    }

    public function viewPeserta($id)
    {
        $agenda = Agenda::findOrFail($id);
        $peserta = $agenda->peserta()->latest()->paginate(25);
        return view('admin.agenda.peserta', compact('agenda', 'peserta'));
    }
}
