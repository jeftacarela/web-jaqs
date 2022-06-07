
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
                                    <li class="breadcrumb-item"><a href="{{ url('admin/quiz/show') }}">Quiz</a></li>
                                    <li class="breadcrumb-item"><a class="active" href="#">Edit</a></li>
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
                                    <form class="form form-horizontal" action="{{ route('admin/quiz/update') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <div class="form-body">
                                            <div class="row">

                                                <div class="col-md-4">
                                                    <label>Topic</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">
                                                            <select class="form-control" name="project_id" id="project_id">
                                                                <option selected disabled>Select Topic</option>
                                                                @foreach ($projects as $project)
                                                                    <option {{ $project->id == $data->project_id ? 'selected' : '' }} value="{{ $project->id}}">{{ $project->projectname}}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-company"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <label>Question</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">
                                                            <input type="text" class="form-control"
                                                                placeholder="Question" id="question" name="question" value="{{ $data->question }}">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-email"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <label>Option</label>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group has-icon-left"></div>
                                                        <div class="input-group mb-2 mr-sm-2">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">a</div>
                                                            </div>
                                                            <input required class="form-control @error('opt1') is-invalid @enderror" type="text" id="opt1" name="opt1" value="{{ $opt1 }}" placeholder="write text here..."
                                                            oninvalid="this.setCustomValidity('Please enter valid question')" oninput="setCustomValidity('')">
                                                        </div>
                                                        <div class="input-group mb-2 mr-sm-2">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">b</div>
                                                            </div>
                                                            <input required class="form-control @error('opt2') is-invalid @enderror" type="text" id="opt2" name="opt2" value="{{ $opt2 }}" placeholder="write text here..."
                                                            oninvalid="this.setCustomValidity('Please enter valid question')" oninput="setCustomValidity('')">
                                                        </div>
                                                        <div class="input-group mb-2 mr-sm-2">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">c</div>
                                                            </div>
                                                            <input required class="form-control @error('opt3') is-invalid @enderror" type="text" id="opt3" name="opt3" value="{{ $opt3 }}" placeholder="write text here..."
                                                            oninvalid="this.setCustomValidity('Please enter valid question')" oninput="setCustomValidity('')">
                                                        </div>
                                                        <div class="input-group mb-2 mr-sm-2">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">d</div>
                                                            </div>
                                                            <input required class="form-control @error('opt4') is-invalid @enderror" type="text" id="opt4" name="opt4" value="{{ $opt4 }}" placeholder="write text here..."
                                                            oninvalid="this.setCustomValidity('Please enter valid question')" oninput="setCustomValidity('')">
                                                        </div>
                                                        <div class="input-group mb-2 mr-sm-2">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">e</div>
                                                            </div>
                                                            <input required class="form-control @error('opt5') is-invalid @enderror" type="text" id="opt5" name="opt5" value="{{ $opt5 }}" placeholder="write text here..."
                                                            oninvalid="this.setCustomValidity('Please enter valid question')" oninput="setCustomValidity('')">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group"></div>
                                                        <div class="input-group mb-2 mr-sm-2">
                                                            <input required class="form-control @error('oresult1') is-invalid @enderror" type="radio" id="result" name="result" value="1" {{ $data->result == 1 ? 'checked' : '' }} placeholder="write text here..."
                                                            oninvalid="this.setCustomValidity('Please Choose One')" oninput="setCustomValidity('')">
                                                        </div>
                                                        <div class="input-group mb-2 mr-sm-2">
                                                            <input required class="form-control @error('result') is-invalid @enderror" type="radio" id="result" name="result" value="2" {{ $data->result == 2 ? 'checked' : '' }} placeholder="write text here..."
                                                            oninvalid="this.setCustomValidity('Please Choose One')" oninput="setCustomValidity('')">
                                                        </div>
                                                        <div class="input-group mb-2 mr-sm-2">
                                                            <input required class="form-control @error('result') is-invalid @enderror" type="radio" id="result" name="result" value="3" {{ $data->result == 3 ? 'checked' : '' }} placeholder="write text here..."
                                                            oninvalid="this.setCustomValidity('Please Choose One')" oninput="setCustomValidity('')">
                                                        </div>
                                                        <div class="input-group mb-2 mr-sm-2">
                                                            <input required class="form-control @error('result') is-invalid @enderror" type="radio" id="result" name="result" value="4" {{ $data->result == 4 ? 'checked' : '' }} placeholder="write text here..."
                                                            oninvalid="this.setCustomValidity('Please Choose One')" oninput="setCustomValidity('')">
                                                        </div>
                                                        <div class="input-group mb-2 mr-sm-2">
                                                            <input required class="form-control @error('result') is-invalid @enderror" type="radio" id="result" name="result" value="5" {{ $data->result == 5 ? 'checked' : '' }} placeholder="write text here..."
                                                            oninvalid="this.setCustomValidity('Please Choose One')" oninput="setCustomValidity('')">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-success waves-effect waves-light mr-2">Update</button>
                                                    <button type="reset" class="btn btn-danger waves-effect waves-light"><a href="{{ route('admin/quiz/show') }}">Back</a></button>
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
