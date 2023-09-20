<?php

use App\Http\Controllers\TeamsController;
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

Route::get('/teams/members/{id}',[TeamsController::class,'getTeamByMember']);
Route::post('/teams',[TeamsController::class,'addTeam']);
Route::delete('/teams/{id}',[TeamsController::class,'removeTeam']);
Route::post('/teams/members',[TeamsController::class,'addTeamMember']);
Route::delete('/teams/members',[TeamsController::class,'removeTeamMember']);
Route::get('/members/teams/{id}',[TeamsController::class,'getTeamMembers']);

Route::post('/channels',[TeamsController::class,'addChannel']);
Route::delete('/channels/{id}',[TeamsController::class,'removeChannel']);
Route::post('/channels/members',[TeamsController::class,'addChannelMember']);
Route::delete('/channels/members',[TeamsController::class,'removeChannelMember']);
Route::get('/members/channels/{id}',[TeamsController::class,'getChannelMembers']);
Route::get('/channels/members/{id}',[TeamsController::class,'getChannelByMember']);
Route::get('/channels/teams/{id}',[TeamsController::class,'getChannelByTeam']);
