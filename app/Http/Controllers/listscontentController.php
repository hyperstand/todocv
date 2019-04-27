<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\todocontent;

class listscontentController extends Controller
{
    public function add_content_todo(Request $request)
    {   
        $id = $request->route('id');
        $value =$request->input('data.value');
        $todo_content=new todocontent();
        $response=$todo_content->insert_todo($value,$id);

        return response()->json($response['output'],$response['code']);
    }
    public function update_task_name(Request $request)
    {
        $id = $request->route('id');
        $content_id=$request->input('data.content_id');
        $value = $request->input('data.value');

        $todo_content=new todocontent();
        $response=$todo_content->update_todo($value,$id,$content_id);
        return response()->json($response['output'],$response['code']);
    }
    
    public function hide_toggle_task(Request $request)
    {
        $id = $request->route('id');
        $content_id=$request->input('data.content_id');
        $status = $request->input('data.status');

        // $task,$todo_id,$content_id        
        $todo_content=new todocontent();
        $response=$todo_content->hide_show($content_id,$status,$id);
        return response()->json($response['output'],$response['code']);
    }
    
    public function delete_content_todo(Request $request)
    {
        $todo_id = $request->route('id');
        $content_id=$request->input('data.content_id');

        $todo_content=new todocontent();
        $response=$todo_content->delete_todo($todo_id,$content_id);
        
        return response()->json($response['output'],$response['code']);
    }
}
