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

            // Position the dropdown after it's created
            function positionDropdown($button) {
                // Remove any existing dropdowns first
                $('div.dt-button-collection-container').remove();

                // Hide filter panel if it's open
                $('#filter-panel').addClass('d-none');

                // Get the button position
                var buttonPos = $button.offset();
                var buttonHeight = $button.outerHeight();
                var buttonWidth = $button.outerWidth();

                // Create a container div at the right position
                var $container = $('<div class="dt-button-collection-container"></div>')
                    .css({
                        'position': 'absolute',
                        'top': buttonPos.top + buttonHeight + 5 + 'px',
                        'left': buttonPos.left + 'px',
                        'z-index': 10000
                    })
                    .appendTo('body');

                // Return the container
                return $container;
            }

            // Custom export button implementation
            $(document).on('click', '.export-btn', function(e) {
                e.preventDefault();
                e.stopPropagation();

                // Create dropdown container
                var $container = positionDropdown($(this));

                // Create dropdown content
                var $dropdown = $('<div class="export-dropdown"></div>').appendTo($container);

                // Add export options
                var exportOptions = [
                    { icon: 'fa-file-csv', text: 'CSV', action: 'buttons-csv' },
                    { icon: 'fa-file-excel', text: 'Excel', action: 'buttons-excel' },
                    { icon: 'fa-file-pdf', text: 'PDF', action: 'buttons-pdf' },
                    { icon: 'fa-print', text: 'Print', action: 'buttons-print' }
                ];

                exportOptions.forEach(function(option) {
                    $('<button class="dt-button dropdown-item"></button>')
                        .html('<i class="fas ' + option.icon + '"></i> ' + option.text)
                        .on('click', function() {
                            $container.remove();
                            // Use the direct selector for the button
                            $('.' + option.action + ':first').trigger('click');
                        })
                        .appendTo($dropdown);
                });

                // Add click outside to close
                $(document).one('click', function() {
                    $container.remove();
                });

                // Prevent dropdown from closing when clicking inside
                $dropdown.on('click', function(e) {
                    e.stopPropagation();
                });
            });

            // Custom columns button implementation
            $(document).on('click', '.columns-btn', function(e) {
                e.preventDefault();
                e.stopPropagation();

                // Create dropdown container
                var $container = positionDropdown($(this));

                // Create dropdown content
                var $dropdown = $('<div class="columns-dropdown"></div>').appendTo($container);

                // Get all columns
                var columns = table.columns().header().toArray();

                // Add column visibility options
                $(columns).each(function(i, col) {
                    var colTitle = $(col).text().trim();
                    if (colTitle && i > 0) { // Skip checkbox column
                        var isVisible = table.column(i).visible();

                        $('<div class="dropdown-item"></div>')
                            .append(
                                $('<label></label>')
                                    .append(
                                        $('<input type="checkbox">')
                                            .prop('checked', isVisible)
                                            .on('change', function(e) { // Change from click to change
                                                e.stopPropagation();
                                                table.column(i).visible(!isVisible);
                                            })
                                    )
                                    .append(' ' + colTitle)
                            )
                            .appendTo($dropdown);
                    }
                });

                // Add click outside to close
                $(document).one('click', function() {
                    $container.remove();
                });

                // Prevent dropdown from closing when clicking inside
                $dropdown.on('click', function(e) {
                    e.stopPropagation();
                });
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
