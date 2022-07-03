<?php

namespace App\Http\Controllers;

use App\Helpers\LogActivity;
use App\Models\Project;
use App\Models\Task;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    public function saveVideo(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            $request->validate([
                'project_id'    => 'required|numeric',
                'description'   => 'required',
                'title'         => 'required|string|max:255',
                'video'         => 'required|string|max:255',
                'duration'      => 'required|date_format:H:i',
            ]);

            $video = new Video;
            $video->project_id  = $request->project_id;
            $video->title        = $request->title;
            $video->description = $request->description;
            $video->video       = $request->video;
            $video->duration    = $request->duration;

            $video->save();

            Toastr::success('Video Added', 'Success');
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
            $data = Video::latest()->get();
            $project = Project::latest()->get();        
            return view('video.video_detail', compact('data', 'user', 'project'));
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
            $video      = $request->video;
            $title      = $request->title;
            $description= $request->description;
            $duration   = $request->duration;
            $project_id = $request->project_id;

            $update = [
                'id'        => $id,
                'title'     => $title,
                'video'     => $video,
                'description'=> $description,
                'duration'  => $duration,
                'project_id'=> $project_id,
            ];

            Video::where('id', $request->id)->update($update);

            // dd($update);
            LogActivity::addToLog('update video');
            Toastr::success('Video Updated','Success');
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
            $delete = Video::find($id);
            $delete->delete();

            Toastr::success('Video deleted','Success');
            // return redirect()->route('admin/task/show');
            return redirect()->back();
        } else {
        Toastr::error('ADMIN ONLY');
        return redirect()->back();
        }
    }
}
