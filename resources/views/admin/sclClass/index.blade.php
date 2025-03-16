@extends('layouts.admin')

@section('content')
<div class="row mb-3">
    <div class="col-12">
        <ol class="breadcrumb bg-light p-3 rounded d-flex justify-content-between">
            <li class="breadcrumb-item active" aria-current="page">Class Management</li>
            <li class="breadcrumb-item">
                <a href="">Academic</a> | Class List
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
        @include('admin.sclClass.table')
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Class Information</h5>
            </div>
            <div class="card-body">
                @include('admin.sclClass.fields')
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Setup event handlers after DataTable is initialized
        var table = window.LaravelDataTables["scl-classes-table"];

        // Setup filter button
        $('.filter-button, .filter-btn').on('click', function() {
            $('#filter-panel').toggleClass('d-none');
        });

        // Connect filter elements
        $('#filter-name, #filter-status').on('change', function() {
            table.draw();
        });

        // Reset filters
        $('#btn-clear-filter').on('click', function() {
            $('#filter-name').val('');
            $('#filter-status').val('');
            table.draw();
        });

        // Apply filters
        $('#btn-apply-filter').on('click', function() {
            table.draw();
            $('#filter-panel').addClass('d-none');
        });

        // Handle checkbox selection
        $('#select-all-checkbox').on('click', function() {
            const isChecked = $(this).prop('checked');
            $('.dt-checkboxes').prop('checked', isChecked);
        });

        // Initialize tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();

        // Custom length menu
        var lengthSelect = $('#table-length-select');
        if (lengthSelect.length) {
            lengthSelect.on('change', function() {
                table.page.len($(this).val()).draw();
            });
        }
    });
</script>
@endpush
