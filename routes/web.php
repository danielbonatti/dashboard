<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DashController;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/',[LoginController::class,'index'])->name('index');
Route::get('/out',[LoginController::class,'out'])->name('user.out');

//Route::get('/login',[LoginController::class,'login'])->name('login.user');
//Route::get('login/alterar/{nrecno?}',[LoginController::class,'alterarSenha'])->name('login.alterar');
//Route::post('login/alterar/{nrecno?}',[LoginController::class,'alterarSenhaPost'])->name('login.alterar.post');

Route::get('/error',[LoginController::class,'error'])->name('error.page');

Route::middleware(['client'])->group(function(){
    Route::get('/home',[DashController::class,'index'])->name("home");
    Route::get('dash',[DashController::class,'dash'])->name("dash");
    Route::post('/atualizar-tag', [DashController::class,'atualizarTag'])->name('atualizar.tag');
    Route::post('/atualizar-gra', [DashController::class,'atualizarGra'])->name('atualizar.gra');
});
