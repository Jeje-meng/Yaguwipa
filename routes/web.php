<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartnerController;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

Route::get('/', [HomeController::class, 'index'])->name('home');

use App\Http\Controllers\GalleryController;

Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery');

use App\Http\Controllers\BeritaController;

Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

Route::get('/agenda/{id}', [HomeController::class, 'showAgenda'])->name('agenda.show');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Forgot Password Routes
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

use App\Http\Controllers\DonasiController;

Route::middleware('auth')->group(function () {

    Route::get('/partner', [PartnerController::class,'index'])->name('partner.index');

    Route::get('/partner/create',[PartnerController::class,'create'])->name('partner.create');

    Route::post('/partner/store',[PartnerController::class,'store'])->name('partner.store');

    Route::get('/partner/edit/{id}',[PartnerController::class,'edit'])->name('partner.edit');

    Route::put('/partner/update/{id}',[PartnerController::class,'update'])->name('partner.update');

    Route::delete('/partner/delete/{id}',[PartnerController::class,'destroy'])->name('partner.delete');

    // Donation routes
    Route::post('/donasi/uang', [DonasiController::class, 'submitUang'])->name('donasi.uang.submit');
    Route::get('/donasi/payment/{id}', [DonasiController::class, 'paymentPage'])->name('donasi.payment');
    Route::post('/donasi/payment/{id}/upload', [DonasiController::class, 'uploadReceipt'])->name('donasi.payment.upload');
    Route::post('/donasi/payment/{id}/cancel', [DonasiController::class, 'cancelDonation'])->name('donasi.payment.cancel');
    Route::post('/donasi/barang', [DonasiController::class, 'submitBarang'])->name('donasi.barang.submit');

    // Profile Settings
    Route::get('/profil', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profil/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profil/delete-photo', [ProfileController::class, 'deletePhoto'])->name('profile.delete-photo');

    // Agenda Join routes
    Route::post('/agenda/{id}/ikut', [HomeController::class, 'ikutAgenda'])->name('agenda.ikut');
    Route::post('/agenda/{id}/batal-ikut', [HomeController::class, 'batalIkutAgenda'])->name('agenda.batal-ikut');

});

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PartnerAdminController;
use App\Http\Controllers\Admin\DonasiController as DonasiAdminController;
use App\Http\Controllers\Admin\AgendaController as AgendaAdminController;
use App\Http\Controllers\Admin\BeritaController as BeritaAdminController;
use App\Http\Controllers\Admin\GalleryController as GalleryAdminController;
use App\Http\Controllers\Admin\UserController as UserAdminController;
use App\Http\Controllers\Admin\SettingController;

Route::get('/admin', function() {
    return redirect('/backoffice/dashboard');
});
Route::get('/admin/{any}', function($any) {
    return redirect('/backoffice/dashboard');
})->where('any', '.*');

Route::middleware(['auth', 'admin'])->prefix('backoffice')->name('admin.')->group(function() {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Partner Management
    Route::get('/partner', [PartnerAdminController::class, 'index'])->name('partner.index');
    Route::get('/partner/create', [PartnerAdminController::class, 'create'])->name('partner.create');
    Route::post('/partner/store', [PartnerAdminController::class, 'store'])->name('partner.store');
    Route::get('/partner/edit/{id}', [PartnerAdminController::class, 'edit'])->name('partner.edit');
    Route::put('/partner/update/{id}', [PartnerAdminController::class, 'update'])->name('partner.update');
    Route::delete('/partner/delete/{id}', [PartnerAdminController::class, 'destroy'])->name('partner.delete');
    Route::put('/partner/setujui/{id}', [PartnerAdminController::class, 'setujui'])->name('partner.setujui');
    Route::put('/partner/tolak/{id}', [PartnerAdminController::class, 'tolak'])->name('partner.tolak');

    // Donation Management
    Route::get('/donasi', [DonasiAdminController::class, 'index'])->name('donasi.index');
    Route::put('/donasi/approve/{id}', [DonasiAdminController::class, 'approve'])->name('donasi.approve');
    Route::put('/donasi/reject/{id}', [DonasiAdminController::class, 'reject'])->name('donasi.reject');

    // Agenda CRUD
    Route::get('/agenda', [AgendaAdminController::class, 'index'])->name('agenda.index');
    Route::get('/agenda/create', [AgendaAdminController::class, 'create'])->name('agenda.create');
    Route::post('/agenda/store', [AgendaAdminController::class, 'store'])->name('agenda.store');
    Route::get('/agenda/edit/{id}', [AgendaAdminController::class, 'edit'])->name('agenda.edit');
    Route::put('/agenda/update/{id}', [AgendaAdminController::class, 'update'])->name('agenda.update');
    Route::delete('/agenda/delete/{id}', [AgendaAdminController::class, 'destroy'])->name('agenda.delete');
    Route::get('/agenda/{id}/peserta', [AgendaAdminController::class, 'viewPeserta'])->name('agenda.peserta');

    // Berita CRUD
    Route::get('/berita', [BeritaAdminController::class, 'index'])->name('berita.index');
    Route::get('/berita/create', [BeritaAdminController::class, 'create'])->name('berita.create');
    Route::post('/berita/store', [BeritaAdminController::class, 'store'])->name('berita.store');
    Route::get('/berita/edit/{id}', [BeritaAdminController::class, 'edit'])->name('berita.edit');
    Route::put('/berita/update/{id}', [BeritaAdminController::class, 'update'])->name('berita.update');
    Route::delete('/berita/delete/{id}', [BeritaAdminController::class, 'destroy'])->name('berita.delete');

    // Gallery CRUD
    Route::get('/gallery', [GalleryAdminController::class, 'index'])->name('gallery.index');
    Route::get('/gallery/create', [GalleryAdminController::class, 'create'])->name('gallery.create');
    Route::post('/gallery/store', [GalleryAdminController::class, 'store'])->name('gallery.store');
    Route::delete('/gallery/delete/{id}', [GalleryAdminController::class, 'destroy'])->name('gallery.delete');

    // User Management
    Route::get('/users', [UserAdminController::class, 'index'])->name('users.index');
    Route::post('/users/toggle-role/{id}', [UserAdminController::class, 'toggleRole'])->name('users.toggle');
    Route::delete('/users/delete/{id}', [UserAdminController::class, 'destroy'])->name('users.delete');

    // Homepage Content Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings/update', [SettingController::class, 'update'])->name('settings.update');

    // Donation Settings
    Route::get('/settings/donasi', [SettingController::class, 'donasiIndex'])->name('settings.donasi');
    Route::post('/settings/donasi/update', [SettingController::class, 'donasiUpdate'])->name('settings.donasi.update');
});