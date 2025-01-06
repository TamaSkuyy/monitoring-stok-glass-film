<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\OrderController;
use App\Models\Order;
use Illuminate\Auth\Middleware\Authenticate;
use \Illuminate\Support\Facades\Auth;

Route::middleware([Authenticate::class])->group(function () {
    Route::resource('barang', BarangController::class);
    Route::resource('vendor', VendorController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::resource('order', OrderController::class);
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
