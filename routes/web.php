<?php

use App\Http\Controllers\adminConteroller;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GambarController;
use App\Http\Controllers\GambartentangController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\userController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [userController::class, 'index'])->name('home');
Route::get('/login', [adminConteroller::class, 'login'])->name('login');
Route::post('/login/auth', [adminConteroller::class, 'Authlogin'])->name('login.auth');
Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [adminConteroller::class, 'index'])->name('admin.home');
    Route::get('/admin/berita', [adminConteroller::class, 'berita'])->name('admin.berita');
    Route::post('/admin/berita/store',[BeritaController::class,'add'])->name('berita.store');
    Route::get('/admin/berita/delete/{id}',[BeritaController::class,'delete'])->name('admin.berita.delete');
    Route::put('/admin/berita/update/{id}',[BeritaController::class,'edit'])->name('admin.berita.update');
    Route::put('/admin/masukan/read/{id}',[KontakController::class,'markAsRead'])->name('admin.kontak.read');
    Route::get('/admin/masukan', [adminConteroller::class, 'kontak'])->name('admin.masukan');
    Route::get('/admin/perusahaan', [adminConteroller::class, 'perusahaan'])->name('admin.perusahaan');
    Route::post('/admin/perusahaan/store',[TentangController::class,'add'])->name('perusahaan.store');
    Route::get('/logout/admin', [adminConteroller::class, 'logout'])->name('logout.admin');
    Route::get('/admin/galeri', [adminConteroller::class, 'galeri'])->name('admin.galeri');
    Route::post('/admin/galeri/store',[GambarController::class,'add'])->name('galeri.store');
    Route::get('/admin/galeri/delete/{id}',[GambarController::class,'delete'])->name('admin.deletegaleri');
    Route::put('/admin/galeri/update/{id}',[GambarController::class,'edit'])->name('galeri.update');
    Route::post('/admin/perusahaan/gambar/store/{id}',[GambartentangController::class,'add'])->name('perusahaan.gambar.store');
});

//user
Route::get('/kontakKami', [userController::class, 'kontakKami'])->name('kontakKami');
Route::post('/kontakKami/store',[KontakController::class,'masukan'])->name('kontak.store');
Route::get('/berita', [userController::class, 'berita'])->name('berita');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');
Route::get('/galeri', [GambarController::class, 'index'])->name('galeri');
Route::get('/tentang', [TentangController::class, 'index'])->name('tentang');
Route::middleware(['user'])->group(function () {
    Route::post('/komentar/store',[KomentarController::class,'komentar'])->name('komentar.store');
    Route::get('/logout', [adminConteroller::class, 'logout'])->name('logout');
});
