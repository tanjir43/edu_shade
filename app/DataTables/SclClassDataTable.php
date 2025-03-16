<?php
namespace App\DataTables;

use App\Models\SclClass;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class SclClassDataTable extends DataTable
{
    protected $settings;
    protected $withTrashed = 'active';

    public function dataTable($query)
    {
        $school = app('school');
        $query = $school->applyFilters($query);
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addColumn('status', function ($row) {
                return $row->active_status ?
                    '<span class="badge bg-soft-success text-success">active</span>' :
                    '<span class="badge bg-soft-danger text-danger">inactive</span>';
            })
            ->addColumn('action', function($row) {
                $data = [
                    'id' => $row->id,
                    'deleted_at' => isset($row->deleted_at) ? $row->deleted_at : null,
                ];
                return view('admin.sclClass.datatables_actions', $data)->render();
            })
            ->addColumn('checkbox', function($row) {
                return '<input type="checkbox" class="dt-checkboxes form-check-input" name="id[]" value="'.$row->id.'">';
            })
            ->addColumn('created_at_formatted', function($row) {
                return $row->created_at ? '<span class="date-column">' . $row->created_at->format('H:i a, d M, y') . '</span>' : '';
            })
            ->filter(function ($query) {
                if ($this->request()->has('name') && $this->request()->get('name') != '') {
                    $query->where('name', 'like', '%' . $this->request()->get('name') . '%');
                }

                if ($this->request()->has('active_status') && $this->request()->get('active_status') != '') {
                    $query->where('active_status', $this->request()->get('active_status'));
                }

                if ($this->request()->has('filter_trashed')) {
                    $trashedFilter = $this->request()->get('filter_trashed');
                    if ($trashedFilter == 'trashed') {
                        $query->onlyTrashed();
                    } else if ($trashedFilter == 'all') {
                        $query->withTrashed();
                    }
                } else if ($this->withTrashed == 'trashed') {
                    $query->onlyTrashed();
                } else if ($this->withTrashed == 'all') {
                    $query->withTrashed();
                }
            }, true)
            ->rawColumns(['status', 'action', 'checkbox', 'created_at_formatted']);
    }

    public function query(SclClass $model): QueryBuilder
    {
        $query = $model->newQuery();

        if ($this->withTrashed == 'trashed') {
            $query->onlyTrashed();
        } else if ($this->withTrashed == 'all') {
            $query->withTrashed();
        }

        return $query->select('scl_classes.*');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('scl-classes-table')
            ->columns($this->getColumns())
            ->minifiedAjax(route('admin.class.index'), "
                data.name = $('#filter-name').val();
                data.active_status = $('#filter-status').val();
                data.filter_trashed = $('#filter-trashed').val();
            ")
            ->dom('Brt<"row align-items-center"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>')
            ->orderBy(1, 'asc')
            ->parameters([
                'responsive' => true,
                'autoWidth'  => false,
                'processing' => true,
                'serverSide' => true,
                'searching'  => false,
                'stateSave'  => false,
                'pageLength' => 10,
                'lengthMenu' => [[10, 25, 50, 100], [10, 25, 50, 100]],
                'language' => [
                    'paginate' => [
                        'previous' => '<i class="fas fa-chevron-left"></i>',
                        'next' => '<i class="fas fa-chevron-right"></i>'
                    ],
                    'info' => "Showing _START_ to _END_ of _TOTAL_ entries",
                    'buttons' => [
                        'collection' => 'Export <i class="fas fa-angle-down"></i>',
                        'colvis' => 'Columns <i class="fas fa-angle-down"></i>'
                    ]
                ],
                'dom' => 'rt<"row align-items-center"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                'buttons' => [
                    'collection' => [
                        'className' => 'btn-light',
                        'buttonDisplay' => 'static',
                        'autoClose' => true
                    ],
                    'colvis' => [
                        'className' => 'btn-light',
                        'columns' => ':not(.noVis)',
                        'collectionLayout' => 'fixed'
                    ]
                ],
                'initComplete' => "function() {
                    // Add custom control elements
                    var tableWrapper = $(this).closest('.card-datatable');

                    if (tableWrapper.find('.table-control-panel').length === 0) {
                        // Create table control panel if it doesn't exist
                        var controlPanel = $('<div class=\"table-control-panel\"></div>');

                        // Bulk Actions (Initially Hidden)
                        var bulkActions = $('<div id=\"bulk-actions\" class=\"bulk-actions d-none me-3\"></div>');
                        bulkActions.append('<span id=\"selected-count\" class=\"badge bg-primary me-2\">0 selected</span>');

                        var bulkBtnGroup = $('<div class=\"btn-group\"></div>');
                        bulkBtnGroup.append('<button type=\"button\" id=\"bulk-delete-btn\" class=\"btn btn-sm btn-danger\"><i class=\"fas fa-trash\"></i> Delete</button>');
                        bulkBtnGroup.append('<button type=\"button\" id=\"bulk-restore-btn\" class=\"btn btn-sm btn-success trashed-action d-none\"><i class=\"fas fa-trash-restore\"></i> Restore</button>');
                        bulkBtnGroup.append('<button type=\"button\" id=\"bulk-force-delete-btn\" class=\"btn btn-sm btn-danger trashed-action d-none\"><i class=\"fas fa-trash-alt\"></i> Force Delete</button>');

                        bulkActions.append(bulkBtnGroup);
                        bulkActions.append('<button type=\"button\" id=\"clear-selection-btn\" class=\"btn btn-sm btn-secondary ms-2\"><i class=\"fas fa-times\"></i> Clear</button>');

                        // Length dropdown
                        var entriesControl = $('<div class=\"entries-control\"></div>');
                        entriesControl.append('Show ');
                        var lengthSelect = $('<select id=\"table-length-select\" class=\"form-select\"></select>');
                        lengthSelect.append('<option value=\"10\">10</option>');
                        lengthSelect.append('<option value=\"25\">25</option>');
                        lengthSelect.append('<option value=\"50\">50</option>');
                        lengthSelect.append('<option value=\"100\">100</option>');
                        entriesControl.append(lengthSelect);
                        entriesControl.append(' entries');

                        // Buttons
                        var tableButtons = $('<div class=\"table-buttons\"></div>');
                        tableButtons.append('<button class=\"btn btn-light export-btn\"><i class=\"fas fa-file-export\"></i> Export</button>');
                        tableButtons.append('<button class=\"btn btn-light columns-btn\"><i class=\"fas fa-columns\"></i> Columns</button>');
                        tableButtons.append('<button class=\"btn btn-primary filter-btn\"><i class=\"fas fa-filter\"></i> Filters</button>');

                        controlPanel.append(bulkActions);
                        controlPanel.append(entriesControl);
                        controlPanel.append(tableButtons);

                        // Add control panel before the table
                        tableWrapper.find('.card-body-datatable').prepend(controlPanel);

                        // Initialize event handlers for the newly added elements
                        lengthSelect.on('change', function() {
                            var table = window.LaravelDataTables[\"scl-classes-table\"];
                            table.page.len($(this).val()).draw();
                        });

                        $('.export-btn').on('click', function() {
                            // Simple export - you can enhance this with a dropdown
                            $('.buttons-excel').click();
                        });

                        $('.columns-btn').on('click', function() {
                            $('.buttons-colvis').click();
                        });

                        // Toggle trashed action buttons based on filter
                        $('#filter-trashed').on('change', function() {
                            if ($(this).val() === 'trashed') {
                                $('.trashed-action').removeClass('d-none');
                                $('#bulk-delete-btn').addClass('d-none');
                            } else {
                                $('.trashed-action').addClass('d-none');
                                $('#bulk-delete-btn').removeClass('d-none');
                            }
                        });
                    }

                    // Initialize row selection tracking
                    window.selectedRows = [];

                    // Select all checkbox handler
                    $(document).off('click', '#select-all-checkbox').on('click', '#select-all-checkbox', function() {
                        const isChecked = $(this).prop('checked');
                        $('.dt-checkboxes').prop('checked', isChecked);

                        if (isChecked) {
                            // Get all visible rows on the current page
                            $('.dt-checkboxes:visible').each(function() {
                                const id = $(this).val();
                                if (!window.selectedRows.includes(id)) {
                                    window.selectedRows.push(id);
                                }
                            });
                        } else {
                            // Clear selection for visible rows
                            $('.dt-checkboxes:visible').each(function() {
                                const id = $(this).val();
                                window.selectedRows = window.selectedRows.filter(item => item !== id);
                            });
                        }

                        updateBulkActionUI();
                    });

                    // Individual checkbox selection
                    $(document).off('click', '.dt-checkboxes').on('click', '.dt-checkboxes', function() {
                        const id = $(this).val();
                        const isChecked = $(this).prop('checked');

                        if (isChecked && !window.selectedRows.includes(id)) {
                            window.selectedRows.push(id);
                        } else if (!isChecked) {
                            window.selectedRows = window.selectedRows.filter(item => item !== id);
                            // Uncheck 'select all' if any row is unchecked
                            $('#select-all-checkbox').prop('checked', false);
                        }

                        updateBulkActionUI();
                    });

                    // Clear selection button
                    $(document).off('click', '#clear-selection-btn').on('click', '#clear-selection-btn', function() {
                        $('.dt-checkboxes').prop('checked', false);
                        $('#select-all-checkbox').prop('checked', false);
                        window.selectedRows = [];
                        updateBulkActionUI();
                    });

                    function updateBulkActionUI() {
                        if (window.selectedRows.length > 0) {
                            // Show bulk actions and counter
                            $('#bulk-actions').removeClass('d-none');
                            $('#selected-count').text(window.selectedRows.length + ' selected');
                        } else {
                            // Hide bulk actions
                            $('#bulk-actions').addClass('d-none');
                        }

                        // Ensure trashed action state is correct
                        if ($('#filter-trashed').val() === 'trashed') {
                            $('.trashed-action').removeClass('d-none');
                            $('#bulk-delete-btn').addClass('d-none');
                        } else {
                            $('.trashed-action').addClass('d-none');
                            $('#bulk-delete-btn').removeClass('d-none');
                        }
                    }

                    // Bulk delete action
                    $(document).off('click', '#bulk-delete-btn').on('click', '#bulk-delete-btn', function() {
                        if (window.selectedRows.length > 0) {
                            if (typeof Swal !== 'undefined') {
                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: `You are about to delete ` + window.selectedRows.length + ` selected items.`,
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#d33',
                                    cancelButtonColor: '#3085d6',
                                    confirmButtonText: 'Yes, delete them!'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        bulkDelete();
                                    }
                                });
                            } else {
                                if (confirm('Are you sure you want to delete ' + window.selectedRows.length + ' selected items?')) {
                                    bulkDelete();
                                }
                            }
                        } else {
                            toastr.warning('No items selected for deletion.');
                        }
                    });

                    function bulkDelete() {
                        $.ajax({
                            url: '" . route('admin.class.bulkDestroy') . "',
                            type: 'POST',
                            data: {
                                ids: window.selectedRows.join(','),
                                _token: $('meta[name=\"csrf-token\"]').attr('content')
                            },
                            success: function(response) {
                                // Show success message
                                toastr.success(response.message);

                                // Refresh the table
                                window.LaravelDataTables[`scl-classes-table`].draw();

                                // Reset selections
                                window.selectedRows = [];
                                $('#select-all-checkbox').prop('checked', false);
                                updateBulkActionUI();
                            },
                            error: function(error) {
                                toastr.error('Error occurred during bulk delete operation');
                                console.error(error);
                            }
                        });
                    }

                    // Bulk Restore Action with SweetAlert
                    $(document).off('click', '#bulk-restore-btn').on('click', '#bulk-restore-btn', function() {
                        if (window.selectedRows.length > 0) {
                            if (typeof Swal !== 'undefined') {
                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: `You are about to restore ` + window.selectedRows.length + ` selected items.`,
                                    icon: 'info',
                                    showCancelButton: true,
                                    confirmButtonColor: '#28a745',
                                    cancelButtonColor: '#6c757d',
                                    confirmButtonText: 'Yes, restore them!'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        bulkRestore();
                                    }
                                });
                            } else {
                                if (confirm('Are you sure you want to restore ' + window.selectedRows.length + ' selected items?')) {
                                    bulkRestore();
                                }
                            }
                        } else {
                            toastr.warning('No items selected for restoration.');
                        }
                    });

                    function bulkRestore() {
                        $.ajax({
                            url: '" . route('admin.class.bulkRestore') . "',
                            type: 'POST',
                            data: {
                                ids: window.selectedRows.join(','),
                                _token: $('meta[name=\"csrf-token\"]').attr('content')
                            },
                            success: function(response) {
                                toastr.success(response.message);
                                window.LaravelDataTables[`scl-classes-table`].draw();
                                window.selectedRows = [];
                                $('#select-all-checkbox').prop('checked', false);
                                updateBulkActionUI();
                            },
                            error: function(error) {
                                toastr.error('Error occurred during bulk restore operation');
                                console.error(error);
                            }
                        });
                    }

                    // Bulk Force Delete Action with SweetAlert
                    $(document).off('click', '#bulk-force-delete-btn').on('click', '#bulk-force-delete-btn', function() {
                        if (window.selectedRows.length > 0) {
                            if (typeof Swal !== 'undefined') {
                                Swal.fire({
                                    title: 'WARNING: This action cannot be undone!',
                                    text: `You are about to permanently delete ` + window.selectedRows.length + ` selected items. This cannot be reversed.`,
                                    icon: 'error',
                                    showCancelButton: true,
                                    confirmButtonColor: '#d33',
                                    cancelButtonColor: '#6c757d',
                                    confirmButtonText: 'Yes, delete them permanently!'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        bulkForceDelete();
                                    }
                                });
                            } else {
                                if (confirm('WARNING: This action cannot be undone. Are you sure you want to permanently delete ' + window.selectedRows.length + ' selected items?')) {
                                    bulkForceDelete();
                                }
                            }
                        } else {
                            toastr.warning('No items selected for deletion.');
                        }
                    });

                    function bulkForceDelete() {
                        $.ajax({
                            url: '" . route('admin.class.bulkForceDelete') . "',
                            type: 'POST',
                            data: {
                                ids: window.selectedRows.join(','),
                                _token: $('meta[name=\"csrf-token\"]').attr('content')
                            },
                            success: function(response) {
                                toastr.success(response.message);
                                window.LaravelDataTables[`scl-classes-table`].draw();
                                window.selectedRows = [];
                                $('#select-all-checkbox').prop('checked', false);
                                updateBulkActionUI();
                            },
                            error: function(error) {
                                toastr.error('Error occurred during bulk force delete operation');
                                console.error(error);
                            }
                        });
                    }

                }",
                'drawCallback' => "function() {
                    $('.dataTables_paginate > .pagination').addClass('pagination-rounded');

                    // Update checkbox state for selected rows
                    if (window.selectedRows && window.selectedRows.length > 0) {
                        $('.dt-checkboxes').each(function() {
                            const id = $(this).val();
                            if (window.selectedRows.includes(id)) {
                                $(this).prop('checked', true);
                            }
                        });
                    }
                }",
            ])
            ->buttons([
                Button::make('csv')
                    ->addClass('d-none buttons-csv')
                    ->exportOptions(['columns' => ':visible']),
                Button::make('excel')
                    ->addClass('d-none buttons-excel')
                    ->exportOptions(['columns' => ':visible']),
                Button::make('pdf')
                    ->addClass('d-none buttons-pdf')
                    ->exportOptions(['columns' => ':visible']),
                Button::make('print')
                    ->addClass('d-none buttons-print')
                    ->exportOptions(['columns' => ':visible']),
                Button::make('colvis')
                    ->addClass('d-none buttons-colvis'),
            ]);
    }

    protected function getColumns()
    {
        $columns = [
            Column::make('checkbox')
                ->title('<input type="checkbox" class="form-check-input" id="select-all-checkbox">')
                ->width(20)
                ->addClass('text-center dt-checkboxes-cell')
                ->orderable(false)
                ->searchable(false),
            Column::make('id')
                ->title('ID')
                ->width(60),
            Column::make('name')
                ->title('NAME')
                ->searchable(true),
            Column::make('class_code')
                ->title('CLASS CODE')
                ->searchable(true),
            Column::make('status')
                ->title('STATUS')
                ->width(100)
                ->addClass('text-center'),
            Column::make('created_at_formatted')
                ->title('CREATED AT')
                ->width(150)
                ->addClass('text-center')
                ->orderable(false),
            Column::computed('action')
                ->title('ACTIONS')
                ->width(80)
                ->addClass('text-center')
                ->exportable(false)
                ->printable(false),
        ];

        return $columns;
    }

    protected function filename(): string
    {
        return 'scl_classes_datatable_' . time();
    }
}
