<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //


    protected $fillable = [
        'description','status'
    ];

    public function employee()
    {
        return $this->belongsTo('App\User','employee_id');
    }
}
