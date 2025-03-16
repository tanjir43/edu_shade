@push('styles')
<link rel="stylesheet" href="{{ asset('custom/css/custom-datatable.css') }}">

@endpush

<div class="card card-datatable">
    <div class="card-header card-header-datatable d-flex justify-content-between align-items-center">
        <h5>Data Table</h5>

        <div class="d-flex align-items-center">
            <!-- Bulk Actions -->
            <div id="bulk-actions" class="d-none me-2">
                <span id="selected-count" class="badge bg-primary me-2">0 selected</span>

                <div class="btn-group">
                    <button type="button" id="bulk-delete-btn" class="btn btn-sm btn-danger btn-action-delete">
                        <i class="fas fa-trash"></i> Delete
                    </button>

                    <button type="button" id="bulk-restore-btn" class="btn btn-sm btn-success btn-action-restore trashed-action d-none">
                        <i class="fas fa-trash-restore"></i> Restore
                    </button>

                    <button type="button" id="bulk-force-delete-btn" class="btn btn-sm btn-danger btn-action-force-delete ms-2 trashed-action d-none">
                        <i class="fas fa-trash-alt"></i> Force Delete
                    </button>
                </div>

                <button type="button" id="clear-selection-btn" class="btn btn-sm btn-secondary ms-2">
                    <i class="fas fa-times"></i> Clear
                </button>
            </div>
        </div>
    </div>

    <div class="card-body card-body-datatable">
        <div id="filter-panel" class="filter-panel d-none">
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="filter-name" class="form-label">Search</label>
                        <div class="form-search">
                            <i class="fas fa-search"></i>
                            <input type="text" id="filter-name" class="form-control" placeholder="Search...">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="filter-status" class="form-label">Status</label>
                        <select id="filter-status" class="form-select">
                            <option value="">All</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="filter-trashed" class="form-label">Data Type</label>
                        <select id="filter-trashed" class="form-select">
                            <option value="active">Active Records</option>
                            <option value="trashed">Trashed Records</option>
                            <option value="all">All Records</option>
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
            'id'    => 'scl-classes-table'
        ]) !!}
    </div>
</div>

@push('scripts')
    @include('components.admin-data-table-component')
    {!! $dataTable->scripts() !!}

    <script>
            $(document).ready(function() {
        $('#filter-trashed').on('change', function() {
            if ($(this).val() === 'trashed') {
                $('.trashed-action').removeClass('d-none');
                $('#bulk-delete-btn').addClass('d-none');
            } else {
                $('.trashed-action').addClass('d-none');
                $('#bulk-delete-btn').removeClass('d-none');
            }
        });

        // Clear selection button
        $('#clear-selection-btn').on('click', function() {
            $('.dt-checkboxes').prop('checked', false);
            $('#select-all-checkbox').prop('checked', false);
            selectedRows = [];
            updateBulkActionUI();
        });
    });
    </script>
@endpush
