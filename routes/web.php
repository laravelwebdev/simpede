<?php

use App\Http\Controllers\ArsipController;
use App\Http\Controllers\BackupActions;
use App\Http\Controllers\DumpDownloadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PulsaController;
use App\Http\Middleware\ValidateAccessToken;
use App\Http\Middleware\ValidatePulsaToken;
use Illuminate\Support\Facades\Route;
use Laravel\Nova\Http\Middleware\Authenticate;
use Laravel\Nova\Nova;

Route::get('/', HomeController::class)->name('welcome');

Route::middleware([Authenticate::class])
    ->prefix(Nova::path())
    ->group(function () {
        Route::get('/dump-download/{filename}', DumpDownloadController::class)
            ->name('dump-download');
        Route::get('/backup/download/{filename}', [BackupActions::class, 'downloadBackup'])
            ->name('backup-download');
        Route::get('/backup/clean', [BackupActions::class, 'cleanBackup'])
            ->name('backup-clean');
    });

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

Route::middleware([ValidatePulsaToken::class])
    ->prefix(Nova::path())
    ->group(function () {
        Route::get('/pulsa/{token}', [PulsaController::class, 'index'])
            ->name('pulsa-index')
            ->where('token', '[A-Za-z0-9]+');
        Route::post('/pulsa/{token}', [PulsaController::class, 'verifikasi'])
            ->name('pulsa-verifikasi')
            ->where('token', '[A-Za-z0-9]+');
        Route::get('/pulsa/actions/{token}', [PulsaController::class, 'actionsChoice'])
            ->name('pulsa-actions')
            ->where('token', '[A-Za-z0-9]+');
        Route::post('/pulsa/actions/{token}', [PulsaController::class, 'choice'])
            ->name('pulsa-choice')
            ->where('token', '[A-Za-z0-9]+');
        Route::get('/pulsa/confirm/{token}', [PulsaController::class, 'confirm'])
            ->name('pulsa-confirm')
            ->where('token', '[A-Za-z0-9]+');
        Route::post('/pulsa/confirm/{token}', [PulsaController::class, 'submitConfirm'])
            ->name('pulsa-submit-confirm')
            ->where('token', '[A-Za-z0-9]+');
        Route::get('/pulsa/upload/{token}', [PulsaController::class, 'upload'])
            ->name('pulsa-upload')
            ->where('token', '[A-Za-z0-9]+');
        Route::post('/pulsa/upload/{token}', [PulsaController::class, 'submitUpload'])
            ->name('pulsa-submit-upload')
            ->where('token', '[A-Za-z0-9]+');
    });
