<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class todocontent extends Model
{   

    protected $table = 'todocontent';
    protected $fillable = ['finish'];
    protected $hidden = array('created_at', 'updated_at');

    public function todo()
    {
        return $this->belongsTo(todo::class,'todo_id','id');
    }

    //creating new todo_content title
    public function insert_todo($content_val,$todo_id)
    {   
        if (todo::where('code','=',$todo_id)->exists()) {
            try{

                $todo=new todo;
                $todo=$todo->where('code','=',$todo_id)->get();


                $todo_content=new todocontent(); 
                $todo_content->value=strval($content_val);
                $todo_content->finish=0;

                //manual
                // $todo_content->todo_id=$todo->pluck('id')->toArray()[0];
                // $todo_content->save();
 
                //option 1
                $todo_content->todo()->associate($todo->pluck('id')->toArray()[0]);
                $todo_content->save();
                //option 2
                // $todo->mytodo()->save($todo_content);
                $get_info=todocontent::where('todo_id','=',$todo->pluck('id')->toArray()[0])
                                      ->orderBy('id', 'desc')
                                      ->first();
                //code need update what if 2 user update simust
                return array('code'=>201,'output'=>array('status'=>true,'task'=>array('id'=>$get_info['id'] ,'value'=>$get_info['value'],'finish'=>$get_info['finish'])));
            }
            catch(\Exception $e){
                echo $e;
               return array('code'=>500,'output'=>array('status'=>false,'message'=>'fail in server'));   // insert query
            }
        }else
        {   
            return array('code'=>406,'output'=>array('status'=>false,'message'=>'id not found')); 
        }
    }

    //Hide Unhide task 
    public function hide_show($task_id,$status,$todo_code)
    {

            if (todo::where('code','=',$todo_code)->exists()) {
                
                // https://laravel.io/forum/09-28-2014-findid-and-whereidid
                // echo todocontent::whereId(1);
                if(todocontent::find($task_id)->exists())
                {   
                    try{
                        $x=todocontent::find($task_id);
                        $x->finish=$status;
                        $x->save();
                        return array('code'=>201,'output'=>array('status'=>true,'message'=>'updated task'));
                    }
                    catch(\Exception $e){
                        // echo $e;
                       return array('code'=>500,'output'=>array('status'=>false,'message'=>'fail in server'));   // insert query
                    }
                }
                else
                {
                    return array('code'=>406,'output'=>array('status'=>false,'message'=>'task id not found'));
                }
    
            
            }else
            {   
                return array('code'=>406,'output'=>array('status'=>false,'message'=>'id not found')); 
            }
    }


    //update task name
    public function update_todo($task,$todo_id,$content_id)
    {
        if (todo::where('code','=',$todo_id)->exists()) {
            
            if(todocontent::whereId($content_id)->exists())
            {   
                try{
                    $x=todocontent::find($content_id);
                    $x->value=$task;
                    $x->save();
                    return array('code'=>201,'output'=>array('status'=>true,'message'=>'updated task'));
                }
                catch(\Exception $e){
                    // echo $e;
                   return array('code'=>500,'output'=>array('status'=>false,'message'=>'fail in server'));   // insert query
                }
            }
            else
            {
                return array('code'=>406,'output'=>array('status'=>false,'message'=>'task id not found'));
            }

        
        }else
        {   
            return array('code'=>406,'output'=>array('status'=>false,'message'=>'id not found')); 
        }
    }

    //removing task
    public function delete_todo($todo_id,$content_id)
    {
    
        if (todo::where('code','=',$todo_id)->exists()) {
            
            if(todocontent::whereId($content_id)->exists())
            {   
                try{
                    $x=todocontent::whereId($content_id);
                    $x->delete();
                    // echo $x;
                    return array('code'=>201,'output'=>array('status'=>true,'message'=>'todo content delete'));
                }
                catch(\Exception $e){
                    // echo $e;
                   return array('code'=>500,'output'=>array('status'=>false,'message'=>'fail in server'));   // insert query
                }
            }
            else
            {
                return array('code'=>406,'output'=>array('status'=>false,'message'=>'content id not found'));
            }

        
        }else
        {   
            return array('code'=>406,'output'=>array('status'=>false,'message'=>'id not found')); 
        }
    }

}
