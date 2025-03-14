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

            <li class="side-nav-title side-nav-item">Core</li>
            <li class="side-nav-item menuitem-active">
                <a data-bs-toggle="collapse" href="#academic" aria-expanded="false" aria-controls="academic"
                    class="side-nav-link {{ request()->is('admin/class') || request()->is('admin/class*') ? 'active' : '' }}">
                    <i class="fa fa-school right-sidebar-icon"></i>
                    <span> Academics </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse {{ request()->is('admin/class') || request()->is('admin/class*') ? 'show' : '' }}" id="academic">
                    <ul class="side-nav-second-level">
                        <li class="{{ request()->is('admin/class') ? 'menuitem-active' : 'pl-30' }}">
                            <a href="{{ route('admin.class.index') }}" class="side-nav-link {{ request()->is('admin/class') ? 'active' : '' }}">
                                @if (request()->is('admin/class'))

                                <span class="child-indicator"><i class="fa fa-arrow-right right-sidebar-icon"></i></span>
                                @endif
                                <span> Class </span>
                            </a>
                        </li>

                        {{-- <li class="{{ request()->is('admin/sections') ? 'menuitem-active' : 'pl-30' }}">
                            <a href="" class="side-nav-link {{ request()->is('admin/sections') ? 'active' : '' }}">
                                @if (request()->is('admin/sections'))
                                    <span class="child-indicator"><i class="fa fa-arrow-right right-sidebar-icon"></i></span>
                                @endif
                                <span> Sections </span>
                            </a>
                        </li> --}}
                    </ul>
                </div>
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

<style>
/* Vertical line for active child item */

</style>
