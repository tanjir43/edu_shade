{!! Form::open(['route' => ['admin.sclClasses.destroy', $id], 'method' => 'delete', 'id' => 'delete-form-'.$id]) !!}
<div class='btn-group'>
    <a href="{{ route('admin.sclClasses.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route('admin.sclClasses.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Are you sure you want to delete this class?')"
    ]) !!}
</div>
{!! Form::close() !!}
