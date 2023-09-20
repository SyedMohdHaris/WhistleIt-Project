<?php

namespace App\Http\Controllers;

use App\Models\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class requestController extends Controller
{
    //
    public function  make_request(Request $request)
    {
        $requests=new Requests;
        $requests->name=$request->name;
        $requests->requestType=$request->requestType;
        $requests->senderId=Auth::id();
        $requests->reciverId=$request->reciverId;
        $requests->lcoationId=$request->locationId;
        return 'sucess';
        



    }
}
