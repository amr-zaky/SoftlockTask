<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/',[\App\Http\Controllers\Controller::class,'index']);
Route::post('/Encrypt',[\App\Http\Controllers\Controller::class,'encryptFile'])->name('encryptFile');
Route::post('/Decrypt',[\App\Http\Controllers\Controller::class,'decryptFile'])->name('decryptFile');