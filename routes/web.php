<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SupplierController;
use App\Models\Supplier;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::controller(SupplierController::class)->prefix('supplier')->group(function () {
    Route::get('/', 'index')->name('supplier.index');
    Route::get('/create', 'create')->name('supplier.create');
    Route::post('/store', 'store')->name('supplier.store');
    Route::get('/edit/{supplier}', 'edit')->name('supplier.edit');
    Route::put('/update/{supplier}', 'update')->name('supplier.update');
    Route::delete('/destroy/{supplier}', 'destroy')->name('supplier.destroy');
});

Route::controller(KategoriController::class)->prefix('kategori')->group(function () {
    Route::get('/', 'index')->name('kategori.index');
    Route::get('/create', 'create')->name('kategori.create');
    Route::post('/store', 'store')->name('kategori.store');
    Route::get('/edit/{kategori}', 'edit')->name('kategori.edit');
    Route::put('/update/{kategori}', 'update')->name('kategori.update');
    Route::delete('/destroy/{kategori}', 'destroy')->name('kategori.destroy');
});

Route::controller(GudangController::class)->prefix('gudang')->group(function () {
    Route::get('/', 'index')->name('gudang.index');
    Route::get('/create', 'create')->name('gudang.create');
    Route::post('/store', 'store')->name('gudang.store');
    Route::get('/edit/{gudang}', 'edit')->name('gudang.edit');
    Route::put('/update/{gudang}', 'update')->name('gudang.update');
    Route::delete('/destroy/{gudang}', 'destroy')->name('gudang.destroy');
});

Route::controller(PembelianController::class)->prefix('pembelian')->group(function () {
    Route::get('/index/{gudang?}', 'index')->name('pembelian.index');
    Route::get('/show/{pembelian}', 'show')->name('pembelian.show');
    Route::get('/create', 'create')->name('pembelian.create');
    Route::post('/store', 'store')->name('pembelian.store');
    Route::get('/edit/{pembelian}', 'edit')->name('pembelian.edit');
    Route::get('/accept/{pembelian}', 'accept')->name('pembelian.accept');
    Route::put('/update/{pembelian}', 'update')->name('pembelian.update');
    Route::delete('/destroy/{pembelian}', 'destroy')->name('pembelian.destroy');
    Route::get('/insert-barang-to-gudang/{pembelian}', 'insertBarangToGudang')->name('pembelian.insert.gudang');
    Route::post('/insert-barang-to-gudang/{pembelian}', 'insertBarangToGudangStore')->name('pembelian.insert.gudang.store');
});

Route::controller(PenjualanController::class)->prefix('penjualan')->group(function () {
    Route::get('/', 'index')->name('penjualan.index');
    Route::get('/show/{kode}', 'show')->name('penjualan.show');
    Route::get('/get-barang', 'getBarang')->name('penjualan.getbarang');
    Route::get('/create', 'create')->name('penjualan.create');
    Route::get('/add-other', 'addOther')->name('penjualan.add.other');
    Route::post('/store', 'store')->name('penjualan.store');
    Route::get('/edit/{penjualan}', 'edit')->name('penjualan.edit');
    Route::put('/update/{penjualan}', 'update')->name('penjualan.update');
    Route::delete('/destroy/{penjualan}', 'destroy')->name('penjualan.destroy');
});

Route::controller(ReportController::class)->prefix('report')->group(function () {

    Route::get('/pembelian', 'formReportPembelian')->name('report.pembelian');
    Route::post('/pembelian', 'reportPembelian')->name('report.pembelian.post');
    Route::get('/penjualan', 'penjualan')->name('report.penjualan');
});
