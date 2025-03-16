<div class="action-btn">
    @if(isset($deleted_at) && $deleted_at)
        <div class="btn-group">
            <form action="{{ route('admin.class.restore', $id) }}" method="POST" id="restore-form-{{ $id }}" class="d-inline">
                @csrf
                <button type="button" class="btn btn-icon text-success"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="Restore"
                        onclick="confirmAction('{{ $id }}', 'restore')">
                    <i class="fas fa-trash-restore"></i>
                </button>
            </form>

            <form action="{{ route('admin.class.forceDelete', $id) }}" method="POST" id="force-delete-form-{{ $id }}" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-icon text-danger"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently Delete"
                        onclick="confirmForceDelete('{{ $id }}')">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </form>
        </div>
    @else
        <form action="{{ route('admin.class.destroy', $id) }}" method="POST" id="delete-form-{{ $id }}" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-icon text-danger"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                    onclick="confirmDelete('{{ $id }}', 'class')">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    @endif
</div>

<script>
    function confirmDelete(id, type) {
        if (confirm('Are you sure you want to delete this ' + type + '?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }

    function confirmForceDelete(id) {
        if (confirm('WARNING: This action cannot be undone. Are you sure you want to permanently delete this item?')) {
            document.getElementById('force-delete-form-' + id).submit();
        }
    }

    function confirmAction(id, action) {
        let message = '';
        if (action === 'restore') {
            message = 'Are you sure you want to restore this item?';
        }

        if (confirm(message)) {
            document.getElementById(action + '-form-' + id).submit();
        }
    }
</script>
