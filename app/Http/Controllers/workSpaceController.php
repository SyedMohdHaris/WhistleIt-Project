<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class workSpaceController extends Controller
{
    //

    public function createWorkSpace(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'description' => 'required',


            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid info'

            ], 500);
        }
        $workSpace = new Workspace();
        $workSpace->name = $request->name;
        $workSpace->description = $request->description;
        $workSpace->owner = Auth::id();
        $workSpace->save();
        $work_id = Workspace::Select('id')->where("name", $request->name)->get();
        $user = User::find(Auth::id());
        // return $work_id;


        if ($workSpace) {
            $user->update(['workspaceId' => $work_id[0]['id']]);


            return response()->json([
                'msg' => 'WorkSpace Created'

            ], 200);
        } else {
            return response()->json([
                'error' => 'WorkSpace not Created'

            ], 500);
        }

    }
    public function showWorkSpace(Request $request)
    {
        $workSpaces = Workspace::all();
        if ($workSpaces) {
            return $workSpaces;
        } else {
            return "Nothing to show";
        }


    }
    public function deleteWorkSpace($id)
    {
        $workSpace = Workspace::where('name', $request->input('name'))->get();
        if ($workSpace) {
            $workSpace->delete();
            return response()->json([
                'msg' => 'WorkSpace Deleted'

            ], 200);
        } else {
            return response()->json([
                'error' => 'WorkSpace Not Deleted'

            ], 500);
        }
    }

    public function assignMembers(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required',



            ]
        );
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid info'

            ], 500);

        }
        $email = $request->input('email');

        $id = Auth::id();
        $work_id = User::Select('workspaceId')->where('id', $id)->get();
        $user = User::Select('id', 'workspaceId')->where('email', $email)->first();


        if ($user->id != $id) {
            if ($user) {
                //  return $work_id[0]['workspaceId'];
                if ($work_id[0]['workspaceId'] != null) {


                    $user->update(['workspaceId' => $work_id[0]['workspaceId']]);
                    if ($user) {
                        return response()->json([
                            'msg' => 'Memeber Addeed'

                        ], 200);

                    } else {
                        return response()->json([
                            'error' => 'Member not added'

                        ], 200);

                    }
                } else {
                    return response()->json([
                        'error' => 'No workspace found'
                    ], 500);
                }
            } else {
                return response()->json([
                    'error' => 'WorkSpace Not found'

                ], 200);
            }
        } else {
            return response()->json([
                'error' => 'ALready in WorkSpace'

            ], 500);

        }
    }


}