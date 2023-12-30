<?php

use App\Http\Controllers\BiayaKuliahController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\RancanganStudiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
Route::get('/mahasiswa/{nim}', [MahasiswaController::class, 'shownim']); //--INI ATAU
Route::get('/mahasiswa/get_id/{id}', [MahasiswaController::class, 'show']); //--ATAU YANG INI
Route::get('/mahasiswa/{key}/{value}', [MahasiswaController::class, 'filer']);

Route::get('/prodi', [ProdiController::class, 'index']);
Route::get('/prodi/{id}', [ProdiController::class, 'show']);

Route::get('/fakultas', [FakultasController::class, 'index']);

Route::get('/biaya-kuliah', [BiayaKuliahController::class, 'index']);
Route::post('/biaya-kuliah', [BiayaKuliahController::class, 'store']);

Route::post('/pembayaran', [PembayaranController::class, 'store']);

Route::post('/rancangan-studi', [RancanganStudiController::class, 'store']);

Route::post('/mata-kuliah', [MatkulController::class, 'store']);


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
