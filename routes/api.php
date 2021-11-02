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
    Route::post('/login', 'App\Http\Controllers\API\LoginController')->name('api.auth.login');
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    // Authenticated Only
    Route::resource('users', 'App\Http\Controllers\API\UserController')->except(['edit']);
    Route::resource('configurations', 'App\Http\Controllers\API\ConfigurationController')->except(['edit']);
    Route::resource('study-program', 'App\Http\Controllers\API\StudyProgramController')->except(['edit']);
    Route::resource('majors', 'App\Http\Controllers\API\MajorController')->except(['edit']);
    Route::resource('classrooms', 'App\Http\Controllers\API\ClassroomController')->except(['edit']);
    Route::resource('subjects', 'App\Http\Controllers\API\SubjectController')->except(['edit']);
    Route::resource('notifications', 'App\Http\Controllers\API\NotificationController')->except([
        'edit', 'update'
    ]);
});

// test github
