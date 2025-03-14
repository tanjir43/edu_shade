@extends('layouts.admin')

@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <ol class="breadcrumb bg-light p-3 rounded d-flex justify-content-between">
                <li class="breadcrumb-item active" aria-current="page">Class Management</li>
                <li class="breadcrumb-item">
                    <a href="">Academic</a> | Class List
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h3>Class List</h3>
                </div>
                <div class="card-body">
                    @include('admin.sclClass.table')
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3>Class Information</h3>
                </div>
                <div class="card-body">
                    @include('admin.sclClass.fields')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('custom/js/core/filter/scl_class_filter.js')}}"></script>
@endpush
