<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($department_id = null)
    {

        if($department_id == null) {
            $employees = User::where('type', 2)->orderBy('id', 'desc')->get();
        }
        else
        {
            $employees = User::where('type', 2)->where('dept_id',$department_id)->orderBy('id', 'desc')->get();
        }

        return view('employees.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'name' => ['required','min:2','max:60','not_regex:/([%\$#\*<>]+)/'],
            'email' => ['required', 'email', Rule::unique((new User)->getTable()), 'regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,3}$/'],
            'password' => ['required', 'min:8', 'confirmed','regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$@#%]).*$/'],
            'password_confirmation' => ['required', 'min:8'],
            'department_id' => 'required|integer|min:0',
        ];

        $this->validate($request,$rules);

        $employee = User::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'department_id' => $request->department_id
        ]);

        if($employee)
        {
            return redirect('admin/employees')->withStatus('employees successfully created');
        }
        else
        {
            return redirect('admin/employees')->withStatus('something went wrong, try again');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $employee = User::find($id);

        if($employee)
        {
            return view('employees.create', compact('employee'));
        }
        else
        {
            return redirect('admin/employees')->withStatus('no employees have this id');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $employee = User::find($id);

        if($request->input('password') == null )
        {
            $rules = [
                'name' => ['required','min:2','max:60','not_regex:/([%\$#\*<>]+)/'],
                'email' => ['required', 'email', Rule::unique((new User)->getTable())->ignore($employee->id), 'regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,3}$/'],
                'department_id' => 'required|integer|min:0',
            ];

            $this->validate($request,$rules);


            if($employee)
            {

                $employee->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'department_id' => $request->department_id
                ]);

                return redirect('/admin/employees')->withStatus('employees information successfully updated.');
            }
            else
            {
                return redirect('admin/employees')->withStatus('no admin with this id');
            }
        }
        else {
            $rules = [
                'name' => ['required','min:2','max:60','not_regex:/([%\$#\*<>]+)/'],
                'email' => ['required', 'email', Rule::unique((new User)->getTable())->ignore($employee->id), 'regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,3}$/'],
                'password' => ['required', 'min:8', 'confirmed', 'different:old_password', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$@#%]).*$/'],
                'password_confirmation' => ['required', 'min:8'],
                'department_id' => 'required|integer|min:0',
            ];

            $this->validate($request,$rules);


            $password = password_hash($request->password,PASSWORD_DEFAULT);


            if($employee)
            {

                $employee->update([

                    'name' => $request->name ,
                    'email' => $request->email ,
                    'password' => $password,
                    'department_id' => $request->department_id

                ]);
                return redirect('/admin/employees')->withStatus('employees information successfully updated.');
            }
            else
            {
                return redirect('admin/employees')->withStatus('no employees with this id');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $employee = User::find($id);

        if($employee)
        {
            $employee->delete();
            return redirect('/admin/employees')->withStatus(__('employees successfully deleted.'));
        }
        return redirect('/admin/employees')->withStatus(__('this id is not in our database'));
    }
}
