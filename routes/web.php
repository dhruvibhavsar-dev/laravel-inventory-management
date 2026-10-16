<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InwardTransactionController;
use App\Http\Controllers\MaterialController;
use Illuminate\Support\Facades\Route;

// Redirect the home page to the main material management screen.
Route::get('/', fn () => redirect()->route('materials.index'));

Route::resource('categories', CategoryController::class)->except(['show']);
Route::resource('materials', MaterialController::class)->except(['show']);
Route::resource('inward-transactions', InwardTransactionController::class)
    ->only(['index', 'create', 'store']);

// Return materials belonging to a selected category for the dynamic dropdown.
Route::get('/categories/{category}/materials', [MaterialController::class, 'byCategory'])
    ->name('categories.materials');
