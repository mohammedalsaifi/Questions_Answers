<?php

use App\Http\Controllers\Api\AnswersController;
use App\Http\Controllers\Api\AuthenticationTokensController;
use App\Http\Controllers\Api\QuestionsController;
use App\Http\Controllers\Api\TagsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('questions', QuestionsController::class)
    ->middleware('auth:sanctum');
Route::apiResource('answers', AnswersController::class);
Route::apiResource('tags', TagsController::class);
Route::post('auth/tokens', [AuthenticationTokensController::class, 'store']);
Route::delete('auth/tokens/{token?}', [AuthenticationTokensController::class, 'abeeeeeeeeeeeeeelolololeeeeeeeee'])
    ->middleware('auth:sanctum');
