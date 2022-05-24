<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Brian2694\Toastr\Facades\Toastr;

class VideoController extends Controller
{
    public function saveVideo(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            $request->validate([
                'project_id'    => 'required|numeric',
                'description'   => 'required',
                'video'         => 'required|string|max:255',
                'duration'      => 'required|date_format:H:i',
            ]);

            $video = new Video;
            $video->project_id  = $request->project_id;
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
}
