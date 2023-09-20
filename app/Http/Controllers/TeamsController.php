<?php

namespace App\Http\Controllers;

use App\Models\Teams;
use App\Models\Users;
use App\Models\UserTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeamsController extends Controller
{
    public function getTeamByMember($id){

        if (Users::where('id',$id)->exists()){

            $user = Users::find($id); 

            $teams = $user->teams;
            
            if(!$teams){
                return response()->json([
                    'message' => 'User has no Teams'
                ], 200);    
            }
            else{
                return response()->json([
                    'message' => 'Teams Fetched',
                    'data' => $teams,
                ], 200);
            }
        }
        else{
            return response()->json([
                'error'=>'Invalid Info'
            ],500);
        }


    }


    public function addTeam(Request $request){
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'adminId' => 'required',
            'description' => 'required',
            'workspaceId' => 'required'
        ]);

        if ($validator->fails()){
            return response()->json([
                'error' => 'Invalid Info'
            ], 500);
        }
        
        $name = $request['name'];
        $adminId = $request['adminId'];
        $description = $request['description'];
        $workspaceId = $request['workspaceId'];

        $team = Teams::create([
            'name' => $name,
            'adminId' => $adminId,
            'description' => $description,
            'workspaceId' => $workspaceId
        ]);

        $teamId = $team->id;

        $userTeams = UserTeam::create([
            'userId' => $adminId,
            'teamId' => $teamId
        ]);
        
        if(!$team){
            return response()->json([
                'error' => 'Team Not Created'
            ], 500);    
        }
        else{
            return response()->json([
                'message' => 'Team Created',
                'data' => $team,
            ], 200);
        }
    }

    public function removeTeam($id){

        if(Teams::where('id', $id)->exists())
        {
            Teams::destroy($id);
            return response()->json([
                'message' => 'Team Deleted'
            ], 200);
        }
        else{
            return response()->json([
                'error' => 'Team Not Deleted'
            ], 500);
        }

    }

    public function addTeamMember(Request $request){

        $validator = Validator::make($request->all(), [
            'userId' => 'required',
            'teamId' => 'required'
        ]);

        $userId = $request('userId');
        $teamId = $request('teamId');
 
        if ($validator->fails() || !(Teams::where('id', $teamId)->exists()) || !(Users::where('id', $userId)->exists()) ){
            return response()->json([
                'error' => 'Invalid Info'
            ], 500);
        }
        
        $team = UserTeam::create([
            'userId'=>$userId,
            'teamId'=>$teamId
        ]);

        if(!$team){
            return response()->json([
                'error' => 'User Not Added'
            ], 500);    
        }
        else{
            return response()->json([
                'message' => 'User Added',
                'data' => $team,
            ], 200);
        }

    }

    public function removeTeamMember(Request $request){

        $validator = Validator::make($request->all(), [
            'userId' => 'required',
            'teamId' => 'required'
        ]);

        $userId = $request('userId');
        $teamId = $request('teamId');
 
        if ($validator->fails() || !(Teams::where('id', $teamId)->exists()) || !(Users::where('id', $userId)->exists()) ){
            return response()->json([
                'error' => 'Invalid Info'
            ], 500);
        }
        
        $team = UserTeam::where('userId',$userId)->where('teamId',$teamId)->first();

        if(!$team){
            return response()->json([
                'error' => 'User Not Removed'
            ], 500);    
        }
        else{
            $team->delete();
            return response()->json([
                'message' => 'User Removed'
            ], 200);
        }

    }

    public function getTeamMembers($id){

        if(Teams::where('id',$id)->exists()){
            
            $teams = Teams::find($id);

            $users = $teams->users;

            if ($users){
                return response()->json([
                    'message' => 'Team Members Fetched',
                    'data' => $users
                ], 200);
            }
        }
        else{
            return response()->json([
                'message' => 'Invalid TeamId'
            ], 200);

        }
    }
}
