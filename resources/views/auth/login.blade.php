
@extends('layouts.app')
@section('content')
<div class="accountbg"></div>
    <!-- Begin page -->
    {{-- <div class="home-btn d-none d-sm-block">
        <a href="index.html" class="text-white"><i class="mdi mdi-home h1"></i></a>
    </div> --}}
    <div class="wrapper-page">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-5">
                    <div class="card card-pages shadow-none mt-4">
                        <div class="card-log" style="color: #2c3749">
                            <div class="text-center mt-0 mb-3">
                                {{-- <h1 style="font-family: Josefin Sans, sans-serif; line-height: 60pt;margin-bottom: 0px; margin: 0px">Cabaretti</h1> --}}
                                {{-- <h6 style="font-family: Josefin Sans, sans-serif; line-height: 60pt; margin-block-start: 0.83em">Performance Web Design & Development</h6> --}}
                                {{-- <a href="index.html" class="logo logo-admin"> --}}
                                    {{-- <img src="{{ URL::to('assets/images/logo-light.png') }}" class="mt-3" alt="" height="26"></a> --}}
                                    <img src="images/cabaretti.png" class="mt-3" width="200" alt=""></a>
                                {{-- <p class="text-muted w-75 mx-auto mb-4 mt-4">Enter your email address and password to access admin panel.</p> --}}
                            </div>
                            {{-- message --}}
                            {!! Toastr::message() !!}
                            <form method="POST" action="{{ route('login') }}" class="form-horizontal mt-4">
                                @csrf
                                <div class="form-group">
                                    <div class="col-12">
                                        <label class="text-muted" for="username">Email</label>
                                        <input class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" type="email" id="email" name="email" placeholder="Enter email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-12">
                                        <label class="text-muted" for="password">Password</label>
                                        <input class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" type="password" id="password" name="password" placeholder="Enter password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="form-group">
                                    <div class="col-12">
                                        <div class="checkbox checkbox-primary">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                <label class="custom-control-label" for="customCheck1"> Remember me</label>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="form-group text-center mt-4">
                                    <div class="col-12">
                                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
                                    </div>
                                </div>
                                <div class="form-group text-center mt-4">
                                    <div class="col-12">
                                        <div class="float-left">
                                            <a href="{{ route('forget-password') }}" class="text-muted"><i class="fa fa-lock mr-1"></i> Forgot your password?</a>
                                        </div>
                                        <div class="text-right">
                                            <a href="{{ route('register') }}" class="text-muted">Create an account</a>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="text-center">
                                    <p class="mt-4 text-muted">Sign in with</p>
                                    <ul class="social-list list-inline mb-2">
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github-circle"></i></a>
                                        </li>
                                    </ul>
                                </div> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
@endsection
