<div class="action-btn">
    @if(isset($deleted_at) && $deleted_at)
        <div class="btn-group">
            <form action="{{ route('admin.class.restore', $id) }}" method="POST" id="restore-form-{{ $id }}" class="d-inline">
                @csrf
                <button type="button" class="btn btn-icon btn-action-restore text-success btn-icon-hover"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="Restore"
                        onclick="confirmAction('{{ $id }}', 'restore')">
                    <i class="fas fa-trash-restore"></i>
                </button>
            </form>

            <form action="{{ route('admin.class.forceDelete', $id) }}" method="POST" id="force-delete-form-{{ $id }}" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-icon btn-action-force-delete text-danger btn-icon-hover ms-1"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently Delete"
                        onclick="confirmForceDelete('{{ $id }}')">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </form>
        </div>
    @else
        <button type="button" class="btn btn-icon text-primary btn-icon-hover"
            data-bs-toggle="tooltip" data-bs-placement="top" title="View"
            onclick="window.location.href='{{ route('admin.class.show', $id) }}'">
            <i class="fa fa-eye"></i>
        </button>

        <button type="button" class="btn btn-icon text-success btn-icon-hover"
            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"
            onclick="window.location.href='{{ route('admin.class.edit', $id) }}'">
            <i class="fa fa-edit"></i>
        </button>

        <form action="{{ route('admin.class.destroy', $id) }}" method="POST" id="delete-form-{{ $id }}" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-icon btn-action-delete text-danger btn-icon-hover ms-1"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                    onclick="confirmDelete('{{ $id }}', 'class')">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    @endif
</div>

<script src="{{asset('js/delete-confirmation.js')}}"></script>
