{{-- each my project --}}


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
                                    <li class="breadcrumb-item"><a href="{{ url('member/project/') }}">Project</a></li>
                                    <li class="breadcrumb-item"><a class="active" href="#">{{ $project->projectname }}</a></li>
                                </ol>
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
                
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <h4 class="mt-2 ml-3 header-title text-left">Project {{ $project->projectname }}</h4>
                                </p>
                                @foreach ($videos as $video)
                                    <iframe width="720" height="540" src="https://www.youtube.com/embed/{{ $video->video }}"></iframe>
                                    <h6 class="text-capitalize font-weight-bold text-center">{{ $video->title }}</h6>
                                    <h6 class="text-center">{{ $video->description }}</h6>
                                @endforeach
                                
                                <button type="submit" class="btn btn-sm btn-success waves-effect waves-light mt-5 mr-2">
                                    <a href="{{ url('member/quiz/'.$project->id)}}" style="font-size: 16px">Quiz</a>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end page-title -->
            {{-- </div> --}}
            <!-- container-fluid -->
        </div>
    </div>
    <!-- content --> 
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
                    <form action="{{ url('member/task/save') }}" method="POST" enctype="multipart/form-data">
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
                            <div class="col-sm-6"> 
                                <label>Project</label>
                                <select required class="form-control" name="project_id" id="project_id">
                                    {{-- <option selected disabled> -- Select Project--</option> --}}
                                    {{-- @foreach ($project as $proyek) --}}
                                    <option value="{{ $project->id }}">{{ $project->projectname }}</option>
                                    {{-- @endforeach --}}
                                </select>
                            </div>
                            <div class="col-sm-6"> 
                                <label>User Assignee</label>
                                <select required class="form-control" name="user_id" id="user_id">
                                    <option selected disabled value=""> -- Select User --</option>
                                    {{-- @foreach ($position as $positions ) --}}
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    {{-- @endforeach --}}
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row"> 
                            <div class="col-sm-4"> 
                                <label>Status</label>
                                <select required class="form-control" name="status" id="status">
                                    <option selected disabled value=""> -- Select Status --</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Wait for Review">Wait for Review</option>
                                        <option value="Completed">Completed</option>
                                </select>
                            </div>
                            <div class="col-sm-4"> 
                                <div class="form-group">
                                    <label>Work Durations (hour:minute)</label>
                                    <input required class="form-control @error('work_time') is-invalid @enderror" type="time" id="work_time" name="work_time" value="00:00"
                                        oninvalid="this.setCustomValidity('Please Enter valid Time <00:00>')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                            <div class="col-sm-4"> 
                                <div class="form-group">
                                    <label>Due Date</label>
                                    <input required class="form-control date-picker @error('duedate') is-invalid @enderror" type="date" id="duedate" name="duedate" value="{{ old('duedate') }}"
                                        oninvalid="this.setCustomValidity('Please Enter valid Date')" oninput="setCustomValidity('')">
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
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Task Modal -->

    <!-- Edit Task Modal -->
    <div id="edit_task" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title header-title">Edit Task</h5>
                    <div class="row">
                        <div class="col-lg-auto">
                            <h6 class="header-title"> Timer: <b class="header-title" id="stopwatch">00:00:00</b> </h6>
                            <button class="btn btn-sm text-primary" onclick="startTimer()" style="background-color: #eee; font-size: 10px">Start</button>
                            <button class="btn btn-sm text-warning" onclick="pauseTimer()" style="background-color: #eee; font-size: 10px">Pause</button>
                            <button class="btn btn-sm text-danger" onclick="stopTimer()" style="background-color: #eee; font-size: 10px">Stop</button>
                        </div>
                        <div class="col">                    
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="{{ route('member/task/update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input hidden class="col-sm-6 form-control" type="text" name="id" id="id" value="">
                        <div class="row"> 
                            <div class="col-sm-12"> 
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Task Name</label>
                                    <input class="form-control" type="text" id="e_name" name="name" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-sm-6"> 
                                <label>Project</label>
                                <select class="form-control" name="project_id">
                                    {{-- <option selected disabled>{{ $task[0]->project->projectname }}</option> --}}
                                    {{-- @foreach ($project as $proyek) --}}
                                    <option value="{{ $project->id }}">{{ $project->projectname }}</option>
                                    {{-- @endforeach --}}
                                </select>
                            </div>
                            <div class="col-sm-6"> 
                                <label>User Assignee</label>
                                <select class="form-control" name="user_id" id="e_user_id">
                                    {{-- <option selected disabled>{{ $user->name }}</option> --}}
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row"> 
                            <div class="col-sm-4"> 
                                <label>Status</label>
                                <select class="form-control" name="status" id="e_status">
                                    {{-- <option selected disabled>{{ $task[0]->status }}</option> --}}
                                    <option value="In Progress">In Progress</option>
                                    <option value="Wait for Review">Wait for Review</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                            <div class="col-sm-4"> 
                                <div class="form-group">
                                    <label>Work Durations (hour:minute)</label>
                                    <input required class="form-control" type="time" id="e_work_time" name="work_time" value="00:00">
                                </div>
                            </div>
                            <div class="col-sm-4"> 
                                <div class="form-group">
                                    <label>Due Date</label>
                                    <input class="form-control date-picker" type="date" id="e_duedate" name="duedate" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-sm-12"> 
                                <label for="notes">Notes</label>
                                <textarea class="form-control" name="notes" value="" type="text" id="e_notes"  cols="30" rows="4"></textarea>
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
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Task Modal -->

    <script>
        $(document).ready( function() {
            $('table#datatable').DataTable({
                "searching": true,
                "paging":true,
                "ordering":true,
                "columnDefs":[{
                    "targets":[4,7,8], 
                    "orderable":false,
                }]
            });
        });
    </script>

@endsection
