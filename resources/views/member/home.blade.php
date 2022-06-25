@extends('member.layouts.master')
@section('content')

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center ">
                    <div class="col-md-9">
                        <div class="page-title-box">
                            @can('isAdmin')
                                <h4 class="page-title">Member Dashboard <b class="text-warning">as Admin</b></h4>
                            @elsecan('isMember')
                                <h4 class="page-title">Member Dashboard</h4>
                            @endcan
                            {{-- <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Cabaretti Dashboard</li>
                            </ol> --}}
                            <h3 class="greeting">Welcome {{ $id->name }}!</h3>
                        </div>
                    </div>
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
            <!-- end page-title -->

            <!-- start top-Contant -->

            {{-- <div class="row">
            @foreach ($task as $tugas)
            @if ($tugas->user_id == $user->id)
                @foreach ($project as $proyek)
                <div class="col-sm-6 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center p-1">
                                <div class="col-lg-8">
                                    

                                    <h5 class="font-16">{{ $proyek->projectname }}</h5>
                                    <h4 class="text-warning pt-1 mb-0">{{ $proyek->duedate }}</h4>
                                    <h6>
                                        @foreach ($proyek->user as $orang)
                                            <h6 class="text-muted text-primary mb-1">{{ $orang->name }}</h6>
                                        @endforeach
                                    </h6>


                                </div>
                                <div class="col-lg-6">
                                    <div id="chart2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div> --}}

            <!-- end top-Contant -->

            {{-- Start Content --}}

            <div class="row">
                <div class="col-sm-6 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center p-1">
                                <div class="col-lg-10">
                                    <h5 class="font-14 mb-4">Total Active Project(s)</h5>
                                    <h6 class="text-danger pt-2 header-title mb-3" style="font-size: 16px">{{ $jumlahProject->count() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center p-1">
                                <div class="col-lg-10">
                                    <h5 class="font-14 mb-4">My Remaining Task(s)</h5>
                                    <h6 class="text-danger pt-2 header-title mb-3" style="font-size: 16px">{{ $jumlahTask }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center p-1">
                                <div class="col-lg-10">
                                    <h5 class="header-title">Weekly Work Time</h5>
                                    <b class="text-muted font-8">{{ $weekStartDate }} - {{ $weekEndDate }}</b>
                                    {{-- <h5 class="text-primary pt-1 mb-0">{{ $taskhour }} <b class="text-muted font-8">minutes</b> </h5> --}}
                                    {{-- <h5 class="text-muted">{{ $weekTaskMinutes }}</h5> --}}
                                    
                                    @if ($hour > 1)
                                        @if ($minute > 1)
                                            <h5 class="text-primary pt-1 mb-0">{{ $hour }} <b class="text-muted font-2">hours</b> {{ $minute }} <b class="text-muted font-8">minutes</b> </h5>    
                                        @else
                                            <h5 class="text-primary pt-1 mb-0">{{ $hour }} <b class="text-muted font-2">hours</b> {{ $minute }} <b class="text-muted font-8">minute</b> </h5>                                            
                                        @endif
                                    @else
                                        @if ($minute > 1)
                                            <h5 class="text-primary pt-1 mb-0">{{ $hour }} <b class="text-muted font-2">hour</b> {{ $minute }} <b class="text-muted font-8">minutes</b> </h5>    
                                        @else
                                            <h5 class="text-primary pt-1 mb-0">{{ $hour }} <b class="text-muted font-2">hour</b> {{ $minute }} <b class="text-muted font-8">minute</b> </h5>                                            
                                        @endif                                        
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!--
            <div class="row">
                {{-- Ambil nilai dari tabel user --}}
                @foreach ($user as $us)
                    {{-- Jika ID Login sama dengan yang ada di tabel user  --}}
                    @if ($us->id == $id->id)
                        {{-- Panggil model project dari model user --}}
                        @foreach ($us->project as $proj)                    
                            <div class="col-sm-6 col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center p-1">
                                            <div class="col-lg-8">
                                                <h4 class="font-16 text-info header-title text-decoration-none">
                                                    <a href="{{ url('member/project/view/'.$proj->id) }}" class="text-primary">{{ $proj->projectname }}</a>
                                                </h4>
                                                <h4 class="text-warning pt-1 mb-3">{{ $proj->duedate }}</h4>
                                                {{-- <h6>
                                                    @foreach ($proj->user as $orang)
                                                    @if ($orang->role_name != 'Client')
                                                        <h6 class="text-muted text-primary mb-1">{{ $orang->name }}</h6>
                                                    @endif
                                                    @endforeach
                                                </h6> --}}
                                            </div>
                                            <div class="col-lg-6">
                                                <div id="chart2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach                
                    @endif
                @endforeach
            </div>
        -->

            {{-- @foreach ($projectuser as $item)
                <h2>{{ $item->project_id }}
            @endforeach --}}

            {{-- @foreach ($task as $tugas)
            @if ($tugas->user_id == $id->id)
                <h1>{{ $tugas->project->projectname }}</h1>
                <h2>{{ $tugas->name }}</h2>                        
            @else
                <h1>Tidak ditemukan</h1>                    
            @endif
            @endforeach --}}

            @foreach ($project as $proj)
                <h5>
                    <a href="{{ url('member/project/view/'.$proj->id) }}" class="text-dark">{{ $proj->projectname }}</a>
                    <i class="dripicons-chevron-right text-right" style="font-size: 15px;color:#000000"></i>
                </h5>
                <div class="row">
                    @foreach ($videos as $video)
                        @if ($video->project_id == $proj->id)
                            <div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-lg-12">
                                                <iframe width="220" height="120" src="https://www.youtube.com/embed/{{ $video->video }}"></iframe>
                                                <h6 class="text-dark pt-2 mb-3" style="font-size: 16px">{{ Str::limit($video->description, 20, ' ...')}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach

            {{-- <div class="row">
                @foreach ($showVideos as $item)
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="social-box text-center">
                                <h3><i class="mdi mdi-youtube text-danger h1 mr-2"></i>{{$item->projectname}}</h3>
                                <iframe width="220" height="150" src="https://www.youtube.com/embed/{{ $item->video }}"></iframe>
                                <h5 class="font-19 mt-3 text-left"><span class="text-secondary"></span>  {{$item->projectname}}</h5>
                                <p class="text-muted text-justify">{{ Str::limit($item->description, 150, ' ...')}}</p>

                                <div class="mt-2 pt-1 mb-2">
                                    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light">Follwing you</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
             </div> --}}

             <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-4">Today Activity</h4>
                            <ol class="activity-feed mb-0 pl-3">
                                @foreach ($task as $item)
                                @if ($item->user_id == $id->id)
                                    @if ($item->created_at->format('D, d M Y') == $date)
                                    <li class="feed-item">
                                        <div class="feed-item-list">
                                            <a href="{{ url('member/task/detail/'.$item->id) }}" class="text-muted mb-1">{{ $item->created_at->format('D, d M Y H:i') }}</a>
                                            <p class="font-15 mt-0 mb-0">{{ $item->name }}<b class="text-warning"> {{ $item->project->projectname }}</b></p>
                                        </div>
                                    </li>
                                    @endif
                                @endif
                                @endforeach
                            </ol>

                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-4">Your Recent Activity</h4>
                            <ol class="activity-feed mb-0 pl-3">
                                @foreach ($task as $item)
                                @if ($item->user_id == $id->id)
                                <li class="feed-item">
                                    <div class="feed-item-list">
                                        <a href="{{ url('member/project/view/'.$item->project_id) }}" class="text-muted mb-1">{{ $item->created_at->format('D, d M Y H:i') }}</a>
                                        <p class="font-15 mt-0 mb-0">{{ $item->name }}<b class="text-warning"> {{ $item->project->projectname }}</b></p>
                                    </div>
                                </li>
                                @endif
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>  
                {{-- <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-4">Recent All Task Activity</h4>
                            <ol class="activity-feed mb-0 pl-3">
                                @foreach ($task as $item)
                                <li class="feed-item">
                                    <div class="feed-item-list">
                                        <a href="{{ url('form/task/detail/'.$item->id) }}" class="text-muted mb-1">{{ $item->created_at }}</a>
                                        <p class="font-15 mt-0 mb-0">{{ $item->name }}<b class="text-primary"> {{ $item->user->name }}</b></p>
                                    </div>
                                </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>  
                </div> --}}

                {{-- <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="social-box text-center">
                                <i class="mdi mdi-facebook text-primary h1"></i>
                                <h5 class="font-19 mt-3"><span class="text-primary">8.625K</span> New Peoples</h5>
                                <p class="text-muted">Your main list is growing</p>

                                <div class="mt-2 pt-1 mb-2">
                                    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light">Follwing you</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="social-box text-center">
                                <i class="mdi mdi-twitter text-info h1"></i>
                                <h5 class="font-19 mt-3"><span class="text-info">125.3K</span> New Peoples</h5>
                                <p class="text-muted">Your main list is growing</p>

                                <div class="mt-2 pt-1 mb-2">
                                    <button type="button" class="btn btn-info btn-sm waves-effect waves-light">Follwing you</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                {{-- @else
                <h1>Tidak ditemukan</h1>                    
            @endif
            @endforeach                --}}
                

            </div>
            {{-- <h1>{{ $date }}</h1>
            <h1>{{ $dt }}</h1>
            <h1>{{ $todayDate }}</h1>
            <h2>{{ $taskhour }}</h2>
            <h2>{{ $weekStartDate }}</h2>
            <h2>{{ $weekEndDate }}</h2> --}}
            {{-- <h2>{{ $weeklyHours }}</h2>
            <h2>{{ $weeklyMinutes }}</h2> --}}
        </div>
        <!-- container-fluid -->
    </div>
</div>

<!-- Add Task Modal -->
<div id="add_task" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title header-title">Add New Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('member/task/save') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row"> 
                        <div class="col-sm-12"> 
                            <div class="form-group">
                                <label for="name" class="col-form-label">Task Name</label>
                                <input required class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Enter Name"
                                    oninvalid="this.setCustomValidity('Please Enter valid Task Name')" oninput="setCustomValidity('')">
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-sm-6"> 
                            <label>Project</label>
                            <select required class="form-control" name="project_id" id="project_id">
                                <option selected disabled value=""> -- Select Project--</option>
                                @foreach ($project as $proyek)
                                <option value="{{ $proyek->id }}">{{ $proyek->projectname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6"> 
                            <label>User Assignee</label>
                            <select required class="form-control" name="user_id" id="user_id">
                                <option selected disabled value=""> -- Select User --</option>
                                <option value="{{ auth()->user()->id }}">{{ auth()->user()->name }}</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row"> 
                        <div class="col-sm-4"> 
                            <label>Status</label>
                            <select required class="form-control" name="status" id="status">
                                <option selected disabled value=""> -- Select Status --</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Wait for Review">Wait for Review</option>
                                    <option value="Completed">Completed</option>
                            </select>
                        </div>
                        <div class="col-sm-4"> 
                            <div class="form-group">
                                <label>Work Durations (hour:minute)</label>
                                <input required class="form-control @error('work_time') is-invalid @enderror" type="time" id="work_time" name="work_time" value="00:00"
                                oninvalid="this.setCustomValidity('Please Enter valid Time <00:00>')" oninput="setCustomValidity('')">
                            </div>
                        </div>
                        <div class="col-sm-4"> 
                            <div class="form-group">
                                <label>Due Date</label>
                                <input required class="form-control date-picker @error('duedate') is-invalid @enderror" type="date" id="duedate" name="duedate" value="{{ old('duedate') }}"
                                    oninvalid="this.setCustomValidity('Please Enter valid Date')" oninput="setCustomValidity('')">
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-sm-12"> 
                            <label for="notes">Notes</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" value="{{ old('notes') }}" type="text" id="notes" placeholder="Enter notes" cols="30" rows="4"></textarea>
                            @error('notes')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Task Modal -->

@endsection