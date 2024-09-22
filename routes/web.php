<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GlosariumController;

Route::get('/', function () {
    return view('admin.login');
});
Route::get('/Login', function () {
    return view('admin.login');
});



// USER
Route::post('/LoginCheck', [UserController::class, 'Login']);
Route::get('/Logout', [UserController::class, 'Logout']);

// BERANDA
Route::get('/HomeAdmin', function () {
    return view('admin.home', [
        "title" => "Beranda"
    ]);
});

// GLOSARIUM
Route::get('/Glosarium', [GlosariumController::class, 'GetListData']);
Route::get('/DetailGlosarium/{id}', [GlosariumController::class, 'GetDetailGlosarium']);
Route::post('/InsertGlosarium', [GlosariumController::class, 'InsertGlosarium']);
Route::post('/EditGlosarium', [GlosariumController::class, 'EditGlosarium']);
Route::post('/DeleteGlosarium', [GlosariumController::class, 'DeleteGlosarium']);
Route::post('/InsertAlamatGlosarium', [GlosariumController::class, 'InsertAlamatGlosarium']);
Route::post('/DeleteAlamatGlosarium', [GlosariumController::class, 'DeleteAlamatGlosarium']);

