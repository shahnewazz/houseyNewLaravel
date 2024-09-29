<?php

use Illuminate\Support\Facades\Route;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Core\Http\Controllers\RoleController;
use Modules\Core\Http\Controllers\UserController;
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


    // users routes
    Route::group(['prefix' => 'users', 'as' => 'users.'], function(){
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/show/{username}', [UserController::class, 'show'])->name('show');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{username}', [UserController::class, 'edit'])->name('edit');
        Route::put('/update/{username}', [UserController::class, 'update'])->name('update');
        Route::delete('/delete/{username}', [UserController::class, 'destroy'])->name('destroy');
    });

    // roles routes
    Route::group(['prefix' => 'roles', 'as' => 'roles.'], function(){
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/create', [RoleController::class, 'create'])->name('create');
        Route::post('/store', [RoleController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [RoleController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [RoleController::class, 'destroy'])->name('destroy');
    });

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


Route::post('/xss/input', [DashboardController::class,'xss'])->name('xss.post');
Route::get('/xss', [DashboardController::class,'getXss'])->name('xss');

require __DIR__.'/auth.php';
