<?php

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AvisoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CaixaController;

use Illuminate\Support\Facades\Route;

Route::resource('vendas',VendaController::class);
Route::resource('produtos',ProdutoController::class);
Route::resource('user',UserController::class);
Route::resource('login',LoginController::class);
Route::resource('caixas',CaixaController::class);
Route::resource('avisos',AvisoController::class);

Route::post('login/auth', [LoginController::class,'authenticate'])->name('auth');
