<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiPenjualanController;
use App\Http\Controllers\KategoriPengeluaranController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'login'])
    ->name('login');

Route::post('/login', [AuthController::class, 'authenticate'])
    ->name('login.authenticate');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return 'Selamat datang di Dashboard Sistem Kasir Hidroponik!';
    })->name('dashboard');

    Route::get('/produk', [ProdukController::class, 'index'])
        ->name('produk.index');

    Route::get('/produk/create', [ProdukController::class, 'create'])
        ->name('produk.create');

    Route::post('/produk', [ProdukController::class, 'store'])
        ->name('produk.store');

    Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])
        ->name('produk.edit');

    Route::put('/produk/{id}', [ProdukController::class, 'update'])
        ->name('produk.update');

    Route::put('/produk/{id}/deactivate', [ProdukController::class, 'deactivate'])
        ->name('produk.deactivate');

    Route::get('/transaksi', [TransaksiPenjualanController::class, 'index'])
        ->name('transaksi.index');

    Route::get('/transaksi/create', [TransaksiPenjualanController::class, 'create'])
        ->name('transaksi.create');

    Route::post('/transaksi', [TransaksiPenjualanController::class, 'store'])
        ->name('transaksi.store');

    Route::get('/transaksi/{id}', [TransaksiPenjualanController::class, 'show'])
        ->name('transaksi.show');

    Route::post('/transaksi/{id}/detail', [TransaksiPenjualanController::class, 'addDetail'])
        ->name('transaksi.addDetail');

    Route::put('/transaksi/{id}/complete', [TransaksiPenjualanController::class, 'complete'])
    ->name('transaksi.complete');    

    Route::get('/kategori-pengeluaran', [KategoriPengeluaranController::class, 'index'])
    ->name('kategori-pengeluaran.index');

    Route::get('/kategori-pengeluaran/create', [KategoriPengeluaranController::class, 'create'])
        ->name('kategori-pengeluaran.create');

    Route::post('/kategori-pengeluaran', [KategoriPengeluaranController::class, 'store'])
        ->name('kategori-pengeluaran.store');

    Route::get('/kategori-pengeluaran/{id}/edit', [KategoriPengeluaranController::class, 'edit'])
        ->name('kategori-pengeluaran.edit');

    Route::put('/kategori-pengeluaran/{id}', [KategoriPengeluaranController::class, 'update'])
        ->name('kategori-pengeluaran.update');

    Route::delete('/kategori-pengeluaran/{id}', [KategoriPengeluaranController::class, 'destroy'])
        ->name('kategori-pengeluaran.destroy');
});