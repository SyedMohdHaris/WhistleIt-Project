<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    //

    public function register(Request $request)
    {
    
        $User = new User();
        $User->name = $request->name;
        $User->email = $request->email;
        
        $User->password = Hash::make($request->password);
        $User->save();
        // $User->assignRole($User->Usertype);

        return 1;


    }
    public function login(Request $request)
    {

        $credetails = [
            'email' => $request->email,
            'password' => $request->password,
        
        ];
        
        if (Auth::attempt($credetails)) {
            // return Auth::user();
            return 1;
        } else {
            return "Inavalid Credetails";
        }
    }
    public function Logout()
    {
        Auth::logout();
        return 1;
    }
    public  function showUsers(Request $request)
    {

        return User::all();

    }


}
