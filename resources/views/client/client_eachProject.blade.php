@extends('client.client_layout')
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
                                    <li class="breadcrumb-item"><a href="{{ route('client') }}">Client</a></li>
                                    <li class="breadcrumb-item"><a class="active" href="{{ url('client/detail') }}">Project</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- message --}}
                {!! Toastr::message() !!}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Project {{ $project->projectname }}</h4>
                                </p>
                                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Task Name</th>
                                            <th>Status</th>
                                            <th>Duration</th>
                                        </tr>    
                                    </thead>
                                    <tbody>
                                    @foreach ($project->task as $key => $item)
                                        <tr>
                                            <td class="id">{{ ++$key }}</td>
                                            <td class="name">{{ $item->name }}</td>
                                            <td class="status">{{ $item->status }}</td>
                                            <td class="billing">{{ $item->billing }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="col-12 d-flex mt-4">
                                    <h4 class="header-title">Total task    : {{ $project->task->count() }}</h4>
                                </div>
                                <div class="col-12 d-flex">
                                    @if ($jam>1)
                                        @if ($menit>1)
                                            <h4 class="header-title">Time Billed : {{ $jam }} hours {{ $menit }} minutes</h4>                        
                                        @else
                                            <h4 class="header-title">Time Billed : {{ $jam }} hours {{ $menit }} minute</h4> 
                                        @endif                    
                                    @else
                                        @if ($menit>1)
                                            <h4 class="header-title">Time Billed : {{ $jam }} hour {{ $menit }} minutes</h4>                    
                                        @else
                                            <h4 class="header-title">Time Billed : {{ $jam }} hour {{ $menit }} minute</h4>                    
                                        @endif    
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-right mb-2">
                            <button type="submit" class="btn btn-info waves-effect waves-light">
                                {{-- <a href="{{ url('client/invoice/'.$project->id) }}">Generate Invoice</a> --}}
                                <a href="{{ url('client/invoice/'.$project->id) }}">View Invoice</a>
                            </button>
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