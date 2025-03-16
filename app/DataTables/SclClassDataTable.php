<?php
// Updated SclClassDataTable.php

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
                return view('admin.sclClass.datatables_actions', ['id' => $row->id])->render();
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
            }, true)
            ->rawColumns(['status', 'action', 'checkbox', 'created_at_formatted']);
    }

    public function query(SclClass $model): QueryBuilder
    {
        $query = $model->newQuery();
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
            ")
            ->dom('rt<"row align-items-center"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>')
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
                        tableButtons.append('<div class=\"btn-group\"><button class=\"btn btn-light\"><i class=\"fas fa-th-large\"></i></button></div>');

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
                    }
                }",
                'drawCallback' => "function() {
                    $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
                }",
            ])
            ->buttons([
                Button::make('csv')->addClass('d-none buttons-csv')->exportOptions(['columns' => ':visible']),
                Button::make('excel')->addClass('d-none buttons-excel')->exportOptions(['columns' => ':visible']),
                Button::make('pdf')->addClass('d-none buttons-pdf')->exportOptions(['columns' => ':visible']),
                Button::make('print')->addClass('d-none buttons-print')->exportOptions(['columns' => ':visible']),
                Button::make('colvis')->addClass('d-none'),
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
