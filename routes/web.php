<?php

use App\Http\Controllers\HelperController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LensController;
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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/stock/tracking/list', [LensController::class, 'index'])->name('stock.tracking.list');
    Route::get('/stock/tracking/product', [LensController::class, 'create'])->name('stock.tracking.create');
    Route::post('/stock/tracking/product', [LensController::class, 'store'])->name('stock.tracking.save');
    Route::get('/stock/tracking/product/edit/{id}', [LensController::class, 'edit'])->name('stock.tracking.edit');
    Route::put('/stock/tracking/product/edit/{id}', [LensController::class, 'update'])->name('stock.tracking.update');
    Route::delete('/stock/tracking/product/delete/{id}', [LensController::class, 'destroy'])->name('stock.tracking.delete');
    Route::get('/stock/tracking/track', [LensController::class, 'show'])->name('stock.tracking.show');
    Route::post('/stock/tracking/track', [LensController::class, 'track'])->name('stock.tracking.track');

    Route::get('/stock/tracking/material', [LensController::class, 'creatematerial'])->name('stock.tracking.create.material');
    Route::post('/stock/tracking/material', [LensController::class, 'storematerial'])->name('stock.tracking.save.material');

    Route::get('/stock/tracking/coating', [LensController::class, 'createcoating'])->name('stock.tracking.create.coating');
    Route::post('/stock/tracking/coating', [LensController::class, 'storecoating'])->name('stock.tracking.save.coating');

    Route::get('/stock/tracking/type', [LensController::class, 'createtype'])->name('stock.tracking.create.type');
    Route::post('/stock/tracking/type', [LensController::class, 'storetype'])->name('stock.tracking.save.type');

    Route::get('/location', [HelperController::class, 'createLocation'])->name('create.location');
    Route::post('/location', [HelperController::class, 'saveLocation'])->name('save.location');

    Route::get('/user', [HelperController::class, 'createUser'])->name('create.user');
    Route::post('/user', [HelperController::class, 'saveUser'])->name('save.user');
    Route::get('/user/edit/{id}', [HelperController::class, 'editUser'])->name('edit.user');
    Route::post('/user/edit/{id}', [HelperController::class, 'updateUser'])->name('update.user');
    Route::delete('/user/delete/{id}', [HelperController::class, 'deleteUser'])->name('delete.user');
});

require __DIR__ . '/auth.php';
