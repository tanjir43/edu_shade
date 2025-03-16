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
    var dataTableInitialized = false;
    var table;

    function initializeEventHandlers() {
        if (!dataTableInitialized) return;

        $(document).on('click', '.filter-btn', function() {
            $('#filter-panel').toggleClass('d-none');
        });

        function positionDropdown($button) {
            $('div.dt-button-collection-container').remove();

            $('#filter-panel').addClass('d-none');

            var buttonPos       = $button.offset();
            var buttonHeight    = $button.outerHeight();
            var buttonWidth     = $button.outerWidth();

            var $container = $('<div class="dt-button-collection-container"></div>')
                .css({
                    'position': 'absolute',
                    'top': buttonPos.top + buttonHeight + 5 + 'px',
                    'left': buttonPos.left + 'px',
                    'z-index': 10000
                })
                .appendTo('body');

            return $container;
        }

        $(document).on('click', '.export-btn', function(e) {
            e.preventDefault();
            e.stopPropagation();

            var $container = positionDropdown($(this));

            var $dropdown = $('<div class="export-dropdown"></div>').appendTo($container);

            var exportOptions = [
                {
                    icon: 'fa-file-csv',
                    text: 'CSV',
                    action: function() {
                        var visibleCols = [];
                        table.columns().every(function(index) {
                            if(table.column(index).visible()) {
                                visibleCols.push(index);
                            }
                        });

                        table.buttons.exportData({
                            columns: visibleCols,
                            format: {
                                header: function (data, columnIdx) {
                                    return $(table.column(columnIdx).header()).text().trim();
                                }
                            }
                        });

                        table.button('.buttons-csv').trigger();
                    }
                },
                {
                    icon: 'fa-file-excel',
                    text: 'Excel',
                    action: function() {
                        table.button('.buttons-excel').trigger();
                    }
                },
                {
                    icon: 'fa-file-pdf',
                    text: 'PDF',
                    action: function() {
                        table.button('.buttons-pdf').trigger();
                    }
                },
                {
                    icon: 'fa-print',
                    text: 'Print',
                    action: function() {
                        table.button('.buttons-print').trigger();
                    }
                }
            ];

            exportOptions.forEach(function(option) {
                $('<button class="dt-button dropdown-item"></button>')
                    .html('<i class="fas ' + option.icon + '"></i> ' + option.text)
                    .on('click', function() {
                        $container.remove();
                        option.action();
                    })
                    .appendTo($dropdown);
            });

            $(document).one('click', function() {
                $container.remove();
            });

            $dropdown.on('click', function(e) {
                e.stopPropagation();
            });
        });

        $(document).on('click', '.columns-btn', function(e) {
            e.preventDefault();
            e.stopPropagation();

            var $container = positionDropdown($(this));

            var $dropdown = $('<div class="columns-dropdown"></div>').appendTo($container);

            var columns = table.columns().header().toArray();

            $(columns).each(function(i, col) {
                var colTitle = $(col).text().trim();
                if (colTitle && i > 0) {
                    var isVisible = table.column(i).visible();

                    $('<div class="dropdown-item"></div>')
                        .append(
                            $('<label></label>')
                                .append(
                                    $('<input type="checkbox">')
                                        .prop('checked', isVisible)
                                        .on('change', function(e) {
                                            e.stopPropagation();
                                            table.column(i).visible(!isVisible);
                                        })
                                )
                                .append(' ' + colTitle)
                        )
                        .appendTo($dropdown);
                }
            });

            $(document).one('click', function() {
                $container.remove();
            });

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

            initializeEventHandlers();

            clearInterval(checkDataTable);
        }
    }, 100);
});
</script>
@endpush
