<?php

use App\Http\Controllers\ApiController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('provinsi', [ApiController::class, 'getProvinsi'])->name('api.provinsi');
Route::get('kabupaten-kota', [ApiController::class, 'getKabupatenKota'])->name('api.kabupaten_kota');

Route::get('data', [ApiController::class, 'getDataTable'])->name('api.data');

Route::get('kabupatenKotaTerbaik', [ApiController::class, 'kabupatenKotaTerbaik'])->name('api.kabupaten_kota_terbaik');
Route::get('kabupatenKotaTerendah', [ApiController::class, 'kabupatenKotaTerendah'])->name('api.kabupaten_kota_terendah');

Route::get('getData', [ApiController::class, 'getDataTable'])->name('api.get_data');
