
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
                    <div class="card card-pages shadow-lg p-3 mb-5 bg-dark rounded mt-4">
                        <div class="card-log" style="color: #2c3749">
                            <div class="text-center mt-0 mb-3">
                                {{-- <h1 style="font-family: Josefin Sans, sans-serif; line-height: 60pt;margin-bottom: 0px; margin: 0px">Cabaretti</h1> --}}
                                {{-- <h6 style="font-family: Josefin Sans, sans-serif; line-height: 60pt; margin-block-start: 0.83em">Performance Web Design & Development</h6> --}}
                                {{-- <a href="index.html" class="logo logo-admin"> --}}
                                    {{-- <img src="{{ URL::to('assets/images/logo-light.png') }}" class="mt-3" alt="" height="26"></a> --}}
                                    <img src="images/jaqs-light-nobg.png" class="mt-3" width="200" alt=""></a>
                                {{-- <p class="text-muted w-75 mx-auto mb-4 mt-4">Enter your email address and password to access admin panel.</p> --}}
                            </div>
                            {{-- message --}}
                            {!! Toastr::message() !!}
                            <h2 class="text-light text-center">Proceed To Quiz ? </h2>
                            <div class="form-group text-center mt-4">
                                <div class="col-12">
                                    <a href="{{ route('member/quiz/view', [$quiz_id]) }}">
                                        <button class="btn btn-primary btn-block waves-effect waves-light" type=""> Proceed to Quiz</button><br>
                                    </a>
                                </div>
                            </div>
                            <a class="text-muted ml-3" href="{{ url('member/project/view/'.$quiz_id) }}"><u>Back</u></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
@endsection
