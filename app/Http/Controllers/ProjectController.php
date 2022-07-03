<?php

namespace App\Http\Controllers;

use App\Helpers\LogActivity;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    // index
    public function index()
    {
        if(Gate::allows('isAdmin')){
            // $company = InformationForm::all();
            $orang = User::all();
            return view('project.project_form', compact('orang'));
        } else {
            Toastr::error('ADMIN ONLY');
            return redirect()->back();
        }
    }

    // saving data
    public function saveRecord(Request $request)
    {
        if(Gate::allows('isAdmin')){
            $request->validate([
                'projectname' => 'required|string|max:255',
                'status' => 'required',
                'duedate' => 'required',
            ]);

            $project = new Project;
            $project->projectname = $request->projectname;
            $project->status = $request->status;      
            $project->duedate = $request->duedate;
            $project->save();

            // $project = Project::create([
            //     'projectname' => $request->projectname,
            //     'duedate' => $request->duedate,
            //     'project_type' => $request->project_type,
            //     'status'        => $request->status,
            //     'website_url'   => $request->website_url,
            //     'staging_url'   => $request->staging_url,
            //     'duedate'       => $request->duedate,
            // ]);

                // $project->user()->attach($request->user);
                // $project->user()->attach($request->client);

            // dd($project);

            LogActivity::addToLog('add topic '.$request->projectname);

            Toastr::success('Data Inserted','Success');
            // return redirect()->route('admin/project/show');
            return redirect()->back();
        } else {
            Toastr::error('ADMIN ONLY');
            return redirect()->back();
        }
    }

    // show table
    public function show()
    {
        if(Gate::allows('isAdmin')){
            $data = Project::latest()->get();
            $orang = User::all();
            return view('project.project_detail', compact('data', 'orang'));
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
            $data = Project::findorfail($id);
            // $company = InformationForm::latest()->get();
            $orang = User::all();
            return view('project.project_edit', compact('data', 'orang'));
        } else {
            Toastr::error('ADMIN ONLY');
            return redirect()->back();
        }
    }

    // view Each Project
    public function viewEach($id)
    {
        if(Gate::allows('isAdmin')){
            $orang = User::all();
            $questions = DB::table('questions')
                        ->where('project_id', $id)
                        ->leftJoin('projects', 'projects.id', '=', 'questions.project_id')
                        ->get(); 
            $videos = DB::table('projects')
                        ->leftJoin('videos', 'videos.project_id', '=', 'projects.id')
                        // ->leftJoin('questions', 'projects.id', '=', 'questions.project_id')
                        ->where('videos.project_id', $id)
                        ->get(); 
            // dd($questions);

            $id = Auth::user()->id;
            // $user = DB::table('users')->get();
            // $data = Video::latest()->get();
            $project = Project::latest()->get();        
            return view('project.each_project', compact('videos','questions','orang', 'project'));
        } else {
            Toastr::error('ADMIN ONLY');
            return redirect()->back();
        }
    }

    // update data
    public function update(Request $request)
    {
        if(Gate::allows('isAdmin')){
            $id = $request->id;
            $projectname = $request->projectname;
            $duedate = $request->duedate;
            $status = $request->status;
            // $user = $request->user;

            $data = Project::findorfail($id);

            $update = [
                // 'id' => $id,
                'status'      => $status,
                'projectname' => $projectname,
                'duedate'     => $duedate,
            ];
            // $data->user()->sync($request->client);
            // $data->user()->attach($request->user);

            // dd($update);
            $data->update($update);

            LogActivity::addToLog('update topic '.$projectname);

            Toastr::success('Data Updated','Success');
            return redirect()->back();
        } else {
            Toastr::error('ADMIN ONLY');
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        if(Gate::allows('isAdmin')){
            LogActivity::addToLog('delete topic '.Project::find($id)->pluck('projectname'));
            
            $delete = Project::find($id);
            $delete->delete();

            Toastr::success('Data Deleted','Success');
            return redirect()->back();
        } else {
            Toastr::error('ADMIN ONLY');
            return redirect()->back();
        }
    }

    // show table
    public function searchProject(Request $request)
    {
        if(Gate::allows('isAdmin')){
            // $data = Project::latest()->get();
            $orang      = User::all();
            $project    = Project::latest()->get();

            $data       = DB::table('projects')
                            ->join('project_user', 'project_user.project_id', '=', 'projects.id')
                            ->join('users', 'users.id', '=', 'project_user.user_id')
                            ->select('projects.*', 'project_user.project_id', 'project_user.user_id', 'users.email','users.name','users.role_name','users.phone','users.password')
                            ->get();

            // dd($data);

            $user       = $request->user_id;
            $status     = $request->status;
            $from       = $request->from;
            $to         = $request->to;

            // Jika tidak memilih All assignee
            if ($user != null) {
                $data = $data->where('user_id', $user);
            }

            // Jika tidak memilih All Assignee & All Status
            if ($status != null) {
                if ($user != null) {
                    $data = $data->where('user_id', $user)->where('status',$status);
                } else {
                    $data = $data->where('status', $status);
                }
            }

            // Jika tidak memilih All Assignee, All Status, & All from
            if ($from != null) {
                if ($status != null) {
                    if ($user != null) {
                        $data = $data->where('user_id', $user)
                            ->where('status',$status)
                            ->whereBetween('duedate', [$from, Carbon::now()->toDateString()]);
                    } else {
                        $data = $data->where('status',$status)->whereBetween('duedate', [$from, Carbon::now()->toDateString()]);
                    }
                } else {
                    $data = $data->whereBetween('duedate', [$from, Carbon::now()->toDateString()]);
                }
            }

            

            // Jika tidak memilih All Assignee, All Status, All From & All to
            if ($to != null) {
                if ($from != null) {
                    if ($status != null) {
                        if ($user != null) {
                            $data = $data->where('user_id', $user)
                                ->where('status',$status)
                                ->whereBetween('duedate', [$from, $to]);
                        } else {
                            $data = $data->where('status',$status)->whereBetween('duedate', [$from, $to]);
                        }
                    } else {
                        $data = $data->whereBetween('duedate', [$from, $to]);
                    }
                } else {
                        $data = $data->whereDate('duedate', '<=', $to);
                }
            } 

            // dd($data);
            
            if ($user == null && $status == null && $from == null && $to == null) {
                return redirect()->route('admin/project/show');
            }

            // return view('task.task_detail_admin', compact('data', 'user', 'project'));

            return view('project.project_detail_search', compact('data', 'orang', 'project'));
        } else {
            Toastr::error('ADMIN ONLY');
            return redirect()->back();
        }
    }

    // search Each Project
    public function searchEachProject(Request $request)
    {
        if(Gate::allows('isAdmin')){
            $orang = User::all();
            $data = Project::findorfail($request->project);
            $task   = $data->task;

            $user       = $request->user_id;
            $status     = $request->status;
            $from       = $request->from;
            $to         = $request->to;

            // Jika tidak memilih All assignee
            if ($user != null) {
                $query = Task::latest()->where('user_id', $user)->where('project_id', $data->id)->get();
            }
            // dd($query);

            // Jika tidak memilih All Assignee & All Status
            if ($status != null) {
                if ($user != null) {
                    $query = Task::latest()->where('user_id', $user)->where('status',$status)->where('project_id', $data->id)->get();
                } else {
                    $query = Task::latest()->where('status', $status)->where('project_id', $data->id)->get();
                }
            }

            // Jika tidak memilih All Assignee, All Status, & All from
            if ($from != null) {
                if ($status != null) {
                    if ($user != null) {
                        $query = Task::latest()->where('user_id', $user)
                            ->where('status',$status)
                            ->whereBetween('duedate', [$from, Carbon::now()->toDateString()])
                            ->where('project_id', $data->id)
                            ->get();
                    } else {
                        $query = Task::latest()->where('status',$status)
                            ->whereBetween('duedate', [$from, Carbon::now()->toDateString()])
                            ->where('project_id', $data->id)
                            ->get();
                    }
                } else {
                    $query = Task::latest()->whereBetween('duedate', [$from, Carbon::now()->toDateString()])
                        ->where('project_id', $data->id)
                        ->get();
                }
            }

            // Jika tidak memilih All Assignee, All Status, All From & All to
            if ($to != null) {
                if ($from != null) {
                    if ($status != null) {
                        if ($user != null) {
                            $query = Task::latest()->where('user_id', $user)
                                ->where('status',$status)
                                ->whereBetween('duedate', [$from, $to])
                                ->where('project_id', $data->id)
                                ->get();
                        } else {
                            $query = Task::latest()->where('status',$status)
                                ->whereBetween('duedate', [$from, $to])
                                ->where('project_id', $data->id)
                                ->get();
                        }
                    } else {
                        $query = Task::latest()->whereBetween('duedate', [$from, $to])->where('project_id', $data->id)->get();
                    }
                } else {
                        $query = Task::latest()->whereDate('duedate', '<=', $to)->where('project_id', $data->id)->get();
                }
            } 
            
            if ($user == null && $status == null && $from == null && $to == null) {
                return redirect('admin/project/view/'.$request->project);
            }

            return view('project.each_project_search', compact('data','orang', 'query'));

        } else {
            Toastr::error('ADMIN ONLY');
            return redirect()->back();
        }
    }
}
