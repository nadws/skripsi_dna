<?php

use App\Http\Controllers\AccPengajuanPermintaanassetController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepartemenCOntroller;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\KategoriAssetController;
use App\Http\Controllers\PerbaikanAssetController;
use App\Http\Controllers\PermintaanBarangController;
use App\Http\Controllers\SuplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::controller(UserController::class)
        ->prefix('user')
        ->name('user.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::get('/getEdit', 'getEdit')->name('getEdit');
            Route::post('/update', 'update')->name('update');
        });

    Route::controller(CabangController::class)
        ->prefix('cabang')
        ->name('cabang.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::get('/delete/{id}', 'delete')->name('delete');
        });

    Route::controller(KategoriAssetController::class)
        ->prefix('kategori')
        ->name('kategori.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
        });

    Route::controller(DepartemenCOntroller::class)
        ->prefix('departemen')
        ->name('departemen.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
        });

    Route::controller(KaryawanController::class)
        ->prefix('karyawan')
        ->name('karyawan.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
        });
    Route::controller(BarangController::class)
        ->prefix('barang')
        ->name('barang.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
        });
    Route::controller(PeminjamanController::class)
        ->prefix('peminjaman')
        ->name('peminjaman.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/getDataPeminjaman', 'getDataPeminjaman')->name('getDataPeminjaman');
            Route::post('/store', 'store')->name('store');
            Route::post('/accepted', 'accepted')->name('accepted');
        });
    Route::controller(SuplierController::class)
        ->prefix('suplier')
        ->name('suplier.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
        });
    Route::controller(PermintaanBarangController::class)
        ->prefix('permintaan')
        ->name('permintaan.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/get_asset', 'get_asset')->name('get_asset');
            Route::get('/get_stock', 'get_stock')->name('get_stock');
            Route::post('/store', 'store')->name('store');
        });
    Route::controller(AccPengajuanPermintaanassetController::class)
        ->prefix('accpermintaan')
        ->name('accpermintaan.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/getEdit', 'getEdit')->name('getEdit');
            Route::post('/edit', 'edit')->name('edit');
        });
    Route::controller(VendorController::class)
        ->prefix('vendor')
        ->name('vendor.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::get('/getEdit', 'getEdit')->name('getEdit');
            Route::post('/edit', 'edit')->name('edit');
        });
    Route::controller(PerbaikanAssetController::class)
        ->prefix('perbaikan')
        ->name('perbaikan.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/getAssetKaryawan', 'getAssetKaryawan')->name('getAssetKaryawan');
            Route::get('/getQtyAssetKaryawan', 'getQtyAssetKaryawan')->name('getQtyAssetKaryawan');
            Route::get('/getStockCabang', 'getStockCabang')->name('getStockCabang');
            Route::post('/store', 'store')->name('store');
            Route::get('/getEdit', 'getEdit')->name('getEdit');
            Route::post('/edit', 'edit')->name('edit');
        });
});



require __DIR__ . '/auth.php';
