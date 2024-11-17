<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\KomposisiSampahController;
use App\Http\Controllers\Admin\PemilahanSampahController;
use App\Http\Controllers\Admin\TimbulanSampahController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\StatistikController;

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
    return view('pages.home');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories');
Route::get('/categories/{id}', [App\Http\Controllers\CategoryController::class, 'detail'])->name('categories-detail');

Route::get('/details/{id}', [App\Http\Controllers\DetailController::class, 'index'])->name('detail');
Route::post('/details/{id}', [App\Http\Controllers\DetailController::class, 'add'])->name('detail-add');

Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik.index');

Route::prefix('statistik')->group(function () {
    Route::get('/data-timbulan', [StatistikController::class, 'getTimbulanData'])->name('statistik.data-timbulan');
    Route::get('/data-komposisi', [StatistikController::class, 'getKomposisiData'])->name('statistik.data-komposisi');
    Route::get('/data-pemilahan', [StatistikController::class, 'getPemilahanData'])->name('statistik.data-pemilahan');
});

Route::post('/checkout/callback', [App\Http\Controllers\CheckoutController::class, 'callback'])->name('midtrans-callback');

Route::get('/success', [App\Http\Controllers\CartController::class, 'success'])->name('success');

Route::get('/register/success', [App\Http\Controllers\Auth\RegisterController::class, 'success'])->name('register-success');


Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('admin-dashboard');
    Route::resource('category', CategoryController::class);
    Route::resource('user', UserController::class);
    Route::resource('product', ProductController::class);
    Route::resource('product-gallery', ProductGalleryController::class);
    Route::delete('product-gallery/{id}', [ProductGalleryController::class, 'destroy'])->name('product-gallery.destroy');
    
    Route::resource('transaction', TransactionController::class);
    Route::put('/transaction/{id}/edit', [TransactionController::class, 'update'])->name('transaction.update');


    Route::get('/statistics', [DashboardController::class, 'statistics'])->name('admin-statistics');
    
    Route::prefix('statistics')->group(function() {
        Route::resource('komposisi', KomposisiSampahController::class);
        Route::put('/komposisi/{id}', [KomposisiSampahController::class, 'update'])->name('komposisi.update');
        Route::get('/komposisi-data', [KomposisiSampahController::class, 'getKomposisiData'])->name('komposisi.data');
        Route::resource('pemilahan', PemilahanSampahController::class);
        Route::get('/pemilahan-data', [PemilahanSampahController::class, 'getPemilahanData'])->name('pemilahan.data');
        Route::resource('timbulan', TimbulanSampahController::class);
        Route::get('/timbulan-data', [TimbulanSampahController::class, 'getTimbulanData'])->name('timbulan.data');
    });
});

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::get('/logout', [LogoutController::class, 'perform'])->name('logout.perform');

    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
    Route::delete('/cart/{id}', [App\Http\Controllers\CartController::class, 'destroy'])->name('cart-destroy');
    Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout');

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/products', [App\Http\Controllers\DashboardProductController::class, 'index'])->name('dashboard-product');
    Route::get('/dashboard/products/create', [App\Http\Controllers\DashboardProductController::class, 'create'])->name('dashboard-product-create');
    Route::post('/dashboard/products/store', [App\Http\Controllers\DashboardProductController::class, 'store'])->name('dashboard-product-store');

    Route::get('/dashboard/products/{id}', [App\Http\Controllers\DashboardProductController::class, 'details'])->name('dashboard-product-details');
    Route::post('/dashboard/products/{id}', [App\Http\Controllers\DashboardProductController::class, 'update'])->name('dashboard-product-update');

    Route::post('/dashboard/products/gallery/upload', [App\Http\Controllers\DashboardProductController::class, 'uploadGallery'])->name('dashboard-product-gallery-upload');
    Route::get('/dashboard/products/gallery/delete/{id}', [App\Http\Controllers\DashboardProductController::class, 'deleteGallery'])->name('dashboard-product-gallery-delete');

    Route::get('/dashboard/transactions', [App\Http\Controllers\DashboardTransactionController::class, 'index'])->name('dashboard-transaction');
    Route::get('/dashboard/transactions/{id}', [App\Http\Controllers\DashboardTransactionController::class, 'details'])->name('dashboard-transaction-details');
    Route::post('/dashboard/transactions/{id}', [App\Http\Controllers\DashboardTransactionController::class, 'update'])->name('dashboard-transaction-update');

    Route::get('/dashboard/settings', [App\Http\Controllers\DashboardSettingController::class, 'store'])->name('dashboard-settings-store');
    Route::get('/dashboard/account', [App\Http\Controllers\DashboardSettingController::class, 'account'])->name('dashboard-settings-account');
    Route::post('/dashboard/account/{redirect}', [App\Http\Controllers\DashboardSettingController::class, 'update'])->name('dashboard-settings-redirect');

});
