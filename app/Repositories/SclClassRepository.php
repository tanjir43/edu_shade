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

    public function getTrashed()
    {
        return $this->model->onlyTrashed()->get();
    }

    public function withTrashedItems()
    {
        return $this->model->withTrashed()->get();
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
        if (strpos($id, ',') !== false) {
            // Handle multiple IDs
            $ids = explode(',', $id);
            return $this->model->withTrashed()->whereIn('id', $ids)->restore();
        }

        // Handle single ID
        $sclClass = $this->model->withTrashed()->findOrFail($id);
        $sclClass->restore();
        return $sclClass;
    }

    public function forceDelete($id)
    {
        if (strpos($id, ',') !== false) {
            // Handle multiple IDs
            $ids = explode(',', $id);
            return $this->model->withTrashed()->whereIn('id', $ids)->forceDelete();
        }

        // Handle single ID
        $sclClass = $this->model->withTrashed()->findOrFail($id);
        $sclClass->forceDelete();
        return $sclClass;
    }
}
