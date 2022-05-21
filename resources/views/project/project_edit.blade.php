
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
                                    <li class="breadcrumb-item"><a href="{{ url('admin/project/show') }}">Project</a></li>
                                    <li class="breadcrumb-item"><a class="active" href="#">Edit</a></li>
                                </ol>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="float-right d-none d-md-block app-datepicker">
                                <input type="text" class="form-control" data-date-format="MM dd, yyyy" readonly="readonly" id="datepicker">
                                <i class="mdi mdi-chevron-down mdi-drop"></i>
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
                                    <form class="form form-horizontal" action="{{ route('admin/project/update') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <div class="form-body">
                                            <div class="row">
                                                
                                                <div class="col-md-4">
                                                    <label>Project Name</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">
                                                            <input type="text" class="form-control"
                                                                placeholder="Project Name" id="first-name-icon" name="projectname" value="{{ $data->projectname }}">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-email"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                    
                                                <div class="col-md-4">
                                                    <label>Client</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">
                                                            <select class="form-control" name="client" id="client">
                                                                <option selected disabled>Select Client Name</option>
                                                                @foreach ($orang as $user)
                                                                @if ($user->role_name == 'Client')
                                                                    <option value="{{ $user->id}}">{{ $user->name}}</option>
                                                                @endif
                                                                @endforeach
                                                            </select>
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-company"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <label>Type of Project</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">
                                                            <select class="form-control" name="project_type" id="project_type">
                                                                <option selected disabled>Select Type of Project</option>
                                                                    <option value="WordPress">WordPress</option>
                                                                    <option value="Laravel">Laravel</option>
                                                                    <option value="Others">Others</option>
                                                            </select>
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-company"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <label>Client Status</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">
                                                            <select class="form-control" name="status" id="status">
                                                                <option selected disabled>Select Client Status</option>
                                                                    <option value="Active">Active</option>
                                                                    <option value="Not Active">Not Active</option>
                                                                    <option value="Top Priority">Top Priority</option>
                                                            </select>
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-company"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <label>Web URL</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">
                                                            <input type="text" class="form-control"
                                                                placeholder="https://example.com" id="first-name-icon" name="website_url" value="{{ $data->website_url }}">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-email"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <label>Staging URL</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">
                                                            <input type="text" class="form-control"
                                                                placeholder="https://staging.example.com" id="first-name-icon" name="staging_url" value="{{ $data->staging_url }}">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-email"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <label>Due Date</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">
                                                            <input type="date" class="form-control"
                                                                placeholder="Due Date" id="first-name-icon" name="duedate" value="{{ $data->duedate }}">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-date"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4"> 
                                                    <div class="form-group">
                                                        <label>Client Status</label>
                                                        <select class="form-control" name="status" id="e_status">
                                                            {{-- <option selected disabled>Status</option> --}}
                                                                <option value="Active">Active</option>
                                                                <option value="Not Active">Not Active</option>
                                                                <option value="Top Priority">Top Priority</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <label>User Assignee</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">
                                                            <select multiple class="form-control" name="user" id="user">
                                                                <option selected disabled>Select User</option>
                                                                @foreach ($orang as $user)
                                                                @if ($user->role_name == 'Team Member' )
                                                                    <option value="{{ $user->id}}">{{ $user->name}}</option>
                                                                @endif
                                                                @endforeach
                                                            </select>
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-person"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-success waves-effect waves-light mr-2">Update</button>
                                                    <button  tton type="reset" class="btn btn-danger waves-effect waves-light"><a href="{{ route('admin/project/show') }}">Back</a></button>
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
