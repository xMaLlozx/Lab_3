<?php

use Illuminate\Support\Facades\Route;
use Tukmachev\Shop\Http\Controllers\CategoryController;
use Tukmachev\Shop\Http\Controllers\ClientController;
use Tukmachev\Shop\Http\Controllers\OrderController;
use Tukmachev\Shop\Http\Controllers\ProductController;
use Tukmachev\Shop\Http\Controllers\SupplierController;
use Tukmachev\Shop\Http\Controllers\WarehouseController;

$prefix = config('shop.route_prefix', 'shop');

Route::middleware('web')->prefix($prefix)->name('shop.')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers',  SupplierController::class);
    Route::resource('products',   ProductController::class);
    Route::resource('clients',    ClientController::class);
    Route::resource('warehouses', WarehouseController::class);
    Route::resource('orders',     OrderController::class);
});
