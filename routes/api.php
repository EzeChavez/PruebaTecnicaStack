<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StackOverflowController;

Route::get('/preguntas', [StackOverflowController::class, 'index']);