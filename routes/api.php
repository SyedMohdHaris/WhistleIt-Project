<?php

use App\Http\Controllers\FriendsController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\userController;
use App\Http\Controllers\workSpaceController;
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

//Routes to manage Teams

Route::get('/teams/members/{id}',[TeamsController::class,'getTeamByMember']);
Route::post('/teams',[TeamsController::class,'addTeam']);
Route::delete('/teams/{id}',[TeamsController::class,'removeTeam']);
Route::post('/teams/members',[TeamsController::class,'addTeamMember']);
Route::delete('/teams/members',[TeamsController::class,'removeTeamMember']);
Route::get('/members/teams/{id}',[TeamsController::class,'getTeamMembers']);

//Routes to manage Channels

Route::post('/channels',[TeamsController::class,'addChannel']);
Route::delete('/channels/{id}',[TeamsController::class,'removeChannel']);
Route::post('/channels/members',[TeamsController::class,'addChannelMember']);
Route::delete('/channels/members',[TeamsController::class,'removeChannelMember']);
Route::get('/members/channels/{id}',[TeamsController::class,'getChannelMembers']);
Route::get('/channels/members/{id}',[TeamsController::class,'getChannelByMember']);
Route::get('/channels/teams/{id}',[TeamsController::class,'getChannelByTeam']);


//Routes to manage Users
Route::get('/', function () {
    return view('welcome');
});

Route::post('/user',[userController::class,'register']);    
Route::post('/login',[userController::class,'login'])->name('login');
Route::middleware(['auth'])->prefix('/user')->group(function ()
{
   
});
Route::get("/show",[userController::class,'showUsers']);
Route::post("/logout",[userController::class,'logout']);


//Routes to manage Workspace

Route::post('/workspace',[workSpaceController::class,'createWorkSpace']);
Route::get('/workspace',[workSpaceController::class ,'showWorkSpace']);
Route::delete('/workspace/{id}',[workSpaceController::class,'deletWorkSpace']);


//Routes to manage messages

Route::post('/messages',[MessageController::class,'addMessage']);
Route::delete('/messages',[MessageController::class,'deleteMessage']);
Route::get('/messages/channel/{id}',[MessageController::class,'getMessageChannel']);
Route::get('/messages/chat/{id}',[MessageController::class,'getMessageChat']);


//Routes to manage CHat Friends

Route::post('/friends',[FriendsController::class,'addMessageFriend']);
Route::get('/friends',[FriendsController::class,'getAllFriends']);



                 
