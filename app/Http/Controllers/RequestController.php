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

        return view('requests.index',compact('requests'));
    }

    public function check_in(Request $request, $employee_id)
    {

        date_default_timezone_set("Africa/Cairo");

        $employee_department = User::where('id',$request->employee_id)->first()->department;

        $start_time = $employee_department->start_time;

        if(strtotime($start_time) >= now() )
        {

            EmployeeRequest::create([

                'check_in' => now(),
                'status' => 'pending',
                'employee_id' => $employee_id
            ]);

            return redirect('admin/employees')->withStatus('employee successfully checked in');
        }
        else
        {
            return redirect('admin/employees')->withStatus('something went wrong, try again');
        }
    }

    public function check_out(Request $request , $request_id)
    {

        date_default_timezone_set("Africa/Cairo");

        $employee_request = EmployeeRequest::find($request_id);

        $employee_department = User::where('id',$employee_request->employee_id)->first()->department;

        $end_time = $employee_department->end_time;


        if($request && strtotime($end_time) <= now())
        {
            $employee_request->update([
                'check_out' => now(),
                'status' => 'approved'
            ]);

            $data = [

                'request_id' => $request_id,
                'employee_department' => $employee_department->id,
                'employee_name' => $employee_request->user->name,
                'checkout_time' => $employee_request->check_out,
                'status' => $employee_request->status,
            ];


            event(new adminnotifications($data));

            event(new headnotifications($data));

            event(new employeenotifications($data));

            return redirect('admin/employees')->withStatus('employee successfully checked out');
        }
        else
        {

            $employee_request->update([
                'check_out' => now(),
                'status' => 'pending',
                'reason' => $request->reason
            ]);

            $data = [

                'request_id' => $request_id,
                'employee_department' => $employee_department->id,
                'employee_name' => $employee_request->user->name,
                'checkout_time' => $employee_request->check_out,
                'status' => $employee_request->status,
            ];


            event(new adminnotifications($data));

            event(new headnotifications($data));

            event(new employeenotifications($data));


            return redirect('admin/employees')->withStatus('something went wrong, try again');
        }
    }

    public function request_status(Request $request , $request_id)
    {

        $request = EmployeeRequest::find($request_id);

        if($request)
        {
            $request->update([
                'status' => $request->status
            ]);
            return redirect('admin/employees')->withStatus('request status successfully updated');
        }
    }

}
