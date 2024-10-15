<?php

use Illuminate\Support\Facades\Route;
use Modules\Core\Http\Controllers\BlogController;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Core\Http\Controllers\CurrencyController;
use Modules\Core\Http\Controllers\MenuController;
use Modules\Core\Http\Controllers\PageController;
use Modules\Core\Http\Controllers\RoleController;
use Modules\Core\Http\Controllers\SiteSettingController;
use Modules\Core\Http\Controllers\UserController;
use Modules\Core\Http\Controllers\LanguageController;
use Modules\Core\Http\Controllers\DashboardController;
use Modules\Core\Models\SiteSetting;

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


require __DIR__.'/auth.php';

Route::group(["prefix" => "admin", "as" => "admin.", "middleware" => ['auth', 'verified']], function () {
    
    
    // dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // page builder routes
    Route::group(['prefix' => 'pages', 'as' => 'pages.'], function(){
        Route::get('/', [PageController::class, 'index'])->name('index');
        Route::get('/create', [PageController::class, 'create'])->name('create');
        Route::post('/store', [PageController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PageController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [PageController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [PageController::class, 'destroy'])->name('destroy');
        Route::post('/set-home', [PageController::class, 'setHomePage'])->name('set_home');

        Route::group(['prefix' => 'widgets', 'as' => 'widgets.'], function(){
            Route::get('/{page_id}', [PageController::class, 'widgetEdit'])->name('edit');
            Route::get('/widgets/{widget}', [PageController::class, 'loadWidget'])->name('load');
            Route::post('/widgets/save/{id}', [PageController::class, 'saveWidgets'])->name('save');
        });
    });

    // menu builder
    Route::group(['prefix' => 'menus', 'as' => 'menus.'], function(){
        Route::get('/', [MenuController::class, 'index'])->name('index');
        Route::get('/create', [MenuController::class, 'create'])->name('create');
        Route::post('/store', [MenuController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [MenuController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [MenuController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [MenuController::class, 'destroy'])->name('destroy');
    });

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
        Route::post('/default/{id}', [LanguageController::class, 'default'])->name('default');
        Route::post('/status/{id}', [LanguageController::class, 'status'])->name('status');

        // translations routes
        Route::get('/translate/{code}', [LanguageController::class, 'translate'])->name('translate');
        Route::get('/translate/{lang}/{file}', [LanguageController::class, 'showTranslations'])->name('translations.show');
        Route::post('/translate/{lang}/{file}', [LanguageController::class, 'updateTranslation'])->name('translations.update');
        Route::post('/change/{lang}', [LanguageController::class, 'changeLanguage'])->name('change');
    });


    // blog routes
    Route::group(['prefix' => 'blog', 'as' => 'blog.'], function(){
        Route::get('/', [BlogController::class, 'index'])->name('index');
        Route::get('/create', [BlogController::class, 'create'])->name('create');
        Route::post('/store', [BlogController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [BlogController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [BlogController::class, 'destroy'])->name('destroy');
    });

    
    Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');

    // general settings
    Route::group(['prefix' => 'general', 'as' => 'general.'], function(){
        Route::put('/general-update', [SiteSettingController::class, 'updateGeneralSettings'])->name('update');
        Route::put('/business-update', [SiteSettingController::class, 'updateBusinessSettings'])->name('business.update');
        Route::put('/interface-update', [SiteSettingController::class, 'updateInterfaceSettings'])->name('interface.update');
    });

    // email settings
    Route::group(['prefix' => 'email', 'as' => 'email.'], function(){
        Route::get('/', [SiteSettingController::class, 'emailSettings'])->name('index');
        Route::post('/update', [SiteSettingController::class, 'updateEmailSettings'])->name('update');
        Route::post('/test-mail', [SiteSettingController::class,'testMail'])->name('testMail');
    });

    // Environment settings
    Route::group(['prefix'=> 'env', 'as'=> 'env.'], function(){
        Route::get('/', [SiteSettingController::class, 'envSettings'])->name('index');
        Route::post('/update', [SiteSettingController::class, 'updateEnvSettings'])->name('update');
    });

    // Maintenance settings
    Route::group(['prefix'=> 'maintenance', 'as'=> 'maintenance.'], function(){
        Route::get('/', [SiteSettingController::class, 'maintenanceSettings'])->name('index');
        Route::post('/store', [SiteSettingController::class, 'maintenanceSettings'])->name('store');
    });

    // payment settings
    Route::group(['prefix'=> 'payment', 'as'=> 'payment.'], function(){
        Route::get('/', [SiteSettingController::class, 'paymentSettings'])->name('index');
        Route::post('/store', [SiteSettingController::class, 'storePaymentSettings'])->name('store');
    });

    // currency settings
    Route::group(['prefix'=> 'currency','as'=> 'currency.'], function(){
        Route::get('/', [CurrencyController::class,'index'])->name('index');
        Route::post('/store', [CurrencyController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CurrencyController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CurrencyController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [CurrencyController::class, 'destroy'])->name('destroy');
    });

});

Route::post('/xss/input', [DashboardController::class,'xss'])->name('xss.post');
Route::get('/xss', [DashboardController::class,'getXss'])->name('xss');

// frontend routes
require __DIR__.'/frontend.php';

Route::get('/{slug?}', [CoreController::class, 'index'])->where('slug', '[a-zA-Z0-9-/]+'); 