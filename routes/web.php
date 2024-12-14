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
Route::get('/arsip-dokumen/{tahun?}', 'App\Http\Controllers\ArsipController@perKro')
    ->name('arsip-per-kro')
    ->prefix(Nova::path());
Route::get('/arsip-dokumen/{tahun}/kro/{kro}', 'App\Http\Controllers\ArsipController@perDetail')
    ->name('arsip-per-detail')
    ->prefix(Nova::path());
Route::get('/arsip-dokumen/{tahun}/coa/{kak}', 'App\Http\Controllers\ArsipController@perKak')
    ->name('arsip-per-kak')
    ->prefix(Nova::path());
