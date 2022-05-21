
{{-- {{ dd($project) }} --}}
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
                                    <li class="breadcrumb-item"><a class="active" href="{{ url('member/task/detail/') }}">New</a></li>
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
                                    <h4 class="mt-0 header-title">Add New Task</h4>
                                    <p class="sub-title">Add Task</p>
                                    <form action="{{ url('member/task/save') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Task Name</label>
                                            <div class="col-sm-10">
                                                <input class="required form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" type="text" id="name" placeholder="Enter task name">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-tel-input" class="col-sm-2 col-form-label">Project</label>
                                            <div class="col-sm-10">
                                                <select class="form-control @error('project_id') is-invalid @enderror" name="project_id" id="project_id">
                                                    <option selected disabled>Select Project</option>
                                                    @foreach ($project as $proyek)
                                                        <option value="{{ $proyek->id}}">{{ $proyek->projectname}}</option>
                                                    @endforeach
                                                </select>
                                                @error('project')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-tel-input" class="col-sm-2 col-form-label">User Assignee</label>
                                            <div class="col-sm-10">
                                                <select class="form-control @error('user_id') is-invalid @enderror" name="user_id" id="user_id">
                                                    <option selected disabled>Select User</option>
                                                    {{-- @foreach ($user as $orang) --}}
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    {{-- @endforeach --}}
                                                </select>
                                                @error('user')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-tel-input" class="col-sm-2 col-form-label">Status</label>
                                            <div class="col-sm-10">
                                                <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                                                    <option selected disabled>Select Status</option>
                                                        <option value="In Progress">In Progress</option>
                                                        <option value="Wait for Review">Wait for Review</option>
                                                        <option value="Completed">Completed</option>
                                                    </select>
                                                @error('status')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-tel-input" class="col-sm-2 col-form-label">Work Time</label>
                                            <div class="col-sm-10">
                                                <input class="required form-control @error('work_time') is-invalid @enderror" name="work_time" value="{{ old('work_time') }}" type="tel" id="work_time" placeholder="Enter Work Time (minutes)">
                                                @error('work_time')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Notes</label>
                                            <div class="col-sm-10">
                                                {{-- <input class="form-control @error('notes') is-invalid @enderror" name="notes" value="{{ old('notes') }}" type="text" id="notes" placeholder="Enter notes"> --}}
                                                <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" value="{{ old('notes') }}" type="text" id="notes" placeholder="Enter notes" cols="30" rows="4"></textarea>
                                                @error('notes')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-password-input" class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
                                                <button type="reset" class="btn btn-danger waves-effect waves-light"><a href="{{ url('member/task/') }}">Cancel</a></button>
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
