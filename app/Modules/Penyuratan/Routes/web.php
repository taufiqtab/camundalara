<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
use App\Modules\Penyuratan\Http\Controllers;


Route::group(['prefix' => 'penyuratan'], function () {
    Route::get('/', ListSurat::class);
    Route::post('/create', CreateSurat::class);
    Route::get('/process/{idx}/{status}', ProcessSurat::class);
    Route::get('/selesai/{idx}', FinishSurat::class);
});
