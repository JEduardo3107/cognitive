<?php

use App\Http\Controllers\FinishProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileQuestionController;
use Illuminate\Support\Facades\Route;

// Secciones estaticas del footer
Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    
    Route::get('/finish-profile', [FinishProfileController::class, 'index'])->name('finishProfile.index');
    Route::post('/finish-profile', [FinishProfileController::class, 'store'])->name('finishProfile.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/view-question-stats', [ProfileQuestionController::class, 'index'])->name('view-question.index');
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