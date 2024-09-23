<?php

use Illuminate\Support\Facades\Route;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Core\Http\Controllers\LanguageController;

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


Route::get('core', function () {
    return view('core::index');
}); 


Route::get('/languages', [LanguageController::class, 'index'])->name('languages.index');
Route::get('/languages/create', [LanguageController::class, 'create'])->name('languages.create');
Route::post('/languages/store', [LanguageController::class, 'store'])->name('languages.store');
Route::post('/languages/default', [LanguageController::class, 'default'])->name('languages.default');
Route::post('/languages/status', [LanguageController::class, 'status'])->name('languages.status');
Route::get('/languages/edit/{id}', [LanguageController::class, 'edit'])->name('languages.edit');
Route::put('/languages/update/{id}', [LanguageController::class, 'update'])->name('languages.update');
Route::delete('/languages/delete/{id}', [LanguageController::class, 'destroy'])->name('languages.destroy');

// Route::post('/languages', [LanguageController::class, 'store'])->name('languages.store');
// Route::get('/languages/edit/{locale}', [LanguageController::class, 'edit'])->name('languages.edit');
// Route::post('/languages/update/{locale}', [LanguageController::class, 'update'])->name('languages.update');

require __DIR__.'/auth.php';
