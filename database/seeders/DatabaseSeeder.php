<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Gallery;
use App\Models\Partner;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Users
        $admin = User::create([
            'name' => 'AdminYaguwipa',
            'email' => 'admin@yaguwipa.org',
            'password' => Hash::make('Yaguwipa27'),
            'role' => 'admin',
            'usertype' => 'perorangan',
            'alamat' => 'Kantor Pusat Yaguwipa, Denpasar, Bali',
            'nomor_anggota' => 'ADM-001',
            'profile' => 'default.png',
        ]);

        $user = User::create([
            'name' => 'Budi Santoso',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'usertype' => 'perorangan',
            'alamat' => 'Jl. Ganetri IV No. 4, Denpasar, Bali',
            'nomor_anggota' => 'MEM-002',
            'profile' => 'default.png',
        ]);

        // 2. Seed Agenda
        Agenda::create([
            'judul' => 'Workshop Pendidikan Digital',
            'gambar' => 'galeri1.png',
            'deskripsi' => 'Program pengenalan teknologi informasi untuk siswa di wilayah terpencil.',
            'lokasi' => 'Ruang Serbaguna Lt.3',
            'tanggal' => '2026-07-12',
        ]);

        Agenda::create([
            'judul' => 'Rapat Koordinasi Relawan',
            'gambar' => 'galeri2.png',
            'deskripsi' => 'Koordinasi program kebersihan lingkungan dan bantuan sosial triwulan ketiga.',
            'lokasi' => 'Zoom Meeting',
            'tanggal' => '2026-07-18',
        ]);

        Agenda::create([
            'judul' => 'Peluncuran Program Beasiswa 2026',
            'gambar' => 'galeri3.png',
            'deskripsi' => 'Pengenalan dan sosialisasi beasiswa pendidikan bagi anak berprestasi tingkat nasional.',
            'lokasi' => 'Grand Ballroom Jakarta',
            'tanggal' => '2026-08-05',
        ]);

        Agenda::create([
            'judul' => 'Pelatihan Digital Marketing UMKM',
            'gambar' => 'foto_cg.jpeg',
            'deskripsi' => 'Peningkatan kapasitas usaha kecil mandiri di daerah pariwisata Bali.',
            'lokasi' => 'Denpasar Institute',
            'tanggal' => '2026-09-15',
        ]);

        Agenda::create([
            'judul' => 'Seminar Nasional Artificial Intelligence',
            'gambar' => 'visi.png',
            'deskripsi' => 'Mengkaji implikasi AI terhadap masa depan pendidikan dan industri riset di Indonesia.',
            'lokasi' => 'Universitas Nasional',
            'tanggal' => '2026-10-08',
        ]);

        // 3. Seed Berita
        Berita::create([
            'judul' => 'Literasi Digital Pelosok Desa',
            'tanggal' => '2026-07-10',
            'body' => 'Yayasan Guna Widya Paramesthi menyelenggarakan program pengenalan teknologi digital bagi siswa sekolah dasar di desa terpencil. Program ini diharapkan dapat memangkas kesenjangan literasi teknologi informasi.',
            'gambar_berita' => 'galeri1.png',
            'is_active' => 'publish',
        ]);

        Berita::create([
            'judul' => 'Penyaluran Bantuan Sosial',
            'tanggal' => '2026-07-12',
            'body' => 'Bantuan sosial disalurkan kepada puluhan keluarga kurang mampu di Bali Utara. Bantuan berupa kebutuhan pangan pokok, buku tulis sekolah, serta vitamin penunjang kesehatan anak-anak.',
            'gambar_berita' => 'galeri2.png',
            'is_active' => 'publish',
        ]);

        Berita::create([
            'judul' => 'Workshop UMKM Unggul',
            'tanggal' => '2026-07-14',
            'body' => 'Kegiatan pelatihan digital marketing dan manajemen keuangan bagi UMKM lokal. Dihadiri oleh 40 perwakilan wirausaha, dengan pemateri ahli di bidang e-commerce.',
            'gambar_berita' => 'galeri3.png',
            'is_active' => 'publish',
        ]);

        Berita::create([
            'judul' => 'Beasiswa Pendidikan 2026 Diluncurkan',
            'tanggal' => '2026-07-15',
            'body' => 'Pendaftaran program beasiswa Yaguwipa resmi dibuka untuk jenjang SMA dan Perguruan Tinggi. Program ini bertujuan membantu siswa berprestasi dari keluarga kurang mampu secara finansial.',
            'gambar_berita' => 'foto_cg.jpeg',
            'is_active' => 'publish',
        ]);

        // 4. Seed Galeri
        Gallery::create([
            'judul' => 'Pengenalan Komputer Sekolah Terpencil',
            'gambar' => 'galeri1.png',
        ]);
        Gallery::create([
            'judul' => 'Bakti Sosial & Pemeriksaan Kesehatan Gratis',
            'gambar' => 'galeri2.png',
        ]);
        Gallery::create([
            'judul' => 'Penanaman Mangrove di Pesisir Bali',
            'gambar' => 'galeri3.png',
        ]);
        Gallery::create([
            'judul' => 'Pemberian Piagam Penghargaan Beasiswa',
            'gambar' => 'foto_cg.jpeg',
        ]);

        // 5. Seed Partner
        Partner::create([
            'user_id' => $user->id,
            'nama_partner' => 'Denpasar Institute',
            'logo' => 'logoyaguwipa.png',
            'status' => 'disetujui',
        ]);
        Partner::create([
            'user_id' => $user->id,
            'nama_partner' => 'Mitra Pendidikan',
            'logo' => 'logoyaguwipa.png',
            'status' => 'disetujui',
        ]);

        // 6. Seed Settings
        Setting::create(['key' => 'hero_title', 'value' => 'Pendidikan Berkualitas untuk Semua Anak Bangsa']);
        Setting::create(['key' => 'hero_subtitle', 'value' => 'Yayasan Guna Widya Paramesthi bergerak dibidang sosial kemanusiaan, memberikan kesempatan belajar bagi generasi emas Indonesia. Mari berkolaborasi menciptakan masa depan yang lebih baik.']);
        Setting::create(['key' => 'hero_image', 'value' => 'foto_cg.jpeg']);
        Setting::create(['key' => 'visi', 'value' => 'Menjadi lembaga sosial dan pendidikan terpercaya yang mampu melahirkan generasi cerdas, mandiri, berkarakter, dan berdaya saing global demi kemakmuran bangsa.']);
        Setting::create(['key' => 'misi', 'value' => "1. Menyelenggarakan bantuan pendidikan bagi anak-anak kurang mampu berprestasi.\n2. Menyediakan akses pelatihan keterampilan digital dan kepemimpinan.\n3. Membangun kemitraan dengan berbagai lembaga pendidikan dan industri.\n4. Menggalang donasi dan menyalurkannya secara transparan dan akuntabel."]);
        Setting::create(['key' => 'tujuan', 'value' => 'Mendirikan lembaga riset, pendidikan, pelatihan, dan badan amal untuk pengembangan SDM, pemberian beasiswa, serta penyelenggaraan program riset dan kegiatan akademik guna meningkatkan kualitas dan solusi bagi masyarakat.']);
        Setting::create(['key' => 'arti_logo', 'value' => 'Asta Mandala dengan warna putih, kuning, biru, ungu, serta simbol teratai, bintang, daun, dan padi melambangkan Yayasan Guna Widya Paramesthi sebagai lembaga yang mendorong kebajikan, kehormatan, keseimbangan, dan kemajuan dalam pelayanan masyarakat.']);
    }
}
