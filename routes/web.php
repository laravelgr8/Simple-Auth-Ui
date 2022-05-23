<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(["auth","user-access:user"])->group(function(){
    Route::get('/user',[HomeController::class,'index'])->name('user.home');
});

Route::middleware(["auth","user-access:admin"])->group(function(){
    Route::get('/admin',[HomeController::class,'admin'])->name('admin.home');
});

Route::middleware(["auth","user-access:manager"])->group(function(){
    Route::get('/manager',[HomeController::class,'manager'])->name('manager.home');
});
