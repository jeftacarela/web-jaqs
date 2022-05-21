
{{-- {{ dd($project) }} --}}
@extends('layouts.master')
@section('content')
    
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                <div class="page-title-box">
                    <div class="row align-items-center ">
                        <div class="col-md-8">
                            <div class="page-title-box">
                                <h4 class="page-title">Dashboard</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Admin</a></li>
                                    <li class="breadcrumb-item"><a href="{{ url('admin/task/show') }}">Task</a></li>
                                    <li class="breadcrumb-item"><a class="active" href="{{ url('admin/task/new') }}">Add</a></li>
                                </ol>
                            </div>
                        </div>
                        {{-- <div class="col-md-4">
                            <div class="float-right d-none d-md-block app-datepicker">
                                <input type="text" class="form-control" data-date-format="MM dd, yyyy" readonly="readonly" id="datepicker">
                                <i class="mdi mdi-chevron-down mdi-drop"></i>
                            </div>
                        </div> --}}
                    </div>
                </div>
                {{-- message --}}
                {!! Toastr::message() !!}
                <div class="page-heading">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title">Form Add New Task</h4>
                                    <p class="sub-title">Add Task</p>
                                    <form action="{{ route('admin/task/save') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Task Name</label>
                                            <div class="col-sm-10">
                                                <input class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" type="text" id="name" placeholder="Enter task name">
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
                                                    {{-- @foreach ($task as $proyek)
                                                        <option value="{{ $proyek->user->id}}">{{ auth()->user()->role_name }}</option>
                                                    @endforeach --}}
                                                    @if ((auth()->user()->name) != 'Admin')
                                                        <option value="{{ auth()->user()->id }}">{{ auth()->user()->name }}</option>
                                                    @else
                                                        @foreach ($user as $orang)
                                                        @if ($orang->role_name != 'Client')
                                                            <option value="{{ $orang->id }}">{{ $orang->name }}</option>
                                                        @endif
                                                        @endforeach
                                                    @endif
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
                                                <input class="form-control @error('work_time') is-invalid @enderror" name="work_time" value="{{ old('work_time') }}" type="tel" id="work_time" placeholder="Enter Work Time (minutes)">
                                                @error('work_time')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-tel-input" class="col-sm-2 col-form-label">Billable Hours</label>
                                            <div class="col-sm-10">
                                                <input class="form-control @error('billing') is-invalid @enderror" name="billing" value="{{ old('billing') }}" type="tel" id="billing" placeholder="Enter Billing Time (minutes)">
                                                @error('billing')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-tel-input" class="col-sm-2 col-form-label">Billed</label>
                                            <div class="col-sm-10">
                                                <select class="form-control @error('billed') is-invalid @enderror" name="billed" id="billed">
                                                    <option selected disabled>Select</option>
                                                        <option value="Billed">Billed</option>
                                                        <option value="Waived">Waived</option>
                                                    </select>
                                                @error('billed')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Notes</label>
                                            <div class="col-sm-10">
                                                <input class="form-control @error('notes') is-invalid @enderror" name="notes" value="{{ old('notes') }}" type="text" id="notes" placeholder="Enter notes">
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
                                                <button type="reset" class="btn btn-danger waves-effect waves-light">Cancel</button>
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
