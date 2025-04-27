<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Question;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    if (app()->isLocal()) { // logando direto no ambiente local

        auth()->loginUsingId(1);

        return to_route('dashboard');
    }

    return view('welcome');
});

Route::middleware('auth')->group(function () {

    // region Questions Controllers

    Route::get('/question', [QuestionController::class, 'index'])->name('question.index'); // Index

    route::post('/question/store', [QuestionController::class, 'store'])->name('question.store');

    Route::delete('/question/{question}', [QuestionController::class, 'destroy'])->name('question.destroy'); // deletar question

    Route::get('/dashboard', DashboardController::class)->middleware(['auth'])->name('dashboard'); // sem metodo, pois só usaremos esse controller para uma função

    Route::post('/question/like/{question}', Question\LikeController::class)->name('question.like'); // Dar like

    Route::post('/question/inlike/{question}', Question\InlikeController::class)->name('question.inlike'); // Dar like

    Route::put('/question/publish/{question}', Question\PublishController::class)->name('question.publish'); // publicar question

    // endregion

    // region Profiles Controllers

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // endregion

});

require __DIR__.'/auth.php';
