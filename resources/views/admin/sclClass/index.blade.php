@extends('layouts.admin')

@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <ol class="breadcrumb bg-light p-3 rounded d-flex justify-content-between">
                <li class="breadcrumb-item active" aria-current="page">Class List</li>
                <li class="breadcrumb-item">
                    <a href="">Academic</a> | Class Management
                </li>
            </ol>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-sm-6 col-lg-8">
                    <h3 class="m-0">Class Management</h3>
                </div>
                <div class="col-sm-6 col-lg-4 text-sm-end mt-3 mt-sm-0">
                    <a class="btn btn-primary" href="{{ route('admin.sclClasses.create') }}">
                        <i class="fa fa-plus-circle me-1"></i> Add New Class
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="filter-form row">
                        <div class="col-md-4 mb-2">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-school"></i></span>
                                <input type="text" class="form-control" id="filter-name" placeholder="Class Name" value="{{ $filters['name'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-toggle-on"></i></span>
                                <select class="form-select" id="filter-status">
                                    <option value="">-- Status --</option>
                                    <option value="1" {{ isset($filters['active_status']) && $filters['active_status'] == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ isset($filters['active_status']) && $filters['active_status'] == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-5 mb-2">
                            <button type="button" id="btn-filter" class="btn btn-primary">
                                <i class="fa fa-filter me-1"></i> Filter
                            </button>
                            <button type="button" id="btn-reset" class="btn btn-secondary ms-1">
                                <i class="fa fa-redo me-1"></i> Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="">
                @include('admin.sclClass.table')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('custom/js/core/filter/scl_class_filter.js')}}"></script>
@endpush
