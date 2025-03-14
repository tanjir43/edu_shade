<?php

namespace App\Repositories;

use App\Models\SclClass;
use App\Repositories\Interfaces\SclClassRepositoryInterface;

class SclClassRepository implements SclClassRepositoryInterface
{
    protected $model;

    public function __construct(SclClass $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $sclClass = $this->model->findOrFail($id);
        $sclClass->update($data);
        return $sclClass;
    }

    public function delete($id): bool
    {
        $ids = explode(',', $id);

        $sclClasses = $this->model->whereIn('id', $ids)->get();

        if ($sclClasses->isEmpty()) {
            return false;
        }

        return $this->model->whereIn('id', $ids)->delete();
    }

    public function restore($id)
    {
        $sclClass = $this->model->withTrashed()->findOrFail($id);
        $sclClass->restore();
        return $sclClass;
    }

    public function forceDelete($id)
    {
        $sclClass = $this->model->withTrashed()->findOrFail($id);
        $sclClass->forceDelete();
        return $sclClass;
    }
}
