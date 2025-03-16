@push('styles')
<link rel="stylesheet" href="{{ asset('custom/css/enhanced-datatable.css') }}">

@endpush

<div class="card card-datatable">
    <div class="card-header card-header-datatable">
        <h5>Data Table</h5>
    </div>

    <div class="card-body card-body-datatable">
        <!-- Filter Panel (initially hidden) -->
        <div id="filter-panel" class="filter-panel d-none">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="filter-name" class="form-label">Search</label>
                        <div class="form-search">
                            <i class="fas fa-search"></i>
                            <input type="text" id="filter-name" class="form-control" placeholder="Search...">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="filter-status" class="form-label">Status</label>
                        <select id="filter-status" class="form-select">
                            <option value="">All</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="filter-buttons">
                <button type="button" id="btn-clear-filter" class="btn btn-clear-filter">Clear Filters</button>
                <button type="button" id="btn-apply-filter" class="btn btn-apply-filter">Apply</button>
            </div>
        </div>

        <!-- DataTable -->
        {!! $dataTable->table([
            'width' => '100%',
            'class' => 'table table-hover dt-responsive nowrap',
            'id' => 'scl-classes-table'
        ]) !!}
    </div>
</div>

@push('scripts')
    @include('components.admin-data-table-component')
    {!! $dataTable->scripts() !!}
@endpush
