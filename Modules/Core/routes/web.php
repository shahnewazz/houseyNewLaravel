<?php

use Illuminate\Support\Facades\Route;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Core\Http\Controllers\LanguageController;
use Modules\Core\Http\Controllers\DashboardController;

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



Route::group(["prefix" => "admin", "as" => "admin.", "middleware" => ['auth', 'verified']], function () {
    
    // dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // lanugages routes
    Route::group(['prefix' => 'languages', 'as' => 'languages.'], function(){
        Route::get('/', [LanguageController::class, 'index'])->name('index');
        Route::get('/create', [LanguageController::class, 'create'])->name('create');
        Route::post('/store', [LanguageController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [LanguageController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [LanguageController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [LanguageController::class, 'destroy'])->name('destroy');
        Route::post('/default', [LanguageController::class, 'default'])->name('default');
        Route::post('/status', [LanguageController::class, 'status'])->name('status');

        // translations routes
        Route::get('/translate/{code}', [LanguageController::class, 'translate'])->name('translate');
        Route::get('/translate/{lang}/{file}', [LanguageController::class, 'showTranslations'])->name('translations.show');
        Route::post('/translate/{lang}/{file}', [LanguageController::class, 'updateTranslation'])->name('translations.update');
        Route::post('/change/{lang}', [LanguageController::class, 'changeLanguage'])->name('change');
    });
});


require __DIR__.'/auth.php';
