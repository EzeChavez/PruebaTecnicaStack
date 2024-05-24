<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StackOverflowController;
use App\Http\Controllers\ConsultaController;




Route::get('/', [ConsultaController::class, 'index'])->name('busqueda.index');
Route::get('/busqueda', [StackOverflowController::class, 'muestra'])->name('muestra.index');
