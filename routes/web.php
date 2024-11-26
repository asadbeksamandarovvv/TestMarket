<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DiscountProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderProductController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\RegisterProductController;
use App\Http\Controllers\Admin\TariffController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WareHouseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->name('dashboard');
Route::resource('users', UserController::class);
Route::resource('branches', BranchController::class);
Route::resource('products', ProductController::class);
Route::resource('brands', BrandController::class);
Route::resource('categories', CategoryController::class);
Route::resource('register_products', RegisterProductController::class);
Route::resource('order_products', OrderProductController::class);
Route::resource('discount_products', DiscountProductController::class);
Route::resource('banners', BannerController::class);
Route::resource('order', OrderController::class);
Route::resource('tariff', TariffController::class);
Route::resource('ware_house', WareHouseController::class);
Route::post('orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
Route::post('/orders/{id}/accept', [OrderController::class, 'accept'])->name('orders.accept');
Route::get('orders/{id}/pdf', [OrderController::class, 'generatePdf'])->name('orders.pdf');
Route::get('categories/subcategories/{categoryId}', [CategoryController::class, 'subCategories']);
Route::post('/calculate-delivery', [TariffController::class, 'calculateDelivery'])->name('calculate.delivery');



require __DIR__ . '/auth.php';
