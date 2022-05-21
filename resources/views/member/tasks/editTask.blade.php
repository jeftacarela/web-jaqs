@extends('member.layouts.master')
@section('content')
    
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                <div class="page-title-box">
                    <div class="row align-items-center ">
                        <div class="col-md-8">
                            <div class="page-title-box">
                                @can('isAdmin')
                                    <h4 class="page-title">Member Dashboard <b class="text-warning">as Admin</b></h4>
                                @elsecan('isMember')
                                    <h4 class="page-title">Member Dashboard</h4>
                                @endcan
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('member') }}">Team Member</a></li>
                                    <li class="breadcrumb-item"><a href="{{ url('member/task/') }}">Task</a></li>
                                    <li class="breadcrumb-item"><a class="active" href="#">Edit</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- message --}}
                {!! Toastr::message() !!}
                <div class="page-heading">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form form-horizontal" action="{{ route('member/task/update') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $task->id }}">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Task</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">
                                                            <input type="text" class="form-control"
                                                                placeholder="Task Name" id="first-name-icon" name="name" value="{{ $task->name }}">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-person"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <label>User Assignee</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">
                                                            <select required class="form-control" name="user_id" id="user_id">
                                                                <option selected disabled>{{ $task->user->name }}</option>
                                                                {{-- @foreach ($user as $proyek) --}}
                                                                    <option value="{{ auth()->user()->id}}">{{ auth()->user()->name}}</option>
                                                                {{-- @endforeach --}}
                                                            </select>
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-person"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <label>Project</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">
                                                            <select required class="form-control" name="project_id" id="project_id">
                                                                <option selected disabled>{{ $task->project->projectname }}</option>
                                                                @foreach ($project as $proyek)
                                                                    <option value="{{ $proyek->id}}">{{ $proyek->projectname}}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-person"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <label>Status</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">
                                                            <select required class="form-control @error('status') is-invalid @enderror" name="status" id="first-name-icon">
                                                                <option selected disabled>{{ $task->status }}</option>
                                                                    <option value="In Progress">In Progress</option>
                                                                    <option value="Wait for Review">Wait for Review</option>
                                                                    <option value="Completed">Completed</option>
                                                                </select>
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-email"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <label>Time Worked</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">
                                                            <input type="number" class="form-control"
                                                                placeholder="Time Work (minutes)" name="work_time" value="{{ $task->work_time }}">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-phone"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                 
                                                <div class="col-md-4">
                                                    <label>Notes</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">
                                                            <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" value="{{ $task->notes }}" type="text" id="notes" placeholder="Enter notes" cols="30" rows="4"></textarea>
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-company"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-info waves-effect waves-light mr-2">Update</button>
                                                    <button type="reset" class="btn btn-danger waves-effect waves-light"><a href="{{ route('member/task') }}">Back</a></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page-title -->
            </div>
            <!-- container-fluid -->
        </div>
    </div>
    <!-- content --> 
@endsection
