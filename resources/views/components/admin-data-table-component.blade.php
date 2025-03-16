<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.4.0/js/dataTables.fixedHeader.min.js"></script>


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
