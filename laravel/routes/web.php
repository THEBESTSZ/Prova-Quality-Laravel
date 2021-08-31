<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\DependenteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/form', function () {
    return view('form');
});

Route::get('/lista',[FuncionarioController::class, 'show']);
Route::post('/form/enviar',[FuncionarioController::class, 'store']);
Route::get('/dependentes/{id}',[FuncionarioController::class, 'showById']);
Route::patch('/funcionario/status',[FuncionarioController::class, 'edit']);
Route::delete('/funcionario/remover',[FuncionarioController::class, 'remove']);

Route::post('/dependentes/enviar',[DependenteController::class, 'store']);
Route::delete('/dependentes/remover',[DependenteController::class, 'remove']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
