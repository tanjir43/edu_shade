s<?php
    $user = Auth::user();
?>

<div class="navbar-custom">
    <ul class="list-unstyled topbar-menu float-end mb-0">
        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="dripicons-search noti-icon"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                <form class="p-3">
                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                </form>
            </div>
        </li>

        {{-- lang --}}
        <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                @if (app()->getLocale() == 'bn')
                    <img src="{{ asset('images/flags/bd.png') }}" alt="English" class="me-0 me-sm-1" height="12">
                    <span class="align-middle d-none d-sm-inline-block">Bangla</span>
                @else
                    <img src="{{ asset('images/flags/us.jpg') }}" alt="English" class="me-0 me-sm-1" height="12">
                    <span class="align-middle d-none d-sm-inline-block">English</span>
                @endif
                <i class="mdi mdi-chevron-down d-none d-sm-inline-block align-middle"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu">

                @if (app()->getLocale() == 'en')
                    <a href="" class="dropdown-item notify-item">
                        <img src="{{ asset('images/flags/bd.png') }}" alt="Bangla" class="me-1" height="12">
                        <span class="align-middle">Bangla</span>
                    </a>
                @else
                    <a href="" class="dropdown-item notify-item">
                        <img src="{{ asset('images/flags/us.jpg') }}" alt="English" class="me-1" height="12">
                        <span class="align-middle">English</span>
                    </a>
                @endif

            </div>
        </li>


        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="dripicons-bell noti-icon"></i>
                <span class="noti-icon-badge"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated notification-dropdown-lg">
                <div class="dropdown-item noti-title px-3">
                    <h5 class="m-0">
                        <span class="float-end">
                            <a href="javascript: void(0);" class="text-dark">
                                <small>Clear All</small>
                            </a>
                        </span>Notification
                    </h5>
                </div>
                <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-0 border-start-0 border-end-0">
                    <div class="card-body py-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="notify-icon bg-primary">
                                    <i class="mdi mdi-comment-account-outline"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 text-truncate ms-2">
                                <h5 class="noti-item-title fw-semibold font-14 m-0">Order No. #999999999999
                                    <small class="fw-normal text-muted ms-1 float-end">1 min ago</small>
                                </h5>
                                <small class="noti-item-subtitle text-muted">Updated by admin.</small>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item border-top border-light py-2">
                    View All
                </a>
            </div>
        </li>

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <span class="account-user-avatar">
                    <img src="{{ asset('images/min-none-default.png') }}" alt="User" class="rounded-circle">
                </span>
                <span>
                    <span class="account-user-name">User Name</span>
                    <span class="account-position">User Role</span>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0 text-center text-uppercase font-weight-bold" style="font-size: 13px">Welcome!</h6>
                </div>
                <a href="{{route('profile.show')}}" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-circle me-1"></i>
                    <span>My Account Settings</span>
                </a>
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="mdi mdi-lock-outline me-1"></i>
                    <span>Lock Screen</span>
                </a>
                <a href="#" class="dropdown-item notify-item">
                    <i class="mdi mdi-logout me-1"></i>
                    <span>Logout</span>
                </a>
            </div>
        </li>
    </ul>
</div>
