<?php

use App\Http\Middleware\ValidateAccessToken;
use Illuminate\Support\Facades\Route;
use Laravel\Nova\Http\Middleware\Authenticate;
use Laravel\Nova\Nova;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dump-download/{filename}', 'App\Http\Controllers\DumpDownloadController@show')
    ->name('dump-download')
    ->middleware(Authenticate::class)
    ->prefix(Nova::path());
Route::get('/arsip-dokumen/{token}', 'App\Http\Controllers\ArsipController@perKro')
    ->name('arsip-per-kro')
    ->middleware(ValidateAccessToken::class)
    ->prefix(Nova::path());
Route::get('/arsip-dokumen/{token}/kro/{kro}', 'App\Http\Controllers\ArsipController@perDetail')
    ->name('arsip-per-detail')
    ->middleware(ValidateAccessToken::class)
    ->prefix(Nova::path());
Route::get('/arsip-dokumen/{token}/coa/{coa}', 'App\Http\Controllers\ArsipController@perKak')
    ->name('arsip-per-kak')
    ->middleware(ValidateAccessToken::class)
    ->prefix(Nova::path());
Route::get('/arsip-dokumen/{token}/kak/{kak}', 'App\Http\Controllers\ArsipController@daftarFile')
    ->name('daftar-file')
    ->middleware(ValidateAccessToken::class)
    ->prefix(Nova::path());

