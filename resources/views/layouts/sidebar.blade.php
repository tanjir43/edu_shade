<div class="leftside-menu">
    <a href="" class="logo logo-light text-center">
        <span class="logo-lg">
            <img src="{{ asset('images/logo/edu_shade.png') }}" style="width: 250px;" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('images/logo/edu_shade.png') }}" style="width: 70px;" alt="small logo">
        </span>
    </a>
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <ul class="side-nav">
            <li class="side-nav-title side-nav-item">Navigation</li>

            <li class="side-nav-item">
                <a href="{{ route('admin.dashboard') }}" class="side-nav-link {{ request()->is('admin.dashboard') ? 'active' : '' }}">
                    <i class="mdi mdi-home"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('users') }}" class="side-nav-link {{ request()->is('users') ? 'active' : '' }}">
                    <i class="mdi mdi-account"></i>
                    <span> Users </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('setting') }}" class="side-nav-link {{ request()->is('setting') ? 'active' : '' }}">
                    <i class="mdi mdi-cogs"></i>
                    <span> setting </span>
                </a>
            </li>

        </ul>
        <div class="clearfix"></div>
    </div>
</div>
