<?php

use App\Http\Controllers\CallbackHandler;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MangaController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\MangakaController;
use App\Http\Controllers\VolMangaController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\UserController;


use App\Http\Controllers\KeranjangController;
use  App\Http\Controllers\PembelianController;
use App\Http\Controllers\TransaksiController;


use App\Http\Controllers\KiosMangaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [KiosMangaController::class, 'homePage'])->name('home');
Route::get('/manga', [KiosMangaController::class, 'listManga'])->name('list-manga');
Route::get('/manga/series/{slugManga}', [KiosMangaController::class, 'listVol'])->name('list-volume');
Route::get('/manga/{slugVol}', [KiosMangaController::class, 'detailManga'])->name('detail-manga');




Route::middleware('guest')->group(function () {
    Route::get('/daftar', function () {
        return view('Frontend.Pages.daftar');
    })->name('register-page');
    Route::post('/daftar', [UserController::class, 'daftar'])->name('register-store');


    Route::get('/login', function () {
        return view('Frontend.Pages.login');
    })->name('login-page');
    Route::post('/authenticate', [KiosMangaController::class, 'authentication'])->name('auth');

    Route::get('/lupa-password', function () {
        return view('Frontend.Pages.lupa_password.cek_email');
    })->name('password-page');

    Route::post('/lupa-password', [KiosMangaController::class, 'lupaPassword'])->name('lupa-password');
});





Route::middleware('auth', 'preventAdmin')->group(function () {
    Route::get('/profile', [UserController::class, 'profilePage'])->name('profile-page');
    Route::post('/profile/{username}', [UserController::class, 'ubahBiodata'])->name('ubah-biodata');
    Route::post('/resetPassword', [UserController::class, 'resetPassword'])->name('reset-password');

    Route::get('/profile/transaksi', [TransaksiController::class, 'daftarTransaksi'])->name('daftar-transaksi');

    Route::get('/library', [KiosMangaController::class, 'libraryPage'])->name('library');
    
    Route::get('/keranjang', [KiosMangaController::class, 'listKeranjang'])->name('list-keranjang');
    Route::get('/keranjang/add-item/{slugVol}', [KiosMangaController::class, 'addToKeranjang'])->name('add-item');
    Route::delete('/keranjang/hapus-item', [KiosMangaController::class, 'hapusItemsKeranjang'])->name('hapus-item');

    Route::get('/manga/konfirmasiPembayaran/{volManga}', [TransaksiController::class, 'beliInstant'])->name('beli-sekarang');
    Route::get('/konfirmasiPembayaran', [TransaksiController::class, 'beliDariKeranjang'])->name('beli-keranjang');
    
    Route::post('/konfirmasiPembayaran', [TransaksiController::class, 'transaksiLewatKeranjang'])->name('konfirmasiPembayaran-keranjang');
    Route::post('/manga/konfirmasiPembayaran/{idVol}', [TransaksiController::class, 'transaksiPembelianLangsung'])->name('konfirmasiPembayaran-langsung');

    Route::get('pembayaran/{external_id}', [TransaksiController::class, 'prosesPembayaran'])->name('pembayaran');


    Route::get('/baca/{slugVol}/{page}', [KiosMangaController::class, 'bacaManga'])->name('read-manga');




    Route::get('/simulasi/{external_id}', [TransaksiController::class, 'halamanSimulasi']);
    Route::post('/simulasi', [TransaksiController::class, 'simulasiPembayaran'])->name('post-simulation');
    
});


Route::get('/logging-out', [KiosMangaController::class, 'logout'])->name('logout')->middleware('auth');

Route::post('/callback/pembayaran', [CallbackHandler::class, 'callbackPembayaran']);
Route::post('/callback/va', [CallbackHandler::class, 'callbackVirtualAccount']);






Route::middleware('auth', 'isAdmin')->group(function () {
    Route::get('/admin/dashboard', [KiosMangaController::class, 'dashboardAdmin'])->name('dashboard-admin');


    Route::get('/admin/mangaka', [MangakaController::class, 'index'])->name('all-mangaka');
    Route::post('/admin/mangaka', [MangakaController::class, 'store'])->name('store-mangaka');
    Route::get('/admin/mangaka/{mangaka}', [MangakaController::class, 'edit'])->name('show-mangaka');
    Route::put('/admin/mangaka/{id}', [MangakaController::class, 'update'])->name('update-mangaka');
    Route::delete('/admin/mangaka/{mangaka}', [MangakaController::class, 'destroy'])->name('update-mangaka');
    

    Route::get('/admin/penerbit', [PenerbitController::class, 'index'])->name('all-penerbit');
    Route::post('/admin/penerbit', [PenerbitController::class, 'store'])->name('store-penerbit');
    Route::get('/admin/penerbit/{penerbit}', [PenerbitController::class, 'edit'])->name('show-penerbit');
    Route::put('/admin/penerbit/{id}', [PenerbitController::class, 'update'])->name('update-penerbit');
    Route::delete('/admin/penerbit/{penerbit}', [PenerbitController::class, 'destroy'])->name('update-penerbit');
    

    Route::get('/admin/genre', [GenreController::class, 'index'])->name('all-genre');
    Route::post('/admin/genre', [GenreController::class, 'store'])->name('store-genre');
    Route::get('/admin/genre/{genre}', [GenreController::class, 'edit'])->name('show-genre');
    Route::put('/admin/genre/{id}', [GenreController::class, 'update'])->name('update-genre');
    Route::delete('/admin/genre/{genre}', [GenreController::class, 'destroy'])->name('update-genre');
    

    Route::get('/admin/user', [UserController::class, 'index'])->name('all-user');
    Route::post('/admin/user', [UserController::class, 'store'])->name('store-user');
    Route::get('/admin/user/{user}', [UserController::class, 'edit'])->name('show-user');
    Route::put('/admin/user/{user}', [UserController::class, 'update'])->name('update-user');
    Route::delete('/admin/user/{user}', [UserController::class, 'destroy'])->name('update-user');
    

    Route::get('/admin/manga', [MangaController::class, 'index'])->name('all-manga');
    Route::post('/admin/manga', [MangaController::class, 'store'])->name('store-manga');
    Route::get('/admin/manga/{manga}', [MangaController::class, 'edit'])->name('show-manga');
    Route::put('/admin/manga/{manga}', [MangaController::class, 'update'])->name('update-manga');
    Route::delete('/admin/manga/{manga}', [MangaController::class, 'destroy'])->name('update-manga');
    

    Route::get('/admin/manga/{slug}/vol', [VolMangaController::class, 'index'])->name('all-vol');
    Route::post('/admin/vol/{id}', [VolMangaController::class, 'store'])->name('store-vol');
    Route::get('/admin/vol/{volManga}', [VolMangaController::class, 'edit'])->name('show-vol');
    Route::put('/admin/vol/{volManga}', [VolMangaController::class, 'update'])->name('update-vol');
    Route::delete('/admin/vol/{volManga}', [VolMangaController::class, 'destroy'])->name('update-vol');


    Route::get('/admin/cart', [KeranjangController::class, 'index'])->name('all-keranjang');
    Route::get('/admin/cart/download', [KeranjangController::class, 'downloadCSV'])->name('keranjang-csv');


    Route::get('/admin/pembelian', [PembelianController::class, 'index'])->name('all-pembelian');
    Route::get('/admin/pembelian/download', [PembelianController::class, 'downloadCSV'])->name('pembelian-csv');


    Route::get('/admin/transaksi', [TransaksiController::class, 'index'])->name('all-transaksi');
    Route::get('/admin/transaksi/download', [TransaksiController::class, 'downloadCSV'])->name('transaksi-csv');
});