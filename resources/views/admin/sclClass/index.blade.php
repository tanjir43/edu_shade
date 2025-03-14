@extends('layouts.admin')

@section('content')
    <!-- Breadcrumb Section with Consistent Styling -->
    <div class="row mb-3">
        <div class="col-12">
            <ol class="breadcrumb bg-light p-3 rounded d-flex justify-content-between">
                <li class="breadcrumb-item active" aria-current="page">Account Settings</li>
                <li class="breadcrumb-item">
                    <a href="">Profile</a> | Account Settings
                </li>
            </ol>
        </div>
    </div>

    <!-- Header Section with Consistent Card Styling -->
    <div class="card mb-3">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-sm-6 col-lg-8">
                    <h3 class="m-0">Class Management</h3>
                </div>
                <div class="col-sm-6 col-lg-4 text-sm-end mt-3 mt-sm-0">
                    <a class="btn btn-primary" href="{{ route('admin.sclClasses.create') }}">
                        <i class="fa fa-plus-circle me-1"></i> Add New Class
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-12">
                    <form action="{{ route('admin.sclClasses.filter') }}" method="GET" class="filter-form row">
                        <div class="col-md-4 mb-2">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-school"></i></span>
                                <input type="text" class="form-control" name="name" placeholder="Class Name" value="{{ request('name') }}">
                            </div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-toggle-on"></i></span>
                                <select class="form-select" name="active_status">
                                    <option value="">-- Status --</option>
                                    <option value="1" {{ request('active_status') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ request('active_status') == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5 mb-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-filter me-1"></i> Filter
                            </button>
                            <a href="{{ route('admin.sclClasses.index') }}" class="btn btn-secondary ms-1">
                                <i class="fa fa-redo me-1"></i> Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                @include('admin.sclClass.table')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Enhance search box with icon
        $('.dataTables_filter label').html(function(index, html) {
            return html.replace('Search:', '<i class="fa fa-search me-1"></i> Search:');
        });

        // Add responsive behavior for smaller screens
        $(window).resize(function() {
            if ($(window).width() < 768) {
                $('.table-responsive').addClass('table-responsive-sm');
            } else {
                $('.table-responsive').removeClass('table-responsive-sm');
            }
        }).resize();
    });
</script>
@endpush
