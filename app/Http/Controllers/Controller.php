<?php

namespace App\Http\Controllers;
use App\Models\WorkflowApplication;
use App\Models\WorkflowHistory;

abstract class Controller
{
    public function UpdateWorkflow(Request $request)
    {
        $dt = WorkflowApplication::where('Regno', $request->Regno)->first();
        $wfLast = $dt->WorkflowCurrentCodeId;

        WorkflowApplication::where('Regno', $request->Regno)->update([
            'WorkflowCurrentCodeId' => $request->Next,
            'WorkflowLastCodeId' => $wfLast
        ]);  

        WorkflowHistory::create([
            'Regno' =>  $request->Regno,
            'WorkflowCodeId' => $wfLast
        ]);  

        return back();
    }
    
}
