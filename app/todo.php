<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class todo extends Model
{   
    protected $table = 'todo';
    protected $fillable = [];
    protected $hidden = array('user_hide_id','created_at', 'updated_at');

    public function task()
    {
       return $this->hasMany(todocontent::class,'todo_id','id');
    }
    //$todo->content()->save($todo_content)


    //get Todo_Title info
    public function get_content($code)
    {
        
        try{   
            $model=new todo();
            if($model::where([['code','=',$code],['hide','=',0]])->count() > 0)
            {   
                
                //???
                // echo todo::->mytodo;
                // echo todo::whereHas('mytodo', function ($query) {                                         
                //     $query->find(1); //'color' is the column on the Color table where 'blue' is stored.
                // })->get();
                    
                
                
                //xample query
                // echo DB::table($this->table)->where('code','=',$code)->get();
                // echo DB::table($this->table)->statement('where code id = 1');
                // echo DB::table($this->table)->select(DB::raw())->raw('WHERE id ="1"')->get();
                // echo DB::select( DB::raw("SELECT * FROM $this->table WHERE id = 1") );

                $data=$model::with('task')->where('code','=',$code);
                // echo $data[0]['name'];
                // echo $data->get()[0];
                
                return array('code'=>200,'output'=>array('status'=>true,'data'=>$data->get())); 
            }else   
            {   
               $code=$model->first();
               return  array('code'=>500,'output'=>array('status'=>false,'code'=>$code['code']));
            }            
        }
        catch(\Exception $e){
            echo $e;
        return array('code'=>500,'output'=>array('status'=>false,'message'=>'fail in server'));   // insert query
        }
    }

    //create Todo_Title info
    public function create($name,$code)
    {
        try{   
            $model=new todo();
            $model->name=$name;
            $model->code=$code;
            $model->hide=0;
            $model->save();
            return array('code'=>201,'output'=>array('status'=>true,'message'=>'todo created','todo'=>array('name'=>$name,'code'=>$code)));
        }
        catch(\Exception $e){
            // echo $e;
        return array('code'=>500,'output'=>array('status'=>false,'message'=>'fail in server'));   // insert query
        }
    }

    //Modify Name Todo_Title 
    public function modify($todo_code,$name)
    {   
        if (todo::where('code','=',$todo_code)->exists()) {
 
            try{
                $model=todo::where('code','=',$todo_code);
                // $model->name=$name;
                // dd($model);
                $model->update(['name' => $name]);
            return array('code'=>201,'output'=>array('status'=>true,'message'=>'updated todo'));

            }
            catch(\Exception $e){
                echo $e;
            return array('code'=>500,'output'=>array('status'=>false,'message'=>'fail in server'));   // insert query
            }   
        }else
        {
            return array('code'=>500,'output'=>array('status'=>false,'message'=>'code not exist'));
        }
    }

    //Modify delete Todo_Title
    public function delete_content($todo_code)
    {   
        if (todo::where('code','=',$todo_code)->exists()) {

        try{    
        $model=todo::where('code','=',$todo_code);
        $model->delete();
            //cascade delete?
        return array('code'=>201,'output'=>array('status'=>true,'message'=>'todo delete'));

        }
        catch(\Exception $e){
            echo $e;
        return array('code'=>500,'output'=>array('status'=>false,'message'=>'fail in server'));   // insert query
        }

        }
        else{
            return array('code'=>500,'output'=>array('status'=>false,'message'=>'code not exist'));
        }
    }

    //https://stackoverflow.com/questions/32473870/how-to-update-a-record-in-laravel-eloquent

    //Hide Unhide Todo_Title
    public function hide_show($user_id,$todo_code,$type)
    {   

        if (todo::where('code','=',$todo_code)->exists()) {

        try{

        $model=todo::where('code','=',$todo_code)->first();
        $model->hide=$type;
        if($type == 0)
        {
            $model->user_hide_id=null;
            $stat='todo open';
        }else if($type == 1)
        {
            $model->user_hide_id=$user_id;
            $stat='todo hidden';
        }
        $model->save();
        return array('code'=>201,'output'=>array('status'=>true,'message'=>$stat));

            }
            catch(\Exception $e){
                echo $e;
            return array('code'=>500,'output'=>array('status'=>false,'message'=>'fail in server'));   // insert query
            }

        }else{
            return array('code'=>500,'output'=>array('status'=>false,'message'=>'code not exist'));
        }


    }

    //get Todo_Title code only for redirect
    public function get_first()
    {   
        $model=new todo();
        $result=todo::select('code')->where('hide','=',0)->first();
        return array('code'=>200,'output'=>array('status'=>true,'data'=>$result));
    }
 
}
