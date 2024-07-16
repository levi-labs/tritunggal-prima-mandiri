<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\KategoriController;
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
