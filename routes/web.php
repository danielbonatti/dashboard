<?php

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

Route::get('/',[UsuarioController::class,'index'])->name('login.page');
Route::post('/auth',[UsuarioController::class,'auth'])->name('auth.user');
Route::get('/out',[UsuarioController::class,'out'])->name('user.out');

Route::middleware(['client'])->group(function(){
    Route::get('home',[DashController::class,'index'])->name("home");
});
