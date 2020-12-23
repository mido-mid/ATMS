<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $questions = Question::orderBy('id', 'desc')->get();

        return view('questions.index',compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('questions.create');

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
            'description' => ['required','min:2','max:60','not_regex:/([%\$#\*<>]+)/'],
            'status' => ['required','string'],
        ];

        $this->validate($request,$rules);

        $question = Question::create([

            'description' => $request->description,
            'status' => $request->status,
        ]);

        if($question)
        {
            return redirect('dashboard/questions')->withStatus('question successfully created');
        }
        else
        {
            return redirect('dashboard/questions')->withStatus('something went wrong, try again');
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
        $question = Question::find($id);

        if($question)
        {
            return view('questions.create', compact('question'));
        }
        else
        {
            return redirect('dashboard/questions')->withStatus('no question have this id');
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
        $rules = [
            'description' => ['required','min:2','max:60','not_regex:/([%\$#\*<>]+)/'],
        ];

        $this->validate($request,$rules);

        $question = Question::find($id);

        if($question) {

            $question->update([
                'description' => $request->description,
            ]);

            return redirect('/dashboard/questions')->withStatus('question successfully updated');
        }
        else
        {
            return redirect('/dashboard/questions')->withStatus('no question have this id');
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

        $question = Question::find($id);

        if($question)
        {
            $question->delete();
            return redirect('/dashboard/questions')->withStatus(__('question successfully deleted.'));
        }
        return redirect('/dashboard/questions')->withStatus(__('this id is not in our database'));
    }

    public function status(Request $request,$question_id)
    {

        $question = Question::find($question_id);


        if($question) {

            if ($question->status == 'active') {

                $question->update(['status' => 'inactive']);
            } else {
                $question->update(['status' => 'active']);
            }
            return redirect()->back()->withStatus(__('question status successfully updated.'));
        }
        return redirect()->back()->withStatus(__('this id is not in our database'));
    }
}
