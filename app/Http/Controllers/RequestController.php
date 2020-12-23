<?php

namespace App\Http\Controllers;

use App\Events\employeenotifications;
use App\Http\Middleware\employee;
use App\Models\Department;
use App\Models\EmployeeRequest;
use App\User;
use Illuminate\Http\Request;
use App\Events\adminnotifications;
use App\Events\headnotifications;

class RequestController extends Controller
{
    //
    public function index($department_id = null)
    {

        if($department_id == null) {
            $requests = EmployeeRequest::all();
        }
        else
        {
            $department = Department::find($department_id);

            $department_employees = $department->employees()->select('id')->get();

            $requests = EmployeeRequest::whereIn('employee_id',$department_employees)->get();
        }

        return view('employees.requests',compact('requests'));
    }

    public function check_in(Request $request, $employee_id)
    {

        date_default_timezone_set("Africa/Cairo");


        EmployeeRequest::create([

            'check_in' => now(),
            'status' => 'pending',
            'employee_id' => auth()->user()->id
        ]);

        return redirect('dashboard/requests')->withStatus('employees successfully checked in');

    }

    public function check_out(Request $request , $request_id)
    {

        date_default_timezone_set("Africa/Cairo");

        $employee_request = EmployeeRequest::find($request_id);

        $employee_request->update([
            'check_out' => now(),
            'status' => 'approved'
        ]);

    }

    public function request_status(Request $request , $request_id)
    {

        $request = EmployeeRequest::find($request_id);

        if($request)
        {
            $request->update([
                'status' => $request->status
            ]);
            return redirect('dashboard/employees')->withStatus('request status successfully updated');
        }
    }

}
