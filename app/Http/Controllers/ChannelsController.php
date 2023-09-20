<?php

namespace App\Http\Controllers;
use App\Models\Channels;
use App\Models\Teams;
use App\Models\UserChannel;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChannelsController extends Controller
{


    public function getChannelByTeam($id){

        if (Teams::where('id',$id)->exists()){

            $channels = Channels::where('teamId', $id)->get();
            
            if (!$channels){
                return response()->json([
                    'message' => 'No Channels Fetched'
                ],200);
            }
            else{
                return response()->json([
                    'message' => 'Channels Fetched',
                    'data' => $channels 
                ],200);
            }
        }
        else{
            return response()->json([
                'error'=>'Invalid Info'
            ],500);
        }
    }

    public function getChannelByMember($id){
        
        if (Users::where('id',$id)->exists()){

            $user = Users::find($id); 

            $channels = $user->channels;
            
            if (!$channels){
                return response()->json([
                    'message' => 'No Channels Fetched'
                ],200);
            }
            else{
                return response()->json([
                    'message' => 'Channels Fetched',
                    'data' => $channels 
                ],200);
            }
        }
        else{
            return response()->json([
                'error'=>'Invalid Info'
            ],500);
        }
    }

    public function addChannel(Request $request,$teamId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'ownerId' => 'required'
        ]);

        if ($validator->fails() || !(Channels::where('teamId', $teamId)->exists()) ){
            return response()->json([
                'error' => 'Invalid Info'
            ], 500);
        }
        
        $name = $request['name'];
        $description = $request['description'];
        $ownerId = $request['ownerId'];

        $channel = Channels::create([
            'name' => $name,
            'teamId' => $teamId,
            'description' => $description,
            'ownerId' => $ownerId
        ]);

        $channelId = $channel->id;

        UserChannel::create([
            'userId' => $ownerId,
            'channelId' => $channelId
        ]);
        
        if(!$channel){
            return response()->json([
                'error' => 'Channel Not Created'
            ], 500);    
        }
        else{
            return response()->json([
                'message' => 'Channel Created',
                'data' => $channel,
            ], 200);
        }
    }

    public function removeChannel($id){


        if (Channels::where('id', $id)->exists()){
            $channel = Channels::find($id);
            $channel->delete();

            return response()->json([
                'message' => 'Channel Removed'
            ], 200);
        }
        else{
            return response()->json([
                'error' => 'Channel Not Removed'
            ], 500);
        }
        
    }

    public function addChannelMember(Request $request){

        $validator = Validator::make($request->all(), [
            'userId' => 'required',
            'channelId' => 'required'
        ]);

        $userId = $request('userId');
        $channelId = $request('channelId');
 
        if($validator->fails() || !(Users::where('id', $userId)->exists()) || !(Channels::where('id', $channelId)->exists())){
            
            return response()->json([
                'error' => 'Invalid Info'
            ], 500);
        }
        
        $channel = UserChannel::create([
            'userId'=>$userId,
            'teamId'=>$channelId
        ]);

        if(!$channel){
            return response()->json([
                'error' => 'User Not Added'
            ], 500);    
        }
        else{
            return response()->json([
                'message' => 'User Added',
                'data' => $channel,
            ], 200);
        }

    }

    public function removeChannelMember(Request $request){

        $validator = Validator::make($request->all(), [
            'userId' => 'required',
            'channelId' => 'required'
        ]);

        $userId = $request('userId');
        $channelId = $request('channelId');
 
        if($validator->fails() || !(Channels::where('channelId', $channelId)->exists()) || !(Users::where('id', $userId)->exists()) ){
            return response()->json([
                'error' => 'Invalid Info'
            ], 500);
        }
        
        $channel = UserChannel::where('userId',$userId)->where('channelId',$channelId)->first();

        if(!$channel){
            return response()->json([
                'error' => 'User Not Removed'
            ], 500);    
        }
        else{
            $channel->delete();
            return response()->json([
                'message' => 'User Removed'
            ], 200);
        }

    }


    public function getChannelMembers($id){

        if(Channels::where('id',$id)->exists()){
            
            $channels = Channels::find($id);

            $users = $channels->users;

            if ($users){
                return response()->json([
                    'message' => 'Team Members Fetched',
                    'data' => $users
                ], 200);
            }

        }
        else{
            return response()->json([
                'message' => 'Invalid ChannelId'
            ], 200);

        }
    }
}
