<?php

use App\Http\Controllers\RegionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TypeTransactionController;
use App\Http\Controllers\TransactionController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Users
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);

//ROUTE REGION
Route::get('/regions', [RegionController::class, 'index']);
Route::post('/regions', [RegionController::class, 'store']);

//ROUTE ACCOUNTS
Route::get('/accounts', [AccountController::class, 'index']);
Route::post('/accounts', [AccountController::class, 'store']);

//ROUTES TYPE TRANSACTIONS
Route::get('/type-transactions', [TypeTransactionController::class, 'index']);
Route::post('/type-transactions', [TypeTransactionController::class, 'store']);

//ROUTES TRANSACTIONS
Route::get('/transactions', [TransactionController::class, 'index']);
Route::post('/transactions', [TransactionController::class, 'store']);