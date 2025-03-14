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
                    <div class="filter-form row">
                        <div class="col-md-4 mb-2">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-school"></i></span>
                                <input type="text" class="form-control" id="filter-name" placeholder="Class Name" value="{{ $filters['name'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-toggle-on"></i></span>
                                <select class="form-select" id="filter-status">
                                    <option value="">-- Status --</option>
                                    <option value="1" {{ isset($filters['active_status']) && $filters['active_status'] == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ isset($filters['active_status']) && $filters['active_status'] == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-5 mb-2">
                            <button type="button" id="btn-filter" class="btn btn-primary">
                                <i class="fa fa-filter me-1"></i> Filter
                            </button>
                            <button type="button" id="btn-reset" class="btn btn-secondary ms-1">
                                <i class="fa fa-redo me-1"></i> Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="">
                @include('admin.sclClass.table')
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    /* Ensure table columns do not break layout */
    .table th, .table td {
        white-space: nowrap; /* Prevents text from wrapping */
    }

    /* Force table cells to wrap on smaller screens */
    @media (max-width: 768px) {
        .table-responsive {
            overflow-x: auto;
        }

        .table th, .table td {
            white-space: normal;
            word-wrap: break-word;
        }
    }


    /* Hide the default "Search:" label */
    .dataTables_filter label {
        margin-bottom: 0;
    }

    /* Style the search input */
    .dataTables_filter .input-group {
        width: 300px;
    }

    /* Adjust spacing between buttons and search */
    .dt-buttons {
        margin-right: 15px;
    }

    /* Make sure the search input is the right size */
    .dataTables_filter .form-control {
        height: calc(1.5em + 0.5rem + 2px);
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }

    /* Style the input group text (search icon) */
    .dataTables_filter .input-group-text {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }

    /* Make the wrapper flex to align items properly */
    .dataTables_wrapper .row:first-child {
        align-items: center;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Get the DataTable instance
        var dataTable = $('#scl-classes-table').DataTable();

        // Handle filter button click
        $('#btn-filter').on('click', function() {
            dataTable.draw();
        });

        // Handle reset button click
        $('#btn-reset').on('click', function() {
            $('#filter-name').val('');
            $('#filter-status').val('');
            dataTable.search('').draw(); // Clear DataTable search too
        });

        // Add responsive behavior for smaller screens
        $(window).resize(function() {
            if ($(window).width() < 768) {
                $('.table-responsive').addClass('table-responsive-sm');
            } else {
                $('.table-responsive').removeClass('table-responsive-sm');
            }
        }).resize();

        // Make DataTable search trigger when hitting Enter
        $('.dataTables_filter input').unbind();
        $('.dataTables_filter input').bind('keyup', function(e) {
            if(e.keyCode == 13) {
                dataTable.search(this.value).draw();
            }
        });
    });
</script>
@endpush
