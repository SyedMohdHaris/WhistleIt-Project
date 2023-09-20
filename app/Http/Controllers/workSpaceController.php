<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;

class workSpaceController extends Controller
{
    //

    public function createWorkSpace(Request $request)
    {
        $workSpace=new Workspace();
        $workSpace->name=$request->name;
        $workSpace->description=$request->description;
        $workSpace->save();
        return 1;
    }
    public function showWorkSpace(Request $request)
    {
        return $workSpaces=Workspace::all();
        
    
    }
    public function deleteWorkSpace(Request $request)
    {
        $workSpace=Workspace::where('name',$request->input('name'))->get();
        return $workSpace;
    }
}
