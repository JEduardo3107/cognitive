<?php

use App\Http\Controllers\FinishProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Secciones estaticas del footer
/*
Route::controller(HomeController::class)->group(function(){
    Route::get('/', 'index')->name('home.index');
});*/

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    
    Route::get('/finish-profile', [FinishProfileController::class, 'index'])->name('finishProfile.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';