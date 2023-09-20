<?php

namespace App\Http\Controllers;

use App\Models\Teams;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeamsController extends Controller
{
    public function getTeam($id){

        if (Users::where('id',$id)->exists()){

            
        }

    }


    public function addTeam(Request $request){
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'adminId' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()){
            return response()->json([
                'error' => 'Invalid Info'
            ], 500);
        }
        
        $name = $request['name'];
        $adminId = $request['adminId'];
        $description = $request['description'];

        $team = Teams::create([
            'name' => $name,
            'adminId' => $adminId,
            'description' => $description
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
        
        //query to add user into team//
        
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
        
        //query to remove user into team//
        
        if(!$team){
            return response()->json([
                'error' => 'User Not Removed'
            ], 500);    
        }
        else{
            return response()->json([
                'message' => 'User Removed',
                'data' => $team,
            ], 200);
        }

    }

    public function getTeamMembers($id){

        if(Teams::where('id',$id)->exists()){
            $members;//query to get all members

            return response()->json([
                'message' => 'Team Members Fetched',
                'data' => $members
            ], 200);
        }
        else{
            return response()->json([
                'message' => 'Invalid TeamId',
                'data' => $members
            ], 200);

        }
    }
}
