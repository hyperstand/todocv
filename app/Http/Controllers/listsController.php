<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\tools\generate as g;
use App\todo;
use Auth;
class listsController extends Controller
{   

    public function get_all()
    {
        //$todo_title=new todo();
        //$result=$todo_title::where('hide','=',0)->get();

        // $todo=new todo();
        // $content=todo::with('mytodo')->withCount('mytodo')->get();
            
        // return todo::with(['mytodo'=>function($query){
        //     $query->select('todo_id AS upvotes_count');
        // }])->get();
        // $t=todo::with('mytodo')->get();
        // foreach ($t as $store) {
        //     $itemCount = $store->mytodo()->count();
        // }
        // return $itemCount;

        return todo::withCount('task')
               ->where([['hide','=',0],['user_hide_id','=',null]])
               ->get();
         
        // $todo->setHidden(['hide']);

        // return $todo->with(['mytodo'=>function($query){
        //     $query->where('finish','=','1');
        // }])->where('id',1)->get();
        //return $result; 
    }

    ///return list content
    public function get_data(Request $request)
    {   
        $id = $request->route('id'); 
        $todo_title=new todo();
        $response=$todo_title->get_content($id);
        
        return response()->json($response['output'],$response['code']);

        // $result=$todo_title::where('code','=',$id);
        // return $result->get();
        // return $todo_title::find($id);
    }
    public function delete_todo(Request $request)
    {
        $id = $request->route('todocode'); 
        $todo_title=new todo();
        $response=$todo_title->delete_content($id);
        return response()->json($response['output'],$response['code']);
    }

    //adding new todo
    public function add_todo(Request $request)
    {   
        $stat=true;
        $todo_title=new todo();
        while($stat)
        {   
           $t=new g();
           $id=$t->gen_id();
           if ($todo_title::where('code', '=',$id)->count() == 0) {
               $stat=false;
            }
        }
        $response=$todo_title->create('todo',$id);
        return response()->json($response['output'],$response['code']);
    }

    //hide or unhide todo
    public function hide_todo(Request $request)
    {
        $todo_code=$request->route('todocode');
        $type=$request->input('data.type');
        //using auth to hide
        if(Auth::check()){
            $todo_title=new todo();
            $response=$todo_title->hide_show(Auth::id(),$todo_code,$type);//1 sample id due to nt log in
            return response()->json($response['output'],$response['code']);
        }
        else
        {
            return response()->json(array('status'=>false,'message'=>'User Not Have Permisssion'),505);
        }
    }   


    //modify name todo
    public function rename_todo(Request $request)
    {   
        $todo_code=$request->route('todocode');
        $name=$request->input('data.name');
       
        $todo_title=new todo();
        $response=$todo_title->modify($todo_code,$name);
        return response()->json($response['output'],$response['code']);
    }

    //get first todo
    public function get_first(Request $request)
    {
        $todo_title=new todo();
        $response=$todo_title->get_first();
        return response()->json($response['output'],$response['code']);
    }
}
