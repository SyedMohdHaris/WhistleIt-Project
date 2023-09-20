<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    //

    public function register(Request $request)
    {
          

        $validator=Validator::make($request->all(),
        [
            'name'=>'required',
            'email'=>'required',
            'pasword'=>'required'

        ]);
        if(!$validator->fails())
        {
            return response()->json([
                'error'=>'Invalid info'
            
        ],500);
        }
        $User = new User();
        $User->name = $request->name;
        $User->email = $request->email;
        
        $User->password = Hash::make($request->password);
        $User->save();
        if($User){
           
                return response()->json([
                    'msg'=>'User Created'
                
            ],500);
            
        }
        else
        {
            return response()->json([
                'error'=>'User not Created'
            ],500);

        }
        // $User->assignRole($User->Usertype)


    }


    public function login(Request $request)
    {

        $credetails = [
            'email' => $request->email,
            'password' => $request->password,
        
        ];
        
        if (Auth::attempt($credetails)) {
            // return Auth::user();
            return response()->json([
                'msg'=>'User Login'
            ],200);
        } else {
            return response()->json([
                'error'=>'Invaid credetails'
            ],500);
        }
    }
    public function Logout()
    {
        Auth::logout();

         return response()->json([
            'msg'=>'Logout Sucessfully'
        ],200);
    
    }
    public  function showUsers(Request $request)
    {

         $user=User::all();
         if($user)
         {
            return $user;
         }
         else
         {
            return response()->json([
                'error'=>'User has not been created yet'
            ],500);
        }
         }

    


}
