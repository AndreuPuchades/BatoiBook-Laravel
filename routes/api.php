<?php

use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\FamilyController;
use App\Http\Controllers\Api\ModuleController;
use App\Http\Controllers\Api\SalesController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\LoginController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('courses',CourseController::class);
Route::apiResource('families',FamilyController::class);
Route::apiResource('modules',ModuleController::class);
Route::apiResource('users',UsersController::class);
Route::apiResource('books',BookController::class);
Route::apiResource('sales',SalesController::class);

Route::middleware('auth:sanctum')->group( function () {
    Route::apiResource('books', BookController::class)->except(['index', 'show']);
    Route::apiResource('sales', SalesController::class)->except(['index', 'show']);
});

Route::post('login', [\App\Http\Controllers\Api\LoginController::class,'login']);
