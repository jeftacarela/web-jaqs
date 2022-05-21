<?php

namespace App\Http\Controllers;

use App\Models\InformationForm;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    // index
    public function new()
    {
        $task = Task::latest()->get();
        $user = User::all();
        $project = Project::latest()->get();
        return view('task.task_form', compact('task','user', 'project'));
    }

    // saving data
    public function saveRecord(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            $request->validate([
                'name'      => 'required|string|max:255',
                'status'    => 'required|string|max:255',
                'work_time' => 'required|date_format:H:i',
                'duedate'   => 'required',
                'project_id'=> 'required|numeric',
                'user_id'   => 'required|numeric',
            ]);

            $task = new Task;
            $task->name         = $request->name;
            $task->status       = $request->status;
            $task->notes        = $request->notes;
            $task->duedate      = $request->duedate;
            $task->work_time    = $request->work_time;
            $task->billing      = $request->billing;
            $task->billed       = $request->billed;
            $task->project_id   = $request->project_id;
            $task->user_id      = $request->user_id;

            $task->save();

            // $task = Task::create([
            //     'name' => $request->name,
            //     'status' =>  $request->status,
            //     // 'notes' =>  $request->notes,
            //     'work_time' => $request->work_time,
            //     'billing' => $request->billing,
            //     'information_id' => $request->information_id,
            //     'project_id' => $request->project_id,
            //     'user_id' => Auth::id()
            // ]);

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
            $data = Task::latest()->get();
            $project = Project::latest()->get();        
            return view('task.task_detail', compact('data', 'user', 'project'));
        } else {
            Toastr::error('ADMIN ONLY');
            return redirect()->back();
        }
    }

    public function myTask()
    {
        if(Gate::allows('isAdmin')){
            $id = Auth::user()->id;
            $user = Auth::user();
            // $data = DB::table('tasks')->where('user_id', $id)->get();
            $data = Task::latest()->get();
            $project = Project::latest()->get();
            return view('task.task_detail_admin', compact('data', 'user', 'project'));
        } else {
            Toastr::error('ADMIN ONLY');
            return redirect()->back();
        }
    }

    // view edit
    public function viewEdit($id)
    {
        if(Gate::allows('isAdmin')){
            // $data = DB::table('tasks')->where('id',$id)->get();
            $task = Task::find($id);
            // $user = Task::all();
            $user = Auth::user();
            $project = Project::latest()->get();
            return view('task.task_edit', compact('task', 'user', 'project'));
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
            $name       = $request->name;
            $status     = $request->status;
            $notes      = $request->notes;
            // $duedate    = Carbon::parse($request->input('duedate'))->format('D, M y');
            $duedate    = $request->duedate;
            $work_time  = $request->work_time;
            $billing    = $request->billing;
            $billed     = $request->billed;
            $project_id = $request->project_id;
            $user_id    = $request->user_id;

            $update = [
                'id'        => $id,
                'name'      => $name,
                'status'    => $status,
                'notes'     => $notes,
                'duedate'   => $duedate,
                'work_time' => $work_time,
                'billing'   => $billing,
                'billed'    => $billed,
                'project_id'=> $project_id,
                'user_id'   => $user_id,
            ];

            Task::where('id', $request->id)->update($update);

            // dd($update);
            Toastr::success('Data Updated','Success');
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
            $delete = Task::find($id);
            $delete->delete();

            Toastr::success('Data deleted','Success');
            // return redirect()->route('admin/task/show');
            return redirect()->back();
        } else {
        Toastr::error('ADMIN ONLY');
        return redirect()->back();
        }
    }

    // search for Team Task
    public function teamTask(Request $request)
    {
        if (Gate::allows('isAdmin')) {

            $id         = Auth::user()->id;
            $user       = DB::table('users')->get();
            $project    = Project::latest()->get();

            $orang      = $request->user_id;
            $status     = $request->status;
            $from       = $request->from;
            $to         = $request->to;

            // Jika tidak memilih All assignee
            if ($orang != null) {
                $data = Task::latest()->where('user_id', $orang)->get();
            }

            // Jika tidak memilih All Assignee & All Status
            if ($status != null) {
                if ($orang != null) {
                    $data = Task::latest()->where('user_id', $orang)->where('status',$status)->get();
                } else {
                    $data = Task::latest()->where('status', $status)->get();
                }
            }

            // Jika tidak memilih All Assignee, All Status, & All from
            if ($from != null) {
                if ($status != null) {
                    if ($orang != null) {
                        $data = Task::latest()->where('user_id', $orang)
                            ->where('status',$status)
                            ->whereBetween('duedate', [$from, Carbon::now()->toDateString()])
                            ->get();
                    } else {
                        $data = Task::latest()->where('status',$status)
                            ->whereBetween('duedate', [$from, Carbon::now()->toDateString()])
                            ->get();
                    }
                } else {
                    $data = Task::latest()->whereBetween('duedate', [$from, Carbon::now()->toDateString()])->get();
                }
            }

            // Jika tidak memilih All Assignee, All Status, All From & All to
            if ($to != null) {
                if ($from != null) {
                    if ($status != null) {
                        if ($orang != null) {
                            $data = Task::latest()->where('user_id', $orang)
                                ->where('status',$status)
                                ->whereBetween('duedate', [$from, $to])
                                ->get();
                        } else {
                            $data = Task::latest()->where('status',$status)
                                ->whereBetween('duedate', [$from, $to])
                                ->get();
                        }
                    } else {
                        $data = Task::latest()->whereBetween('duedate', [$from, $to])->get();
                    }
                } else {
                        $data = Task::latest()->whereDate('duedate', '<=', $to)->get();
                }
            } 
            
            if ($orang == null && $status == null && $from == null && $to == null) {
                return redirect()->route('admin/task/show');
            }

        
            return view('task.task_detail', compact('data', 'user', 'project'));

        } else {
            Toastr::error('ADMIN ONLY');
            return redirect()->back();
        }
    }

    // search for Admin Task
    public function adminTask(Request $request)
    {
        if(Gate::allows('isAdmin')){
            $id = Auth::user()->id;
            $user = Auth::user();
            $project = Project::latest()->get();

            $orang      = $request->user_id;
            $status     = $request->status;
            $from       = $request->from;
            $to         = $request->to;

            // Jika tidak memilih All assignee
            if ($orang != null) {
                $data = Task::latest()->where('user_id', $orang)->get();
            }

            // Jika tidak memilih All Assignee & All Status
            if ($status != null) {
                if ($orang != null) {
                    $data = Task::latest()->where('user_id', $orang)->where('status',$status)->get();
                } else {
                    $data = Task::latest()->where('status', $status)->get();
                }
            }

            // Jika tidak memilih All Assignee, All Status, & All from
            if ($from != null) {
                if ($status != null) {
                    if ($orang != null) {
                        $data = Task::latest()->where('user_id', $orang)
                            ->where('status',$status)
                            ->whereBetween('duedate', [$from, Carbon::now()->toDateString()])
                            ->get();
                    } else {
                        $data = Task::latest()->where('status',$status)
                            ->whereBetween('duedate', [$from, Carbon::now()->toDateString()])
                            ->get();
                    }
                } else {
                    $data = Task::latest()->whereBetween('duedate', [$from, Carbon::now()->toDateString()])->get();
                }
            }

            // Jika tidak memilih All Assignee, All Status, All From & All to
            if ($to != null) {
                if ($from != null) {
                    if ($status != null) {
                        if ($orang != null) {
                            $data = Task::latest()->where('user_id', $orang)
                                ->where('status',$status)
                                ->whereBetween('duedate', [$from, $to])
                                ->get();
                        } else {
                            $data = Task::latest()->where('status',$status)
                                ->whereBetween('duedate', [$from, $to])
                                ->get();
                        }
                    } else {
                        $data = Task::latest()->whereBetween('duedate', [$from, $to])->get();
                    }
                } else {
                        $data = Task::latest()->whereDate('duedate', '<=', $to)->get();
                }
            } 
            
            if ($orang == null && $status == null && $from == null && $to == null) {
                return redirect()->route('admin/task/me');
            }

            return view('task.task_detail_admin', compact('data', 'user', 'project'));

        } else {
            Toastr::error('ADMIN ONLY');
            return redirect()->back();
        }
    }
}
