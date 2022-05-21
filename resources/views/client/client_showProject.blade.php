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
                                @can('isAdmin')
                                    <h4 class="page-title">Client Dashboard <b class="text-warning">as Admin</b></h4>
                                @elsecan('isClient')
                                    <h4 class="page-title">Client Dashboard</h4>
                                @endcan
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
                        @foreach ($orang as $org)
                            @if ($org->id == $user->id)
                                @foreach ($org->project as $proyek)
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mt-2 ml-3 header-title">Project {{ $proyek->projectname }}</h4>
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
                                            @foreach ($proyek->task as $key => $item)
                                                <tr>
                                                    <td class="id">{{ ++$key }}</td>
                                                    <td class="name">{{ $item->name }}</td>
                                                    <td class="status">{{ $item->status }}</td>
                                                    @php
                                                        $hour    = 0;
                                                        $minute  = 0;

                                                        $waktu   = $item->billing;
                                                        $parsed  = date_parse($waktu);
                                                        $hour    = $hour + $parsed['hour'];
                                                        $minute  = $minute + $parsed['minute'];
                                                    @endphp
                                                    <td class="billing">{{ $hour }}h : {{ $minute }}m</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="col-12 d-flex mt-4">
                                            <h4 class="header-title">Total task   : {{ $proyek->task->count() }}</h4>
                                            {{-- <button type="submit" class="btn btn-warning waves-effect waves-light">
                                                <a href="{{ url('client/detail/'.$proyek->id) }}">View {{ $proyek->projectname }}</a>
                                            </button> --}}
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
                                        <div class="col-12 d-flex justify-right mt-3 mb-2">
                                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                                <a href="{{ url('client/invoices/'.$proyek->id) }}">View Invoice</a>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        @endforeach
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