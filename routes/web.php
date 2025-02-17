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

Route::middleware([ValidateAccessToken::class])
    ->prefix(Nova::path())
    ->group(function () {
        Route::get('/arsip-dokumen/{token}', [ArsipController::class, 'perKro'])
            ->name('arsip-per-kro');
        Route::get('/arsip-dokumen/{token}/kro/{kro}/akun/{akun?}', [ArsipController::class, 'perDetail'])
            ->name('arsip-per-detail');
        Route::get('/arsip-dokumen/{token}/coa/{coa}', [ArsipController::class, 'perKak'])
            ->name('arsip-per-kak');
        Route::get('/arsip-dokumen/{token}/kak/{kak}', [ArsipController::class, 'daftarFile'])
            ->name('daftar-file');
        Route::get('/download-folder/{token}/kak/{kak}', [ArsipController::class, 'downloadFolder'])
            ->name('download-folder');
    });
