<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
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
            $jumlahUser = DB::table('users')->where('role_name', 'Team Member')->orWhere('role_name', 'Admin')->count();
            $id = Auth::user();

            // $project = Project::find(Auth::user()->id);
            $project = Project::latest()->get();
            $jumlahProject = DB::table('projects')->where('status', '!=', 'Not Active')->count();

            $task =Task::latest()->get();
            $jumlahTask = DB::table('tasks')->where('status', 'In Progress')->count();
            $jumlahMyTask = DB::table('tasks')->where('user_id', $id->id)->count();

            $projectuser = DB::table('project_user')->get();
            return view('home', compact(
                'user', 'task','id', 
                'project', 'projectuser', 'jumlahUser', 
                'jumlahProject', 'jumlahTask', 'jumlahMyTask'
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
