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
        $result=$todo_title::where('code','=',$id);
        return $result->get();
        // return $todo_title::find($id);
    }

    public function add_todo()
    {   
        $id='asd';
        return $id;
    }

    private function gen_id()
    {
        if (User::where('email', '=', Input::get('email'))->count() > 0) {
            // user found
         }
    }
}
