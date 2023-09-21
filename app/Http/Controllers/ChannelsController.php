<?php

namespace App\Http\Controllers;
use App\Models\Channels;
use App\Models\Teams;
use App\Models\User;
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

    public function addChannel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'adminEmail' => 'required',
            'teamName' => 'required',
        ]);

        if ($validator->fails() ){
            return response()->json([
                'error' => 'Invalid Info'
            ], 500);
        }

        $team=Teams::Select("id")->where("name",$request->input("teamName"))->first();
        $adminId=User::Select("id")->where("email",$request->input('adminEmail'))->first();
    //    return $adminId->id;
        if($team and $adminId)
        {
         $name = $request->input('name');
         $description = $request->input('description');
        

        $channel = Channels::create([
            'name' => $name,
            'teamId' => $team->id,
            'description' => $description,
            'owner' => $adminId->id,
        ]);

        $channelId = $channel->id;

        UserChannel::create([
            'userId' => $adminId->id,
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
            'email' => 'required',
            'channelId' => 'required'
        ]);

        $email = $request->input('email');
        $channelId = $request->input('channelId');
       
 
        if($validator->fails() || !(Users::where('email', $email)->exists()) || !(Channels::where('id', $channelId)->exists())){
            
            return response()->json([
                'error' => 'Invalid Info'
            ], 500);
        }

       
        $userId=User::Select("id")->where("email",$email)->first();
    
        $channel = UserChannel::create([
            'userId'=>$userId->id,
            'channelId'=>$channelId
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
            'email' => 'required',
            'channelId' => 'required'
        ]);


        $email = $request->input('email');
        $channelId = $request->input('channelId');

     
        if($validator->fails()  || !(Channels::where('id', $channelId)->exists()) || !(Users::where('email', $email)->exists())){
            return response()->json([
                'error' => 'Invalid Info'
            ], 500);
        }
        $userId=User::Select("id")->where("email",$email)->first();
        
        $channel = UserChannel::where('userId',$userId->id)->where('channelId',$channelId)->first();

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


    public function getChannelMembers(Request $request){
        $validator = Validator::make($request->all(), [
            'channelId' => 'required',
        
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => 'Invalid Info'
            ], 500);
        }
        $id=$request->input("channelId");
        if(Channels::where('id',$id)->exists()){
            
           
        

            $users =  User::Select("name","email")->join("user_channels",'users.id','userId')->where('channelId',$id)->get();

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
