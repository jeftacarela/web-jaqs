
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
                                    <li class="breadcrumb-item"><a class="active" href="{{ route('user/management') }}">User Management</a></li>
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
                        <script>
                        $('#add_user').modal('show');</script>
                    @endforeach
                @endif
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-2 ml-3 header-title" id="title">User Management Datatable</h4>
                                </p>
                                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" data-cols-width="5,15,30,20,20">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th data-exclude="true" hidden>ID</th>
                                            <th>Full Name</th>
                                            <th>Email Address</th>
                                            <th>Phone Number</th>
                                            <th>Role Name</th>
                                            <th class="text-center" data-exclude="true">Modify</th>
                                        </tr>    
                                    </thead>

                                    <tbody>
                                    @foreach ($user as $key => $item)
                                        <tr>
                                            <td class="No">{{ ++$key }}</td>
                                            <td data-exclude="true" hidden class="id">{{ $item->id }}</td>
                                            <td class="name">{{ $item->name }}</td>                                            
                                            <td class="email">{{ $item->email }}</td>
                                            <td class="phone">{{ $item->phone }}</td>

                                            
                                            <td class="role_name">
                                                @if($item->role_name =='Admin')
                                                    <span  class="badge bg-success" style="font-size: 12px;color: #eee">{{ $item->role_name }}</span>
                                                @else
                                                    @if($item->role_name =='Team Member')
                                                        <span  class="badge bg-info" style="font-size: 12px;color: #eee">{{ $item->role_name }}</span>
                                                    @else
                                                        <span  class=" badge bg-danger" style="font-size: 12px;color: #eee">{{ $item->role_name }}</span>
                                                    @endif
                                                @endif
                                            </td>

                                            {{-- <td class="name">
                                                <div class="d-flex mr-3 rounded-circle thumb-md">
                                                    <img class="d-flex mr-3 rounded-circle thumb-md" src="{{ URL::to('/images/'. $item->avatar) }}" alt="{{ $item->avatar }}">
                                                </div>
                                            </td> --}}
                                                                                        
                                            <td class="text-center" data-exclude="true">
                                                <button type="submit" class="btn btn-success btn-sm waves-effect waves-light mr-2">
                                                    <a href="#" class="userUpdate" data-toggle="modal" data-id="'$item->id'" data-target="#edit_user">
                                                        {{-- <i class="fas fa-edit mr-3" style="font-size: 20px;color:#20d4b6"></i> --}}
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a><br>
                                                </button>
                                                {{-- <a href="{{ url('admin/profile/changePassword/'.$item->id) }}" class="text-warning">Change Password</a>
                                                </a><br><br> --}}
                                                <button type="submit" class="btn btn-danger btn-sm ">
                                                    <a href="{{ url('delete_user/'.$item->id) }}" style="color: #eee" onclick="return confirm('Are you sure to want to delete it?')">
                                                        {{-- <i class="fas fa-trash-alt" style="font-size: 20px;color:#fb4365"></i> --}}
                                                        <i class="fas fa-trash-alt" style="color: #cfacb"></i> Delete
                                                    </a>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <div class="col-12 d-flex mb-2">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light mb-2">
                                            {{-- <a href="{{ route('user/add/new') }}">Add User</a> --}}
                                            <a href="#" data-toggle="modal" data-target="#add_user">Add User</a>
                                        </button>
                                    </div>
                                </table>
                            {{-- <div class="col-12 d-flex justify-right mt-3 mb-2">
                                <button id="btn-export" onclick="exportReportToExcel('User')" class="btn btn-success waves-effect mt-2">
                                    <i class="mdi mdi-file-excel" style="font-size: 20px"></i> Export Task</b>
                                </button>
                            </div> --}}
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

    <!-- Edit User Modal -->
    <div id="edit_user" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title header-title">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input hidden type="text" name="id" id="id" value="">
                        <div class="row"> 
                            <div class="col-sm-8"> 
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Full Name</label>
                                    <input class="form-control" type="twxt" id="e_name" name="name" value="">
                                </div>
                            </div>
                            <div class="col-sm-4"> 
                                <label>Role Name</label>
                                <select required class="form-control" name="role_name" id="e_role_name">
                                    <option selected disabled value="">-- Select Role --</option>
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
                                    <input class="form-control" type="email" id="e_email" name="email" value="">
                                </div>
                            </div>
                            <div class="col-sm-4"> 
                                <div class="form-group">
                                    <label for="phone" class="col-form-label example-tel-input">Phone</label>
                                    <input class="form-control" type="tel" id="e_phone" name="phone" value="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Edit User</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit User Modal -->

    <script>
        $(document).ready( function() {
            $('table#datatable').DataTable({
                "searching": true,
                "paging":true,
                "ordering":true,
                "columnDefs":[{
                    "targets":[3,4,6], 
                    "orderable":false,
                }]
            });
        });
    </script>
    
@endsection
