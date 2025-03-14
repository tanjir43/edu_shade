<form action="{{ route('admin.sclClasses.destroy', $id) }}" method="POST" id="delete-form-{{ $id }}">
    @csrf
    @method('DELETE')
    <div class='btn-group'>
        <a href="{{ route('admin.sclClasses.show', $id) }}" class='btn btn-sm btn-outline-primary' title="View">
            <i class="fa fa-eye"></i>
        </a>
        <a href="{{ route('admin.sclClasses.edit', $id) }}" class='btn btn-sm btn-outline-success' title="Edit">
            <i class="fa fa-edit"></i>
        </a>
        <button type="button" class='btn btn-sm btn-outline-danger' title="Delete" onclick="if(confirm('Are you sure you want to delete this class?')) { document.getElementById('delete-form-{{ $id }}').submit(); }">
            <i class="fa fa-trash"></i>
        </button>
    </div>
</form>
