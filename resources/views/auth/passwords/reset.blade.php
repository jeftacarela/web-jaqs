
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
                        <div class="card-log" style="color: #2c3749">
                            <div class="text-center mt-0 mb-3">
                                <a href="/" class="logo logo-admin">
                                    <img src="{{ URL::to('assets/images/logo-light.png') }}" class="mt-3" alt="" width="200"></a>
                                <p class="text-muted w-75 mx-auto mb-4 mt-4">Input your email to register reset new password.</p>
                            </div>
                            <form method="POST" action="/reset-password" class="form-horizontal mt-4">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                    
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
                                <div class="form-group text-center mt-4">
                                    <div class="col-12">
                                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Reset Password</button>
                                    </div>
                                </div>
                                <div class="form-group text-center mt-3 mb-2">
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