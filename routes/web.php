<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PenjualController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Controllers\HomeController::class, 'index'])->name('home.index');
Route::get('produk/{category}', [Controllers\HomeController::class, 'produk'])->name('home.produk');
Route::get('kategori/{category}', [Controllers\HomeController::class, 'kategori'])->name('home.kategori');
Route::get('search', [Controllers\HomeController::class, 'search'])->name('home.search');
Route::get('home', [Controllers\HomeController::class, 'redir_penjual'])->name('home.redir_penjual');
Route::post('buatakun', [App\Http\Controllers\AdminController::class, 'createPenjual'])->name('admin.Buatakun');
Route::group(['middleware' => 'revalidate'], function() {
    Auth::routes(['/register' => false,'reset' => false]);
    Route::get('penjual', [App\Http\Controllers\PenjualController::class, 'index'])->name('penjual.index')->middleware(['auth', 'penjual']);

    // route produk
    Route::prefix('penjual/produk')->group(function () {
        Route::get('/', [App\Http\Controllers\PenjualController::class, 'produk'])->name('penjual.produk')->middleware(['auth', 'penjual']);
        Route::get('delete/{category}', [App\Http\Controllers\PenjualController::class, 'delete_produk'])->name('penjual.delete_produk')->middleware(['auth', 'penjual']);
        Route::post('edit', [App\Http\Controllers\PenjualController::class, 'edit_produk'])->name('penjual.edit_produk')->middleware(['auth', 'penjual']);
        Route::post('create', [App\Http\Controllers\PenjualController::class, 'create_produk'])->name('penjual.create_produk')->middleware(['auth', 'penjual']);
        Route::post('update', [App\Http\Controllers\PenjualController::class, 'update_produk'])->name('penjual.update_produk')->middleware(['auth', 'penjual']);
    });
    // route kategori
    Route::prefix('penjual/kategori')->group(function () {
        Route::get('/', [App\Http\Controllers\PenjualController::class, 'kategori'])->name('penjual.kategori')->middleware(['auth', 'penjual']);
        Route::get('delete/{category}', [App\Http\Controllers\PenjualController::class, 'delete_kategori'])->name('penjual.delete_kategori')->middleware(['auth', 'penjual']);
        Route::post('create', [App\Http\Controllers\PenjualController::class, 'create_kategori'])->name('penjual.create_kategori')->middleware(['auth', 'penjual']);
        Route::post('update', [App\Http\Controllers\PenjualController::class, 'update_kategori'])->name('penjual.update_kategori')->middleware(['auth', 'penjual']);
    });
    // route profil
    Route::prefix('penjual/profil')->group(function () {
        Route::get('/', [App\Http\Controllers\PenjualController::class, 'profil'])->name('penjual.profil')->middleware(['auth', 'penjual']);
        Route::post('update', [App\Http\Controllers\PenjualController::class, 'update_profil'])->name('penjual.update_profil')->middleware(['auth', 'penjual']);
    });
    //route pesanan
    Route::prefix('penjual/pesanan')->group(function () {
        Route::get('/', [Controllers\PenjualController::class, 'pesanan'])->name('penjual.pesanan')->middleware(['auth', 'penjual']);
        Route::get('/detailpesanan/{id}', [Controllers\PenjualController::class, 'detailpesanan'])->name('penjual.detailpesanan')->middleware(['auth', 'penjual']);
        Route::put('/pesananselesai/{id}', [Controllers\PenjualController::class, 'pesananselesai'])->name('penjual.pesananselesai')->middleware(['auth', 'penjual']);
    });
    //route penjualan
    Route::prefix('penjual/datapenjualan')->group(function () {
        Route::get('/', [Controllers\PenjualController::class, 'datapenjualan'])->name('penjual.datapenjualan')->middleware(['auth', 'penjual']);
        Route::get('/detailpenjualan/{id}', [Controllers\PenjualController::class, 'detailpenjualan'])->name('penjual.detailpenjualan')->middleware(['auth', 'penjual']);
    });
    //route pembeli
        Route::get('/keranjang', [Controllers\PembeliController::class, 'keranjang'])->name('pembeli.keranjang')->middleware(['auth', 'pembeli']);
        Route::get('/hapuspesanan/{checkout}', [Controllers\PembeliController::class, 'hapuspesanan'])->name('pembeli.hapuspesanan')->middleware(['auth', 'pembeli']);
        Route::get('/checkoutpesanan', [Controllers\PembeliController::class, 'checkoutpesanan'])->name('pembeli.checkoutpesanan')->middleware(['auth', 'pembeli']);
        Route::get('/saldo', [Controllers\PembeliController::class, 'saldo'])->name('pembeli.saldo')->middleware(['auth','pembeli']);
        Route::PATCH('/addsaldo', [Controllers\PembeliController::class, 'addsaldo'])->name('pembeli.saldo')->middleware(['auth', 'pembeli']);
        Route::get('/pesanansukses', [Controllers\PembeliController::class, 'pesanansukses'])->name('pembeli.pesanansukses')->middleware(['auth', 'pembeli']);
        Route::post('/addtoCart', [Controllers\PembeliController::class, 'addCart'])->middleware(['auth', 'pembeli']);
    //route admin
        Route::get('/homeadmin', [Controllers\AdminController::class, 'home'])->name('admin.home')->middleware(['auth', 'admin']);
});
//bayar checkout
Route::post('/bayar', [Controllers\PembeliController::class, 'bayar'])->middleware(['auth', 'pembeli']);
Route::get('/viewproduk/{id}', [Controllers\PembeliController::class, 'viewProduk'])->middleware(['auth', 'pembeli']);

    


