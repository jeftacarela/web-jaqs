<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Result;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function showResult()
    {
        if (Gate::allows('isAdmin')) {            
            // $results = Result::orderby('project_id', 'asc')->get();
            $results = DB::table('results')->latest('results.created_at')
                ->leftJoin('projects', 'projects.id', '=', 'results.project_id')
                ->leftJoin('users', 'users.id', '=', 'results.user_id')
                ->get();
                // dd($results);
            $projects = Project::all();
            return view('result.showResult', compact('results', 'projects'));
        } else {
            Toastr::error('Not for Client','MEMBER PAGE');
            return redirect()->back();
        }
    }
}
