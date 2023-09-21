<?php

namespace App\Http\Controllers;

use App\Models\Teams;
use App\Models\User;
use App\Models\Users;
use App\Models\UserTeam;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeamsController extends Controller
{
    public function getTeamByMember($id)
    {

        if (Users::where('id', $id)->exists()) {

            $user = Users::find($id);

            $teams = $user->teams;

            if (!$teams) {
                return response()->json([
                    'message' => 'User has no Teams'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Teams Fetched',
                    'data' => $teams,
                ], 200);
            }
        } else {
            return response()->json([
                'error' => 'Invalid Info'
            ], 500);
        }


    }


    public function addTeam(Request $request)
    {



        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'adminEmail' => 'required',
            'description' => 'required',
            'workSpace' => 'required'
        ]);


        $user = User::Select('id')->where('email', $request->adminEmail)->first();
        $workspaceId = Workspace::Select('id')->where('name', $request->workSpace)->first();

        if ($user) {
            if ($validator->fails()) {
                return response()->json([
                    'error' => 'Invalid Info'
                ], 500);
            }

            $name = $request->name;
            $adminId = $user['id'];
            $description = $request['description'];
            $workspaceId = $workspaceId['id'];

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

            if (!$team) {
                return response()->json([
                    'error' => 'Team Not Created'
                ], 500);
            } else {
                return response()->json([
                    'message' => 'Team Created',
                    'data' => $team,
                ], 200);
            }
        } else {
            return response()->json([
                'message' => 'user not found',

            ], 200);
        }
    }

    public function removeTeam($id)
    {

        if (Teams::where('id', $id)->exists()) {
            Teams::destroy($id);
            return response()->json([
                'message' => 'Team Deleted'
            ], 200);
        } else {
            return response()->json([
                'error' => 'Team Not Deleted'
            ], 500);
        }

    }

    public function addTeamMember(Request $request)
    {



        $validator = Validator::make($request->all(), [
            'teamMemberEmail' => 'required',
            'teamId' => 'required'
        ]);



        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid Info'
            ], 500);
        }

        $userId = User::select('id')->where('email', $request->teamMemberEmail)->first();
        $teamId = $request->input('teamId');


        $team = UserTeam::create([
            'userId' => $userId['id'],
            'teamId' => $teamId
        ]);

        if (!$team) {
            return response()->json([
                'error' => 'User Not Added'
            ], 500);
        } else {
            return response()->json([
                'message' => 'User Added',
                'data' => $team,
            ], 200);
        }

    }

    public function removeTeamMember(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'teamId' => 'required'
        ]);



        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid Info'
            ], 500);
        }
        $user = User::Select("id")->where("email", $request->input("email"))->first();
        if ($user) {
            // $userId = $request->input('userId');
            $teamId = $request->input('teamId');
            $team = UserTeam::where('userId', $user->id)->where('teamId', $teamId)->first();

            if (!$team) {
                return response()->json([
                    'error' => 'User Not Removed'
                ], 500);
            } else {
                $team->delete();
                return response()->json([
                    'message' => 'User Removed'
                ], 200);
            }

        }
        else
        {
            return response()->json([
                'error' => 'User Not Found'
            ], 500);
        }
    }
    public function getTeams()
    {
        return Teams::select('name','description')->get();
    }

    public function getTeamMembers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);



        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid Info'
            ], 500);
        }

        if (Teams::where('id', $request->id)->exists()) {
             $id=$request->input('id');
            // $teams = Teams::find($request->id);

            $users = User::Select("name","email")->join("user_teams",'users.id','userId')->where('teamId',$id)->get();
        

            if ($users) {
                return response()->json([
                    'message' => 'Team Members Fetched',
                    'data' => $users
                ], 200);
            }
        } else {
            return response()->json([
                'message' => 'Invalid TeamId'
            ], 200);

        }
    }


}