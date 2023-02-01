<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\ColumnController;
use App\Http\Middleware\CheckToken;
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

Route::get('cards', [CardController::class, 'index']);
Route::get('list-cards', [CardController::class, 'list'])->middleware(CheckToken::class);
Route::post('cards', [CardController::class, 'store']);
Route::put('cards/{card}', [CardController::class, 'update']);
Route::delete('cards/{card}', [CardController::class, 'destroy']);
