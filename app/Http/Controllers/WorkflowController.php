<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkflowApplication;
use App\Models\WorkflowHistory;
use Hash;
use Session;
use Carbon\Carbon;

class WorkflowController extends Controller
{
    public function UpdateWorkflow(Request $request)
    {
        //dd($request->Regno);
        $dt = WorkflowApplication::where('Regno', $request->Regno)->first();
        $wfLast = $dt->WorkflowCurrentCodeId;

        WorkflowApplication::where('Regno', $request->Regno)->update([
            'WorkflowCurrentCodeId' => $request->Next,
            'WorkflowLastCodeId' => $wfLast
        ]);  

        WorkflowHistory::create([
            'Regno' =>  $request->Regno,
            'WorkflowCodeId' => $request->Next
        ]);  

        //return back();
        return redirect('/HomeAdmin');
    }
}
