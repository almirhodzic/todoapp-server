<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

// Todo
Route::prefix('todo')->group(function () {
    Route::get('/', [TodoController::class, 'index']);
    Route::get('all', [TodoController::class, 'index']);
    Route::post('store', [TodoController::class, 'store']);
    Route::patch('{id}/toggle', [TodoController::class, 'toggle']);
    Route::delete('{id}', [TodoController::class, 'delete']);
});

//Admin
Route::prefix('admin')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware(['auth:sanctum', 'scope.admin'])->group(function () {
        Route::get('user', [AuthController::class, 'user']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::patch('user/info', [AuthController::class, 'updateInfo']);
        Route::patch('user/email', [AuthController::class, 'updateEmail']);
        Route::patch('user/password', [AuthController::class, 'updatePassword']);
        Route::get('users', [UserController::class, 'index']);
    });

});