
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
                                    <li class="breadcrumb-item"><a class="active" href="{{ url('member/result/') }}">Result</a></li>
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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-2 ml-3 header-title">Result Datatable</h4>
                                </p>
                                <table id="datatable" class="table table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="max-width: 5%">No</th>
                                            <th hidden data-exclude="true">ID</th>
                                            <th hidden data-exclude="true">Project ID</th>
                                            <th style="max-width: 15%" data-bs-toggle="tooltip" data-bs-placement="top" title="Name of Project">Project</th>
                                            <th class="text-center" style="max-width: 8%" data-bs-toggle="tooltip" data-bs-placement="top" title="Work Durations (hour:minute)">Score</th>
                                            <th class="text-center" style="max-width: 12%" data-bs-toggle="tooltip" data-bs-placement="top" title="Dateline for each Task">Submit Date</th>
                                        </tr>    
                                    </thead>

                                    <tbody>
                                    @foreach ($results as $key => $result)
                                    @if ($result->user_id == auth()->user()->id)
                                        <tr>
                                            <td class="no">{{ ++$key }}</td>
                                            <td hidden class="id">{{ $result->id }}</td>
                                            <td hidden class="project_id">{{ $result->project_id }}</td>
                                            <td class="projectname">{{ $result->projectname }}</td>
                                            <td class="score text-center">{{ $result->score }} %</td>
                                            <td class="submit_date text-center">{{ $result->created_at }}</td>
                                        </tr>
                                    @endif
                                    @endforeach
                                    </tbody>
                                    {{-- <div class="col-12 d-flex mb-3">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            <a href="#" data-toggle="modal" data-target="#add_task"><i class="fa fa-plus"></i> Add Result</a>
                                        </button>
                                    </div> --}}
                                    {{-- <div class="col-auto float-left ml-auto">
                                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_task"><i class="fa fa-plus"></i> Add Task</a>
                                    </div> --}}
                                </table>
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

    <script>
        $(document).ready( function() {
            $('table#datatable').DataTable({
                "searching": true,
                "paging":true,
                "ordering":true,
                "columnDefs":[{
                    "targets":[], 
                    "orderable":false,
                }]
            });
        });
    </script>

@endsection
