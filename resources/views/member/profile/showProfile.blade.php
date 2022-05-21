@extends('member.layouts.master')
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
                                <h4 class="page-title">Profile</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('member') }}">Team Member</a></li>
                                    <li class="breadcrumb-item"><a class="active" href="{{ url('member/profile/') }}">Profile</a></li>
                                </ol>
                                {{-- <h3 class="greeting">Hello, {{ $user->name }}</h3> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                        <div class="col-xl-4">
                            <div class="card messages">
                                <div class="card-body">
                                    <h4 class="mt-1 ml-2 header-title mb-4">My Profile</h4>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="nav-first" role="tabpanel" aria-labelledby="nav-first-tab">
                                            <div class="p-2 mt-2">
                                                <ul class="list-unstyled latest-message-list mb-0">
                                                    <li class="message-list-item">
                                                        <a href="#">
                                                            <div class="media">
                                                                <div class="media-body">
                                                                    <h6 class="mt-0 text-primary">Name</h6>
                                                                    <p class="text-muted mb-0">{{ $user->name }}</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="message-list-item">
                                                        <a href="#">
                                                            <div class="media">
                                                                <div class="media-body">
                                                                    <h6 class="mt-0 text-primary">Email</h6>
                                                                    <p class="text-muted mb-0">{{ $user->email }}</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="message-list-item">
                                                        <a href="#">
                                                            <div class="media">
                                                                <div class="media-body">
                                                                    <h6 class="mt-0 text-primary">Phone Number</h6>
                                                                    <p class="text-muted mb-0">{{ $user->phone }}</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="message-list-item">
                                                        <a href="#">
                                                            <div class="media">
                                                                <div class="media-body">
                                                                    <h6 class="mt-0 text-primary">Role</h6>
                                                                    <p class="text-muted mb-0">{{ $user->role_name }}</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="text-center">
                                                <a href="{{ url('member/profile/detail/'.$user->id) }}" class="text-warning btn-sm">Edit Profile</a>
                                                <a href="{{ url('member/profile/changePassword/'.$user->id) }}" class="text-danger btn-sm">Change Password</a>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end tab-content --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    

                </div>
            </div>
            <!-- container-fluid -->
        </div>
    </div>

@endsection
