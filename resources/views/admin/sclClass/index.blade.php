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
        @include('admin.sclClass.table')
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Class Information</h5>
            </div>
            <div class="card-body">
                @include('admin.sclClass.fields')
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

{!! $dataTable->scripts() !!}

    @include('components.admin-data-table-component')

</script>
@endpush
