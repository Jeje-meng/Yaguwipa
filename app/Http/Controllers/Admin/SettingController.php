<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function index()
    {
        $hero_subtitle = Setting::get('hero_subtitle', '');
        $hero_image = Setting::get('hero_image', 'foto_cg.jpeg');
        $visi = Setting::get('visi', '');
        $misi = Setting::get('misi', '');
        $tujuan = Setting::get('tujuan', '');
        $arti_logo = Setting::get('arti_logo', '');

        // Logos
        $visi_logo = Setting::get('visi_logo', 'visi.png');
        $misi_logo = Setting::get('misi_logo', 'misi.png');
        $tujuan_logo = Setting::get('tujuan_logo', '');
        $arti_logo_logo = Setting::get('arti_logo_logo', '');

        // Navbar Menu settings
        $nav_title_1 = Setting::get('nav_title_1', 'Tentang Kami');
        $nav_link_1 = Setting::get('nav_link_1', '#tentang_kami');
        $nav_title_2 = Setting::get('nav_title_2', 'Partner');
        $nav_link_2 = Setting::get('nav_link_2', '#lembaga_terkait');
        $nav_title_3 = Setting::get('nav_title_3', 'Galeri');
        $nav_link_3 = Setting::get('nav_link_3', '#galeri');
        $nav_title_4 = Setting::get('nav_title_4', 'Berita');
        $nav_link_4 = Setting::get('nav_link_4', '#berita');
        $nav_title_5 = Setting::get('nav_title_5', 'Agenda');
        $nav_link_5 = Setting::get('nav_link_5', '#agenda');
        $nav_title_6 = Setting::get('nav_title_6', 'Donasi');
        $nav_link_6 = Setting::get('nav_link_6', '#donasi');

        // Contact info settings
        $contact_alamat = Setting::get('contact_alamat', 'Jln. Ganetri IV No. 4 DPS 80237 Bali');
        $contact_telp = Setting::get('contact_telp', '(+62) 87865309966');
        $contact_email = Setting::get('contact_email', 'info@yaguwipa.org');
        $contact_ig = Setting::get('contact_ig', 'https://www.instagram.com/');
        $contact_fb = Setting::get('contact_fb', 'https://www.facebook.com/');
        $contact_map = Setting::get('contact_map', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.5663737526715!2d115.23466189999999!3d-8.6375376!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23f6479f6e6ab%3A0x63cd2e0c034ec6b4!2sJl.%20Ganetri%20IV%2C%20Tonja%2C%20Kec.%20Denpasar%20Utara%2C%20Kota%20Denpasar%2C%20Bali%2080235!5e0!3m2!1sid!2sid!4v1710000000000!5m2!1sid!2sid');

        return view('admin.settings.index', compact(
            'hero_subtitle', 'hero_image', 'visi', 'misi', 'tujuan', 'arti_logo',
            'visi_logo', 'misi_logo', 'tujuan_logo', 'arti_logo_logo',
            'nav_title_1', 'nav_link_1',
            'nav_title_2', 'nav_link_2',
            'nav_title_3', 'nav_link_3',
            'nav_title_4', 'nav_link_4',
            'nav_title_5', 'nav_link_5',
            'nav_title_6', 'nav_link_6',
            'contact_alamat', 'contact_telp', 'contact_email', 'contact_ig', 'contact_fb', 'contact_map'
        ));
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_subtitle' => 'required|string',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'tujuan' => 'required|string',
            'arti_logo' => 'required|string',
            'hero_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,mp4,webm,ogg,avi,mov|max:20480',
            'visi_logo' => 'nullable|image|max:2048',
            'misi_logo' => 'nullable|image|max:2048',
            'tujuan_logo' => 'nullable|image|max:2048',
            'arti_logo_logo' => 'nullable|image|max:2048',
            'nav_title_1' => 'required|string|max:100',
            'nav_link_1' => 'required|string|max:255',
            'nav_title_2' => 'required|string|max:100',
            'nav_link_2' => 'required|string|max:255',
            'nav_title_3' => 'required|string|max:100',
            'nav_link_3' => 'required|string|max:255',
            'nav_title_4' => 'required|string|max:100',
            'nav_link_4' => 'required|string|max:255',
            'nav_title_5' => 'required|string|max:100',
            'nav_link_5' => 'required|string|max:255',
            'nav_title_6' => 'required|string|max:100',
            'nav_link_6' => 'required|string|max:255',
            'contact_alamat' => 'required|string',
            'contact_telp' => 'required|string|max:100',
            'contact_email' => 'required|string|email|max:150',
            'contact_ig' => 'required|string|max:255',
            'contact_fb' => 'required|string|max:255',
            'contact_map' => 'required|string',
        ]);

        Setting::set('hero_subtitle', $request->hero_subtitle);
        Setting::set('visi', $request->visi);
        Setting::set('misi', $request->misi);
        Setting::set('tujuan', $request->tujuan);
        Setting::set('arti_logo', $request->arti_logo);

        // Save navbar settings
        Setting::set('nav_title_1', $request->nav_title_1);
        Setting::set('nav_link_1', $request->nav_link_1);
        Setting::set('nav_title_2', $request->nav_title_2);
        Setting::set('nav_link_2', $request->nav_link_2);
        Setting::set('nav_title_3', $request->nav_title_3);
        Setting::set('nav_link_3', $request->nav_link_3);
        Setting::set('nav_title_4', $request->nav_title_4);
        Setting::set('nav_link_4', $request->nav_link_4);
        Setting::set('nav_title_5', $request->nav_title_5);
        Setting::set('nav_link_5', $request->nav_link_5);
        Setting::set('nav_title_6', $request->nav_title_6);
        Setting::set('nav_link_6', $request->nav_link_6);

        // Save contact settings
        Setting::set('contact_alamat', $request->contact_alamat);
        Setting::set('contact_telp', $request->contact_telp);
        Setting::set('contact_email', $request->contact_email);
        Setting::set('contact_ig', $request->contact_ig);
        Setting::set('contact_fb', $request->contact_fb);
        Setting::set('contact_map', $this->cleanMapUrl($request->contact_map));

        // Upload Helper calls
        $this->handleLogoUpload($request, 'hero_image', 'hero_image', 'foto_cg.jpeg');
        $this->handleLogoUpload($request, 'visi_logo', 'visi_logo', 'visi.png');
        $this->handleLogoUpload($request, 'misi_logo', 'misi_logo', 'misi.png');
        $this->handleLogoUpload($request, 'tujuan_logo', 'tujuan_logo', '');
        $this->handleLogoUpload($request, 'arti_logo_logo', 'arti_logo_logo', '');

        return redirect()->route('admin.settings.index')
            ->with('success', 'Konten halaman utama, navbar, and kontak berhasil diperbarui.');
    }

    public function donasiIndex()
    {
        // Donation Maps
        $donasi_nama_1 = Setting::get('donasi_nama_1', 'Denpasar Institute');
        $donasi_map_1 = Setting::get('donasi_map_1', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.3467657969305!2d115.2227183!3d-8.6585188!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23f7902d1d4d3%3A0xbcc0e82f718c3b4a!2sDenpasar%20Institute!5e0!3m2!1sid!2sid!4v1700000000000');
        
        $donasi_nama_2 = Setting::get('donasi_nama_2', 'Yaguwipa Sosial');
        $donasi_map_2 = Setting::get('donasi_map_2', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15777.387994801124!2d115.215!3d-8.655!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23f7c11f71df1%3A0x67ba4f3d2f954ec2!2sDenpasar%20Utara%2C%20Denpasar%20City%2C%20Bali!5e0!3m2!1sid!2sid!4v1700000000001');
        
        $donasi_nama_3 = Setting::get('donasi_nama_3', 'Mitra Pendidikan');
        $donasi_map_3 = Setting::get('donasi_map_3', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3947.458928394!2d115.34!3d-8.25!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd1f3ad2132ab7f%3A0xc3f83dd717804473!2sKintamani%2C%20Bangli%20Regency%2C%20Bali!5e0!3m2!1sid!2sid!4v1700000000002');

        // Payment settings
        $pay_bank_bca = Setting::get('pay_bank_bca', '123-456-7890');
        $pay_bank_mandiri = Setting::get('pay_bank_mandiri', '987-654-3210');
        $pay_bank_bni = Setting::get('pay_bank_bni', '555-666-7777');
        $pay_bank_bri = Setting::get('pay_bank_bri', '888-999-1111');
        $pay_ewallet_gopay = Setting::get('pay_ewallet_gopay', '087865309966');
        $pay_ewallet_ovo = Setting::get('pay_ewallet_ovo', '087865309966');
        $pay_ewallet_dana = Setting::get('pay_ewallet_dana', '087865309966');
        $pay_ewallet_linkaja = Setting::get('pay_ewallet_linkaja', '087865309966');
        $pay_qris_qr = Setting::get('pay_qris_qr', 'qris_qr.png');

        return view('admin.settings.donasi', compact(
            'donasi_nama_1', 'donasi_map_1', 'donasi_nama_2', 'donasi_map_2', 'donasi_nama_3', 'donasi_map_3',
            'pay_bank_bca', 'pay_bank_mandiri', 'pay_bank_bni', 'pay_bank_bri',
            'pay_ewallet_gopay', 'pay_ewallet_ovo', 'pay_ewallet_dana', 'pay_ewallet_linkaja', 'pay_qris_qr'
        ));
    }

    public function donasiUpdate(Request $request)
    {
        $request->validate([
            'donasi_nama_1' => 'required|string',
            'donasi_map_1' => 'required|string',
            'donasi_nama_2' => 'required|string',
            'donasi_map_2' => 'required|string',
            'donasi_nama_3' => 'required|string',
            'donasi_map_3' => 'required|string',
            'pay_bank_bca' => 'required|string',
            'pay_bank_mandiri' => 'required|string',
            'pay_bank_bni' => 'required|string',
            'pay_bank_bri' => 'required|string',
            'pay_ewallet_gopay' => 'required|string',
            'pay_ewallet_ovo' => 'required|string',
            'pay_ewallet_dana' => 'required|string',
            'pay_ewallet_linkaja' => 'required|string',
            'pay_qris_qr' => 'nullable|image|max:4096',
        ]);

        Setting::set('donasi_nama_1', $request->donasi_nama_1);
        Setting::set('donasi_map_1', $this->cleanMapUrl($request->donasi_map_1));
        Setting::set('donasi_nama_2', $request->donasi_nama_2);
        Setting::set('donasi_map_2', $this->cleanMapUrl($request->donasi_map_2));
        Setting::set('donasi_nama_3', $request->donasi_nama_3);
        Setting::set('donasi_map_3', $this->cleanMapUrl($request->donasi_map_3));

        Setting::set('pay_bank_bca', $request->pay_bank_bca);
        Setting::set('pay_bank_mandiri', $request->pay_bank_mandiri);
        Setting::set('pay_bank_bni', $request->pay_bank_bni);
        Setting::set('pay_bank_bri', $request->pay_bank_bri);
        Setting::set('pay_ewallet_gopay', $request->pay_ewallet_gopay);
        Setting::set('pay_ewallet_ovo', $request->pay_ewallet_ovo);
        Setting::set('pay_ewallet_dana', $request->pay_ewallet_dana);
        Setting::set('pay_ewallet_linkaja', $request->pay_ewallet_linkaja);

        $this->handleLogoUpload($request, 'pay_qris_qr', 'pay_qris_qr', 'qris_qr.png');

        return redirect()->route('admin.settings.donasi')
            ->with('success', 'Pengaturan lokasi donasi and metode pembayaran berhasil diperbarui.');
    }

    private function cleanMapUrl(string $url): string
    {
        if (preg_match('/src="([^"]+)"/i', $url, $match)) {
            return $match[1];
        }
        return trim($url);
    }

    private function handleLogoUpload(Request $request, string $fieldName, string $settingKey, string $defaultFile)
    {
        if ($request->hasFile($fieldName)) {
            $oldImage = Setting::get($settingKey);
            if ($oldImage && $oldImage !== $defaultFile) {
                $oldPath = public_path('images/' . $oldImage);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            $imageName = $fieldName . '_' . time() . '.' . $request->$fieldName->extension();
            $request->$fieldName->move(public_path('images'), $imageName);
            Setting::set($settingKey, $imageName);
        }
    }
}
