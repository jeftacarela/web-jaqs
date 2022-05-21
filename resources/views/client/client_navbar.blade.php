<!-- Left Sidebar Start -->
<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <a href="{{ route('client') }}" class="waves-effect">
                        <i class="dripicons-meter"></i><span class="badge badge-info badge-pill float-right"></span> <span> Dashboard </span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('client/detail') }}" class="waves-effect">
                        <i class="dripicons-to-do"></i><span class="badge badge-info badge-pill float-right"></span> <span> Project </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('client/profile') }}" class="waves-effect">
                        <i class="dripicons-user"></i><span class="badge badge-info badge-pill float-right"></span> <span> Profile </span>
                    </a>
                </li>
                {{-- <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-to-do"></i><span> List<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{ route('user/management') }}">User</a></li>
                        <li><a href="{{ route('form/information/show') }}">Company List</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-document"></i><span>Form Input<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span></a>
                    <ul class="submenu">
                        <li><a href="{{ route('user/management') }}">User</a></li>
                        <li><a href="{{ route('form/information/new') }}">Company</a></li>
                        <li><a href="{{ route('form/project/new') }}">Project</a></li>
                        <li><a href="{{ route('form/task/new') }}">Task</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="waves-effect  mm-active"><i class="dripicons-list"></i><span> Reporting <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li class="mm-active">
                            <a href="{{ route('user/management') }}">All User</a>
                            <a href="{{ route('form/information/show') }}">All Company</a>
                            <a href="{{ route('form/project/show') }}">All Project</a>
                            <a href="{{ route('form/task/show') }}">All Task</a>
                            {{-- <a href="{{ route('form/invoice/show') }}">Invoice</a> --}}
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- Sidebar -left -->
</div>

<!-- Left Sidebar End -->