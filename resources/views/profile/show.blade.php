@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        @include('profile.breadcumb')
    </nav>

    <!-- Profile Information -->
    <div class="card shadow-sm p-4">
        @include('profile.profile-information')
    </div>

    <!-- Update Password -->
    <div class="card shadow-sm p-4 mt-4">
        @include('profile.update-password')
    </div>

    <!-- Two Factor Authentication -->
    <div class="card shadow-sm p-4 mt-4">
        @include('profile.two-factor-authentication')
    </div>

    <!-- Browser Sessions -->
    <div class="card shadow-sm p-4 mt-4 mb-4">
        @include('profile.logout-other-browser-sessions')
    </div>
</div>
@endsection
