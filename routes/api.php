<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserFileController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('uploadFile', [UserFileController::class, 'uploadFile']);

Route::get('getUserFiles/{user_id}', [UserController::class, 'getUserFiles']);

Route::get('getUsersFiles', [UserController::class, 'getUsersFiles']);