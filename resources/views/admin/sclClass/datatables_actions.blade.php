<div class="action-btn">
    <form action="{{ route('admin.class.destroy', $id) }}" method="POST" id="delete-form-{{ $id }}" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="button" class="btn btn-icon text-danger"
                data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                onclick="confirmDelete('{{ $id }}', 'class')">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</div>

<script>
    function confirmDelete(id, type) {
        if (confirm('Are you sure you want to delete this ' + type + '?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
