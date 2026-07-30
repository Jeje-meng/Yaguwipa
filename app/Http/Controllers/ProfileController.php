<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $myDonations = \App\Models\Donasi::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        $myAgendas = $user->agendaDiikuti()->orderBy('tanggal', 'asc')->get();
            
        return view('profile', compact('user', 'myDonations', 'myAgendas'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'password' => 'nullable|string|min:6|confirmed',
            'profile_image' => 'nullable|image|max:2048'
        ]);

        $user->name = $request->name;
        $user->alamat = $request->alamat;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('profile_image')) {
            // Delete old profile image if it is not default.png
            if ($user->profile && $user->profile !== 'default.png') {
                $oldPath = public_path('images/' . $user->profile);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            $imageName = 'profile_' . $user->id . '_' . time() . '.' . $request->profile_image->extension();
            $request->profile_image->move(public_path('images'), $imageName);
            $user->profile = $imageName;
        }

        $user->save();

        return redirect()->route('profile.index')
            ->with('success', 'Profil Anda berhasil diperbarui.');
    }

    public function deletePhoto()
    {
        $user = Auth::user();
        if ($user->profile && $user->profile !== 'default.png') {
            $oldPath = public_path('images/' . $user->profile);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
            $user->profile = 'default.png';
            $user->save();
            return redirect()->route('profile.index')
                ->with('success', 'Foto profil berhasil dihapus.');
        }
        return redirect()->route('profile.index')
            ->with('error', 'Foto profil Anda sudah menggunakan bawaan.');
    }
}
