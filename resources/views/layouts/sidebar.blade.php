<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Protected Page
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('protected.admin') }}">
            <i class="fas fa-users-cog"></i>
            <span>Halaman Admin</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('protected.user') }}">
            <i class="fas fa-users-cog"></i>
            <span>Halaman User 1</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-users-cog"></i>
            <span>Halaman level 3</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Settings
    </div>
    <!-- Nav Item - User Management -->
    @if (auth()->user()->hasRole('admin'))

    <li class="nav-item {{ $page == 'user' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user') }}">
            <i class="fas fa-users-cog"></i>
            <span>User Management</span></a>
    </li>
    <li class="nav-item {{ $page == 'activity' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('act') }}">
            <i class="fas fa-clipboard-list"></i>
            <span>Activity Log</span></a>
    </li>
    @endif

    @guest
    <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">
            <i class="fas fa-users-cog"></i>
            <span>Login</span></a>
    </li>

    @else
    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            <span>logout</span></a>
        {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
        </form> --}}
    </li>
    @endguest

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
