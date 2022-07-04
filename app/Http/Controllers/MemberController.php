<?php

namespace App\Http\Controllers;

use App\Helpers\LogActivity;
use App\Models\Project;
use App\Models\Question;
use App\Models\Result;
use App\Models\Task;
use App\Models\User;
use App\Models\Video;
use App\Rules\MatchOldPassword;
use Brian2694\Toastr\Facades\Toastr;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function index(){
        if (Gate::denies('isClient')) {                        
            $id             = Auth::user();
            $user           = User::latest()->get();
            $dt             = Carbon::now();
            // $todayDate      = $dt->toDayDateTimeString();
            $date           = date('D, d M Y');
            $weekStartDate  = $dt->startOfWeek()->format('D, d M');
            $weekEndDate    = $dt->endOfWeek()->format('D, d M Y');
            $project        = Project::latest()->get();
            $task           = Task::latest()->get();
            $videos         = Video::latest()->get();
            $results        = Result::where('user_id', auth()->user()->id)->latest('results.created_at')
                ->leftJoin('projects', 'projects.id','=', 'project_id')
                ->get();
                // dd($results);
            $showVideos     = DB::table('videos')->orderby('videos.created_at', 'desc')->leftJoin('projects', 'projects.id', '=', 'project_id')->take(4)->get();
            // $task = DB::table('tasks')->where('user_id', Auth::user()->id);
            // $taskhour       = DB::table('tasks')->where('user_id', Auth::user()->id)->sum('work_time');
            $weekTaskMinutes = DB::table('tasks')
                ->where('user_id', Auth::user()->id)
                ->where(function ($query) {
                    //    $query->whereDate('created_at', '<=', Carbon::now()->endOfWeek());
                    $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                    })
                ->get();
            
            $hour = 0;
            $minute = 0;
            foreach ($weekTaskMinutes as $work_time) {
                $waktu = $work_time->work_time;
                $parsed = date_parse($waktu);
                $hour = $hour+$parsed['hour'];
                $minute = $minute+$parsed['minute'];
            }


            // $cobaweeklytask = Task::whereBetween('created_at', [$dt->startOfWeek(), $dt->endOfWeek()])->sum('work_time');
            
            // $weeklyMinutes   = $weekTaskMinutes % 60;
            // $weeklyHours     = ($weekTaskMinutes-$weeklyMinutes)/60;
            
            // $start = Carbon::now()->startOfWeek();
            // $end = Carbon::now()->endOfWeek();

            $jumlahTask     = DB::table('tasks')->where('status', 'In Progress')->where('user_id','$id->id')->count();
            $jumlahProject  = DB::table('projects')->where('status','!=','Not Active')->get();
            $jumlahQuiz     = DB::table('results')->where('user_id', auth()->user()->id)->get();
                
            return view('member.home', compact(
                'id', 'date','project', 'videos', 'results',
                'user', 'task', 'weekTaskMinutes',
                'weekStartDate', 'weekEndDate', 
                'minute', 'hour', 'showVideos',
                'jumlahTask', 'jumlahProject', 'jumlahQuiz'
            ));
        } else {
            Toastr::error('Not for Client','MEMBER PAGE');
            return redirect()->back();
        }
    }

    public function showTask()
    {
        if (Gate::denies('isClient')) {
            $id = Auth::user()->id;
            $user = Auth::user();
            // $task = DB::table('tasks')->where('users_id', $id);
            $task = Task::latest()->get();
            $project = Project::latest()->get();
            return view('member.tasks.showTask', compact('user', 'task', 'project'));
        } else {
            Toastr::error('Not for Client','MEMBER PAGE');
            return redirect()->back();
        }
    }

    public function newTask()
    {
        if (Gate::denies('isClient')) {
            $user = Auth::user();
            $id = Auth::user()->id;
            $task = Task::latest()->get();
            $project = Project::latest()->get();
            return view('member.tasks.newTask', compact('task', 'user', 'project'));
        } else {
            Toastr::error('Not for Client','MEMBER PAGE');
            return redirect()->back();
        }
    }

    public function saveTask(Request $request)
    {
        if (Gate::denies('isClient')) {
            $request->validate([
                'name'   => 'required|string|max:255',
                'status' => 'required|string|max:255',
                'work_time' => 'required',
                'project_id' =>'required',
                'duedate'   => 'required',
                'user_id' =>'required',
            ]);

            $task = new Task;
            $task->name         = $request->name;
            $task->status       = $request->status;
            $task->notes        = $request->notes;
            $task->duedate      = $request->duedate;
            $task->work_time    = $request->work_time;
            $task->project_id   = $request->project_id;
            $task->user_id      = $request->user_id;

            $task->save();

            Toastr::success('Task Added', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Not for Client','MEMBER PAGE');
            return redirect()->back();
        }
    }

    public function viewTask($id)
    {
        if (Gate::denies('isClient')) {
            $task = Task::findorfail($id);
            $project = Project::latest()->get();
            return view('member.tasks.editTask', compact('task', 'project'));
        } else {
            Toastr::error('Not for Client','MEMBER PAGE');
            return redirect()->back();
        }
    }

    public function updateTask(Request $request)
    {
        if (Gate::denies('isClient')) {
            $id         = $request->id;
            $name       = $request->name;
            $status     = $request->status;
            $work_time  = $request->work_time;
            $project_id = $request->project_id;
            $notes      = $request->notes;
            $duedate    = $request->duedate;
            $user_id    = $request->user_id;

            $update = [
                'id'        => $id,
                'name'      => $name,
                'duedate'   => $duedate,
                'status'    => $status,
                'work_time' => $work_time,
                'project_id'=> $project_id,
                'notes'     => $notes,
                'user_id'   => $user_id,
            ];

            Task::where('id', $request->id)->update($update);

            // dd($update);
            Toastr::success('Task Updated', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Not for Client','MEMBER PAGE');
            return redirect()->back();
        }
    }

    public function deleteTask($id)
    {
        if (Gate::denies('isClient')) {
            $delete = Task::findorfail($id);
            $delete->delete();

            Toastr::success('Task deleted', 'Success');
            return redirect()->route('member/task');
        } else {
            Toastr::error('Not for Client','MEMBER PAGE');
            return redirect()->back();
        }
    }

    public function showProject()
    {
        if (Gate::denies('isClient')) {
            $user = Auth::user();
            $project = Project::where('status', '!=', 'Not Active')->orderBy('status', 'desc')->orderBy('id', 'desc')->get();
            $video = Video::latest()->get();
            // dd($project);
            return view('member.projects.showProject', compact('project', 'user', 'video'));
        } else {
            Toastr::error('Not for Client','MEMBER PAGE');
            return redirect()->back();
        }
    }
    
    public function viewProject($id)
    {
        $user = Auth::user();
        $project = Project::findorfail($id);
        $videos = Video::where('project_id', $id)->orderby('created_at', 'asc')->get();
        return view('member.projects.viewProject', compact('project', 'user', 'videos'));
    }

    public function showQuiz($id)
    {
        if (Gate::denies('isClient')) {      
            $quiz_id = $id;      
            $user = Auth::user();
            return view('member.quiz.quiz_landing_page', compact('user', 'quiz_id'));
        } else {
            Toastr::error('Not for Client','MEMBER PAGE');
            return redirect()->back();
        }
    }

    public function viewQuiz($id)
    {
        if (Gate::denies('isClient')) { 
            $quiz_id = $id;      
            $user = Auth::user();
            $project = Project::where('id', $id)->first();
            $questions = Question::where('project_id', $quiz_id)->get();
            // dd($questions);
            LogActivity::addToLog($user->name.'view quiz '.$id);
            return view('member.quiz.quiz_page', compact('user', 'quiz_id', 'questions', 'project'));
        } else {
            Toastr::error('Not for Client','MEMBER PAGE');
            return redirect()->back();
        }
    }

    // saving data
    public function submitQuiz(Request $request)
    {
        // dd($request);
        if (Gate::denies('isClient')) {
            // dd($request);
            $quizzes = Question::where('project_id', $request->quiz_id)->get();

            $trueAnswer = 0;
            $counter = 0;
            $answer = [];
            
            foreach ($quizzes as $key => $quiz) {
                $temp = 'opt-'.$quiz->id;

                // store the quiz answer
                $answer[$quiz->id] = $request->$temp;

                // store the number of true answer
                if ($request->$temp == $quiz->result) {
                    $trueAnswer += 1;
                }
                $counter += 1;
            }

            // calculate as percentage
            $score = ($trueAnswer/$counter)*100;
            // dd(json_encode($answer));

            $request->validate([
                'quiz_id'        => 'required|numeric'
            ]);
            

            $result = new Result();
            $result->user_id    = auth()->user()->id;
            $result->project_id = $request->quiz_id;
            $result->answer     = json_encode($answer);
            $result->score      = $score;

            $result->save();

            LogActivity::addToLog('finish quiz '.$request->quiz_id);

            Toastr::success('Quiz Submitted', 'Success');
            return redirect()->route('member');
            // return redirect()->back();
        } else {
            Toastr::error('ADMIN ONLY');
            return redirect()->back();
        }
    }

    public function showResult()
    {
        if (Gate::denies('isClient')) {            
            // $results = Result::where('user_id', auth()->user()->id)->get();
            $results = DB::table('results')->where('user_id', auth()->user()->id)
                ->leftJoin('projects', 'projects.id', '=', 'results.project_id')
                ->get();
            $projects = Project::all();
            return view('member.results.showResult', compact('results', 'projects'));
        } else {
            Toastr::error('Not for Client','MEMBER PAGE');
            return redirect()->back();
        }
    }

    public function showProfile()
    {
        if (Gate::denies('isClient')) {            
            $user = Auth::user();
            return view('member.profile.showProfile', compact('user'));
        } else {
            Toastr::error('Not for Client','MEMBER PAGE');
            return redirect()->back();
        }
    }

    public function viewProfile($id)
    {
        if (Gate::denies('isClient')) {
            $orang = DB::table('users')->where('id', $id)->get();
            return view('member.profile.viewProfile', compact('orang'));
        } else {
            Toastr::error('Not for Client','MEMBER PAGE');
            return redirect()->back();
        }
    }

    public function updateProfile(Request $request)
    {
        if (Gate::denies('isClient')) {
            $id             = $request->id;
            $name           = $request->name;
            $email          = $request->email;
            $phone          = $request->phone;
            $role_name      = $request->role_name;

            $update = [
                'id'        => $id,
                'name'      => $name,
                'email'     => $email,
                'phone'     => $phone,
                'role_name' => $role_name,
            ];

            User::where('id',$request->id)->update($update);

            LogActivity::addToLog('update profile '.$name);

            Toastr::success('Profile updated','Success');
            return redirect()->route('member/profile');
        } else {
            Toastr::error('Not for Client','MEMBER PAGE');
            return redirect()->back();
        }
    }

    // view change password
   public function changePassword($id)
   {
       if (Gate::denies('isClient')) {
            $orang = DB::table('users')->where('id', $id)->get();
            return view('member.profile.changePassword', compact('orang'));
        } else {
            Toastr::error('Not for Client','MEMBER PAGE');
            return redirect()->back();
        }
   }
   
   // change password in db
   public function updatePassword(Request $request)
   {
       $request->validate([
           'password' => ['required', new MatchOldPassword],
           'new_password' => ['required'],
           'new_confirm_password' => ['same:new_password'],
       ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        LogActivity::addToLog('update password');
        Toastr::success('Password Changed','Success');
        return redirect()->route('member/profile');

   }
}
