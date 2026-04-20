<?php

use App\Http\Controllers\LoginController;


Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);


Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/admin', function () {
    return view('admin.admin');
})->middleware('auth');


Route::get('/', function () {
    return redirect('/login');
});