<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;


Route::get('/changerole/{role}', RoleController::class);
Route::get('/dump-download/{filename}', 'App\Http\Controllers\DumpDownloadController@show')->name('dump-download');