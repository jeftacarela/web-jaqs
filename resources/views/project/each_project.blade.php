{{-- each my project --}}


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
                                    <li class="breadcrumb-item"><a href="{{ url('admin/project/show') }}">Topic</a></li>
                                    <li class="breadcrumb-item"><a class="active" href="#">Detail</a></li>
                                <br>
                            </div>
                            @foreach ($videos as $item)
                                @once <h1 class="page-title">{{ $item->projectname }}</h1> @endonce
                            @endforeach
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
                @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{$error}}
                        </div>
                    @endforeach
                @endif
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title mb-4">Videos Datatable</h4>
                                </p>
                                <table name="video" id="datatable" class="table dt-responsive text-center" 
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%; font-size: 14px" data-cols-width="">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="max-width: 5%">No</th>
                                            <th data-exclude="true" hidden>ID</th>
                                            {{-- <th data-exclude="true" hidden>Topic ID</th> --}}
                                            {{-- <th style="max-width: 12%" data-bs-toggle="tooltip" data-bs-placement="top" title="Name of Project">Topic</th> --}}
                                            <th hidden>Duration</th>
                                            <th data-exclude="true" style="max-width: 8%" data-bs-toggle="tooltip" data-bs-placement="top" title="Work Time (hour:minute)">Duration</th>
                                            <th hidden>Video</th>
                                            <th style="max-width: 12%" title="link">Youtube Link</th>
                                            <th style="max-width: 12%" title="Description">Description</th>
                                            <th style="max-width: 10%" title="Action for each video" class="text-center" data-exclude="true">Modify</th>
                                        </tr>    
                                    </thead>

                                    <tbody>
                                    @foreach ($videos as $key => $item)
                                        <tr>
                                            <td class="no">{{ ++$key }}</td>
                                            <td data-exclude="true" hidden class="id">{{ $item->id }}</td>
                                            {{-- <td data-exclude="true" hidden class="project_id">{{ $item->project->id }}</td> --}}
                                            {{-- <td class="projectname">{{ $item->project->projectname }}</td>    --}}
                                            @php
                                                $hour    = 0;
                                                $minute  = 0;

                                                $waktu   = $item->duration;
                                                $parsed  = date_parse($waktu);
                                                $hour    = $hour + $parsed['hour'];
                                                $minute  = $minute + $parsed['minute'];
                                            @endphp
                                            <td hidden class="duration">{{ sprintf("%02d",$hour) }}:{{ sprintf("%02d",$minute) }}</td>
                                            <td data-exclude="true" class="text-center">{{ $hour }}h:{{ $minute }}m</td>
                                            <td hidden data-exclude="true" class="video text-center">{{ $item->video }}</td>
                                            <td data-exclude="true" class="text-center">
                                                <iframe width="150" height="75" src="https://www.youtube.com/embed/{{ $item->video }}">
                                                </iframe>
                                            </td>
                                            <td data-exclude="true" class="description text-center">{{ $item->description }}</td>
                                            <td class="text-center" data-exclude="true">
                                                <a href="#" class="videoUpdate mr-2" data-toggle="modal" data-id="'$item->id'" data-target="#edit_video">
                                                    <i class="fas fa-edit" style="color: #0ee7e3"></i></a>
                                                <a href="{{ url('admin/task/delete/'.$item->id) }}" onclick="return confirm('Are you sure to want to delete it?')" style="color: #fb4365">
                                                    <i class="fas fa-trash-alt" style="color: #fb4365"></i></a>
                                            </td>   
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <div class="col-12 d-flex mb-3">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            <a href="#" data-toggle="modal" data-target="#add_video"><i class="fa fa-plus"></i> Add Video</a>
                                        </button>
                                    </div>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title mb-4">Quiz Datatable</h4>
                                </p>
                                <table name="video" id="datatable" class="table dt-responsive text-center" 
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%; font-size: 14px" data-cols-width="">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="max-width: 5%">No</th>
                                            <th data-exclude="true" hidden>ID</th>
                                            <th data-exclude="true" hidden>Topic ID</th>
                                            <th data-exclude="true" hidden>Question ID</th>
                                            <th style="max-width: 12%" title="Question">Question</th>
                                            <th style="max-width: 12%" title="Option" class="text-left">Option</th>
                                            <th style="max-width: 12%" title="Key">Key</th>
                                            <th style="max-width: 10%" title="Action for each video" class="text-center" data-exclude="true">Modify</th>
                                        </tr>    
                                    </thead>

                                    <tbody>
                                    @foreach ($questions as $key => $item)
                                        <tr>
                                            <td class="no">{{ ++$key }}</td>
                                            <td data-exclude="true" hidden class="id">{{ $item->id }}</td>
                                            <td data-exclude="true" hidden class="project_id">{{ $item->id }}</td>
                                            <td data-exclude="true" hidden class="question_id">{{ $item->id }}</td>
                                            <td class="question">{{ $item->question }}</td>
                                            <td class="option text-left">
                                                @foreach (json_decode($item->option) as $key => $option)
                                                    {{ $key }}. {{ $option }} <br>
                                                @endforeach
                                            </td>
                                            <td class="result text-center">{{ $item->result }}</td>
                                            <td class="text-center" data-exclude="true">
                                                {{-- <a href="#" class="videoUpdate mr-2" data-toggle="modal" data-id="'$item->id'" data-target="#edit_video">
                                                    <i class="fas fa-edit" style="color: #0ee7e3"></i></a> --}}
                                                <a href="{{ url('admin/quiz/detail/'.$item->id) }}" style="color: #fb4365" class="mr-2">
                                                    <i class="fas fa-edit" style="color: #0ee7e3"></i></a>
                                                <a href="{{ url('admin/quiz/delete/'.$item->id) }}" onclick="return confirm('Are you sure to want to delete it?')" style="color: #fb4365">
                                                    <i class="fas fa-trash-alt" style="color: #fb4365"></i></a>
                                            </td>   
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <div class="col-12 d-flex mb-3">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            <a href="#" data-toggle="modal" data-target="#add_quiz"><i class="fa fa-plus"></i> Add Quiz</a>
                                        </button>
                                    </div>
                                </table>
                                {{-- <div class="col-12 d-flex justify-right mt-3 mb-2">
                                    <button id="btn-export" onclick="exportReportToExcel('Team')" class="btn btn-success waves-effect">
                                        <i class="mdi mdi-file-excel" style="font-size: 20px"></i> Export Task</b>
                                    </button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end page-title -->
            </div>
            <!-- container-fluid -->            
        </div>
    </div>
    <!-- content --> 

    <!-- Add Video Modal -->
    <div id="add_video" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title header-title">Add Video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin/video/save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-8"> 
                                <label>Topic</label>
                                <select required class="form-control" name="project_id" id="project_id">
                                    <option selected disabled value=""> -- Select Topic --</option>
                                    @foreach ($project as $proj) 
                                        <option value={{$proj->id}}>{{$proj->projectname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3"> 
                                <div class="form-group">
                                    <label>Durations (hour:minute)</label>
                                    <input required class="form-control @error('duration') is-invalid @enderror" type="time" id="duration" name="duration" value="00:00" placeholder="Enter Time Worked"
                                        oninvalid="this.setCustomValidity('Please Enter valid Time <00:00>')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-11">
                                <div class="form-group"></div>
                                <label>Video</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">https://www.youtube.com/watch?</div>
                                    </div>
                                    <input required class="form-control @error('video_url') is-invalid @enderror" type="text" id="video" name="video" value="{{ old('video') }}" placeholder="Only Token, e.g. https://www.youtube.com/embed/[watch?v=eh8manMzXlk]"
                                    oninvalid="this.setCustomValidity('Please Enter valid Webiste URL')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12"> 
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <br>
                                    <textarea name="description" id="description" cols="100" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Add Video</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Video Modal -->

    <!-- Add Quiz Modal -->
    <div id="add_quiz" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title header-title">Add Quiz</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin/quiz/save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-9"> 
                                <label>Topic</label>
                                <select required class="form-control" name="project_id" id="project_id">
                                    <option selected disabled value=""> -- Select Topic --</option>
                                    @foreach ($project as $proj) 
                                        <option value={{$proj->id}}>{{$proj->projectname}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-9"> 
                                <div class="form-group">
                                    <label for="question">Question</label>
                                    <br>
                                    {{-- <textarea name="question" id="question" cols="100" rows="3"></textarea> --}}
                                    <input required class="form-control @error('question') is-invalid @enderror" type="text" id="question" name="question" value="{{ old('question') }}" placeholder="write question here..."
                                    oninvalid="this.setCustomValidity('Please enter valid question')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group"></div>
                                <label>Option</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">a</div>
                                    </div>
                                    <input required class="form-control @error('opt1') is-invalid @enderror" type="text" id="opt1" name="opt1" value="{{ old('opt1') }}" placeholder="write text here..."
                                    oninvalid="this.setCustomValidity('Please enter valid question')" oninput="setCustomValidity('')">
                                </div>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">b</div>
                                    </div>
                                    <input required class="form-control @error('opt2') is-invalid @enderror" type="text" id="opt2" name="opt2" value="{{ old('opt2') }}" placeholder="write text here..."
                                    oninvalid="this.setCustomValidity('Please enter valid question')" oninput="setCustomValidity('')">
                                </div>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">c</div>
                                    </div>
                                    <input required class="form-control @error('opt3') is-invalid @enderror" type="text" id="opt3" name="opt3" value="{{ old('opt3') }}" placeholder="write text here..."
                                    oninvalid="this.setCustomValidity('Please enter valid question')" oninput="setCustomValidity('')">
                                </div>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">d</div>
                                    </div>
                                    <input required class="form-control @error('opt4') is-invalid @enderror" type="text" id="opt4" name="opt4" value="{{ old('opt4') }}" placeholder="write text here..."
                                    oninvalid="this.setCustomValidity('Please enter valid question')" oninput="setCustomValidity('')">
                                </div>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">e</div>
                                    </div>
                                    <input required class="form-control @error('opt5') is-invalid @enderror" type="text" id="opt5" name="opt5" value="{{ old('opt5') }}" placeholder="write text here..."
                                    oninvalid="this.setCustomValidity('Please enter valid question')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group"></div>
                                <label>Key</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <input required class="form-control @error('oresult1') is-invalid @enderror" type="radio" id="result" name="result" value="1" placeholder="write text here..."
                                    oninvalid="this.setCustomValidity('Please Choose One')" oninput="setCustomValidity('')">
                                </div>
                                <div class="input-group mb-2 mr-sm-2">
                                    <input required class="form-control @error('result') is-invalid @enderror" type="radio" id="result" name="result" value="2" placeholder="write text here..."
                                    oninvalid="this.setCustomValidity('Please Choose One')" oninput="setCustomValidity('')">
                                </div>
                                <div class="input-group mb-2 mr-sm-2">
                                    <input required class="form-control @error('result') is-invalid @enderror" type="radio" id="result" name="result" value="3" placeholder="write text here..."
                                    oninvalid="this.setCustomValidity('Please Choose One')" oninput="setCustomValidity('')">
                                </div>
                                <div class="input-group mb-2 mr-sm-2">
                                    <input required class="form-control @error('result') is-invalid @enderror" type="radio" id="result" name="result" value="4" placeholder="write text here..."
                                    oninvalid="this.setCustomValidity('Please Choose One')" oninput="setCustomValidity('')">
                                </div>
                                <div class="input-group mb-2 mr-sm-2">
                                    <input required class="form-control @error('result') is-invalid @enderror" type="radio" id="result" name="result" value="5" placeholder="write text here..."
                                    oninvalid="this.setCustomValidity('Please Choose One')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer">
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Add Quiz</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Quiz Modal -->

    <script>
        $(document).ready( function() {
            $('table#datatable').DataTable({
                "searching": false,
                "paging":false,
                "ordering":true,
                "columnDefs":[{
                    "targets":[1,11, 4], 
                    "orderable":false,
                }]
            });
        });
    </script>

@endsection
