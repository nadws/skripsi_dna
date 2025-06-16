<?php

use App\Http\Controllers\AccDisposalController;
use App\Http\Controllers\AccPengajuanPermintaanassetController;
use App\Http\Controllers\AccPerbaikanAssetController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepartemenCOntroller;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\DisposalController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\KategoriAssetController;
use App\Http\Controllers\laporanKaryawan;
use App\Http\Controllers\LaporanStokInventaris;
use App\Http\Controllers\LaporanDepartemen;
use App\Http\Controllers\LaporanCabang;
use App\Http\Controllers\LaporanDisposal;
use App\Http\Controllers\LaporanPeminjamanIventaris;
use App\Http\Controllers\LaporanPerbaikanIventaris;
use App\Http\Controllers\LaporanPermintaanInventaris;
use App\Http\Controllers\NotifikasiController;
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
    Route::controller(NotifikasiController::class)
        ->prefix('notifikasi')
        ->name('notifikasi.')
        ->group(function () {
            Route::get('/edit', 'edit')->name('edit');
        });

    Route::controller(CabangController::class)
        ->prefix('cabang')
        ->name('cabang.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::get('/getEdit', 'getEdit')->name('getEdit');
            Route::get('/delete/{id}', 'delete')->name('delete');
            Route::post('/update', 'update')->name('update');
        });

    Route::controller(KategoriAssetController::class)
        ->prefix('kategori')
        ->name('kategori.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::get('/delete/{id}', 'delete')->name('delete');
            Route::get('/getEdit', 'getEdit')->name('getEdit');
            Route::post('/update', 'update')->name('update');
        });

    Route::controller(SuplierController::class)
        ->prefix('suplier')
        ->name('suplier.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::get('/delete/{id}', 'delete')->name('delete');
            Route::get('/getEdit', 'getEdit')->name('getEdit');
            Route::post('/update', 'update')->name('update');
        });

    Route::controller(VendorController::class)
        ->prefix('vendor')
        ->name('vendor.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::get('/getEdit', 'getEdit')->name('getEdit');
            Route::post('/update', 'update')->name('update');
            Route::get('/delete/{id}', 'delete')->name('delete');
        });

    Route::controller(DepartemenCOntroller::class)
        ->prefix('departemen')
        ->name('departemen.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::get('/delete/{id}', 'delete')->name('delete');
            Route::get('/getEdit', 'getEdit')->name('getEdit');
            Route::post('/update', 'update')->name('update');
        });

    Route::controller(KaryawanController::class)
        ->prefix('karyawan')
        ->name('karyawan.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::get('/delete/{id}', 'delete')->name('delete');
            Route::get('/getEdit', 'getEdit')->name('getEdit');
            Route::post('/update', 'update')->name('update');
        });
    Route::controller(BarangController::class)
        ->prefix('barang')
        ->name('barang.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::get('/delete/{id}', 'delete')->name('delete');
            Route::get('/getEdit', 'getEdit')->name('getEdit');
            Route::post('/update', 'update')->name('update');
        });
    Route::controller(PeminjamanController::class)
        ->prefix('peminjaman')
        ->name('peminjaman.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/formulir', 'formulir')->name('formulir');
            Route::get('/getDataPeminjaman', 'getDataPeminjaman')->name('getDataPeminjaman');
            Route::post('/store', 'store')->name('store');
            Route::post('/accepted', 'accepted')->name('accepted');
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

    Route::controller(PerbaikanAssetController::class)
        ->prefix('perbaikan')
        ->name('perbaikan.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/getAssetKaryawan', 'getAssetKaryawan')->name('getAssetKaryawan');
            Route::get('/getQtyAssetKaryawan', 'getQtyAssetKaryawan')->name('getQtyAssetKaryawan');
            Route::get('/getStockCabang', 'getStockCabang')->name('getStockCabang');
            Route::get('/getPerbaikan', 'getPerbaikan')->name('getPerbaikan');
            Route::post('/store', 'store')->name('store');
            Route::get('/getEdit', 'getEdit')->name('getEdit');
            Route::post('/selesai', 'selesai')->name('selesai');
        });
    Route::controller(AccPerbaikanAssetController::class)
        ->prefix('accperbaikan')
        ->name('accperbaikan.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/getPerbaikan', 'getPerbaikan')->name('getPerbaikan');
            Route::post('/edit', 'edit')->name('edit');
        });
    Route::controller(DisposalController::class)
        ->prefix('disposal')
        ->name('disposal.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
        });
    Route::controller(AccDisposalController::class)
        ->prefix('accdisposal')
        ->name('accdisposal.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/getDisposal', 'getDisposal')->name('getDisposal');
            Route::post('/edit', 'edit')->name('edit');
        });
    Route::controller(LaporanStokInventaris::class)
        ->prefix('stok_inventaris')
        ->name('stok_inventaris.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/getStok', 'getStok')->name('getStok');
            Route::get('/print', 'print')->name('print');
        });
    Route::controller(laporanKaryawan::class)
        ->prefix('laporan_karyawan')
        ->name('laporan_karyawan.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/getKaryawan', 'getKaryawan')->name('getKaryawan');
            Route::get('/print', 'print')->name('print');
        });
    Route::controller(LaporanCabang::class)
        ->prefix('laporan_cabang')
        ->name('laporan_cabang.')
        ->group(function () {
            Route::get('/', 'index')->name('index');

            Route::get('/print', 'print')->name('print');
        });
    Route::controller(LaporanDepartemen::class)
        ->prefix('laporan_departemen')
        ->name('laporan_departemen.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/getdepartemen', 'getdepartemen')->name('getdepartemen');
            Route::get('/print', 'print')->name('print');
        });
    Route::controller(LaporanPeminjamanIventaris::class)
        ->prefix('laporan_peminjaman_inventaris')
        ->name('laporan_peminjaman_inventaris.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/getdata', 'getdata')->name('getdata');
            Route::get('/print', 'print')->name('print');
        });
    Route::controller(LaporanPerbaikanIventaris::class)
        ->prefix('laporan_perbaikan_inventaris')
        ->name('laporan_perbaikan_inventaris.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/getdata', 'getdata')->name('getdata');
            Route::get('/print', 'print')->name('print');
        });
    Route::controller(LaporanPermintaanInventaris::class)
        ->prefix('laporan_permintaan_inventaris')
        ->name('laporan_permintaan_inventaris.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/getdata', 'getdata')->name('getdata');
            Route::get('/print', 'print')->name('print');
        });
    Route::controller(LaporanDisposal::class)
        ->prefix('laporan_disposal')
        ->name('laporan_disposal.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/getdata', 'getdata')->name('getdata');
            Route::get('/print', 'print')->name('print');
        });
});



require __DIR__ . '/auth.php';
