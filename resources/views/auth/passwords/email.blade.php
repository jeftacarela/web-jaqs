
@extends('layouts.app')
@section('content')
    <div class="accountbg"></div>
    <!-- Begin page -->
    {{-- <div class="home-btn d-none d-sm-block">
        <a href="index.html" class="text-white"><i class="mdi mdi-home h1"></i>
        </a> 
    </div> --}}
    <div class="wrapper-page">
        <div class="container">
            <div class="row row justify-content-center">
                <div class="col-lg-5">
                    <div class="card card-pages shadown-none mt-4">
                        <div class="card-log" style="color: #2c3749">
                           
                            <div class="text-center mt-0 mb-3">
                                <a href="{{ route('home') }}" class="logo logo-admin"> <img src="assets/images/logo-light.png" class="mt-3" alt="" width="200"></a>
                                <p class="text-muted mx-auto mb-4 mt-4">Enter your email address and we'll send you an email with instructions to reset your password.</p>
                            </div>
                            {{-- message --}}
                            {!! Toastr::message() !!}
                            <form method="POST" action="/forget-password" class="form-horizontal mt-4">
                                @csrf
                                <div class="form-group">
                                    <div class="col-12">
                                        <label class="text-muted" for="email">Email</label>
                                        <input class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" type="text" name="email" id="email" placeholder="Enter Registered Email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group text-center mt-3">
                                    <div class="col-12">
                                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Send Email</button>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12 text-center">
                                        <p class="text-muted mb-2">Back to <a href="{{ route('login') }}" class="ml-1"><b>Log in</b></a></p>
                                    </div>
                                    <!-- end col -->
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