<!-- Left Sidebar Start -->
<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <a href="{{ route('home') }}" class="waves-effect">
                        <i class="dripicons-meter"></i><span class="badge badge-info badge-pill float-right"></span> <span>Dashboard </span>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('home') }}" class="waves-effect">
                        <i class="dripicons-to-do"></i><span class="badge badge-info badge-pill float-right"></span> <span> My Project </span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-to-do"></i><span> List<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{ route('user/management') }}">User</a></li>
                        <li><a href="{{ route('form/information/show') }}">Company List</a></li>
                    </ul>
                </li> --}}
                {{-- <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-document"></i><span>Tasks<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span></a>
                    <ul class="submenu">
                        <li><a href="{{ route('admin/task/me') }}">My Tasks & Report</a></li>
                        <li><a href="{{ route('admin/task/show') }}">Team Tasks & Report</a></li>
                    </ul>
                </li> --}}
                {{-- <li>
                    <a href="{{ route('admin/project/show') }}" class="waves-effect">
                        <i class="dripicons-to-do"></i><span class="badge badge-info badge-pill float-right"></span><span>Projects</span>
                    </a>
                </li> --}}
                <li>
                    <a href="#" class="waves-effect"><i class="dripicons-list"></i><span>Topics<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span></a>
                    <ul class="submenu">
                        <!-- Navitem from AppServiceProvider.php -->
                        <li><a href="{{ route('admin/project/show') }}">All Topic</a></li>
                        @foreach ($navitem as $item)
                            <li><a href="{{ route('admin/project/view', [$item->id]) }}">{{ $item->projectname }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="{{ route('admin/video/show') }}" class="waves-effect">
                        <i class="dripicons-monitor"></i><span class="badge badge-info badge-pill float-right"></span><span>Videos</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin/quiz/show') }}" class="waves-effect">
                        <i class="dripicons-graduation"></i><span class="badge badge-info badge-pill float-right"></span><span>Quiz</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin/result') }}" class="waves-effect">
                        <i class="dripicons-document"></i><span class="badge badge-info badge-pill float-right"></span><span>Result</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user/management') }}" class="waves-effect">
                        <i class="dripicons-user-group"></i><span class="badge badge-info badge-pill float-right"></span><span>Users</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin/profile') }}" class="waves-effect">
                        <i class="dripicons-user-id"></i><span class="badge badge-info badge-pill float-right"></span><span>My Profile</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-user"></i><span>Profiles<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span></a>
                    <ul class="submenu">
                        <li><a href="{{ route('admin/profile') }}">My Profile</a></li>
                        <li><a href="{{ route('user/management') }}">Team Profiles</a></li>
                    </ul>
                </li> --}}
                {{-- <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-document"></i><span>Form Input<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span></a>
                    <ul class="submenu">
                        <li><a href="{{ route('user/management') }}">User</a></li>
                        <li><a href="{{ route('form/information/new') }}">Company</a></li>
                        <li><a href="{{ route('admin/project/new') }}">Project</a></li>
                        <li><a href="{{ route('admin/task/new') }}">Task</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="waves-effect  mm-active"><i class="dripicons-list"></i><span> Reporting <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li class="mm-active">
                            <a href="{{ route('user/management') }}">All User</a>
                            <a href="{{ route('form/information/show') }}">All Company</a>
                            <a href="{{ route('admin/project/show') }}">All Project</a>
                            <a href="{{ route('admin/task/show') }}">All Task</a>
                            <a href="{{ route('admin/invoice/show') }}">Invoice</a>
                        </li>
                    </ul>
                </li> --}}
            </ul>
        </div>
    </div>
    <!-- Sidebar -left -->
</div>

<!-- Left Sidebar End -->