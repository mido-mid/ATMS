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
    public function index($employee_id = null)
    {

        if ($employee_id != null )
        {

            $employee = User::find($employee_id);

            $requests = $employee->requests;

            return view('employees.requests',compact('requests','employee'));

        }
        else
        {
            $requests = EmployeeRequest::all();

            $employee = auth()->user();

            return view('employees.requests',compact('requests','employee'));
        }

    }

    public function check_in(Request $request, $employee_id)
    {

        date_default_timezone_set("Africa/Cairo");


        EmployeeRequest::create([

            'check_in' => now(),
            'status' => 'pending',
            'employee_id' => auth()->user()->id
        ]);

        return redirect('dashboard/requests/'.auth()->user()->id)->withStatus('employees successfully checked in');

    }

    public function check_out(Request $request , $request_id)
    {

        date_default_timezone_set("Africa/Cairo");

        $employee_request = EmployeeRequest::find($request_id);

        $employee_request->update([
            'check_out' => now(),
            'status' => 'approved'
        ]);

        return redirect('dashboard/requests/'.auth()->user()->id)->withStatus('employees successfully checked out');

    }


}
