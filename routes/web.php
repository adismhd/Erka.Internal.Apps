<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('admin.login');
});


// USER
Route::post('/LoginCheck', [UserController::class, 'Login']);

// ADMIN
Route::get('/HomeAdmin', function () {
    return view('admin.home', [
        "title" => "Beranda"
    ]);
});
