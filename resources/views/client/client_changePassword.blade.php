
@extends('client.client_layout')
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
                                    <li class="breadcrumb-item"><a href="{{ route('client') }}">Client</a></li>
                                    <li class="breadcrumb-item"><a href="{{ url('client/profile/') }}">Profile</a></li>
                                    <li class="breadcrumb-item"><a class="active" href="#">Change Password</a></li>
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
                                    <form class="form form-horizontal" action="{{ route('client/updatePass') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $orang[0]->id }}">
                                        @foreach ($errors->all() as $error)
                                            <p class="text-danger">{{ $error }}</p>
                                        @endforeach
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="password">Current Password</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">
                                                            <input required type="password" class="form-control @error('password') is-invalid @enderror" 
                                                                name="password" value="{{ old('password') }}" id="password" placeholder="Enter password"
                                                                oninvalid="this.setCustomValidity('Please Enter valid Password')" oninput="setCustomValidity('')">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-password"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="new_password">New Password</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">
                                                            <input required title="8 characters minimum" type="password" class="form-control @error('new_password') is-invalid @enderror" 
                                                                name="new_password" value="{{ old('new_password') }}" minlength="8" id="new_password" placeholder="Enter password">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-password"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="new_confirm_password">Password Confirm</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">
                                                            <input required type="password" class="form-control @error('new_confirm_password') is-invalid @enderror" 
                                                                name="new_confirm_password" value="{{ old('new_confirm_password') }}" id="new_confirm_password" placeholder="Enter password"
                                                                oninvalid="this.setCustomValidity('Please Enter valid Password')" oninput="setCustomValidity('')">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-password"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
            
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-info waves-effect waves-light mr-3">Update</button>
                                                    <button type="reset" class="btn btn-danger waves-effect waves-light"><a href="{{ url('client/profile/') }}">Back</a></button>
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
