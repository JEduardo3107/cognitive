<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\FinishProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileQuestionController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\GameManagerController;
use App\Http\Controllers\GameProcessController;
use App\Http\Controllers\GameResponseController;
use Illuminate\Support\Facades\Route;

// Secciones estaticas del footer
Route::middleware(['auth', 'checkLoginStreak'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    
    Route::get('/finish-profile', [FinishProfileController::class, 'index'])->name('finishProfile.index');
    Route::post('/finish-profile', [FinishProfileController::class, 'store'])->name('finishProfile.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/view-question-stats', [ProfileQuestionController::class, 'index'])->name('view-question.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/show-questions', [QuestionsController::class, 'index'])->name('questions.index');

    Route::get('/questions/{question:id}', [QuestionsController::class, 'show'])->name('questions.show');
    
    Route::get('/create-question/{area:id}', [QuestionsController::class, 'create'])->name('questions.create');
    Route::post('/create-question/{area:id}', [QuestionsController::class, 'store'])->name('questions.store');

    Route::get('/edit-question/{question:id}', [QuestionsController::class, 'edit'])->name('questions.edit');
    Route::put('/update-question/{question:id}', [QuestionsController::class, 'update'])->name('questions.update');

    Route::delete('/delete-question/{question:id}', [QuestionsController::class, 'destroy'])->name('questions.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/create-answer/{question:id}', [AnswerController::class, 'create'])->name('answer.create');
    Route::post('/create-answer/{question:id}', [AnswerController::class, 'store'])->name('answer.store');

    Route::get('/show-answer/{answer:id}', [AnswerController::class, 'show'])->name('answer.show');
    Route::put('/update-answer/{answer:id}', [AnswerController::class, 'update'])->name('answer.update');

    Route::delete('/delete-answer/{answer:id}', [AnswerController::class, 'destroy'])->name('answer.destroy');
});
/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::middleware(['auth', 'checkLoginStreak'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/play/{sessionid}/{game:id}', [GameManagerController::class, 'index'])->name('game.index');
});

Route::middleware(['auth', 'check_activity_status'])->group(function () {
    Route::post('/process/1/{sessionToken}/{game_id}', [GameProcessController::class, 'store1'])->name('gamestore.game1');
    Route::post('/process/2/{sessionToken}/{game_id}', [GameProcessController::class, 'store2'])->name('gamestore.game2');
    Route::post('/process/3/{sessionToken}/{game_id}', [GameProcessController::class, 'store3'])->name('gamestore.game3');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/response/1/{sessionid}', [GameResponseController::class, 'index1'])->name('index.game1');
    Route::get('/response/2/{sessionid}', [GameResponseController::class, 'index2'])->name('index.game2');
    Route::get('/response/3/{sessionid}', [GameResponseController::class, 'index3'])->name('index.game3');
});


require __DIR__.'/auth.php';