<?php

namespace App\Http\Controllers;

use App\Helpers\LogActivity;
use App\Models\Option;
use App\Models\Project;
use App\Models\Question;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class QuizController extends Controller
{
    // saving data
    public function saveQuiz(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            $request->validate([
                'question'      => 'required|string|max:255',
                'project_id'    => 'required|numeric',
                'opt1'          => 'required|string|max:255',
                'opt2'          => 'required|string|max:255',
                'opt3'          => 'required|string|max:255',
                'opt4'          => 'required|string|max:255',
                'opt5'          => 'required|string|max:255',
                'result'        => 'required'
            ]);
            
            $collectOption = [];
            $collectOption = array(
                1 => $request->opt1,
                2 => $request->opt2,
                3 => $request->opt3,
                4 => $request->opt4,
                5 => $request->opt5,
            );
            $option = json_encode($collectOption);

            $question = new Question();
            $question->question     = $request->question;
            $question->project_id   = $request->project_id;
            $question->option       = $option;
            $question->result       = $request->result;

            $question->save();

            LogActivity::addToLog('add quiz from topic'.$request->project_id);

            Toastr::success('Data Added', 'Success');
            // return redirect()->route('admin/task/show');
            return redirect()->back();
        } else {
            Toastr::error('ADMIN ONLY');
            return redirect()->back();
        }
    }

    // show table
    public function show()
    {
        if (Gate::allows('isAdmin')) {
            $id = Auth::user()->id;
            $user = DB::table('users')->get();
            $data = Question::latest()->get();
            // dd($data);
            $project = Project::latest()->get();        
            return view('quiz.quiz_detail', compact('data', 'user', 'project'));
        } else {
            Toastr::error('ADMIN ONLY');
            return redirect()->back();
        }
    }

    // view edit
    public function viewEdit($id)
    {
        if(Gate::allows('isAdmin')){
            // $data = DB::table('projects')->where('id', $id)->get();
            $data = Question::findorfail($id);
            $projects = Project::latest()->get();
            $option = json_decode($data->option);
            $opt1 = ''; $opt2 = ''; $opt3 = ''; $opt4 = ''; $opt5 = '';
            foreach ($option as $key => $value) {
                if ($key == 1) {
                    $opt1 = $value;
                } elseif ($key == 2) {
                    $opt2 = $value;
                } elseif ($key == 3) {
                    $opt3 = $value;
                } elseif ($key == 4) {
                    $opt4 = $value;
                } elseif ($key == 5) {
                    $opt5 = $value;
                }
            }

            return view('quiz.quiz_edit', compact('data', 'projects', 'option', 'opt1', 'opt2', 'opt3', 'opt4', 'opt5'));
        } else {
            Toastr::error('ADMIN ONLY');
            return redirect()->back();
        }
    }

    // Update data
    public function update(Request $request)
    {
        if(Gate::allows('isAdmin')){
            
            $id         = $request->id;
            $question   = $request->question;
            $project_id = $request->project_id;
            $result      = $request->result;

            $collectOption = [];
            $collectOption = array(
                1 => $request->opt1,
                2 => $request->opt2,
                3 => $request->opt3,
                4 => $request->opt4,
                5 => $request->opt5,
            );
            $option = json_encode($collectOption);

            $updateQuestion = [
                'id'        => $id,
                'project_id'=> $project_id,
                'question'  => $question,
                'option'    => $option,
                'result'    => $result,
            ];

            Question::where('id', $request->id)->update($updateQuestion);

            LogActivity::addToLog('update quiz '.$id);

            // dd($update);
            Toastr::success('Quiz Updated','Success');
            // return redirect()->route('admin/task/show');   
            return redirect()->back();
        } else {
        Toastr::error('ADMIN ONLY');
        return redirect()->back();
        }
    }

    // delete data
    public function delete($id)
    {
        if(Gate::allows('isAdmin')){
            LogActivity::addToLog('delete quiz '.$id);
            $delete = Question::find($id);
            // $delete = DB::table('questions')
            //             ->leftJoin('options', 'questions.id', '=', 'options.question_id')
            //             ->get();
            $delete->delete();


            Toastr::success('Quiz deleted','Success');
            // return redirect()->route('admin/task/show');
            return redirect()->back();
        } else {
        Toastr::error('ADMIN ONLY');
        return redirect()->back();
        }
    }
}
