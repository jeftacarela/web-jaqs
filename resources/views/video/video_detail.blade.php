
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
                                    <li class="breadcrumb-item"><a class="active" href="{{ url('admin/video/show') }}">Videos</a></li>
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
                    {{-- <form action="{{ route('admin/task/show/search') }}" method="POST" enctype="multipart/form-data">
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
                                                        @foreach ($user as $orang )
                                                            @if ($orang->role_name != 'Client')
                                                                <option value="{{ $orang->id }}">{{ $orang->name }}</option>
                                                            @endif
                                                        @endforeach
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
                    </form> --}}
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
                                <h4 class="mt-2 ml-3 header-title">Videos Datatable</h4>
                                </p>
                                <table name="video" id="datatable" class="table dt-responsive text-center" 
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%; font-size: 14px" data-cols-width="">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="max-width: 5%">No</th>
                                            <th data-exclude="true" hidden>ID</th>
                                            <th data-exclude="true" hidden>Topic ID</th>
                                            <th style="max-width: 12%" data-bs-toggle="tooltip" data-bs-placement="top" title="Name of Project">Topic</th>
                                            <th hidden>Duration</th>
                                            <th data-exclude="true" style="max-width: 8%" data-bs-toggle="tooltip" data-bs-placement="top" title="Work Time (hour:minute)">Duration</th>
                                            <th hidden>Video</th>
                                            <th style="max-width: 12%" title="link">Youtube Link</th>
                                            <th style="max-width: 12%" title="Description">Description</th>
                                            <th style="max-width: 10%" title="Action for each video" class="text-center" data-exclude="true">Modify</th>
                                        </tr>    
                                    </thead>

                                    <tbody>
                                    @foreach ($data as $key => $item)
                                        <tr>
                                            <td class="no">{{ ++$key }}</td>
                                            <td data-exclude="true" hidden class="id">{{ $item->id }}</td>
                                            <td data-exclude="true" hidden class="project_id">{{ $item->projects->id }}</td>
                                            <td class="projectname">{{ $item->projects->projectname }}</td>   
                                            @php
                                                $hour    = 0;
                                                $minute  = 0;

                                                $waktu   = $item->duration;
                                                $parsed  = date_parse($waktu);
                                                $hour    = $hour + $parsed['hour'];
                                                $minute  = $minute + $parsed['minute'];
                                            @endphp
                                            <td hidden class="duration">{{ sprintf("%02d",$hour) }}:{{ sprintf("%02d",$minute) }}</td>
                                            <td data-exclude="true" class="text-center">{{ $hour }}h:{{ $minute }}m</td>
                                            <td hidden data-exclude="true" class="video text-center">{{ $item->video }}</td>
                                            <td data-exclude="true" class="text-center">
                                                <iframe width="200" height="100" src="https://www.youtube.com/embed/{{ $item->video }}">
                                                </iframe>
                                            </td>
                                            <td data-exclude="true" class="description text-justify">{{ $item->description }}</td>
                                            <td class="text-center" data-exclude="true">
                                                <a href="#" class="videoUpdate mr-2" data-toggle="modal" data-id="'$item->id'" data-target="#edit_video">
                                                    <i class="fas fa-edit" style="color: #0ee7e3"></i></a>
                                                <a href="{{ url('admin/video/delete/'.$item->id) }}" onclick="return confirm('Are you sure to want to delete it?')" style="color: #fb4365">
                                                    <i class="fas fa-trash-alt" style="color: #fb4365"></i></a>
                                            </td>   
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <div class="col-12 d-flex mb-3">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            <a href="#" data-toggle="modal" data-target="#add_video"><i class="fa fa-plus"></i> Add Video</a>
                                        </button>
                                    </div>
                                </table>
                                <div class="col-12 d-flex justify-right mt-3 mb-2">
                                    <button id="btn-export" onclick="exportReportToExcel('Team')" class="btn btn-success waves-effect">
                                        <i class="mdi mdi-file-excel" style="font-size: 20px"></i> Export Task</b>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end page-title -->
            </div>
            <!-- container-fluid -->
        </div>
    </div>
    <!-- content --> 

    <!-- Add Video Modal -->
    <div id="add_video" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title header-title">Add Video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin/video/save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-8"> 
                                <label>Topic</label>
                                <select required class="form-control" name="project_id" id="project_id">
                                    <option selected disabled value=""> -- Select Topic --</option>
                                    @foreach ($project as $proj) 
                                        <option value={{$proj->id}}>{{$proj->projectname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3"> 
                                <div class="form-group">
                                    <label>Durations (hour:minute)</label>
                                    <input required class="form-control @error('duration') is-invalid @enderror" type="time" id="duration" name="duration" value="00:00" placeholder="Enter Time Worked"
                                        oninvalid="this.setCustomValidity('Please Enter valid Time <00:00>')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-11">
                                <div class="form-group"></div>
                                <label>Video</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">https://www.youtube.com/watch?v=</div>
                                    </div>
                                    <input required class="form-control @error('video_url') is-invalid @enderror" type="text" id="video" name="video" value="{{ old('video') }}"
                                    oninvalid="this.setCustomValidity('Please Enter valid Webiste URL')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12"> 
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <br>
                                    <textarea name="description" id="description" cols="100" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Add Video</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Video Modal -->

    <!-- Edit Video Modal -->
    <div id="edit_video" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title header-title">Edit Video</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ url('admin/video/update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input hidden class="col-sm-6 form-control" type="text" name="id" id="id" value="">
                        <div class="row"> 
                            <div class="col-sm-6"> 
                                <label>Project</label>
                                <select class="form-control" name="project_id" id="e_project_id">
                                    @foreach ($project as $proyek)
                                        <option value="{{ $proyek->id }}">{{ $proyek->projectname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4"> 
                                <div class="form-group">
                                    <label>Work Durations (hour:minute)</label>
                                    <input required class="form-control" type="time" id="e_duration" name="duration" value="00:00">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-11">
                                <div class="form-group"></div>
                                <label>Video</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">https://www.youtube.com/watch?v=</div>
                                    </div>
                                    <input required class="form-control @error('video_url') is-invalid @enderror" type="text" id="e_video" name="video" value="{{ old('video') }}"
                                    oninvalid="this.setCustomValidity('Please Enter valid Webiste URL')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-sm-12"> 
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" value="" type="text" id="e_description"  cols="30" rows="4"></textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer">
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Save</button>
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
                    "targets":[7,9], 
                    "orderable":false,
                }]
            });
        });
    </script>

@endsection
