
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
                                    <li class="breadcrumb-item active">User / Management / View Detail</li>
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
                                    <form class="form form-horizontal" action="{{ route('form/information/update') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Name</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">
                                                            <select class="form-control @error('role_name') is-invalid @enderror" name="user_id" id="user_id">
                                                                <option selected disabled>Select Username</option>
                                                                @foreach ($orang as $nama)
                                                                    @if ($nama->role_name == 'Client' )
                                                                        <option value="{{ $nama->id }}">{{ $nama->name }}</option>        
                                                                    @endif                                                                                                    
                                                                @endforeach
                                                            </select>
                                                            {{-- <input type="text" class="form-control"
                                                                placeholder="Name" id="first-name-icon" name="user_id" value="{{ $data->user_id }}"> --}}
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-person"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- <div class="col-md-4">
                                                    <label>Photo</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-lefts">
                                                        <div class="position-relative">
                                                            <input type="file" class="form-control"
                                                            placeholder="Name" id="first-name-icon" name="image"/>
                                                            <div class="d-flex mr-3 rounded-circle thumb-md">
                                                                <img class="d-flex mr-3 rounded-circle thumb-md" src="{{ URL::to('/images/'. $data[0]->image) }}">
                                                            </div>
                                                            <input type="hidden" name="hidden_image" value="{{ $data[0]->image }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="hidden_image" value="{{ $data[0]->image }}"> --}}
                                                
                                                <div class="col-md-4">
                                                    <label>Company</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">
                                                            <input type="text" class="form-control"
                                                                placeholder="company" id="first-name-icon" name="company" value="{{ $data->company }}">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-person"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                    
                                                <div class="col-md-4">
                                                    <label>Email Address</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">
                                                            <input type="email" class="form-control"
                                                                placeholder="Email" id="first-name-icon" name="email" value="{{ $data->email }}">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-envelope"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Mobile Number</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">
                                                            <input type="number" class="form-control"
                                                                placeholder="Mobile" name="phone" value="{{ $data->phone }}">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-phone"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
{{--                     
                                                <div class="col-md-4">
                                                    <label>Country</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">
                                                            <input type="text" class="form-control"
                                                             placeholder="Country" name="country" value="{{ $data[0]->country }}">
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-success waves-effect waves-light mr-2">Update</button>
                                                    <button  tton type="reset" class="btn btn-danger waves-effect waves-light"><a href="{{ route('form/information/show') }}">Back</a></button>
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
