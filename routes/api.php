<?php

use App\Http\Controllers\ColumnController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('columns', [ColumnController::class, 'index']);
Route::post('columns', [ColumnController::class, 'store']);
Route::delete('columns/{column}', [ColumnController::class, 'destroy']);
