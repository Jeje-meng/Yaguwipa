<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PartnerController extends Controller
{
    public function index()
    {
        $partner = Partner::where('user_id', Auth::id())->latest()->get();
        return view('user.partner.index', compact('partner'));
    }

    public function create()
    {
        return view('user.partner.create');
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
            'status' => 'pending'
        ]);

        return redirect()->route('partner.index')
            ->with('success', 'Pengajuan partner berhasil dikirim. Menunggu verifikasi admin.');
    }

    public function edit($id)
    {
        $partner = Partner::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        if ($partner->status !== 'pending') {
            return redirect()->route('partner.index')->with('error', 'Partner yang sudah diverifikasi tidak dapat diubah.');
        }

        return view('user.partner.edit', compact('partner'));
    }

    public function update(Request $request, $id)
    {
        $partner = Partner::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($partner->status !== 'pending') {
            return redirect()->route('partner.index')->with('error', 'Partner yang sudah diverifikasi tidak dapat diubah.');
        }

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

        return redirect()->route('partner.index')->with('success', 'Pengajuan partner berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $partner = Partner::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Delete logo file
        $oldPath = public_path('partner/' . $partner->logo);
        if (File::exists($oldPath)) {
            File::delete($oldPath);
        }

        $partner->delete();

        return redirect()->route('partner.index')->with('success', 'Pengajuan partner berhasil dibatalkan.');
    }
}