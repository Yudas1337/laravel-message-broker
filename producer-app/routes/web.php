<?php

use App\Http\Controllers\ProducerController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::view('/', 'producers');

Route::post('send-queue',[ProducerController::class, 'index'])->name('send-queue');
