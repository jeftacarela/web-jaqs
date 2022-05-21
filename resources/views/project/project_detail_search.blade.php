
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
                                    <li class="breadcrumb-item"><a class="active" href="{{ url('admin/project/show') }}">Project</a></li>
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
                    <form action="{{ route('admin/project/show/search') }}" method="POST" enctype="multipart/form-data">
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
                                                        @foreach ($orang as $user )
                                                            @if ($user->role_name != 'Client')
                                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
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
                                                            <option value="Active">Active</option>
                                                            <option value="Not Active">Not Active</option>
                                                            <option value="Top Priority">Top Priority</option>
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
                                <h4 class="mt-2 ml-3 header-title">Project Datatable</h4>
                                </p>
                                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; font-size: 14px">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th hidden>ID</th>
                                            <th data-bs-toggle="tooltip" data-bs-placement="top" title="Name of Project">Project Name</th>
                                            <th data-bs-toggle="tooltip" data-bs-placement="top" title="Team Assinee">Assignee</th>
                                            <th data-bs-toggle="tooltip" data-bs-placement="top" title="Type of Project">Project Type</th>
                                            <th hidden>Due Date</th>
                                            <th data-bs-toggle="tooltip" data-bs-placement="top" title="Client's Contact Person">Contact</th>
                                            <th hidden>Web URL</th>
                                            <th hidden>Staging URL</th>
                                            <th hidden>Status</th>
                                            <th data-bs-toggle="tooltip" data-bs-placement="top" title="Action for each project" class="text-center">Modify</th>
                                        </tr>    
                                    </thead>

                                    <tbody>

                                    @php
                                        // Array temporary Storage
                                        $temp = array();
                                    @endphp

                                    @foreach ($data as $key => $item)

                                        @php
                                            // Cek unique projectname
                                            if (in_array($item->projectname, $temp)){
                                                continue;
                                            } else {
                                                array_push($temp, $item->projectname);
                                            }
                                        @endphp                 

                                        <tr>
                                            <td class="no">{{ ++$key }}</td>
                                            <td hidden class="id">{{ $item->id }}</td>
                                            <td class="projectname">
                                                @foreach ($project as $proyek)
                                                    @if ($proyek->id == $item->id)
                                                        {{ $proyek->projectname }}    
                                                    @endif                                                
                                                @endforeach
                                            </td>
                                            <td class="user">
                                                {{-- @foreach ($item->user as $user) --}}
                                                {{-- @if ($item->role_name != 'Client') --}}
                                                    {{-- <h5><span class="badge badge-info">{{ $item->name }}</span></h5> --}}
                                                {{-- @endif --}}
                                                {{-- @endforeach --}}
                                                @foreach ($orang as $user)
                                                    @foreach ($user->project as $projectuser)
                                                        @if ($projectuser->id == $item->id)
                                                            @if ($user->role_name != 'Client')
                                                                <h6><span class="badge badge-info">{{ $user->name }}</span></h6>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </td>
                                            <td class="project_type">{{ $item->project_type }}</td>
                                            <td hidden class="duedate">{{ $item->duedate }}</td>
                                            <td class="client">
                                                @foreach ($orang as $user)
                                                    @foreach ($user->project as $projectuser)
                                                        @if ($projectuser->id == $item->id)
                                                            @if ($user->role_name == 'Client')
                                                                <h6><span class="badge badge-secondary">{{ $user->name }}</span></h6>
                                                                <h6><span class="badge badge-success">{{ $user->phone }}</span></h6>
                                                                <h6><span class="badge badge-danger">{{ $user->email }}</span></h6>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </td>
                                            <td hidden class="website_url">{{ $item->website_url }}</td>
                                            <td hidden class="staging_url">{{ $item->staging_url }}</td>
                                            <td hidden class="status">{{ $item->status }}</td>
                                            <td class="text-center">
                                                <a href="{{ url('admin/project/view/'.$item->id) }}">
                                                    <i class="fas fa-eye mb-3 mr-2" style="font-size: 20px;color:#d4c220"></i>
                                                </a>
                                                
                                                {{-- <a href="{{ url('admin/project/detail/'.$item->id) }}">
                                                    <i class="fas fa-edit mb-3" style="font-size: 25px;color:#20d4b6"></i>
                                                </a> --}}
                                                <a href="#" class="projectUpdate" data-toggle="modal" data-id="'$item->id'" data-target="#edit_project">
                                                    <i class="fas fa-edit mr-4" style="font-size: 20px;color:#20d4b6"></i></a>
                                                <a href="{{ url('admin/project/delete/'.$item->id) }}" onclick="return confirm('Are you sure to want to delete it?')">
                                                    <i class="fas fa-trash-alt" style="font-size: 20px;color:#a79c9e"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <div class="col-12 d-flex mb-2">
                                        {{-- <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            <a href="{{ route('admin/project/new') }}">Add Project</a>
                                        </button> --}}
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            <a href="#" data-toggle="modal" data-target="#add_project">Create Project</a>
                                        </button>
                                    </div>
                                </table>
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
                                    @foreach ($orang as $user)
                                    @if ($user->role_name == 'Client')
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
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
                                        @foreach ($orang as $user)
                                        @if ($user->role_name == 'Team Member' )
                                            <option value="{{ $user->id}}">{{ $user->name}}</option>
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

    <!-- Edit Project Modal -->
    <div id="edit_project" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title header-title">Edit Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin/project/update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id" value="">
                        <div class="row"> 
                            <div class="col-sm-8"> 
                                <div class="form-group">
                                    <label for="projectname" class="col-form-label">Project Name</label>
                                    <input class="form-control" type="text" id="e_projectname" name="projectname" value="">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="duedate">Due Date</label>
                                    <input class="form-control" type="date" id="e_duedate" name="duedate" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-sm-4"> 
                                <label>Client Name</label>
                                <select class="form-control" name="client" id="e_client">
                                    <option selected disabled>Select Client Name</option>
                                    @foreach ($orang as $user)
                                    @if ($user->role_name == 'Client')
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4"> 
                                <label>Type of Project</label>
                                <select class="form-control" name="project_type" id="e_project_type">
                                    {{-- <option selected disabled>Select Type of Project</option> --}}
                                        <option value="WordPress">WordPress</option>
                                        <option value="Laravel">Laravel</option>
                                        <option value="Others">Others</option>
                                </select>
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
                        </div>
                        <div class="row"> 
                            <div class="col-sm-6"> 
                                <div class="form-group">
                                    <label>Web URL</label>
                                    <input class="form-control" type="url" id="e_website_url" name="website_url" value="{{ old('website_url') }}" placeholder="Enter Website URL">
                                </div>
                            </div>
                            <div class="col-sm-6"> 
                                <div class="form-group">
                                    <label>Staging URL</label>
                                    <input class="form-control" type="url" id="e_staging_url" name="staging_url" value="{{ old('staging_url') }}" placeholder="Enter Staging URL">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="user">Team Member</label>
                                    <select required class="form-control" multiple="" name="user[]" id="e_user">
                                        <option selected disabled>Select Team</option>
                                        @foreach ($orang as $user)
                                        @if ($user->role_name == 'Team Member' )
                                            <option value="{{ $user->id}}">{{ $user->name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Edit Project</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Project Modal -->

    <script>
        $(document).ready( function() {
            $('table#datatable').DataTable({
                "searching": true,
                "paging":true,
                "ordering":true,
                "columnDefs":[{
                    "targets":[6,10], 
                    "orderable":false,
                }]
            });
        });
    </script>

@endsection
