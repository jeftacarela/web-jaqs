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
            // dd($request->video_file);
            $request->validate([
                'project_id'    => 'required|numeric',
                'description'   => 'nullable|string',
                'title'         => 'required|string|max:255',
                'video'         => 'nullable|string|max:255',
                'duration'      => 'required|date_format:H:i',
            ]);


            if($file = $request->hasFile('video_file')) {
                $file = $request->file('video_file') ;
                $fileName = $file->getClientOriginalName() ;
                $destinationPath = public_path().'/video' ;
                $file->move($destinationPath,$fileName);
            } 

            $video = new Video;
            $video->project_id  = $request->project_id;
            $video->title        = $request->title;
            $video->description = $request->description;
            $video->video       = $request->video;
            // $video->video_file  = $request->file('video_file')->getClientOriginalName();
            $video->video_file  = $fileName;
            $video->duration    = $request->duration;

            $video->save();

            LogActivity::addToLog('add video '.$request->title);

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

            $fileName = $request->video_file;
            if($file = $request->hasFile('video_file')) {
                $file = $request->file('video_file') ;
                $fileName = $file->getClientOriginalName() ;
                $destinationPath = public_path().'/video' ;
                $file->move($destinationPath,$fileName);
            }

            $update = [
                'id'        => $id,
                'title'     => $title,
                'video'     => $video,
                'video_file'=> $fileName,
                'description'=> $description,
                'duration'  => $duration,
                'project_id'=> $project_id,
            ];

            Video::where('id', $request->id)->update($update);
            // dd($update);

            LogActivity::addToLog('update video '.$title);

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
            LogActivity::addToLog('delete video '.Video::where('id', $id)->pluck('title'));

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
