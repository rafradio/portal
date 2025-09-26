<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Middleware\SetCustomUser;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/menutest', [MenuController::class, 'warehouseData'])->name('menutest')->middleware(SetCustomUser::class);
