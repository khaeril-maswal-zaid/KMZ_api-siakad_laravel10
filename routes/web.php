<?php

use App\Models\Prodi;
use Illuminate\Support\Facades\Route;

use function Laravel\Prompts\select;

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
    // return Prodi::select('kode_prodi')->where('id', 3)->get()->value('kode_prodi');
    // return Prodi::select('kode_prodi')->where('id', 3)->first();

    return view('welcome');
});
