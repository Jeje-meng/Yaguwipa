<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use Illuminate\Http\Request;

class DonasiController extends Controller
{
    public function index()
    {
        $donations = Donasi::with(['user', 'agenda'])->latest()->paginate(15);
        return view('admin.donasi.index', compact('donations'));
    }

    public function approve($id)
    {
        $donation = Donasi::findOrFail($id);
        $donation->update([
            'status' => 'diterima',
        ]);

        if ($donation->agenda_id && $donation->user_id) {
            $agenda = \App\Models\Agenda::find($donation->agenda_id);
            if ($agenda) {
                if (!$agenda->peserta()->where('user_id', $donation->user_id)->exists()) {
                    $agenda->peserta()->attach($donation->user_id);
                }
            }
        }

        return back()->with('success', 'Donasi berhasil disetujui.');
    }

    public function reject($id)
    {
        $donation = Donasi::findOrFail($id);
        $donation->update([
            'status' => 'ditolak',
        ]);

        return back()->with('success', 'Donasi ditolak.');
    }
}
