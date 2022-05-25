
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
                                    <li class="breadcrumb-item"><a class="active" href="{{ url('admin/quiz/show') }}">Quiz</a></li>
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

                    <!-- Search Filter -->
                    {{-- <form action="{{ route('admin/task/show/search') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row ">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row ml-2">
                                            <div class="col-sm-2"> 
                                                <div class="form-group">
                                                    <label class="text-muted">User Assignee</label>
                                                    <select class="form-control" name="user_id" id="user_id">
                                                        <option selected disabled value="">All</option>
                                                        @foreach ($user as $orang )
                                                            @if ($orang->role_name != 'Client')
                                                                <option value="{{ $orang->id }}">{{ $orang->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-auto"> 
                                                <div class="form-group">
                                                    <label class="text-muted">Status</label>
                                                    <select  class="form-control" name="status" id="status">
                                                        <option selected value="">All</option>
                                                            <option value="In Progress">In Progress</option>
                                                            <option value="Wait for Review">Wait for Review</option>
                                                            <option value="Completed">Completed</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-auto"> 
                                                <div class="form-group">
                                                    <label class="text-muted">From</label>
                                                    <input  class="form-control date-picker" type="date" id="from" name="from" value="{{ old('duedate') }}"
                                                        oninvalid="this.setCustomValidity('Please Enter valid Date')" oninput="setCustomValidity('')">
                                                </div>
                                            </div>
                                            <div class="col-md-auto"> 
                                                <div class="form-group">
                                                    <label class="text-muted">To</label>
                                                    <input  class="form-control date-picker" type="date" id="to" name="to" value="{{ old('duedate') }}"
                                                        oninvalid="this.setCustomValidity('Please Enter valid Date')" oninput="setCustomValidity('')">
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label for="">&nbsp;</label>
                                                    <button type="submit" class="btn btn-success btn-block submit-btn"> Search </button>
                                                </div>
                                            </div>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form> --}}
                    <!-- /Search Filter -->

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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-2 ml-3 header-title">Quiz Datatable</h4>
                                </p>
                                <table name="video" id="datatable" class="table dt-responsive text-center" 
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%; font-size: 14px" data-cols-width="">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="max-width: 5%">No</th>
                                            <th data-exclude="true" hidden>ID</th>
                                            <th data-exclude="true" hidden>Topic ID</th>
                                            <th style="max-width: 12%" data-bs-toggle="tooltip" data-bs-placement="top" title="Name of Project">Topic</th>
                                            <th data-exclude="true" hidden>Question ID</th>
                                            <th style="max-width: 12%" title="Question">Question</th>
                                            <th style="max-width: 12%" title="Option" class="text-left">Option</th>
                                            <th style="max-width: 12%" title="Key">Key</th>
                                            <th style="max-width: 10%" title="Action for each video" class="text-center" data-exclude="true">Modify</th>
                                        </tr>    
                                    </thead>

                                    <tbody>
                                    @foreach ($data as $key => $item)
                                        <tr>
                                            <td class="no">{{ ++$key }}</td>
                                            <td data-exclude="true" hidden class="id">{{ $item->id }}</td>
                                            <td data-exclude="true" hidden class="project_id">{{ $item->id }}</td>
                                            <td class="projectname">{{ $item->project->projectname }}</td>
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

    <!-- Edit Video Modal -->
    <div id="edit_video" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title header-title">Edit Video</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ url('admin/video/update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input hidden class="col-sm-6 form-control" type="text" name="id" id="id" value="">
                        <div class="row"> 
                            <div class="col-sm-6"> 
                                <label>Project</label>
                                <select class="form-control" name="project_id" id="e_project_id">
                                    @foreach ($project as $proyek)
                                        <option value="{{ $proyek->id }}">{{ $proyek->projectname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4"> 
                                <div class="form-group">
                                    <label>Work Durations (hour:minute)</label>
                                    <input required class="form-control" type="time" id="e_duration" name="duration" value="00:00">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-11">
                                <div class="form-group"></div>
                                <label>Video</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">https://www.youtube.com/watch?v=</div>
                                    </div>
                                    <input required class="form-control @error('video_url') is-invalid @enderror" type="text" id="e_video" name="video" value="{{ old('video') }}"
                                    oninvalid="this.setCustomValidity('Please Enter valid Webiste URL')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-sm-12"> 
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" value="" type="text" id="e_description"  cols="30" rows="4"></textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer">
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Task Modal -->

    <script>
        $(document).ready( function() {
            $('table#datatable').DataTable({
                "searching": true,
                "paging":true,
                "ordering":true,
                "columnDefs":[{
                    "targets":[6,7,8], 
                    "orderable":false,
                }]
            });
        });
    </script>

@endsection
