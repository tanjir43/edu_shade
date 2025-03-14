@push('styles')
@endpush

{!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped table-bordered']) !!}

@push('scripts')
    @include('components.admin-data-table-component')

    {!! $dataTable->scripts() !!}
@endpush
