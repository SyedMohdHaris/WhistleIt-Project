<?php

namespace App\Http\Controllers;

use App\Models\Requests;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class requestController extends Controller
{
    //
    public function make_request(Request $request)
    {

        $user=User::Select('id')->where('email',$request->email)->first();

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'requestType' => 'required',
                'reciverId' => 'required',
                'locationId' => "locatonId"

            ]
        );
        if ($validator->fails()) {
            return response()->json()([
                'error',
                'Invalid Info'
            ], 500);

        }
        $requests = new Requests;
        $requests->name = $request->name;
        $requests->requestType = $request->requestType;
        $requests->senderId = Auth::id();
        $requests->reciverId = $user->id;
        $requests->lcoationId = $request->locationId;
        if ($requests) {
            return response()->json()([
                'msg',
                'Request Sent Successfully',
            ], 200);
        } else {
            return response()->json()([
                'error',
                'Technical fault',
            ], 500);
        }
    }


    public function show_send_reuest_users(Request $request)
    {
        $validator = Validator::make(
                    $request->all(),
                    [
    
                        'email' => 'required',
        
                    ]
                );

        if($validator->fails())
        {
            if ($validator->fails()) {
                return response()->json()([
                    'error',
                    'Invalid Info'
                ], 500);
    
            }

        }
       $user=User::where("email",$request->email)->first();
            
    //  $requests=Requests::where()
    }
    // public function accept_request(Request $request)
    // {
    //     $validator = Validator::make(
    //         $request->all(),
    //         [
    //             'name' => 'required',
    //             'requestType' => 'required',
    //             'reciverId' => 'required',
    //             'locationId' => "locatonId"

    //         ]
    //     );

    //     if($validator->fails())
    //     {
    //         return response()->json()([
    //             'error','Invalid Infor',
    //         ],500);
    //     }
    // }
        


}