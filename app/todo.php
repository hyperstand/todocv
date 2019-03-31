<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class todo extends Model
{   
    protected $table = 'todo';
    public function content()
    {
       return $this->hasMany(todocontent::class);
    }
}
