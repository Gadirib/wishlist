<?php

use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('wishlist')->controller(WishlistController::class)->group(function () {
    Route::get('/', 'getAllProducts')->name('wishlist.index');
    Route::get('/get/{id}', 'get');
    Route::get('/add', 'add');
    Route::get('/delete/{id}', 'delete');
    Route::get('/clear', 'clear');
});
Route::prefix('compare')->controller(CompareController::class)->group(function () {
    Route::get('/', 'getAllProducts')->name('compare.index');
    Route::get('/get/{id}', 'get');
    Route::get('/add', 'add');
    Route::get('/delete/{id}', 'delete');
    Route::get('/clear', 'clear');
});
