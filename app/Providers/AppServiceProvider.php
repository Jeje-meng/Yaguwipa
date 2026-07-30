<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('layouts.admin', function ($view) {
            if (auth()->check()) {
                $pendingDonations = \App\Models\Donasi::where('status', 'pending')
                    ->with('user')
                    ->latest()
                    ->get();
                $pendingPartners = \App\Models\Partner::where('status', 'pending')
                    ->with('user')
                    ->latest()
                    ->get();
                $view->with([
                    'pendingDonationsCount' => $pendingDonations->count(),
                    'latestPendingDonations' => $pendingDonations->take(5),
                    'pendingPartnersCount' => $pendingPartners->count(),
                    'latestPendingPartners' => $pendingPartners->take(5),
                    'totalPendingCount' => $pendingDonations->count() + $pendingPartners->count(),
                ]);
            } else {
                $view->with([
                    'pendingDonationsCount' => 0,
                    'latestPendingDonations' => collect(),
                    'pendingPartnersCount' => 0,
                    'latestPendingPartners' => collect(),
                    'totalPendingCount' => 0,
                ]);
            }
        });
    }
}
