<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', function () {
    return view('layouts.main');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('surat', SuratController::class);
});

