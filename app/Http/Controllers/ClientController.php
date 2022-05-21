<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Barryvdh\DomPDF\Facade as PDF;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function index()
    {
        if (Gate::denies('isMember')) {

            $user = User::latest()->get();
            $id = Auth::user();
            $project = Project::latest()->get();
            $task = Task::latest()->get();
            // $projectuser = DB::table('project_user')->get();
            return view('client.client_home', compact('user','task','id', 'project'));
        } else {
            Toastr::error('Not for member','CLIENT PAGE');
            return redirect()->back();
        }
    }

    public function showProject()
    {
        if (Gate::denies('isMember')) {
            $user       = Auth::user();
            $orang      = User::latest()->get();
            $project    = Project::latest()->get();

            if (DB::table('project_user')->where('user_id',$user->id)->exists()) {

                // Match user with project using project_id from Table project_user
                // Save project_id that matched in new variable
                $projectuser= DB::table('project_user')->where('user_id',$user->id)->get();
                foreach ($projectuser as $proj) {
                    $project_id = $proj->project_id;
                }
                
                $duration = DB::table('tasks')->where('project_id', $project_id)->get();

                $hour   = 0;
                $minute = 0;
                foreach ($duration as $work_time){
                    $waktu = $work_time->billing;
                    $parsed = date_parse($waktu);
                    $hour = $hour+$parsed['hour'];
                    $minute = $minute+$parsed['minute'];
                }

                if ($minute <= 0) {
                    if ($hour>0) {
                        $jam = $hour;
                        $menit = 0;
                    } else {
                        $menit = 0;
                        $jam = 0;
                    }
                } else {
                    $menit = $minute % 60;
                    $jam = $hour + (($minute-$menit)/60);
                }                 
            
                return view('client.client_showProject', compact('user', 'orang','menit', 'jam'));
            } else {
                $menit  = null;
                $jam    = null;
                return view('client.client_showProject', compact('user', 'orang','menit', 'jam'));
            }
        } else {
            Toastr::error('Not for member','CLIENT PAGE');
            return redirect()->back();
        }
    }

    public function viewProject($id)
    {
        $project = Project::findorfail($id);
        // total duration yang nilai id == project_id
        $duration = DB::table('tasks')->where('project_id', $id)->get();
        // $time = explode('billing', $duration);

        // $startTime= '01:30:02';
        // $finishTime= '12:30:20';

        $hour = 0;
        $minute = 0;
        foreach ($duration as $work_time) {
            $waktu = $work_time->billing;
            $parsed = date_parse($waktu);
            $hour = $hour+$parsed['hour'];
            $minute = $minute+$parsed['minute'];
        }

        if ($minute <= 0) {
            if ($hour>0) {
                $jam = $hour;
                $menit = 0;
            } else {
                $menit = 0;
                $jam = 0;
            }
        } else {
            $menit = $minute % 60;
            $jam = $hour + (($minute-$menit)/60);
        } 

        // dd($jam);

        return view('client.client_eachProject', compact('project', 'duration','menit', 'jam'));
    }

    public function invoice($id)
    {
        $dt = Carbon::now();
        $project = Project::findorfail($id);
        // total duration yang nilai id == project_id
        $duration = DB::table('tasks')->where('project_id', $id)->get();

        $hour = 0;
        $minute = 0;
        foreach ($duration as $work_time) {
            $waktu = $work_time->billing;
            $parsed = date_parse($waktu);
            $hour = $hour+$parsed['hour'];
            $minute = $minute+$parsed['minute'];
        }

        if ($minute <= 0) {
            if ($hour>0) {
                $jam = $hour;
                $menit = 0;
            } else {
                $menit = 0;
                $jam = 0;
            }
        } else {
            $menit = $minute % 60;
            $jam = $hour + (($minute-$menit)/60);
        } 
        
        return view('client.client_invoice', compact('project', 'duration','menit','dt', 'jam'));
    }

    public function invoices($id)
    {
        if (Gate::denies('isMember')) {
            if (Project::where('id', $id)->exists()) {
                $dt = Carbon::now();
                $project = Project::findorfail($id);
                $duration = DB::table('tasks')->where('project_id', $id)->get();

                $hour = 0;
                $minute = 0;
                foreach ($duration as $work_time) {
                    $waktu = $work_time->billing;
                    $parsed = date_parse($waktu);
                    $hour = $hour+$parsed['hour'];
                    $minute = $minute+$parsed['minute'];
                }

                if ($minute <= 0) {
                    if ($hour>0) {
                        $jam = $hour;
                        $menit = 0;
                    } else {
                        $menit = 0;
                        $jam = 0;
                    }
                } else {
                    $menit = $minute % 60;
                    $jam = $hour + (($minute-$menit)/60);
                } 

                $data = [
                    'dt' => $dt,
                    'project' => $project,
                    'duration' => $duration,
                    'hour' => $hour,
                    'minute' => $minute,
                    'jam' => $jam,
                    'menit' => $menit,
                ];
                
                return view('client.invoice', compact('project', 'duration','menit','dt', 'jam'));

            } else {
                return redirect()->back()->with('status','No Project Found');
            }
        } else {
            Toastr::error('Not for member','CLIENT PAGE');
            return redirect()->back();
        }
    }

    public function saveInvoice($id)
    {
        // $invoice = new Invoice();
        // $invoice->information_id  = $info;
        // $invoice->project_id   = $id;
        // $invoice->task_id     = $task;
        // $invoice->amount_bill     = $duration;
        // $invoice->amount_payment = $payment;

        // $invoice->save();
        if (Project::where('id', $id)->exists()) {
            $dt = Carbon::now();
            $project = Project::findorfail($id);
            $duration = DB::table('tasks')->where('project_id', $id)->get();

            $hour = 0;
            $minute = 0;
            foreach ($duration as $work_time) {
                $waktu = $work_time->billing;
                $parsed = date_parse($waktu);
                $hour = $hour+$parsed['hour'];
                $minute = $minute+$parsed['minute'];
            }

            if ($minute <= 0) {
                if ($hour>0) {
                    $jam = $hour;
                    $menit = 0;
                } else {
                    $menit = 0;
                    $jam = 0;
                }
            } else {
                $menit = $minute % 60;
                $jam = $hour + (($minute-$menit)/60);
            } 

            $data = [
                'dt' => $dt,
                'project' => $project,
                'duration' => $duration,
                'hour' => $hour,
                'minute' => $minute,
                'jam' => $jam,
                'menit' => $menit,
            ];

            $pdf = PDF::loadView('client.invoice', $data);

            Toastr::success('Invoice generated','Success');    
            return $pdf->stream('cabaretti.pdf');
            
            // return view('client.client_invoice', compact('project', 'duration','menit','dt', 'jam'));

        } else {
            return redirect()->back()->with('status','No Project Found');
        }

        // Toastr::success('Invoice generated :)','Success');
        // return view('client.client_home');
    }

    public function showProfile()
    {
        if (Gate::denies('isMember')) {
            $user = Auth::user();
            $project = Project::latest()->get();
            return view('client.client_showProfile', compact('project', 'user'));
        } else {
            Toastr::error('Not for member','CLIENT PAGE');
            return redirect()->back();
        }
    }
    
    public function viewProfile($id)
    {
        if (Gate::denies('isMember')) {
            // $orang = User::findorfail($id);
            // $user = Auth::user();
            $orang = DB::table('users')->where('id', $id)->get();
            return view('client.client_viewProfile', compact('orang'));
        } else {
            Toastr::error('Not for member','CLIENT PAGE');
            return redirect()->back();
        }
    }

    public function updateProfile(Request $request)
    {
        if (Gate::denies('isMember')) {
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

            Toastr::success('Profile updated','Success');
            return redirect()->back();
        } else {
            Toastr::error('Not for member','CLIENT PAGE');
            return redirect()->back();
        }
    }

    // view change password
   public function changePassword($id)
   {
       if (Gate::denies('isMember')) {
            $orang = DB::table('users')->where('id', $id)->get();
            return view('client.client_changePassword', compact('orang'));
        } else {
            Toastr::error('Not for member','CLIENT PAGE');
            return redirect()->back();
        }
   }
   
   // change password in db
   public function updatePassword(Request $request)
   {
        if (Gate::denies('isMember')) {
            $request->validate([
                'password' => ['required', new MatchOldPassword],
                'new_password' => ['required'],
                'new_confirm_password' => ['same:new_password'],
            ]);

                User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
                Toastr::success('Password Changed','Success');
                return redirect()->back();
        } else {
            Toastr::error('Not for member','CLIENT PAGE');
            return redirect()->back();
        }

   }
}
