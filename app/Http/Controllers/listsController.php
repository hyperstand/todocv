<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\todo as todo;

class listsController extends Controller
{
    public function get_all()
    {
        $todo_title=new todo();
        $result=$todo_title::where('hide','=',0)->get();
        
        return $result; 
    }
    public function get_data(Request $request)
    {   

        $id = $request->route('id'); 
        $todo_title=new todo();
        $result=$todo_title::where('code','=',$id);
        return $result->get();
        // return $todo_title::find($id);
    }

    public function add_todo(Request $request)
    {   
        $stat=true;
        $todo_title=new todo();
        while($stat)
        {   
           $id=$this->gen_id();
           if ($todo_title::where('code', '=',$id)->count() == 0) {
               $stat=false;
            }
        }
        $todo_title->create($request->get('name'),$id);
        //error handling
        return 1;
    }
    public function add_content_todo(Request $request)
    {
        
    }

    public function get_first(Request $request)
    {
        $todo_title=new todo();
        echo $todo_title->first();
        return null;
    }

    private function gen_id($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
