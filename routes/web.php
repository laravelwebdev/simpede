<?php

use Illuminate\Support\Facades\Route;
use Laravel\Nova\Http\Middleware\Authenticate;

Route::get('/changerole/{role}', 'App\Http\Controllers\RoleController@changeRole')
    ->name('changerole')
    ->middleware(Authenticate::class);
Route::get('/dump-download/{filename}', 'App\Http\Controllers\DumpDownloadController@show')
    ->name('dump-download')
    ->middleware(Authenticate::class);

