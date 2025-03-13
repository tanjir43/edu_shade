<?php

namespace App\DataTables;

use App\Models\SclClass;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class SclClassDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addColumn('school', function ($row) {
                return $row->school ? $row->school->name : 'N/A';
            })
            ->addColumn('branch', function ($row) {
                return $row->branch ? $row->branch->name : 'N/A';
            })
            ->addColumn('version', function ($row) {
                return $row->version ? $row->version->name : 'N/A';
            })
            ->addColumn('shift', function ($row) {
                return $row->shift ? $row->shift->name : 'N/A';
            })
            ->editColumn('active_status', function ($row) {
                return $row->active_status ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
            })
            ->addColumn('action', 'admin.sclClass.datatables_actions')
            ->rawColumns(['active_status', 'action']);
    }

    public function query(SclClass $model)
    {
        return $model->newQuery()
            ->with(['school', 'branch', 'version', 'shift'])
            ->select('scl_classes.*');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => false,
                'order'     => [[1, 'ASC']],
                'buttons'   => [
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner'],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner'],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner'],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner'],
                ],
                'language' => [
                    'url' => url('//cdn.datatables.net/plug-ins/1.10.21/i18n/English.json'),
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id' => new Column(['title' => 'ID', 'data' => 'id']),
            'name' => new Column(['title' => __('Name'), 'data' => 'name']),
            'class_code' => new Column(['title' => __('Class Code'), 'data' => 'class_code']),
            'class_level' => new Column(['title' => __('Class Level'), 'data' => 'class_level']),
            'school' => new Column(['title' => __('School'), 'data' => 'school', 'name' => 'school.name']),
            'branch' => new Column(['title' => __('Branch'), 'data' => 'branch', 'name' => 'branch.name']),
            'version' => new Column(['title' => __('Version'), 'data' => 'version', 'name' => 'version.name']),
            'shift' => new Column(['title' => __('Shift'), 'data' => 'shift', 'name' => 'shift.name']),
            'active_status' => new Column(['title' => __('Status'), 'data' => 'active_status'])
        ];
    }

    protected function filename(): string
    {
        return 'scl_classes_datatable_' . time();
    }
}
