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
        // Wait for DataTable to be fully initialized
        var dataTableInitialized = false;
        var table;

        // Function to initialize event handlers
        function initializeEventHandlers() {
            if (!dataTableInitialized) return;

            // Setup filter button
            $(document).on('click', '.filter-btn', function() {
                $('#filter-panel').toggleClass('d-none');
            });

            // Export button handler - properly triggers the Excel export
            $(document).on('click', '.export-btn', function() {
                table.button('.buttons-excel:first').trigger();
            });

            // Columns button handler - properly triggers the column visibility
            $(document).on('click', '.columns-btn', function() {
                table.button('.buttons-colvis:first').trigger();
            });

            // Reset filters
            $(document).on('click', '#btn-clear-filter', function() {
                $('#filter-name').val('');
                $('#filter-status').val('');
                table.draw();
            });

            // Apply filters
            $(document).on('click', '#btn-apply-filter', function() {
                table.draw();
                $('#filter-panel').addClass('d-none');
            });

            // Handle checkbox selection
            $(document).on('click', '#select-all-checkbox', function() {
                const isChecked = $(this).prop('checked');
                $('.dt-checkboxes').prop('checked', isChecked);
            });

            // Initialize tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();

            // Custom length menu
            $(document).on('change', '#table-length-select', function() {
                table.page.len($(this).val()).draw();
            });
        }

        // Check if DataTable exists and initialize
        var checkDataTable = setInterval(function() {
            if (window.LaravelDataTables && window.LaravelDataTables["scl-classes-table"]) {
                table = window.LaravelDataTables["scl-classes-table"];
                dataTableInitialized = true;

                // Initialize event handlers
                initializeEventHandlers();

                // Clear interval once initialized
                clearInterval(checkDataTable);
            }
        }, 100);
    });
</script>
@endpush
