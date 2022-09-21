<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProblemSolvingController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
