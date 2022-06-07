
@extends('member.layouts.master')
@section('content')
    
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                <div class="page-title-box">
                    <div class="row align-items-center ">
                        <div class="col-md-8">
                            <div class="page-title-box">
                                @can('isAdmin')
                                    <h4 class="page-title">Member Dashboard <b class="text-warning">as Admin</b></h4>
                                @elsecan('isMember')
                                    <h4 class="page-title">Member Dashboard</h4>
                                @endcan
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('member') }}">Team Member</a></li>
                                    <li class="breadcrumb-item"><a class="active" href="{{ url('member/project/') }}">Topic</a></li>
                                </ol>
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
                {{-- <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-2 ml-3 header-title">Project Datatable</h4>
                                </p>
                                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Project Name</th>
                                            <th>Status</th>
                                        </tr>    
                                    </thead>

                                    <tbody>
                                    @foreach ($project as $key => $item)
                                        <tr>
                                            <td class="id">{{ ++$key }}</td>
                                            <td class="projectname">
                                                <a href="{{ url('member/project/view/'.$item->id) }}" class="text-primary">{{ $item->projectname }}</a> 
                                            </td>
                                            <td class="status">{{ $item->status }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div> --}}

                <div class="row">
                    @foreach ($project as $item)
                    <div class="col-sm-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center p-1">
                                    <div class="col-lg-10">
                                        <h4 class="mt-2 ml-3 header-title">
                                            <a href="{{ url('member/project/view/'.$item->id) }}" class="text-dark">{{ $item->projectname }}</a>
                                            <i class="dripicons-chevron-right text-right" style="font-size: 15px;color:#000000"></i>
                                        </h4><br>
                                        {{-- <a href="{{ url('member/project/view/'.$item->id) }}" class="text-primary">{{ $item->projectname }}</a> --}}
                                        @foreach ($video as $key => $vid)
                                            @if ($vid->project_id == $item->id)
                                            <iframe width="320" height="150" src="https://www.youtube.com/embed/{{ $item->video }}"></iframe>
                                            <h6 class="text-secondary ml-2 mb-0" style="font-size: 12px">{{ Str::limit($vid->description, 75, ' ...')}}</h6><br>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <!-- end col -->
                    @endforeach
                    </div>
                <!-- end page-title -->
            </div>
            <!-- container-fluid -->
        </div>
    </div>
    <!-- content --> 
@endsection
