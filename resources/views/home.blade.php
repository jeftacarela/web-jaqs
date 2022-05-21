@extends('layouts.master')
@section('content')

    <div class="content-page">
        {{-- message --}}
        {!! Toastr::message() !!}
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                <div class="page-title-box">
                    <div class="row align-items-center ">
                        <div class="col-md-7">
                            <div class="page-title-box">
                                <h4 class="page-title">Dashboard</h4>
                                {{-- <ol class="breadcrumb">
                                    <li class="breadcrumb-item active">Cabaretti Dashboard</li>
                                </ol> --}}
                                <h3 class="greeting">Welcome {{ $id->name }}!</h3>
                            </div>
                        </div>
                        <div class="row align-items-right">
                            <div class="col">
                                <div class="float-right d-none d-md-block">                    
                                    <button type="submit" class="btn btn-sm btn-primary waves-effect waves-light mt-5 mr-2">
                                        <a href="#" class="mr-3 ml-3" data-toggle="modal" data-target="#add_task" style="font-size: 14px">Create a Task</a>
                                    </button>
                                    <button type="submit" class="btn btn-sm btn-success waves-effect waves-light mt-5 mr-1">
                                        <a href="#" class="mr-3 ml-3" data-toggle="modal" data-target="#add_project" style="font-size: 14px">Add a Project</a>
                                    </button>
                                    <button type="submit" class="btn btn-sm btn-danger waves-effect waves-light mt-5">
                                        <a href="#" class="mr-4 ml-4" data-toggle="modal" data-target="#add_user" style="font-size: 14px">Add a User</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- message --}}
            {!! Toastr::message() !!}
            @if(count($errors) > 0)
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{$error}}
                    </div>
                @endforeach
            @endif
                <!-- end page-title -->

                <!-- start top-Contant -->

                {{-- <div class="row">
                @foreach ($task as $tugas)
                @if ($tugas->user_id == $user->id)
                    @foreach ($project as $proyek)
                    <div class="col-sm-6 col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center p-1">
                                    <div class="col-lg-8">
                                        

                                        <h5 class="font-16">{{ $proyek->projectname }}</h5>
                                        <h4 class="text-warning pt-1 mb-0">{{ $proyek->duedate }}</h4>
                                        <h6>
                                            @foreach ($proyek->user as $orang)
                                                <h6 class="text-muted text-primary mb-1">{{ $orang->name }}</h6>
                                            @endforeach
                                        </h6>


                                    </div>
                                    <div class="col-lg-6">
                                        <div id="chart2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div> --}}

                <!-- end top-Contant -->

                {{-- Start Content --}}
                <div class="row">
                    <div class="col-sm-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center p-1">
                                    <div class="col-lg-10">
                                        <h5 class="font-14">Total Active Project(s)</h5>
                                        <h6 class="text-danger header-title pt-1 mb-0" style="font-size: 16px">{{ $jumlahProject }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center p-1">
                                    <div class="col-lg-12">
                                        <h5 class="font-14">Remaining Tasks for Team</h5>
                                        <h6 class="text-danger header-title pt-1 mb-0" style="font-size: 16px">{{ $jumlahTask }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center p-1">
                                    <div class="col-lg-10">
                                        <h5 class="font-14">My Remaining Task(s)</h5>
                                        <h6 class="text-danger header-title pt-1 mb-0" style="font-size: 16px">{{ $jumlahMyTask }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center p-1">
                                    <div class="col-lg-10">
                                        <h5 class="font-14">Total Users</h5>
                                        <h6 class="text-danger header-title pt-1 mb-0" style="font-size: 16px">{{ $jumlahUser }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <!--
               <div class="row">
                {{-- Ambil nilai dari tabel user --}}
                @foreach ($user as $us)
                    {{-- Jika ID Login sama dengan yang ada di tabel user  --}}
                    @if ($us->id == $id->id)
                        {{-- Panggil model project dari model user --}}
                        @foreach ($us->project as $proj)                    
                            <div class="col-sm-6 col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center p-1">
                                            <div class="col-lg-8">
                                                <h4 class="font-16 text-info header-title text-decoration-none">
                                                    {{-- <a href="{{ url('admin/project/view/'.$proj->id) }}" class="text-muted">{{ $proj->projectname }}</a> --}}
                                                    <a href="{{ url('admin/project/show/') }}" class="text-muted">{{ $proj->projectname }}</a>
                                                </h4>
                                                <h3 class="text-warning pt-1 mb-0">{{ $proj->duedate }}</h3>
                                                <h6>
                                                    @foreach ($proj->user as $orang)
                                                        <h6 class="text-muted text-primary mb-1">{{ $orang->name }}</h6>
                                                    @endforeach
                                                </h6>
                                            </div>
                                            <div class="col-lg-6">
                                                <div id="chart2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach                
                    @endif
                @endforeach
                </div>
            -->

                {{-- @foreach ($projectuser as $item)
                    <h2>{{ $item->project_id }}
                @endforeach --}}

                {{-- @foreach ($task as $tugas)
                @if ($tugas->user_id == $id->id)
                    <h1>{{ $tugas->project->projectname }}</h1>
                    <h2>{{ $tugas->name }}</h2>                        
                @else
                    <h1>Tidak ditemukan</h1>                    
                @endif
                @endforeach --}}

                 <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title mb-4">Your Recent Task Activity</h4>
                                <ol class="activity-feed mb-0 pl-3">
                                    @foreach ($task as $item)
                                    @if ($item->user_id == $id->id)
                                    <li class="feed-item">
                                        <div class="feed-item-list">
                                            {{-- <a href="{{ url('admin/task/detail/'.$item->id) }}" class="text-muted mb-1">{{ $item->created_at }}</a> --}}
                                            <a href="{{ url('admin/task/me/') }}" class="text-muted mb-1">{{ $item->created_at }}</a>
                                            <p class="font-15 mt-0 mb-0">{{ $item->name }} <b class="text-warning">{{ $item->project->projectname }}</b></p>
                                        </div>
                                    </li>
                                    @endif
                                    @endforeach
                                </ol>

                            </div>
                        </div>
                    </div>  
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title mb-4">Recent All Task Activity</h4>
                                <ol class="activity-feed mb-0 pl-3">
                                    @foreach ($task as $item)
                                    {{-- @if ($item->user_id == $id->id) --}}
                                    <li class="feed-item">
                                        <div class="feed-item-list">
                                            {{-- <a href="{{ url('admin/task/detail/'.$item->id) }}" class="text-muted mb-1">{{ $item->created_at }}</a> --}}
                                            <a href="{{ url('admin/task/show/') }}" class="text-muted mb-1">{{ $item->created_at }}</a>
                                            <p class="font-15 mt-0 mb-0">{{ $item->name }}
                                                <b class="text-warning"> {{ $item->project->projectname }}</b>
                                                <b class="text-primary"> {{ $item->user->name }}</b>
                                            </p>
                                        </div>
                                    </li>
                                    {{-- @endif --}}
                                    @endforeach
                                </ol>

                            </div>
                        </div>  
                    </div>  
                    
                    {{-- <div class="col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title mb-4">Action</h4>
                                <div class="social-box text-center">
                                    <div class="mt-2 pt-1 mb-2">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mb-2">
                                            <a href="#" data-toggle="modal" data-target="#add_project">Add a Project</a>
                                        </button>
                                        <br>
                                        <button type="submit" class="btn btn-success waves-effect waves-light mb-2">
                                            <a href="#" data-toggle="modal" data-target="#add_task">Create a Task</a>
                                        </button>
                                        <br>
                                        <button type="submit" class="btn btn-success waves-effect waves-light">
                                            <a href="#" class="mr-2 ml-2" data-toggle="modal" data-target="#add_user">Add a User</a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                    {{-- <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="social-box text-center">
                                    <i class="mdi mdi-facebook text-primary h1"></i>
                                    <h5 class="font-19 mt-3"><span class="text-primary">8.625K</span> New Peoples</h5>
                                    <p class="text-muted">Your main list is growing</p>

                                    <div class="mt-2 pt-1 mb-2">
                                        <button type="button" class="btn btn-primary btn-sm waves-effect waves-light">Follwing you</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="social-box text-center">
                                    <i class="mdi mdi-twitter text-info h1"></i>
                                    <h5 class="font-19 mt-3"><span class="text-info">125.3K</span> New Peoples</h5>
                                    <p class="text-muted">Your main list is growing</p>

                                    <div class="mt-2 pt-1 mb-2">
                                        <button type="button" class="btn btn-info btn-sm waves-effect waves-light">Follwing you</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    {{-- @else
                    <h1>Tidak ditemukan</h1>                    
                @endif
                @endforeach                --}}

                    
                </div>
            </div>
            <!-- container-fluid -->
        </div>
    </div>

    <!-- Add Project Modal -->
    <div id="add_project" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title header-title">Create New Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin/project/save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row"> 
                            <div class="col-sm-8"> 
                                <div class="form-group">
                                    <label for="projectname" class="col-form-label">Project Name</label>
                                    <input required class="form-control @error('projectname') is-invalid @enderror" type="text" id="projectname" name="projectname" value="{{ old('projectname') }}" placeholder="Enter Project Name"
                                        oninvalid="this.setCustomValidity('Please Enter valid Project Name')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="duedate">Due Date</label>
                                    <input required class="form-control @error('duedate') is-invalid @enderror" type="date" id="duedate" name="duedate" value="{{ old('duedate') }}"
                                        oninvalid="this.setCustomValidity('Please Enter valid Date')" oninput="setCustomValidity('')">
                                    @error('duedate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-sm-4"> 
                                <label>Client Name</label>
                                <select class="form-control" name="client" id="client">
                                    <option selected disabled> -- Select Client Name --</option>
                                    @foreach ($user as $orang)
                                    @if ($orang->role_name == 'Client')
                                        <option value="{{ $orang->id }}">{{ $orang->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4"> 
                                <label>Type of Project</label>
                                <select class="form-control" name="project_type" id="project_type">
                                    <option selected disabled> -- Select Type of Project --</option>
                                        <option value="WordPress">WordPress</option>
                                        <option value="Laravel">Laravel</option>
                                        <option value="Others">Others</option>
                                </select>
                            </div>
                            <div class="col-sm-4"> 
                                <div class="form-group">
                                    <label>Client Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option selected disabled> -- Select Status --</option>
                                            <option value="Active">Active</option>
                                            <option value="Not Active">Not Active</option>
                                            <option value="Top Priority">Top Priority</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-sm-6"> 
                                <div class="form-group">
                                    <label>Web URL</label>
                                    <input required class="form-control @error('website_url') is-invalid @enderror" type="url" id="website_url" name="website_url" value="{{ old('website_url') }}" placeholder="Example: https://www.example.com"
                                        oninvalid="this.setCustomValidity('Please Enter valid Webiste URL')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                            <div class="col-sm-6"> 
                                <div class="form-group">
                                    <label>Staging URL</label>
                                    <input required class="form-control @error('staging_url') is-invalid @enderror" type="url" id="staging_url" name="staging_url" value="{{ old('staging_url') }}" placeholder="Example: https://staging.example.com"
                                        oninvalid="this.setCustomValidity('Please Enter valid Staging URL')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="user">Team Member</label>
                                    <select multiple class="form-control @error('user') is-invalid @enderror" name="user[]" id="user">
                                        <option selected disabled>Select Team</option>
                                        @foreach ($user as $orang)
                                        @if ($orang->role_name == 'Team Member' )
                                            <option value="{{ $orang->id}}">{{ $orang->name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Create Project</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Project Modal -->

    <!-- Add Task Modal -->
    <div id="add_task" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title header-title">Add New Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin/task/save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row"> 
                            <div class="col-sm-12"> 
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Task Name</label>
                                    <input required class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Enter Name"
                                        oninvalid="this.setCustomValidity('Please Enter valid Task Name')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-sm-4"> 
                                <label>Project</label>
                                <select required class="form-control" name="project_id" id="project_id">
                                    <option selected disabled value=""> -- Select Project --</option>
                                    @foreach ($project as $proyek)
                                    <option value="{{ $proyek->id }}">{{ $proyek->projectname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4"> 
                                <label>User Assignee</label>
                                <select required class="form-control" name="user_id" id="user_id">
                                    <option selected disabled value=""> -- Select User --</option>
                                    @foreach ($user as $orang )
                                    @if ($orang->role_name != 'Client')
                                        <option value="{{ $orang->id }}">{{ $orang->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4"> 
                                <div class="form-group">
                                    <label>Task Due Date</label>
                                    <input required class="form-control date-picker @error('duedate') is-invalid @enderror" type="date" id="duedate" name="duedate" value="{{ old('duedate') }}"
                                        oninvalid="this.setCustomValidity('Please Enter valid Date')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-sm-6"> 
                                <label>Status</label>
                                <select required class="form-control" name="status" id="status">
                                    <option selected disabled value=""> -- Select Status --</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Wait for Review">Wait for Review</option>
                                        <option value="Completed">Completed</option>
                                </select>
                            </div>
                            <div class="col-sm-6"> 
                                <div class="form-group">
                                    <label>Work Durations (hour:minute)</label>
                                    <input required class="form-control @error('work_time') is-invalid @enderror" type="time" id="work_time" name="work_time" value="00:00" placeholder="Enter Time Worked"
                                        oninvalid="this.setCustomValidity('Please Enter valid Time <00:00>')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6"> 
                                <div class="form-group">
                                    <label>Billable Hours (hour:minute)</label>
                                    <input class="form-control @error('billing') is-invalid @enderror" type="time" id="billing" name="billing" value="00:00" placeholder="Enter Time Worked">
                                </div>
                            </div>
                            <div class="col-sm-6"> 
                                <div class="form-group">
                                    <label>Billed Status</label>
                                    <select class="form-control" name="billed" id="billed">
                                        <option selected disabled value=""> -- Billed Status --</option>
                                            <option value="Billed">Billed</option>
                                            <option value="Waived">Waived</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-sm-12"> 
                                <label for="notes">Notes</label>
                                <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" value="{{ old('notes') }}" type="text" id="notes" placeholder="Enter notes" cols="30" rows="4"></textarea>
                                @error('notes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer">
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Create Task</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Task Modal -->

    <!-- Add User Modal -->
    <div id="add_user" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title header-title">Add New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user/add/save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row"> 
                            <div class="col-sm-8"> 
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Full Name</label>
                                    <input required class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Enter Full Name"
                                        oninvalid="this.setCustomValidity('Please Enter valid Name')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                            <div class="col-sm-4"> 
                                <label>Role Name</label>
                                <select required class="form-control" name="role_name" id="role_name">
                                    <option selected disabled value=""> -- Select Role --</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Team Member">Team Member</option>
                                        <option value="Client">Client</option>
                                </select>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-sm-8"> 
                                <div class="form-group">
                                    <label for="email" class="col-form-label example-email-input">Email</label>
                                    <input required class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Example: example@gmail.com"
                                    oninvalid="this.setCustomValidity('Please Enter valid Email')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                            <div class="col-sm-4"> 
                                <div class="form-group">
                                    <label for="phone" class="col-form-label example-tel-input">Phone</label>
                                    <input required class="form-control @error('phone') is-invalid @enderror" type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Example: 08xxx"
                                        oninvalid="this.setCustomValidity('Please Enter valid Number')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-sm-6"> 
                                <div class="form-group">
                                    <label for="password" class="col-form-label">Password</label>
                                    <input required title="8 characters minimum" class="form-control @error('password') is-invalid @enderror" type="password" id="password" name="password" value="{{ old('password') }}" placeholder="Enter Password" pattern=".{8,}">
                                </div>
                            </div>
                            <div class="col-sm-6"> 
                                <div class="form-group">
                                    <label for="password_confirmation" class="col-form-label">Password Confirmation</label>
                                    <input required class="form-control @error('password_confirmation') is-invalid @enderror" type="password" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Repeat Password"
                                        oninvalid="this.setCustomValidity('Please Enter valid Password')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Add User</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add User Modal -->


@endsection
