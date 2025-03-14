<?php

namespace App\DataTables;

use App\Models\SclClass;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class SclClassDataTable extends DataTable
{
    protected $settings;

    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
        ->addColumn('status', function ($row) {
            return $row->active_status ?
                '<span class="badge bg-success">Active</span>' :
                '<span class="badge bg-danger">Inactive</span>';
        })
        ->addColumn('action', function($row) {
            return view('admin.sclClass.datatables_actions', ['id' => $row->id])->render();
        })
        ->filter(function ($query) {
            if ($this->request()->has('search') && $this->request()->search['value'] != '') {
                $searchValue = $this->request()->search['value'];
                $query->where(function($query) use ($searchValue) {
                    $query->where('name', 'like', "%{$searchValue}%")
                    ->orWhere('class_code', 'like', "%{$searchValue}%");
                });
            }
        }, true)
        ->rawColumns(['status', 'action']);
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
        ->ajax([
            'url' => route('admin.class.index'),
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
            'autoWidth'  => false,
            'searching'  => true,
            'drawCallback' => "function() {
                $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
            }",
            'initComplete' => "function() {
                $('.dt-buttons .btn').addClass('btn-secondary');
                $('.dt-buttons').addClass('btn-group');
                $('.dataTables_filter').addClass('mb-3');
                $('.dataTables_filter input').addClass('form-control');
                $('.dataTables_filter input').attr('placeholder', 'Search all columns...');
            }",
        ]);
    }

    protected function getColumns()
    {
        $columns = [
            Column::make('id')->title('ID')->width(60),
            Column::make('name')->title('Name')->searchable(true),
            Column::make('class_code')->title('Class Code')->searchable(true),
        ];

        $columns[] = Column::computed('status')->title('Status')->width(100)->addClass('text-center');

        return $columns;
    }

    protected function filename(): string
    {
        return 'scl_classes_datatable_' . time();
    }
}
