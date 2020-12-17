<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeRequest extends Model
{
    //

    protected $table = 'requests';

    protected $fillable = [
        'employee_id','check_in','check_out','status','reason'
    ];

    public function employee()
    {
        return $this->belongsTo('App\User','employee_id');
    }
}
