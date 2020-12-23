<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class HeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $heads = User::where('type',1)->orderBy('id', 'desc')->get();

        return view('heads.index',compact('heads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('heads.create');
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
            'department_id' => ['required', 'min:0' , 'integer'],
        ];

        $this->validate($request,$rules);

        $head = User::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'department_id' => $request->department_id,
            'type' => 1
        ]);

        if($head)
        {
            return redirect('dashboard/heads')->withStatus('heads successfully created');
        }
        else
        {
            return redirect('dashboard/heads')->withStatus('something went wrong, try again');
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
        $head = User::find($id);

        if($head)
        {
            return view('heads.create', compact('head'));
        }
        else
        {
            return redirect('dashboard/heads')->withStatus('no heads have this id');
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

        $head = User::find($id);

        if($request->input('password') == null )
        {
            $rules = [

                'name' => ['required','min:2','max:60','not_regex:/([%\$#\*<>]+)/'],
                'email' => ['required', 'email', Rule::unique((new User)->getTable())->ignore($head->id), 'regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,3}$/'],
                'department_id' => ['required','min:0','integer']
            ];

            $this->validate($request,$rules);


            if($head)
            {

                $head->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'department_id' => $request->department_id
                ]);

                return redirect('/dashboard/heads')->withStatus('head information successfully updated.');
            }
            else
            {
                return redirect('/dashboard/heads')->withStatus('no head with this id');
            }
        }
        else {
            $rules = [
                'name' => ['required','min:2','max:60','not_regex:/([%\$#\*<>]+)/'],
                'email' => ['required', 'email', Rule::unique((new User)->getTable())->ignore($head->id), 'regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,3}$/'],
                'password' => ['required', 'min:8', 'confirmed', 'different:old_password', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$@#%]).*$/'],
                'password_confirmation' => ['required', 'min:8'],
                'department_id' => ['required','min:0','integer']

            ];

            $this->validate($request,$rules);


            $password = password_hash($request->password,PASSWORD_DEFAULT);


            if($head)
            {
                $head->update([

                    'name' => $request->name ,
                    'email' => $request->email ,
                    'password' => $password,
                    'department_id' => $request->department_id
                ]);

                return redirect('/dashboard/heads')->withStatus('head information successfully updated.');
            }
            else
            {
                return redirect('/dashboard/heads')->withStatus('no heads with this id');
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
        $head = User::find($id);

        if($head)
        {
            $head->delete();
            return redirect('/dashboard/heads')->withStatus(__('head successfully deleted.'));
        }
        return redirect('/dashboard/heads')->withStatus(__('this id is not in our database'));
    }
}
