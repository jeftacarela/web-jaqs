@extends('layouts.app')
@section('content')
    <div class="accountbg"></div>
    <!-- Begin page -->
    {{-- <div class="home-btn d-none d-sm-block">
        <a href="index.html" class="text-white"><i class="mdi mdi-home h1"></i></a>
    </div> --}}
    <div class="wrapper-page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card card-pages mt-4">
                        <div class="card-log">
                            <div class="text-center mt-0 mb-3">
                                {{-- <a href="index.html" class="logo logo-admin"> --}}
                                    {{-- <img src="{{ URL::to('assets/images/logo-light.png') }}" class="mt-3" alt="" height="26"> --}}
                                    <img src="images/cabaretti.png" class="mt-3" width="200" alt="">
                                </a>
                                <p class="text-muted w-75 mx-auto mb-4 mt-4">Don't have an account? Create your account, it takes less than a minute</p>
                            </div>

                            <form method="POST" action="{{ route('register') }}" class="form-horizontal mt-4">
                                @csrf
                                <div class="form-group">
                                    <div class="col-12">
                                        <label class="text-muted" for="usermenu">Username</label>
                                        <input class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" type="text" id="username" placeholder="Enter username">
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- insert defaults --}}
                                {{-- <input type="hidden" class="image" name="image" value="photo_defaults.jpg"> --}}
                                <div class="form-group">
                                    <div class="col-12">
                                        <label class="text-muted" for="email">Email</label>
                                        <input class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" type="text" id="email" placeholder="Enter email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-12">
                                        <label class="text-muted" for="phone">Phone Number</label>
                                        <input class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" type="tel" id="phone" placeholder="Enter phone number">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-12">
                                        <label class="text-muted" for="role_name">Role Name</label>
                                        <select class="form-control @error('role_name') is-invalid @enderror" name="role_name" id="role_name">
                                            <option selected disabled>Select Role Name</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Team Member">Team Member</option>
                                            <option value="Client">Client</option>
                                        </select>
                                    </div>
                                    @error('role_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="col-12">
                                        <label class="text-muted" for="password">Password</label>
                                        <input class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" type="password" id="password" placeholder="Enter password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-12">
                                        <label class="text-muted" for="password">Password confirm</label>
                                        <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder="Enter password confirm">
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label font-weight-normal" for="customCheck1">I accept <a href="#" class="text-primary">Terms and Conditions</a></label>
                                    </div>
                                </div> --}}
                                <div class="form-group text-center mt-4">
                                    <div class="col-12">
                                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Register</button>
                                    </div>
                                </div>
                                <div class="form-group text-center mt-2 mb-6">
                                    <div class="col-12">
                                        <a href="{{ route('login') }}" class="text-muted">Already have account?</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
@endsection