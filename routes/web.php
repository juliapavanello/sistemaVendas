<?php

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AvisoController;

use Illuminate\Support\Facades\Route;

Route::resource('vendas',VendaController::class);
Route::resource('produtos',ProdutoController::class);
Route::resource('user',UserController::class);
Route::resource('caixas',ProdutoController::class);
Route::resource('avisos',AvisoController::class);