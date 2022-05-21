


@extends('layouts.app')
@section('content')
    <div class="error-bg"></div>
    <!-- Begin page -->
    <div class="home-btn d-none d-sm-block">
        <a href="{{ route('home') }}" class="text-white"><i class="mdi mdi-home h1"></i></a>
    </div>
    <div class="wrapper-page">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-5">
                    <div class="card card-pages shadow-none mt-4">
                        <div class="text-center p-3">
                            <div class="img">
                                <img src="{{URL::to('assets/images/error.png')}}" class="img-fluid" alt="">
                            </div>
                            <h1 class="error-page mt-5"><span>500!</span></h1>
                            <h4 class="mb-4 mt-5">Sorry, page not found</h4>
                            <p class="mb-4 w-75 mx-auto">It will be as simple as Occidental in fact, it will Occidental to an English person</p>
                            <a class="btn btn-primary mb-4 waves-effect waves-light" href="{{ route('home') }}"><i class="mdi mdi-home"></i> Back to Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
@endsection