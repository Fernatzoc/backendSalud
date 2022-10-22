<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


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

Route::controller(UserController::class)->group(function () {
    Route::post('/users/login', 'login')->name('loginApi');
    Route::post('/users/new', 'newUser')->name('newUserApi');
    Route::post('/users/logout', 'logout');
    Route::get('/users/refresh', 'refresh');
    Route::get('/users/me', 'getUser');
    Route::get('/users/all', 'allUsers');
});

Route::apiResource('/pregnant', 'App\Http\Controllers\Api\PregnantController');