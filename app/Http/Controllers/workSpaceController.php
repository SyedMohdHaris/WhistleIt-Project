<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class workSpaceController extends Controller
{
    //

    public function createWorkSpace(Request $request)
    {
        $id = Auth::id();
        $workSpace=new Workspace();
        $workSpace->name=$request->name;
        $workSpace->description=$request->description;
        $workSpace->ownerId=$id;
        $workSpace->save();
        return 1;
    }
    public function showWorkSpace(Request $request)
    {
        return $workSpaces=Workspace::all();
        
    
    }
    public function deleteWorkSpace($id)
    {
        $workSpace=Workspace::where('id',$id)->get();
        $workSpace->delete();
        return $workSpace;
    }
}
