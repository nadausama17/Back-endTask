<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProblemSolvingController;
use App\Http\Controllers\UserController;
use App\Models\User;

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

//backend task part one (problem solving)
Route::get('/numsCount/{startNum}/{endNum}', [ProblemSolvingController::class, 'getNumsCount']);
Route::get('/stringIndex/{input_string}', [ProblemSolvingController::class, 'getStringIndex']);

Route::post('/reduceNumSteps', [ProblemSolvingController::class, 'getReducedNumSteps']);

//backend task part two
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::get('/users/{id}', [UserController::class, 'getUser']);
Route::get('/users', [UserController::class, 'getAllUsers']);

Route::put('/users/{id}', [UserController::class, 'updateUserInfo']);

Route::delete('/users/{id}', [UserController::class, 'deleteUser']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
