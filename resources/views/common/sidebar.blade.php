<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <i class="fas fa-drumstick-bite"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Oshxona tizimi</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Asosiy
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    @if(auth()->user()->role_id == 2)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('attendances.index') }}">
                <i class="fas fa-book"></i>
                <span>Kunlik hisobot kiritish</span></a>
        </li>
    @endif

    <li class="nav-item">
        <a class="nav-link" href="{{ route('attendances.departmentReport') }}">
            <i class="fas fa-book"></i>
            <span>Bo'limlar bo'yicha hisobot</span></a>
    </li>

    @if(auth()->user()->role_id == 1)

        <li class="nav-item">
            <a class="nav-link" href="{{ route('attendances.report1c') }}">
                <i class="fas fa-book"></i>
                <span>1c hisobot (Bo'limlar)</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('attendances.employeesReport') }}">
                <i class="fas fa-book"></i>
                <span>1c hisobot (Hodimlar)</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('users.index') }}">
                <i class="fas fa-user-alt"></i>
                <span>Foydalanuvchilar</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('departments.index') }}">
                <i class="fas fa-book"></i>
                <span>Bo'limlar</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('positions.index') }}">
                <i class="fas fa-book"></i>
                <span>Lavozimlar</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('employees.index') }}">
                <i class="fas fa-book"></i>
                <span>Hodimlar</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('absenceTypes.index') }}">
                <i class="fas fa-book"></i>
                <span>Ishga kelmaslik sabablari</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('shifts.index') }}">
                <i class="fas fa-book"></i>
                <span>Smenalar</span></a>
        </li>

    @endif
    <!-- Divider -->
    <hr class="sidebar-divider">

    {{--    @hasrole('Admin')--}}
    {{--    <!-- Heading -->--}}
    {{--    <div class="sidebar-heading">--}}
    {{--        Admin Section--}}
    {{--    </div>--}}

    {{--    <!-- Nav Item - Pages Collapse Menu -->--}}
    {{--    <li class="nav-item">--}}
    {{--        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"--}}
    {{--           aria-expanded="true" aria-controls="collapsePages">--}}
    {{--            <i class="fas fa-fw fa-folder"></i>--}}
    {{--            <span>Masters</span>--}}
    {{--        </a>--}}
    {{--        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">--}}
    {{--            <div class="bg-white py-2 collapse-inner rounded">--}}
    {{--                <h6 class="collapse-header">Role & Permissions</h6>--}}
    {{--                <a class="collapse-item" href="{{ route('roles.index') }}">Roles</a>--}}
    {{--                <a class="collapse-item" href="{{ route('permissions.index') }}">Permissions</a>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </li>--}}

    {{--    <!-- Divider -->--}}
    {{--    <hr class="sidebar-divider d-none d-md-block">--}}
    {{--    @endhasrole--}}

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt"></i>
            <span>Tizimdan chiqish</span>
        </a>
    </li>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
