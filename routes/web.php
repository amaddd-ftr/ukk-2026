<?php

use App\Controllers\Core\AuthController;
use App\Controllers\Core\DashboardController;
use App\Controllers\Core\DatabaseController;
use App\Controllers\Core\DocsController;
use App\Controllers\Core\RoleController;
use App\Controllers\Core\UserController;
use App\Controllers\KategoriController;
use App\Controllers\LokasiController;
use App\Controllers\KondisiController;
use App\Controllers\SiswaController;
use Sakuci\Route;

/*
|--------------------------------------------------------------------------
| Route Web
|--------------------------------------------------------------------------
| Daftarkan seluruh route aplikasi di sini.
|
| Cara menulis action:
|   [HomeController::class, 'index']   -> disarankan
|   'HomeController@index'             -> namespace App\Controllers otomatis
|   function () { ... }                -> closure
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/docs', [DocsController::class, 'index'])->name('docs');

/*
|--------------------------------------------------------------------------
| Login multi-role
|--------------------------------------------------------------------------
| Lihat /docs untuk penjelasan lengkap langkah demi langkah.
*/

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('register.attempt')->middleware('guest');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', [DashboardController::class, 'admin'])->name('admin.dashboard');

    Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles.index');
    Route::post('/roles', [RoleController::class, 'store'])->name('admin.roles.store');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('admin.roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');

    Route::get('/database/export', [DatabaseController::class, 'export'])->name('admin.database.export');

//Kategori
    Route::get('/kategori', [KategoriController::class, 'index'])->name('admin.kategori.index');
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('admin.kategori.create');
    Route::post('/kategori/store', [KategoriController::class, 'store'])->name('admin.kategori.store');
    Route::get('/kategori/{id_kategori}/edit', [KategoriController::class, 'edit'])->name('admin.kategori.edit');
    Route::post('/kategori/{id_kategori}', [KategoriController::class, 'update'])->name('admin.kategori.update');
    Route::delete('/kategori/{id_kategori}', [KategoriController::class, 'delete'])->name('admin.kategori.delete');

//Lokasi
  Route::get('/Lokasi', [LokasiController::class, 'index'])->name('admin.lokasi.index');
  Route::get('/lokasi/create', [LokasiController::class, 'create'])->name('admin.lokasi.create');
  Route::post('/lokasi/store', [LokasiController::class, 'store'])->name('admin.lokasi.store');
  Route::get('/lokasi/{id_lokasi}/edit', [LokasiController::class, 'edit'])->name('admin.lokasi.edit');
  Route::post('/lokasi/{id_lokasi}', [LokasiController::class, 'update'])->name('admin.lokasi.update');
  Route::delete('/lokasi/{id_lokasi}', [LokasiController::class, 'delete'])->name('admin.lokasi.delete');

//Kondisi
  Route::get('/kondisi', [KondisiController::class, 'index'])->name('admin.kondisi.index');
  Route::get('/kondisi/create', [KondisiController::class, 'create'])->name('admin.kondisi.create');
  Route::post('/kondisi/store', [KondisiController::class, 'store'])->name('admin.kondisi.store');
  Route::get('/kondisi/{id_kondisi}/edit', [KondisiController::class, 'edit'])->name('admin.kondisi.edit');
  Route::post('/Kondisi/{id_kondisi}', [KondisiController::class, 'update'])->name('admin.kondisi.update');
  Route::delete('/kondisi/{id_kondisi}', [KondisiController::class, 'delete'])->name('admin.kondisi.delete');

//siswa
  Route::get('/siswa', [SiswaController::class, 'index'])->name('admin.siswa.index');
  Route::get('/siswa/create', [SiswaController::class, 'create'])->name('admin.siswa.create');
  Route::post('/siswa/store', [SiswaController::class, 'store'])->name('admin.siswa.store');
  Route::get('/siswa/{id_siswa}/edit', [SiswaController::class, 'edit'])->name('admin.siswa.edit');
  Route::post('/siswa/{id_siswa}', [SiswaController::class, 'update'])->name('admin.siswa.update');
});

/*
|--------------------------------------------------------------------------
| Route role dinamis
|--------------------------------------------------------------------------
| Blok di bawah ini dikelola otomatis oleh RoleController saat admin
| menambah, mengganti nama, atau menghapus role lewat /admin/roles.
| Jangan diedit manual -- perubahan bisa tertimpa.
*/
// @generated-roles:start

// @role:siswa:start
Route::group(['prefix' => 'siswa', 'middleware' => 'siswa'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('siswa.dashboard');
});
// @role:siswa:end
// @generated-roles:end

/*
|--------------------------------------------------------------------------
| Contoh (hapus/ubah sesuai kebutuhan)
|--------------------------------------------------------------------------
|
| use App\Controllers\BukuController;
|
| Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
|
| // Tujuh route CRUD sekaligus: index, create, store, show, edit, update, destroy
| // Route::resource
|
| // Group dengan prefix dan middleware bersama
| Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
|     Route::get('/dashboard', [DashboardController::class, 'index']);
| });
*/

