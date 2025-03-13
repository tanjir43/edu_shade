<?php

namespace App\DataTables;

use App\Models\Advertise;
use App\Models\SclClass;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class AdvertiseDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->editColumn('image', function ($line) {
                return '<img src="' . $line->getFirstMediaUrl('default') . '" style="height:25px;width:auto" title="' . $line->title . '">';
            })
            ->editColumn('french_image', function ($line) {
                return '<img src="' . $line->getFirstMediaUrl('french_images') . '" style="height:25px;width:auto" title="' . $line->title . '">';
            })
            ->addColumn('action', 'admin.advertises.datatables_actions')
            ->rawColumns(['image', 'french_image', 'action']);
    }

    public function query(SclClass $model)
    {
        return $model->newQuery();
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
            ->parameters(array_merge(
                config('datatables-buttons.parameters'), [
                    'language' => json_decode(
                        file_get_contents(base_path('resources/lang/'.app()->getLocale().'/datatable.json')
                        ),true),
                    'stateSave' => false,
                    'order'     => [[1, 'ASC']],
                    'buttons' => [
                        'export',
                        'print',
                        'reset',
                        'reload',
                    ],
                ]
            ));
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'image' => new Column(['title' => __('Image'), 'data' => 'image','name' => 'id','orderable'=>false,'searchable'=>false]),
            'french_image' => new Column(['title' => __('French Image'), 'data' => 'french_image','name' => 'french_imaget','orderable'=>false,'searchable'=>false]),
            'title',
            'subtitle',
            'description',
            'btn_text'
        ];
    }

    protected function filename(): string
    {
        return 'advertises_datatable_' . time();
    }
}
