<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MahasiswaController;
use App\Http\Controllers\Api\DosenController;
use App\Http\Controllers\Api\MakulController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Routes for Auth
Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
});

// Routes for Mahasiswa
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/mahasiswa/create', [\App\Http\Controllers\Api\MahasiswaController::class, 'create']);
    Route::get('/mahasiswa/read', [\App\Http\Controllers\Api\MahasiswaController::class, 'read']);
    Route::put('/mahasiswa/update/{id}', [\App\Http\Controllers\Api\MahasiswaController::class, 'update']);
    Route::delete('/mahasiswa/delete/{id}', [\App\Http\Controllers\Api\MahasiswaController::class, 'delete']);
});

// Routes for Dosen
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/dosen/create', [\App\Http\Controllers\Api\DosenController::class, 'create']);
    Route::get('/dosen/read', [\App\Http\Controllers\Api\DosenController::class, 'read']);
    Route::put('/dosen/update/{id}', [\App\Http\Controllers\Api\DosenController::class, 'update']);
    Route::delete('/dosen/delete/{id}', [\App\Http\Controllers\Api\DosenController::class, 'delete']);
});

// Routes for Makul
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/makul/create', [\App\Http\Controllers\Api\MakulController::class, 'create']);
    Route::get('/makul/read', [\App\Http\Controllers\Api\MakulController::class, 'read']);
    Route::put('/makul/update/{id}', [\App\Http\Controllers\Api\MakulController::class, 'update']);
    Route::delete('/makul/delete/{id}', [\App\Http\Controllers\Api\MakulController::class, 'delete']);
});