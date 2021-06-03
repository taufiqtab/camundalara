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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/camu', [\App\Http\Controllers\Camucont::class, 'index']);
Route::get('/surat', [\App\Http\Controllers\SuratController::class, 'index']);
Route::post('/newsurat', [\App\Http\Controllers\SuratController::class, 'create']);
Route::get('/editmasuk/{idx}', [\App\Http\Controllers\SuratController::class, 'updateMasuk']);
Route::get('/editkeluar/{idx}', [\App\Http\Controllers\SuratController::class, 'updateKeluar']);
Route::get('/selesai/{idx}', [\App\Http\Controllers\SuratController::class, 'selesai']);