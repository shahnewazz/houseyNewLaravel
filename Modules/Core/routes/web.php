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


// create group base on controllers

Route::group(['prefix' => 'admin', 'as' => 'admin.', ], function(){
    Route::get('test', function(){
        return "Hello from admin";
    })->name('test');
});

Route::get('/languages', [LanguageController::class, 'index'])->name('languages.index');
Route::get('/languages/create', [LanguageController::class, 'create'])->name('languages.create');
Route::post('/languages/store', [LanguageController::class, 'store'])->name('languages.store');
Route::post('/languages/default', [LanguageController::class, 'default'])->name('languages.default');
Route::post('/languages/status', [LanguageController::class, 'status'])->name('languages.status');
Route::get('/languages/edit/{id}', [LanguageController::class, 'edit'])->name('languages.edit');
Route::put('/languages/update/{id}', [LanguageController::class, 'update'])->name('languages.update');
Route::delete('/languages/delete/{id}', [LanguageController::class, 'destroy'])->name('languages.destroy');

Route::get('/languages/translate/{code}', [LanguageController::class, 'translate'])->name('languages.translate');
//
Route::get('/languages/translate/{lang}/{file}', [LanguageController::class, 'showTranslations'])->name('translations.show');

Route::post('/languages/translate/{lang}/{file}', [LanguageController::class, 'updateTranslation'])->name('translations.update');
Route::post('/languages/change/{lang}', [LanguageController::class, 'changeLanguage'])->name('language.change');

Route::get('/get', function(){
    return view('core::locale');
});

Route::post('/update', [LanguageController::class, 'test'])->name('locale');

require __DIR__.'/auth.php';
