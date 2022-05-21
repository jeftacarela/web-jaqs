
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
                                    <li class="breadcrumb-item active">Form / Add / Project</li>
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
                                    <h4 class="mt-0 header-title">Form Add New Project</h4>
                                    <p class="sub-title">Add Project</p>
                                    <form action="{{ route('admin/project/save') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Project Name</label>
                                            <div class="col-sm-8">
                                                <input class="form-control @error('projectname') is-invalid @enderror" name="projectname" value="{{ old('projectname') }}" type="text" id="projectname" placeholder="Enter project name">
                                                @error('projectname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-tel-input" class="col-sm-2 col-form-label">Client</label>
                                            <div class="col-sm-8">
                                                <select class="form-control @error('client') is-invalid @enderror" name="client" id="client">
                                                    <option selected disabled>Select Client Name</option>
                                                    @foreach ($orang as $user)
                                                    @if ($user->role_name == 'Client')
                                                        <option value="{{ $user->id}}">{{ $user->name}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                @error('client')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-tel-input" class="col-sm-2 col-form-label">Type of Project</label>
                                            <div class="col-sm-8">
                                                <select class="form-control @error('project_type') is-invalid @enderror" name="project_type" id="project_type">
                                                    <option selected disabled>Select Type of Project</option>
                                                        <option value="WordPress">WordPress</option>
                                                        <option value="Laravel">Laravel</option>
                                                        <option value="Others">Others</option>
                                                </select>
                                                @error('project_type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-tel-input" class="col-sm-2 col-form-label">Client Status</label>
                                            <div class="col-sm-8">
                                                <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                                                    <option selected disabled>Select Client Status</option>
                                                        <option value="Active">Active</option>
                                                        <option value="Not Active">Not Active</option>
                                                        <option value="Top Priority">Top Priority</option>
                                                </select>
                                                @error('status')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Web URL</label>
                                            <div class="col-sm-8">
                                                <input class="form-control @error('website_url') is-invalid @enderror" name="website_url" value="{{ old('website_url') }}" type="url" id="website_url" placeholder="Enter project name">
                                                @error('website_url')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Staging URL</label>
                                            <div class="col-sm-8">
                                                <input class="form-control @error('staging_url') is-invalid @enderror" name="staging_url" value="{{ old('staging_url') }}" type="url" id="staging_url" placeholder="Enter project name">
                                                @error('staging_url')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Due Date</label>
                                            <div class="col-sm-8">
                                                <div class="float-left d-none d-md-block app-datepicker">
                                                    <input type="text" class="form-control @error('duedate') is-invalid @enderror" data-date-format="MM dd, yyyy" name="duedate" id="datepicker">
                                                    <i class="mdi mdi-chevron-down mdi-drop"></i>
                                                    @error('duedate')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                  @enderror                                                
                                                </div>                                            
                                            </div>
                                        </div> --}}

                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Due Date</label>
                                            <div class="col-sm-8">
                                                <input class="form-control @error('duedate') is-invalid @enderror" name="duedate" value="{{ old('duedate') }}" type="date" id="duedate" placeholder="Enter duedate">
                                                @error('duedate')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-tel-input" class="col-sm-2 col-form-label">User Assignee</label>
                                            <div class="col-sm-8">
                                                <select required multiple class="form-control @error('user') is-invalid @enderror" name="user[]" id="user">
                                                    <option selected disabled>Select Name</option>
                                                    @foreach ($orang as $user)
                                                    @if ($user->role_name == 'Team Member' )
                                                        <option value="{{ $user->id}}">{{ $user->name}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                @error('user')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-password-input" class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-8">
                                                <button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
                                                <button type="reset" class="btn btn-danger waves-effect waves-light"><a href="{{ route('admin/project/show') }}">Cancel</a></button>
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
