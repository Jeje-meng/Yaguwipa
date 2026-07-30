<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonasiController extends Controller
{
    public function submitUang(Request $request)
    {
        $request->validate([
            'nominal' => 'nullable|numeric|min:1000',
            'custom_nominal' => 'nullable|numeric|min:1000',
            'payment_method' => 'required|string',
            'agenda_id' => 'nullable|integer|exists:agenda,id',
        ]);

        $nominal = $request->custom_nominal ?: $request->nominal;

        if (!$nominal) {
            return back()->withErrors(['nominal' => 'Silakan pilih atau masukkan nominal donasi.'])->withInput();
        }

        $donasi = Donasi::create([
            'user_id' => Auth::id(),
            'jenis_donasi' => 'uang',
            'nominal' => $nominal,
            'deskripsi' => 'Metode Pembayaran: ' . strtoupper($request->payment_method),
            'status' => 'pending',
            'agenda_id' => $request->input('agenda_id'),
        ]);

        return redirect()->route('donasi.payment', $donasi->id);
    }

    public function paymentPage($id)
    {
        $donasi = Donasi::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('donasi.payment', compact('donasi'));
    }

    public function uploadReceipt(Request $request, $id)
    {
        $request->validate([
            'bukti_transfer' => 'required|image|max:4096',
            'payment_provider' => 'nullable|string',
        ]);

        $donasi = Donasi::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $receiptName = 'receipt_' . time() . '.' . $request->bukti_transfer->extension();
        $request->bukti_transfer->move(public_path('donations'), $receiptName);

        // Append provider code to description (e.g. "Metode Pembayaran: BANK_TRANSFER (BCA)")
        $provider = $request->payment_provider ? ' (' . strtoupper($request->payment_provider) . ')' : '';
        $newDesc = $donasi->deskripsi . $provider;

        $donasi->update([
            'bukti_transfer' => $receiptName,
            'deskripsi' => $newDesc,
        ]);

        return redirect()->route('home')->with('success', 'Bukti transfer berhasil diunggah. Donasi Anda sedang diproses oleh admin.');
    }

    public function submitBarang(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah_barang' => 'required|integer|min:1',
            'tujuan_lembaga' => 'required|string',
            'foto_barang' => 'required|image|max:4096',
            'deskripsi' => 'nullable|string',
            'agenda_id' => 'nullable|integer|exists:agenda,id',
        ]);

        $fotoName = 'barang_' . time() . '.' . $request->foto_barang->extension();
        $request->foto_barang->move(public_path('donations'), $fotoName);

        Donasi::create([
            'user_id' => Auth::id(),
            'jenis_donasi' => 'barang',
            'nama_barang' => $request->nama_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'deskripsi' => 'Tujuan: ' . $request->tujuan_lembaga . '. Catatan: ' . $request->deskripsi,
            'bukti_transfer' => $fotoName, // store foto barang in bukti_transfer column
            'status' => 'pending',
            'agenda_id' => $request->input('agenda_id'),
        ]);

        return redirect()->route('home')->with('success', 'Informasi sumbangan barang berhasil dikirim. Kami akan memverifikasi kiriman Anda.');
    }

    public function cancelDonation(Request $request, $id)
    {
        $donasi = Donasi::where('id', $id)
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->firstOrFail();

        if ($donasi->bukti_transfer) {
            $filePath = public_path('donations/' . $donasi->bukti_transfer);
            if (\Illuminate\Support\Facades\File::exists($filePath)) {
                \Illuminate\Support\Facades\File::delete($filePath);
            }
        }

        $donasi->delete();

        if ($request->input('redirect_to') === 'profile') {
            return redirect()->route('profile.index')->with('success', 'Permohonan donasi Anda berhasil dibatalkan.');
        }

        return redirect()->route('home')->with('success', 'Permohonan donasi Anda berhasil dibatalkan.');
    }
}
