@extends('client.client_layout')
@section('content')

    <div class="content-page">
        {{-- message --}}
        {!! Toastr::message() !!}
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
                                <h3>Welcome {{ $id->name }}!</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page-title -->

                {{-- Start Content --}}

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
                                                        {{-- <a href="{{ url('client/detail/') }}" class="text-primary">{{ $proj->projectname }}</a> --}}
                                                        <a href="{{ url('client/detail/') }}" class="text-primary">{{ $proj->projectname }}</a>
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

                 <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title mb-4">Recent Progress</h4>
                                <ol class="activity-feed mb-0 pl-3">
                                    @foreach ($user as $us)
                                        {{-- Cek jika ID User sama dengan Auth User ID --}}
                                        @if ($us->id == $id->id)
                                            @foreach ($us->project as $proj) 
                                                @foreach ($task as $item)
                                                    {{-- Cek jika project_id dari Task sama dengan ID pada project --}}
                                                    @if ($item->project_id == $proj->id)
                                                    <li class="feed-item">
                                                        <div class="feed-item-list">
                                                            <a href="{{ url('client/detail/') }}" class="text-muted mb-1">{{ $item->created_at->format('D, d M Y H:i') }}</a>
                                                            <p class="font-15 mt-0 mb-0">{{ $item->name }}<b class="text-warning"> {{ $item->project->projectname }}</b></p>
                                                        </div>
                                                    </li>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @endif
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>  

                    {{-- @else
                    <h1>Tidak ditemukan</h1>                    
                @endif
                @endforeach                --}}
                    

                </div>
            </div>
            <!-- container-fluid -->
        </div>
    </div>


@endsection