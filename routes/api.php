<?php

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

Route::prefix('auth')->group(function () {
    Route::post('/login', 'App\Http\Controllers\API\AuthController@login')->name('api.auth.login');
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    // Authenticated Only
    Route::post('auth/verify', 'App\Http\Controllers\API\AuthController@verify')->name('api.auth.verify');
    Route::apiResource('users', 'App\Http\Controllers\API\UserController');
    Route::apiResource('configurations', 'App\Http\Controllers\API\ConfigurationController');
    Route::apiResource('study-program', 'App\Http\Controllers\API\StudyProgramController');
    Route::apiResource('majors', 'App\Http\Controllers\API\MajorController');
    Route::apiResource('classrooms', 'App\Http\Controllers\API\ClassroomController');
    Route::apiResource('subjects', 'App\Http\Controllers\API\SubjectController');
    Route::apiResource('notifications', 'App\Http\Controllers\API\NotificationController')->except(['update']);
    Route::apiResource('help_categories', 'App\Http\Controllers\API\HelpCategoryController');
    Route::apiResource('helps', 'App\Http\Controllers\API\HelpController');
});

// test github
