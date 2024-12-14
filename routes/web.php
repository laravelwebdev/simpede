<?php

use Illuminate\Support\Facades\Route;
use Laravel\Nova\Http\Middleware\Authenticate;
use Laravel\Nova\Nova;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dump-download/{filename}', 'App\Http\Controllers\DumpDownloadController@show')
    ->name('dump-download')
    ->middleware(Authenticate::class)
    ->prefix(Nova::path());
Route::get('/arsip-dokumen/{tahun?}', 'App\Http\Controllers\ArsipController@show')
    ->name('dump-download')
    ->prefix(Nova::path());
