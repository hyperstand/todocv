<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class todocontent extends Model
{   
    protected $table = 'todocontent';
    public function todo()
    {
        return $this->belongsTo(todo::class);
    }
}
