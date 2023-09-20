<?php

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

Route::post('/teams',[TeamsController::class,'addTeam']);
Route::delete('/teams/{id}',[TeamsController::class,'removeTeam']);
Route::post('/teams/member',[TeamsController::class,'addTeamMember']);
Route::delete('/teams/member',[TeamsController::class,'removeTeamMember']);
Route::get('/team/member/{id}',[TeamsController::class,'getTeamMembers']);

