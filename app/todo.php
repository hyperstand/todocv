<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class todo extends Model
{   
    protected $table = 'todo';
    protected $fillable = [];
    public function content()
    {
       return $this->hasMany(todocontent::class);
    }
    //$todo->content()->save($todo_content)

    public function create($name,$code)
    {
        $model=new todo();
        $model->name=$name;
        $model->code=$code;
        $model->hide=0;
        return $model->save();
    }

    public function modify($code,$params)
    {

    }

 
}
