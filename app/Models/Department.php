<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //

    protected $fillable = [
        'name','start_time','end_time'
    ];

    public function employees()
    {
        return $this->hasMany('App\User');
    }
}
