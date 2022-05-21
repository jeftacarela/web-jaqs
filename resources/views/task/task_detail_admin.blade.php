
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
                                    <li class="breadcrumb-item"><a class="active" href="{{ url('admin/task/show') }}">Task</a></li>
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

                    <!-- Search Filter -->
                    <form action="{{ route('admin/task/me/search') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row ">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row ml-2">
                                            <div class="col-sm-2"> 
                                                <div class="form-group">
                                                    <label class="text-muted">User Assignee</label>
                                                    <select class="form-control" name="user_id" id="user_id">
                                                        <option selected disabled value="">All</option>
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-auto"> 
                                                <div class="form-group">
                                                    <label class="text-muted">Status</label>
                                                    <select  class="form-control" name="status" id="status">
                                                        <option selected value="">All</option>
                                                            <option value="In Progress">In Progress</option>
                                                            <option value="Wait for Review">Wait for Review</option>
                                                            <option value="Completed">Completed</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-auto"> 
                                                <div class="form-group">
                                                    <label class="text-muted">From</label>
                                                    <input  class="form-control date-picker" type="date" id="from" name="from" value="{{ old('duedate') }}"
                                                        oninvalid="this.setCustomValidity('Please Enter valid Date')" oninput="setCustomValidity('')">
                                                </div>
                                            </div>
                                            <div class="col-md-auto"> 
                                                <div class="form-group">
                                                    <label class="text-muted">To</label>
                                                    <input  class="form-control date-picker" type="date" id="to" name="to" value="{{ old('duedate') }}"
                                                        oninvalid="this.setCustomValidity('Please Enter valid Date')" oninput="setCustomValidity('')">
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label for="">&nbsp;</label>
                                                    <button type="submit" class="btn btn-success btn-block submit-btn"> Search </button>
                                                </div>
                                            </div>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- /Search Filter -->

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
                            <div class="card-body">
                                <h4 class="mt-2 ml-3 header-title">Task Datatable</h4>
                                </p>
                                <table id="datatable" class="table table-bordered dt-responsive" 
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%; font-size: 14px" data-cols-width="5,15,30,15,10,10,10,15,30">
                                    <thead>
                                        <tr>
                                            <th style="max-width: 5%">No</th>
                                            <th data-exclude="true" hidden>ID</th>
                                            <th data-exclude="true" hidden>Project ID</th>
                                            <th style="max-width: 12%" data-bs-toggle="tooltip" data-bs-placement="top" title="Name of Project">Project</th>
                                            <th style="max-width: 25%" data-bs-toggle="tooltip" data-bs-placement="top" title="Name of Task">Task Name</th>
                                            <th data-exclude="true" hidden>User ID</th>
                                            <th data-exclude="true" hidden>Assignee</th>
                                            <th style="max-width: 10%" data-bs-toggle="tooltip" data-bs-placement="top" title="Status for Task">Status</th>
                                            <th hidden>Duration</th>
                                            <th data-exclude="true" style="max-width: 8%" data-bs-toggle="tooltip" data-bs-placement="top" title="Work Durations (hour:minute)">Duration</th>
                                            <th hidden>Bill</th>
                                            <th data-exclude="true" style="max-width: 8%" data-bs-toggle="tooltip" data-bs-placement="top" title="Billing Time (hour:minute)">Bill</th>
                                            <th style="max-width: 8%" data-bs-toggle="tooltip" data-bs-placement="top" title="Billing Status">Billed</th>
                                            <th style="max-width: 12%" data-bs-toggle="tooltip" data-bs-placement="top" title="Dateline for each Task">Due Date</th>
                                            <th hidden>Notes</th>
                                            <th style="max-width: 10%" data-bs-toggle="tooltip" data-bs-placement="top" title="Action for each Task" class="text-center" data-exclude="true">Modify</th>
                                        </tr>    
                                    </thead>

                                    <tbody>
                                    @foreach ($data as $key => $item)
                                    @if ($item->user_id == $user->id)
                                        <tr>
                                            <td class="no">{{ ++$key }}</td>
                                            <td data-exclude="true" hidden class="id">{{ $item->id }}</td>
                                            <td data-exclude="true" hidden class="project_id">{{ $item->project->id }}</td>
                                            <td class="projectname">{{ $item->project->projectname }}</td>
                                            <td class="name">{{ $item->name }}</td>
                                            <td data-exclude="true" hidden class="user_id">{{ $item->user->id }}</td>
                                            <td data-exclude="true" hidden class="user">{{ $item->user->name }}</td>
                                            <td class="status">{{ $item->status }}</td>
                                            @php
                                                $hour    = 0;
                                                $minute  = 0;

                                                $waktu   = $item->work_time;
                                                $parsed  = date_parse($waktu);
                                                $hour    = $hour + $parsed['hour'];
                                                $minute  = $minute + $parsed['minute'];
                                            @endphp
                                            <td hidden class="work_time">{{ sprintf("%02d",$hour) }}:{{ sprintf("%02d",$minute) }}</td>
                                            <td data-exclude="true" class="text-center">{{ $hour }}h:{{ $minute }}m</td>

                                            @php
                                                $hour    = 0;
                                                $minute  = 0;

                                                $waktu   = $item->billing;
                                                $parsed  = date_parse($waktu);
                                                $hour    = $hour + $parsed['hour'];
                                                $minute  = $minute + $parsed['minute'];
                                            @endphp
                                            <td hidden class="billing">{{ sprintf("%02d",$hour) }}:{{ sprintf("%02d",$minute) }}</td>
                                            <td data-exclude="true" class="text-center">{{ $hour }}h:{{ $minute }}m</td>
                                            <td class="billed">{{ $item->billed }}</td>
                                            <td class="duedate">{{ $item->duedate }}</td>
                                            <td hidden class="notes">{{ $item->notes }}</td>
                                            <td class="text-center" data-exclude="true">
                                                {{-- <a href="{{ route('admin/task/new') }}">
                                                    <i class="fas fa-user-plus" style="font-size: 20px;color:#0e86e7"></i>
                                                </a> --}}
                                                {{-- <a href="{{ url('admin/task/delete/'.$item->id) }}" onclick="return confirm('Are you sure to want to delete it?')"><i class="fas fa-trash-alt" style="font-size: 20px;color:#fb4365"></i></a> --}}
                                                    <a href="#" class="taskUpdate mr-3" data-toggle="modal" data-id="'.$item->id.'" data-target="#edit_task">
                                                        <i class="fas fa-edit" style="color: #0ee7e3"></i></a>
                                                    <a href="{{ url('admin/task/delete/'.$item->id) }}" onclick="return confirm('Are you sure to want to delete it?')" style="color: #cfacb">
                                                        {{-- <i class="fas fa-trash-alt" style="font-size: 20px;color:#fb4365"></i>Delete</a> --}}
                                                        <i class="fas fa-trash-alt" style="color: #fb4365"></i></a>
                                            </td>
                                        </tr>
                                    @endif
                                    @endforeach
                                    </tbody>
                                    <div class="col-12 d-flex mb-3">
                                        {{-- <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            <a href="{{ route('admin/task/new') }}">Add Task</a>
                                        </button> --}}
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            <a href="#" data-toggle="modal" data-target="#add_task"><i class="fa fa-plus"></i> Create Task</a>
                                        </button>
                                    </div>
                                </table>
                            <div class="col-12 d-flex justify-right mt-3 mb-2">
                                <button id="btn-export" onclick="exportReportToExcel('My')" class="btn btn-success waves-effect">
                                    <i class="mdi mdi-file-excel" style="font-size: 20px"></i> Export Task</b>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end page-title -->
            </div>
            <!-- container-fluid -->
            {{-- <div class="row">
                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center p-1">
                                <div class="col-lg-12">
                                    <div class="stopwatch text-dark header-title text-center">Stopwatch</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
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
                                    <option value=""> -- Select Project --</option>
                                    @foreach ($project as $proyek)
                                    <option value="{{ $proyek->id }}">{{ $proyek->projectname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4"> 
                                <label>User Assignee</label>
                                <select required class="form-control" name="user_id" id="user_id">
                                    <option selected disabled value=""> -- Select User --</option>
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
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
                    <form action="{{ route('admin/task/update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input hidden class="col-sm-6 form-control" type="text" name="id" id="id" value="">
                        <div class="row"> 
                            <div class="col-sm-12"> 
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Task Name</label>
                                    <input required class="form-control" type="text" id="e_name" name="name" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-sm-4"> 
                                <label>Project</label>
                                <select class="form-control" name="project_id" id="e_project_id">
                                    @foreach ($project as $proyek)
                                    <option value="{{ $proyek->id }}">{{ $proyek->projectname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4"> 
                                <label>User Assignee</label>
                                <select class="form-control" name="user_id" id="e_user_id">
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                </select>
                            </div>
                            <div class="col-sm-4"> 
                                <div class="form-group">
                                    <label>Task Due Date</label>
                                    <input class="form-control date-picker" type="date" id="e_duedate" name="duedate" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-sm-6"> 
                                <label>Status</label>
                                <select class="form-control" name="status" id="e_status">
                                    <option value="In Progress">In Progress</option>
                                    <option value="Wait for Review">Wait for Review</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                            <div class="col-sm-6"> 
                                <div class="form-group">
                                    <label>Work Durations (hour:minute)</label>
                                    <input required class="form-control" type="time" id="e_work_time" name="work_time" value="00:00">
                                </div>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-sm-6"> 
                                <div class="form-group">
                                    <label>Billable Hours (hour:minute)</label>
                                    <input required class="form-control" type="time" id="e_billing" name="billing" value="00:00">
                                </div>
                            </div>
                            <div class="col-sm-6"> 
                                <label>Billed Status</label>
                                <select class="form-control" name="billed" id="e_billed">
                                    <option value="Billed">Billed</option>
                                    <option value="Waived">Waived</option>
                                </select>
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
                        <div class="modal-footer">
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Edit Task</button>
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
                    "targets":[9,11,12,15], 
                    "orderable":false,
                }]
            });
        });
    </script>

@endsection
