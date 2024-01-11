<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomepageController;

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

Route::get('/', [HomepageController::class, 'index']);
Route::middleware('auth')->group(function (){
    Route::post('/pesan_layanan', [HomepageController::class, 'store']);
    Route::put('/pesan_layanan/edit/{id_order}', [HomepageController::class, 'update']);
    Route::put('/cancel/{id_order}', [HomepageController::class, 'batal']);
    Route::post('/transaksi', [HomepageController::class, 'transaksi']);
    Route::get('/transaksi/{id}', [HomepageController::class, 'show']);
});
Auth::routes();

