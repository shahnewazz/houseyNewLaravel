<?php

use Illuminate\Support\Facades\Route;



Route::get('/change-language/{lang}', function ($lang) {
    session(['lang' => $lang]); // Store the selected language in the session
    return redirect()->back();    // Redirect back to the previous page
})->name('change.language');