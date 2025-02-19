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
        Route::get('/arsip-dokumen/{token}', [ArsipController::class, 'perDetail'])
            ->name('arsip-per-detail')
            ->where('token', '[A-Za-z0-9]+');
        Route::get('/arsip-dokumen/{token}/coa/{coa}', [ArsipController::class, 'perKak'])
            ->name('arsip-per-kak')
            ->where(['token' => '[A-Za-z0-9]+', 'coa' => '[0-9]+']);
        Route::get('/arsip-dokumen/{token}/kak/{kak}', [ArsipController::class, 'daftarFile'])
            ->name('daftar-file')
            ->where(['token' => '[A-Za-z0-9]+', 'kak' => '[0-9]+']);
        Route::get('/download-folder/{token}/kak/{kak}', [ArsipController::class, 'downloadFolder'])
            ->name('download-folder')
            ->where(['token' => '[A-Za-z0-9]+', 'kak' => '[0-9]+']);
    });
