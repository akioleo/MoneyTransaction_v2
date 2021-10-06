<?php

use App\Http\Controllers\LoginJwtController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
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

Route::prefix('auth')->group(function(){
        Route::post('/login', [LoginJwtController::class, 'login']);
        Route::get('/logout', [LoginJwtController::class, 'logout']);
        Route::get('/refresh', [LoginJwtController::class, 'refresh']);
        Route::group(['middleware' => ['jwt.auth']], function (){
            Route::name('users.')->group(function(){
                Route::resource('users', UserController::class);
            });
    });
});


    Route::prefix('transaction')->group(function(){
        Route::group(['middleware' => ['jwt.auth']], function (){
            Route::post('/', [TransactionController::class, 'transaction']);
            Route::post('/deposit', [TransactionController::class, 'deposit']);
            Route::post('/withdrawl', [TransactionController::class, 'withdrawl']);
    });
});

