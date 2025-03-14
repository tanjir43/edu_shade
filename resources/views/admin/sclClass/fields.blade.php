<!-- Name Field -->
<div class="form-group col-sm-6">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="{{ old('name', $sclClass->name ?? '') }}" class="form-control" maxlength="200" required>
</div>

<!-- Class Code Field -->
<div class="form-group col-sm-6">
    <label for="class_code">Class Code:</label>
    <input type="text" name="class_code" id="class_code" value="{{ old('class_code', $sclClass->class_code ?? '') }}" class="form-control" maxlength="50">
</div>


<!-- School Field -->
<div class="form-group col-sm-6">
    <label for="school_id">School:</label>
    <select name="school_id" id="school_id" class="form-control select2" required>
        <option value="">Select School</option>
        @foreach($schools as $id => $name)
            <option value="{{ $id }}" {{ (old('school_id', $sclClass->school_id ?? '') == $id) ? 'selected' : '' }}>{{ $name }}</option>
        @endforeach
    </select>
</div>

<!-- Branch Field -->
<div class="form-group col-sm-6">
    <label for="branch_id">Branch:</label>
    <select name="branch_id" id="branch_id" class="form-control select2">
        <option value="">Select Branch</option>
        @foreach($branches as $id => $name)
            <option value="{{ $id }}" {{ (old('branch_id', $sclClass->branch_id ?? '') == $id) ? 'selected' : '' }}>{{ $name }}</option>
        @endforeach
    </select>
</div>

<!-- Version Field -->
<div class="form-group col-sm-6">
    <label for="version_id">Version:</label>
    <select name="version_id" id="version_id" class="form-control select2">
        <option value="">Select Version</option>
        @foreach($versions as $id => $name)
            <option value="{{ $id }}" {{ (old('version_id', $sclClass->version_id ?? '') == $id) ? 'selected' : '' }}>{{ $name }}</option>
        @endforeach
    </select>
</div>

<!-- Shift Field -->
<div class="form-group col-sm-6">
    <label for="shift_id">Shift:</label>
    <select name="shift_id" id="shift_id" class="form-control select2">
        <option value="">Select Shift</option>
        @foreach($shifts as $id => $name)
            <option value="{{ $id }}" {{ (old('shift_id', $sclClass->shift_id ?? '') == $id) ? 'selected' : '' }}>{{ $name }}</option>
        @endforeach
    </select>
</div>

<!-- Active Status Field -->
<div class="form-group col-sm-6">
    <label for="active_status">Status:</label>
    <select name="active_status" id="active_status" class="form-control" required>
        <option value="1" {{ (old('active_status', $sclClass->active_status ?? 1) == 1) ? 'selected' : '' }}>Active</option>
        <option value="0" {{ (old('active_status', $sclClass->active_status ?? 1) == 0) ? 'selected' : '' }}>Inactive</option>
    </select>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap4',
        });
    });
</script>
@endpush
