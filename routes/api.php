<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;

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

Route::get('/events', [EventController::class, 'AllEvent']);
Route::get('/participant', [EventController::class, 'FetchParticipant']);
Route::post('/events/register', [EventController::class, 'RegisterEvent']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);