<?php

use App\Http\Controllers\ProducerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('send-queue', [ProducerController::class, 'index']);
