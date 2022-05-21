
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
                                    <li class="breadcrumb-item"><a class="active" href="{{ url('member/project/') }}">Project</a></li>
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
                                <h4 class="mt-2 ml-3 header-title">Project Datatable</h4>
                                </p>
                                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            {{-- <th>User Assignee</th> --}}
                                            <th>Project Name</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Website URL</th>
                                            <th>Staging URL</th>
                                        </tr>    
                                    </thead>

                                    <tbody>
                                    @foreach ($project as $key => $item)
                                        <tr>
                                            <td class="id">{{ ++$key }}</td>
                                            {{-- <td>
                                                @foreach ($item->user as $orang)
                                                @if ($orang->role_name != 'Client')
                                                <ul>
                                                    <h5><span class="badge badge-info">{{ $orang->name }}</span></h5>
                                                </ul>
                                                @endif
                                                @endforeach
                                            </td> --}}
                                            {{-- <td class="name">{{ $item->user->name }}</td> --}}
                                            <td class="projectname">
                                                <a href="{{ url('member/project/view/'.$item->id) }}" class="text-primary">{{ $item->projectname }}</a> 
                                            </td>
                                            <td class="project_type">{{ $item->project_type }}</td>
                                            <td class="status">{{ $item->status }}</td>
                                            <td class="website-url">{{ $item->website_url }}</td>
                                            <td class="staging-url">{{ $item->staging_url }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
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
@endsection
