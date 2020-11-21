<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $departments = Department::orderBy('id', 'desc')->get();

        return view('departments.index',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('departments.create');
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
        ];

        $this->validate($request,$rules);

        $department = Department::create([
            'name' => $request->name,
        ]);

        if($department)
        {
            return redirect('admin/departments')->withStatus('department successfully created');
        }
        else
        {
            return redirect('admin/departments')->withStatus('something went wrong, try again');
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
        $department = Department::find($id);

        if($department)
        {
            return view('departments.create', compact('department'));
        }
        else
        {
            return redirect('admin/departments')->withStatus('no department have this id');
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

        $rules = [
            'name' => ['required','min:2','max:60','not_regex:/([%\$#\*<>]+)/'],
        ];


        $this->validate($request, $rules);

        $department = Department::find($id);

        if($department) {

            $department->update([
                'name' => $request->name,
            ]);

            return redirect('/admin/departments')->withStatus('department successfully updated');
        }
        else
        {
            return redirect('/admin/departments')->withStatus('no department have this id');
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
        $department = Department::find($id);

        if($department)
        {
            $department->delete();
            return redirect('/admin/departments')->withStatus(__('department successfully deleted.'));
        }
        return redirect('/admin/departments')->withStatus(__('this id is not in our database'));
    }
}
