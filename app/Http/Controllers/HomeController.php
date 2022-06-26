<?php

namespace App\Http\Controllers;

use App\Helpers\LogActivity;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Models\UserLogTable;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

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
        if (Gate::allows('isAdmin')) {       
            // $user = Auth::user();
            $user = User::latest()->get();
            $jumlahUser = $user->count();
            $id = Auth::user();

            // $project = Project::find(Auth::user()->id);
            $project = Project::latest()->get();
            $jumlahProject = DB::table('projects')->where('status', '!=', 'Not Active')->count();

            // videos
            $videos = DB::table('videos')->leftJoin('projects', 'projects.id', '=', 'project_id')->get();
            $jumlahVideo     = $videos->count();
            $showVideos = DB::table('videos')->orderby('videos.created_at', 'desc')->leftJoin('projects', 'projects.id', '=', 'project_id')->take(4)->get();

            $time = [];
            foreach ($videos as $key => $value) {
                array_push($time, $value->duration);
            }
             
            $sum = strtotime('00:00:00');
            $totaltime = 0;
             
            foreach( $time as $element ) {
                // Converting the time into seconds
                $timeinsec = strtotime($element) - $sum;
                // Sum the time with previous value
                $totaltime = $totaltime + $timeinsec;
            }
            // Hours is obtained by dividing
            // totaltime with 3600
            $h = intval($totaltime / 3600);
            $totaltime = $totaltime - ($h * 3600);
             
            // Minutes is obtained by dividing
            // remaining total time with 60
            $m = intval($totaltime / 60);
            // Remaining value is seconds
            $s = $totaltime - ($m * 60);
             
            // dd($h, $m, $s);

            $log = UserLogTable::latest()->where('subject', '!=', 'logout success')->get();
            // dd($log);

            // questions
            $questions = DB::table('questions')->leftJoin('projects', 'projects.id', '=', 'project_id')->get();
            $jumlahQuestion     = $questions->count();

            $task =Task::latest()->get();
            $jumlahTask = DB::table('tasks')->where('status', 'In Progress')->count();
            $jumlahMyTask = DB::table('tasks')->where('user_id', $id->id)->count();

            $projectuser = DB::table('project_user')->get();

            LogActivity::addToLog('show home');
            return view('home', compact(
                'user', 'task','id', 'videos', 'showVideos', 'questions',
                'project', 'projectuser', 'jumlahUser', 'jumlahQuestion',
                'jumlahProject', 'jumlahVideo', 'jumlahMyTask', 'h', 'm', 's', 'log'
            ));
        } else {
            if (Gate::allows('isClient')) {
                return redirect()->route('client');
            } else {
                return redirect()->route('member');
            }
        }
    }
}
