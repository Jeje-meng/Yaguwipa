<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PartnerAdminController extends Controller
{
    public function index()
    {
        $partner = Partner::with('user')->latest()->get();
        return view('admin.partner.index', compact('partner'));
    }

    public function create()
    {
        return view('admin.partner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_partner' => 'required|string|max:255',
            'logo' => 'required|image|max:4096'
        ]);

        $logoName = time() . '.' . $request->logo->extension();
        $request->logo->move(public_path('partner'), $logoName);

        Partner::create([
            'user_id' => Auth::id(),
            'nama_partner' => $request->nama_partner,
            'logo' => $logoName,
            'status' => 'disetujui' // Admin-added partners are approved by default
        ]);

        return redirect()->route('admin.partner.index')
            ->with('success', 'Partner berhasil ditambahkan secara langsung.');
    }

    public function edit($id)
    {
        $partner = Partner::findOrFail($id);
        return view('admin.partner.edit', compact('partner'));
    }

    public function update(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);

        $request->validate([
            'nama_partner' => 'required|string|max:255',
            'logo' => 'nullable|image|max:4096'
        ]);

        $data = [
            'nama_partner' => $request->nama_partner,
        ];

        if ($request->hasFile('logo')) {
            // Delete old logo
            $oldPath = public_path('partner/' . $partner->logo);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $logoName = time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('partner'), $logoName);
            $data['logo'] = $logoName;
        }

        $partner->update($data);

        return redirect()->route('admin.partner.index')
            ->with('success', 'Partner berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $partner = Partner::findOrFail($id);

        // Delete logo file
        $oldPath = public_path('partner/' . $partner->logo);
        if (File::exists($oldPath)) {
            File::delete($oldPath);
        }

        $partner->delete();

        return redirect()->route('admin.partner.index')
            ->with('success', 'Partner berhasil dihapus.');
    }

    public function setujui($id)
    {
        $partner = Partner::findOrFail($id);
        $partner->status = 'disetujui';
        $partner->save();

        return back()->with('success', 'Pengajuan partner disetujui.');
    }

    public function tolak($id)
    {
        $partner = Partner::findOrFail($id);
        $partner->status = 'ditolak';
        $partner->save();

        return back()->with('success', 'Pengajuan partner ditolak.');
    }
}
