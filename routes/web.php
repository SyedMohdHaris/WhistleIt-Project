<?php

use App\Http\Controllers\requestController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\userController;
use App\Http\Controllers\workSpaceController;
use App\Models\Workspace;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get("/show",[userController::class,'showUsers']);
Route::get('/', function () {
    return view('welcome');
});
Route::post("/user",[userController::class,'register']);    
Route::post("/login",[userController::class,'login']);
Route::middleware(['auth'])->prefix('/user')->group(function ()
{
Route::post("/logout",[userController::class,'logout']);
Route::get("/show",[userController::class,'showUsers']);
Route::get("/delete",[userController::class,'delete_users']);
});


Route::middleware('auth')->prefix('/workSpace')->group(function ()
{
    Route::get('/add',[workSpaceController::class,'createWorkSpace']);
    Route::get('/show',[workSpaceController::class ,'showWorkSpace']);
    Route::get('/delete',[workSpaceController::class,'deletWorkSpace']);
    Route::get('/addmembers',[workSpaceController::class,'assignMembers']);
});
Route::middleware('auth')->prefix('/teams')->group(function ()
{
    Route::get('',[TeamsController::class,'addTeam']);
    Route::get('/members',[TeamsController::class,'addTeamMember']);
    Route::get('/remove',[TeamsController::class,'removeTeamMember']);
    Route::get('/getMembers',[TeamsController::class,'getTeamMembers']);
    // Route::get('/getTeams',[TeamsController::class,'getTeams']);
});
Route::get('/getTeams',[TeamsController::class,'getTeams']);



Route::middleware('auth')->prefix('/requests')->group(function ()
{

    
    Route::get('/send',[requestController::class,'make_request']);
});


