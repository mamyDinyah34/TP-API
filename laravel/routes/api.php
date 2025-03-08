<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Tymon\JWTAuth\Facades\JWTAuth;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function(){
    return 'API';
});*/


//Route::apiResource('user', UserController::class);

//Route::post('/login', [UserController::class, 'login']);

//Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');;


Route::post('/register', [UserController::class, 'store']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/users', [UserController::class, 'index']);


Route::middleware('auth:api')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/{id}', [UserController::class, 'show']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
    });

    Route::post('/logout', [UserController::class, 'logout']);
});

