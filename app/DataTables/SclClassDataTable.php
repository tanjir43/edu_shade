<?php

namespace App\DataTables;

use App\Models\SclClass;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Button;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class SclClassDataTable extends DataTable
{
    /**
     * Build DataTable class.
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addColumn('branch', function ($row) {
                return $row->branch ? $row->branch->name : 'N/A';
            })
            ->addColumn('version', function ($row) {
                return $row->version ? $row->version->name : 'N/A';
            })
            ->addColumn('shift', function ($row) {
                return $row->shift ? $row->shift->name : 'N/A';
            })
            ->addColumn('school', function ($row) {
                return $row->school ? $row->school->name : 'N/A';
            })
            ->addColumn('status', function ($row) {
                return $row->active_status ?
                    '<span class="badge bg-success">Active</span>' :
                    '<span class="badge bg-danger">Inactive</span>';
            })
            ->addColumn('action', function($row) {
                return view('admin.sclClass.datatables_actions', ['id' => $row->id])->render();
            })
            ->filter(function ($query) {
                // This ensures the global search works across all searchable columns
                if ($this->request()->has('search') && $this->request()->search['value'] != '') {
                    $searchValue = $this->request()->search['value'];
                    $query->where(function($query) use ($searchValue) {
                        $query->where('name', 'like', "%{$searchValue}%")
                            ->orWhere('class_code', 'like', "%{$searchValue}%")
                            ->orWhere('class_level', 'like', "%{$searchValue}%")
                            ->orWhereHas('school', function($q) use ($searchValue) {
                                $q->where('name', 'like', "%{$searchValue}%");
                            })
                            ->orWhereHas('branch', function($q) use ($searchValue) {
                                $q->where('name', 'like', "%{$searchValue}%");
                            })
                            ->orWhereHas('version', function($q) use ($searchValue) {
                                $q->where('name', 'like', "%{$searchValue}%");
                            })
                            ->orWhereHas('shift', function($q) use ($searchValue) {
                                $q->where('name', 'like', "%{$searchValue}%");
                            });
                    });
                }
            }, true) // true = skip the default global search
            ->rawColumns(['status', 'action']);
    }

    /**
     * Get query source of dataTable.
     */
    public function query(SclClass $model): QueryBuilder
    {
        $query = $model->newQuery()
            ->with(['branch', 'version', 'shift', 'school'])
            ->select('scl_classes.*');

        // Apply filters from request if they exist
        if ($this->request()->has('name') && $this->request()->name != '') {
            $query->where('name', 'like', '%' . $this->request()->name . '%');
        }

        if ($this->request()->has('active_status') && $this->request()->active_status != '') {
            $query->where('active_status', $this->request()->active_status);
        }

        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('scl-classes-table')
            ->columns($this->getColumns())
            ->ajax([
                'url' => route('admin.sclClasses.index'),
                'data' => 'function(d) {
                    d.name = $("#filter-name").val();
                    d.active_status = $("#filter-status").val();
                }'
            ])
            ->responsive(true)
            ->orderBy(1, 'asc')
            ->addAction(['width' => '120px', 'printable' => false, 'title' => 'Action', 'class' => 'text-center'])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'buttons'   => [
                    [
                        'extend' => 'csv',
                        'className' => 'btn btn-sm btn-secondary csv',
                        'text' => '<i class="fa fa-file-csv"></i> CSV'
                    ],
                    [
                        'extend' => 'excel',
                        'className' => 'btn btn-sm btn-secondary excel',
                        'text' => '<i class="fa fa-file-excel"></i> Excel'
                    ],
                    [
                        'extend' => 'pdf',
                        'className' => 'btn btn-sm btn-secondary pdf',
                        'text' => '<i class="fa fa-file-pdf"></i> PDF'
                    ],
                    [
                        'extend' => 'print',
                        'className' => 'btn btn-sm btn-secondary print',
                        'text' => '<i class="fa fa-print"></i> Print'
                    ],
                ],
                'responsive' => true,
                'processing' => true,
                'serverSide' => true,
                'autoWidth' => false,
                'searching' => true, // Explicitly enable searching
                'drawCallback' => "function() {
                    $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
                }",
                'initComplete' => "function() {
                    $('.dt-buttons .btn').removeClass('btn-secondary');
                    $('.dt-buttons').addClass('btn-group');
                    // Make the search box more visible
                    $('.dataTables_filter').addClass('mb-3');
                    $('.dataTables_filter input').addClass('form-control');
                    $('.dataTables_filter label').addClass('form-label d-flex align-items-center');
                    $('.dataTables_filter input').attr('placeholder', 'Search all columns...');
                }",
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->title('ID')->width(60),
            Column::make('name')->title('Name')->searchable(true),
            Column::make('class_code')->title('Class Code')->searchable(true),
            Column::make('class_level')->title('Class Level')->searchable(true),
            Column::make('school')->title('School')->searchable(true),
            Column::make('branch')->title('Branch')->searchable(true),
            Column::make('version')->title('Version')->searchable(true),
            Column::make('shift')->title('Shift')->searchable(true),
            Column::computed('status')
                ->title('Status')
                ->width(100)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     */
    protected function filename(): string
    {
        return 'scl_classes_datatable_' . time();
    }
}
