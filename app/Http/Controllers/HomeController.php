<?php

namespace App\Http\Controllers;

use App\Http\Middleware\employee;
use App\Models\Department;
use App\Models\EmployeeRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if(auth()->user()->department != null) {
            $department = Department::find(auth()->user()->department->id);

            $department_employees = $department->employees()->select('id')->get();

            $available_dept_employees = EmployeeRequest::whereIn('employee_id', $department_employees)->where('created_at', '=', today())->where('check_out', null)->get();

            $dept_employees = User::where('type', '2')->where('department_id', auth()->user()->department_id)->get();
        }

        $today_requests = EmployeeRequest::where('created_at','=',today())->where('check_out',null)->get();

        $monthly_requests = auth()->user()->requests()->where('check_in','!=',null)->where('check_out','!=',null)->whereMonth('created_at','=',date('m'))->get();

        $absence_days = date('t') - $monthly_requests->count();


        if(auth()->user()->department != null) {

            return view('dashboard', compact('today_requests', 'dept_employees', 'available_dept_employees', 'absence_days','monthly_requests'));
        }
        else
        {
            return view('dashboard', compact('today_requests','absence_days'));
        }
    }
}
