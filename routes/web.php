<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\QuestionCommentController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\QuestionLikeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::resource('home', HomeController::class)->middleware(['auth', 'verified']);
Route::get('/', [HomeController::class, 'index'])
    ->name('home.index')
    ->middleware(['auth', 'verified']);
Route::middleware('auth')->group(function () {
    // Route::resource('/question/like/{id}',QuestionLikeController::class);
    // question like
    Route::resource('/question/like', QuestionLikeController::class);

    //question comment
    Route::resource('/question/comment', QuestionCommentController::class);

    // question
    Route::get('/question/detail/{slug}', [QuestionController::class, 'index'])->name('question.index');
    Route::get('/question/detail', [QuestionController::class, 'create'])->name('question.create');
    Route::post('/question', [QuestionController::class, 'store'])->name('question.store');
    Route::post('/question/{id}', [QuestionController::class, 'update'])->name('question.update');
    Route::delete('/question/{question}', [QuestionController::class, 'destory'])->name('question.delete');
    Route::get('/question/user-question', [QuestionController::class, 'userQuestion'])->name('question.user');
    Route::post('/question/save-question/{id}', [QuestionController::class, 'saveQuestion'])->name('question.save');

    Route::get('/question/save-question', [QuestionController::class, 'showQuestion'])->name('question.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
