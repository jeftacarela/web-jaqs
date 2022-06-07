
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
                <div class="col-lg-12">
                    <div class="row">
                        {!! Toastr::message() !!}
                        {{-- <div class="col-sm-6 col-xl-3"> --}}
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center justify-content-center p-1">
                                        <div class="col-lg-10">
                                            <form action="{{ route('member/quiz/submit') }}" method="POST" enctype="multipart/form-data">
                                                <h2 class="header-title text-secondary" style="font-size: 22px">{{ $project->projectname}}</h2><br>
                                                @csrf
                                                <div class="row">
                                                    @foreach ($questions as $num => $question)
                                                        <div class="col-sm-8">
                                                            <div class="form-group"></div>
                                                            <label>{{ ++$num }}. {{ $question->question }}</label>
                                                            @foreach (json_decode($question->option) as $key => $option)
                                                                <div class="input-group mb-2 mr-sm-2">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">{{ $key == 1 ? 'a' : ($key == 2 ? 'b' : ($key == 3 ? 'c' : ($key == 4 ? 'd' : 'e'))) }}</div>
                                                                    </div>
                                                                    {{-- <h6><input type="radio"> {{ $key == 1 ? 'a' : ($key == 2 ? 'b' : ($key == 3 ? 'c' : ($key == 4 ? 'd' : 'e'))) }}. {{ $option }}</h6> --}}
                                                                    <input required class="form-control @error('opt') is-invalid @enderror" type="text" id="opt" name="opt" value="{{ $option }}">
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group"></div>
                                                            <label style="color: #ffffff">Key</label>
                                                            @foreach (json_decode($question->option) as $key => $option)
                                                            <div class="input-group mb-2 mr-sm-2">
                                                                <input required class="form-control @error('oresult1') is-invalid @enderror" type="radio" id="result" name="{{ $question->question }}" value="{{ $key }}" placeholder="write text here..."
                                                                oninvalid="this.setCustomValidity('Please Choose One')" oninput="setCustomValidity('')">
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <br>
                                                <div class="modal-footer">
                                                    <div class="submit-section">
                                                        <button type="submit" class="btn btn-primary submit-btn" onclick="return confirm('Are you sure to want to submit it?')">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                            
                                            {{-- <h5 class="font-14">Total Topics</h5> --}}
                                            <h6 class="text-light" style="font-size: 16px; color: #ffffff">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi soluta, eum voluptates vitae ducimus exercitationem 
                                                {{-- unde voluptate minus iste. Numquam possimus dolor, quos at veniam voluptas ad voluptatibus ex culpa! --}}
                                            </h6>
                                            {{-- @foreach ($questions as $question)
                                                <h5>{{ $question->question }}</h5>
                                                @foreach (json_decode($question->option) as $key => $option)
                                                    {{ $key }}. {{ $option }}
                                                @endforeach
                                            @endforeach --}}
                                        </div>
                                    </div>
                                {{-- </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
    
@endsection
