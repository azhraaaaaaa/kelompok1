<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaliController;
use App\Http\Controllers\RajaAmpatController;
use App\Http\Controllers\LabuanBajoController;
use App\Http\Controllers\DanauTobaController;


Route::redirect('/', '/login'); 
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/bali', [BaliController::class, 'index'])
    ->middleware('auth')
    ->name('bali');

   Route::get('/raja-ampat', [RajaAmpatController::class, 'index'])
    ->middleware('auth')
    ->name('raja-ampat');

Route::get('/labuan-bajo', [LabuanBajoController::class, 'index'])
    ->middleware('auth')
    ->name('labuan-bajo');

Route::get('/danau-toba', [DanauTobaController::class, 'index'])
    ->middleware('auth')
    ->name('danau-toba'); 

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
