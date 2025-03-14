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
            ->addColumn('action', function($row) {
                return view('admin.sclClass.datatables_actions', ['id' => $row->id])->render();
            })
            ->filterColumn('name', function($query, $keyword) {
                $query->where('name', 'like', "%{$keyword}%");
            })
            ->filterColumn('active_status', function($query, $keyword) {
                $query->where('active_status', $keyword);
            })
            ->rawColumns(['active_status', 'action']);
    }

    /**
     * Get query source of dataTable.
     */
    public function query(SclClass $model): QueryBuilder
    {
        $query = $model->newQuery()
            ->with(['branch', 'version', 'shift'])
            ->select('scl_classes.*');

        // Apply filters from request if they exist
        if (request()->has('name') && request()->name != '') {
            $query->where('name', 'like', '%' . request()->name . '%');
        }

        if (request()->has('active_status') && request()->active_status != '') {
            $query->where('active_status', request()->active_status);
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
            ->minifiedAjax(route('admin.sclClasses.index'), null, [
                'name' => '$("#filter-name").val()',
                'active_status' => '$("#filter-status").val()',
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
                    // [
                    //     'extend' => 'reset',
                    //     'className' => 'btn btn-sm btn-secondary',
                    //     'text' => '<i class="fa fa-undo"></i> Reset'
                    // ],
                    // [
                    //     'extend' => 'reload',
                    //     'className' => 'btn btn-sm btn-secondary',
                    //     'text' => '<i class="fa fa-sync-alt"></i> Reload'
                    // ],
                ],
                'responsive' => true,
                'processing' => true,
                'serverSide' => true,
                'autoWidth' => false,
                'drawCallback' => "function() {
                    $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
                }",
                'initComplete' => "function() {
                    $('.dt-buttons .btn').removeClass('btn-secondary');
                    $('.dt-buttons').addClass('btn-group');
                }",
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->title('ID')->width(80),
            Column::make('name')->title('Name'),
            Column::make('class_code')->title('Class Code'),
            Column::make('class_level')->title('Class Level'),
            Column::make('branch')->title('Branch'),
            Column::make('version')->title('Version'),
            Column::make('shift')->title('Shift'),
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
