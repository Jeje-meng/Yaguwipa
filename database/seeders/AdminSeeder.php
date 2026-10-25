<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ============================================================
        // ADMIN USER
        // Ubah email, name, dan password sesuai yang biasa kamu gunakan
        // ============================================================
        DB::table('users')->insert([
            'name'          => 'Admin Yaguwipa',
            'email'         => 'admin@yaguwipa.com',
            'password'      => Hash::make('admin123'),
            'role'          => 'admin',
            'usertype'      => 'perorangan',
            'profile'       => 'default.png',
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        // ============================================================
        // SETTINGS - Konten Website
        // ============================================================
        $settings = [
            // Hero
            'hero_subtitle'     => 'Yayasan Guna Widya Paramesthi hadir untuk memberikan dampak nyata melalui pendidikan, sosial, dan kemanusiaan.',
            'hero_image'        => 'foto_cg.jpeg',

            // Navbar
            'nav_title_1'   => 'Tentang Kami',     'nav_link_1' => '#tentang_kami',
            'nav_title_2'   => 'Partner',           'nav_link_2' => '#lembaga_terkait',
            'nav_title_3'   => 'Galeri',            'nav_link_3' => '#galeri',
            'nav_title_4'   => 'Berita',            'nav_link_4' => '#berita',
            'nav_title_5'   => 'Agenda',            'nav_link_5' => '#agenda',
            'nav_title_6'   => 'Donasi',            'nav_link_6' => '#donasi',

            // Kontak
            'contact_alamat'    => 'Bali, Indonesia',
            'contact_telp'      => '-',
            'contact_email'     => 'info@yaguwipa.com',
            'contact_ig'        => '#',
            'contact_fb'        => '#',
            'contact_map'       => '',

            // Pembayaran
            'pay_bank_bni'          => '2706782708',
            'pay_ewallet_gopay'     => '-',
            'pay_ewallet_ovo'       => '-',
            'pay_ewallet_dana'      => '-',
            'pay_ewallet_linkaja'   => '-',
            'pay_qris_qr'           => 'qris_qr.png',

            // Visi Misi
            'visi'      => 'Menjadi yayasan terdepan dalam memajukan pendidikan dan kesejahteraan masyarakat.',
            'misi'      => 'Memberikan layanan pendidikan berkualitas dan pemberdayaan sosial yang berkelanjutan.',
            'tujuan'    => 'Mewujudkan masyarakat yang cerdas, mandiri, dan berdaya saing.',
            'arti_logo' => 'Logo Yayasan Guna Widya Paramesthi melambangkan tekad dan semangat dalam memajukan pendidikan.',
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }
    }
}
