<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

// Route pour le tableau de bord
Route::get("/", [ArticleController::class, 'Affichage'])->name("dashboard");

// Groupe de routes avec le préfixe 'articles'
Route::prefix('articles')->group(function () {
    Route::get('{id}', [ArticleController::class, 'show'])->where('id', '[0-9]+')->name('articles.show');
    Route::get('index', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('store', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    
});





