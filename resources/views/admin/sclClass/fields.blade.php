@if (@$sclClass)
    <form action="{{ route('admin.class.update', $sclClass->id) }}" method="POST">
        @csrf
        @method('PATCH')
@else
    <form action="{{ route('admin.class.store') }}" method="POST">
        @csrf
@endif

<div class="row mb-4">

    <!-- Name Field -->
    <div class="col-md-12">
        <div class="form-group">
            <label for="name">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name', $sclClass->name ?? '') }}"
                class="form-control" maxlength="200" required>
        </div>
    </div>

    <!-- Class Code Field -->
    <div class="col-md-12">
        <div class="form-group">
            <label for="class_code">Class Code</label>
            <input type="text" name="class_code" id="class_code" value="{{ old('class_code', $sclClass->class_code ?? '') }}"
                class="form-control" maxlength="50">
        </div>
    </div>

    <!-- Active Status Field -->
    <div class="col-md-12">
        <div class="form-group">
            <label for="active_status">Status <span class="text-danger">*</span></label>
            <select name="active_status" id="active_status" class="form-control" required>
                <option value="1" {{ (old('active_status', $sclClass->active_status ?? 1) == 1) ? 'selected' : '' }}>Active</option>
                <option value="0" {{ (old('active_status', $sclClass->active_status ?? 1) == 0) ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
    </div>

    <hr class="mt-3">

    <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</div>
</form>
