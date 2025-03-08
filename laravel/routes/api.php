<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function(){
    return 'API';
});*/

<<<<<<< HEAD
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
=======
Route::apiResource('user', UserController::class);

Route::post('/login', [UserController::class, 'login']);

Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');;

>>>>>>> 6b3dd9e544b0ce4bf7160fd5ab10dc87b229d8f7
