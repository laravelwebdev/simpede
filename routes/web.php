<?php

use App\Http\Controllers\ArsipController;
use App\Http\Controllers\DumpDownloadController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\ValidateAccessToken;
use Illuminate\Support\Facades\Route;
use Laravel\Nova\Http\Middleware\Authenticate;
use Laravel\Nova\Nova;

Route::get('/', HomeController::class)->name('welcome');

Route::get('/dump-download/{filename}', DumpDownloadController::class)
    ->name('dump-download')
    ->middleware(Authenticate::class)
    ->prefix(Nova::path());
Route::get('/arsip-dokumen/{token}', [ArsipController::class, 'perKro'])
    ->name('arsip-per-kro')
    ->middleware(ValidateAccessToken::class)
    ->prefix(Nova::path());
Route::get('/arsip-dokumen/{token}/kro/{kro}', [ArsipController::class, 'perDetail'])
    ->name('arsip-per-detail')
    ->middleware(ValidateAccessToken::class)
    ->prefix(Nova::path());
Route::get('/arsip-dokumen/{token}/coa/{coa}', [ArsipController::class, 'perKak'])
    ->name('arsip-per-kak')
    ->middleware(ValidateAccessToken::class)
    ->prefix(Nova::path());
Route::get('/arsip-dokumen/{token}/kak/{kak}', [ArsipController::class, 'daftarFile'])
    ->name('daftar-file')
    ->middleware(ValidateAccessToken::class)
    ->prefix(Nova::path());
