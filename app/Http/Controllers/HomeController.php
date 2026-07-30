<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Gallery;
use App\Models\Partner;
use App\Models\Donasi;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $agendas = Agenda::orderBy('tanggal', 'asc')->take(5)->get();
        $beritas = Berita::where('is_active', 'publish')->orderBy('tanggal', 'desc')->take(4)->get();
        $galleries = Gallery::orderBy('created_at', 'desc')->take(4)->get();
        $partners = Partner::where('status', 'disetujui')->orderBy('created_at', 'desc')->get();
        
        // Fetch approved donations: Geld and Goods
        $moneyDonations = Donasi::where('status', 'diterima')
            ->where('jenis_donasi', 'uang')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $goodsDonations = Donasi::where('status', 'diterima')
            ->where('jenis_donasi', 'barang')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Merge and take latest 5 for history list
        $donationsHistory = Donasi::where('status', 'diterima')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Landing page settings
        $hero_subtitle = Setting::get('hero_subtitle', 'Yayasan Guna Widya Paramesthi bergerak dibidang sosial kemanusiaan, memberikan kesempatan belajar bagi generasi emas Indonesia. Mari berkolaborasi menciptakan masa depan yang lebih baik.');
        $hero_image = Setting::get('hero_image', 'foto_cg.jpeg');
        $visi = Setting::get('visi', 'Menjadi lembaga sosial dan pendidikan terpercaya yang mampu melahirkan generasi cerdas, mandiri, berkarakter, dan berdaya saing global demi kemakmuran bangsa.');
        $misi = Setting::get('misi', "1. Menyelenggarakan bantuan pendidikan bagi anak-anak kurang mampu berprestasi.\n2. Menyediakan akses pelatihan keterampilan digital dan kepemimpinan.\n3. Membangun kemitraan dengan berbagai lembaga pendidikan dan industri.\n4. Menggalang donasi dan menyalurkannya secara transparan dan akuntabel.");
        $tujuan = Setting::get('tujuan', 'Mendirikan lembaga riset, pendidikan, pelatihan, dan badan amal untuk pengembangan SDM, pemberian beasiswa, serta penyelenggaraan program riset dan kegiatan akademik guna meningkatkan kualitas dan solusi bagi masyarakat.');
        $arti_logo = Setting::get('arti_logo', 'Asta Mandala dengan warna putih, kuning, biru, ungu, serta simbol teratai, bintang, daun, dan padi melambangkan Yayasan Guna Widya Paramesthi sebagai lembaga yang mendorong kebajikan, kehormatan, keseimbangan, dan kemajuan dalam pelayanan masyarakat.');

        // Logos
        $visi_logo = Setting::get('visi_logo', 'visi.png');
        $misi_logo = Setting::get('misi_logo', 'misi.png');
        $tujuan_logo = Setting::get('tujuan_logo', '');
        $arti_logo_logo = Setting::get('arti_logo_logo', '');

        // Donation Map Settings
        $donasi_nama_1 = Setting::get('donasi_nama_1', 'Denpasar Institute');
        $donasi_map_1 = Setting::get('donasi_map_1', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.3467657969305!2d115.2227183!3d-8.6585188!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23f7902d1d4d3%3A0xbcc0e82f718c3b4a!2sDenpasar%20Institute!5e0!3m2!1sid!2sid!4v1700000000000');
        
        $donasi_nama_2 = Setting::get('donasi_nama_2', 'Yaguwipa Sosial');
        $donasi_map_2 = Setting::get('donasi_map_2', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15777.387994801124!2d115.215!3d-8.655!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23f7c11f71df1%3A0x67ba4f3d2f954ec2!2sDenpasar%20Utara%2C%20Denpasar%20City%2C%20Bali!5e0!3m2!1sid!2sid!4v1700000000001');
        
        $donasi_nama_3 = Setting::get('donasi_nama_3', 'Mitra Pendidikan');
        $donasi_map_3 = Setting::get('donasi_map_3', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3947.458928394!2d115.34!3d-8.25!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd1f3ad2132ab7f%3A0xc3f83dd717804473!2sKintamani%2C%20Bangli%20Regency%2C%20Bali!5e0!3m2!1sid!2sid!4v1700000000002');

        return view('home', compact(
            'agendas', 'beritas', 'galleries', 'partners', 'donationsHistory',
            'hero_subtitle', 'hero_image', 'visi', 'misi', 'tujuan', 'arti_logo',
            'visi_logo', 'misi_logo', 'tujuan_logo', 'arti_logo_logo',
            'donasi_nama_1', 'donasi_map_1', 'donasi_nama_2', 'donasi_map_2', 'donasi_nama_3', 'donasi_map_3'
        ));
    }

    public function showAgenda($id)
    {
        $agenda = Agenda::findOrFail($id);
        $recentAgendas = Agenda::where('id', '!=', $id)->orderBy('tanggal', 'asc')->take(5)->get();
        return view('agenda-detail', compact('agenda', 'recentAgendas'));
    }

    public function ikutAgenda($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan masuk terlebih dahulu untuk mengikuti agenda.');
        }

        $agenda = Agenda::findOrFail($id);

        if ($agenda->is_donasi) {
            return back()->with('error', 'Agenda ini memerlukan donasi terlebih dahulu.');
        }

        if (!$agenda->peserta()->where('user_id', auth()->id())->exists()) {
            $agenda->peserta()->attach(auth()->id());
        }

        return back()->with('success', 'Anda berhasil mendaftar untuk mengikuti agenda: ' . $agenda->judul);
    }

    public function batalIkutAgenda($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $agenda = Agenda::findOrFail($id);
        $agenda->peserta()->detach(auth()->id());

        return back()->with('success', 'Pendaftaran agenda berhasil dibatalkan.');
    }
}
