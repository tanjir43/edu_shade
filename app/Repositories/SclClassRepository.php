<?php

namespace App\Repositories;

use App\Models\SclClass;
use App\Filters\SclClassFilter;
use App\Repositories\Interfaces\SclClassRepositoryInterface;

class LabelRepository implements SclClassRepositoryInterface
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
        $label = $this->model->findOrFail($id);
        $label->update($data);
        return $label;
    }

    public function delete($id): bool
    {
        $ids = explode(',', $id);

        $labels = $this->model->whereIn('id', $ids)->get();

        if ($labels->isEmpty()) {
            return false;
        }

        return $this->model->whereIn('id', $ids)->delete();
    }

    public function filter(array $filters)
    {
        $query = $this->model->newQuery();

        $filter = new SclClassFilter();
        $filter->apply($query, $filters);

        $perPage = $filters['per_page'] ?? 10;
        return $query->paginate($perPage);
    }

    public function restore($id)
    {
        $label = $this->model->withTrashed()->findOrFail($id);
        $label->restore();
        return $label;
    }

    public function forceDelete($id)
    {
        $label = $this->model->withTrashed()->findOrFail($id);
        $label->forceDelete();
        return $label;
    }
}
