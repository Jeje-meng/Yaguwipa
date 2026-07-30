<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Partner;
use App\Models\Donasi;
use App\Models\Berita;

class DashboardController extends Controller
{
    public function index()
    {
        // Berita Stats
        $newsCount = Berita::count();
        $newsDraftCount = Berita::where('is_active', 'draft')->count();
        $newsPublishCount = Berita::where('is_active', 'publish')->count();

        // Partner Stats
        $partnersCount = Partner::count();
        $partnersPendingCount = Partner::where('status', 'pending')->count();
        $partnersApprovedCount = Partner::where('status', 'disetujui')->count();

        // Donasi Stats
        $donationsCount = Donasi::count();
        $donationsPendingCount = Donasi::where('status', 'pending')->count();
        $donationsSuccessCount = Donasi::where('status', 'diterima')->count();

        // User Stats
        $usersCount = User::count();
        $usersAdminCount = User::where('role', 'admin')->count();

        // Get latest records
        $latestBeritas = Berita::latest()->take(5)->get();
        $latestDonations = Donasi::with('user')->orderBy('created_at', 'desc')->take(3)->get();
        $latestPartners = Partner::with('user')->orderBy('created_at', 'desc')->take(3)->get();

        return view('admin.dashboard', compact(
            'newsCount', 'newsDraftCount', 'newsPublishCount',
            'partnersCount', 'partnersPendingCount', 'partnersApprovedCount',
            'donationsCount', 'donationsPendingCount', 'donationsSuccessCount',
            'usersCount', 'usersAdminCount',
            'latestBeritas', 'latestDonations', 'latestPartners'
        ));
    }
}
