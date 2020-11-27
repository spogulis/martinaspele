<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

//User related
Route::prefix('/user')->group(function() {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
    // Route::get('/verify', [UserController::class, 'verify']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('/logout', [UserController::class, 'logout']);
        Route::get('/user', [UserController::class, 'user']);
        Route::get('/verify/{id}/{hash}', [UserController::class, 'verify']);
        Route::get('/getgenerallevel', [UserController::class, 'getGeneralLevel']);
        Route::get('/getuserprofileimage', [UserController::class, 'getProfileImage']);
        Route::post('/setuserbgimage', [UserController::class, 'setProfileBgImage']);
    });
});
