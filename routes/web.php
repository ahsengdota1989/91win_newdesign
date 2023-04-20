<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//games
Route::get('/live-casino', [App\Http\Controllers\HomeController::class, 'livecasino']);
Route::get('/slots', [App\Http\Controllers\HomeController::class, 'slots']);
Route::get('/sports', [App\Http\Controllers\HomeController::class, 'sports']);
Route::get('/fishing', [App\Http\Controllers\HomeController::class, 'fishing']);

