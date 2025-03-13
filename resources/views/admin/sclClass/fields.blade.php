<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'maxlength' => 200, 'required']) !!}
</div>

<!-- Class Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('class_code', 'Class Code:') !!}
    {!! Form::text('class_code', null, ['class' => 'form-control', 'maxlength' => 50]) !!}
</div>

<!-- Class Level Field -->
<div class="form-group col-sm-6">
    {!! Form::label('class_level', 'Class Level:') !!}
    {!! Form::number('class_level', null, ['class' => 'form-control', 'min' => 1, 'max' => 255]) !!}
</div>

<!-- School Field -->
<div class="form-group col-sm-6">
    {!! Form::label('school_id', 'School:') !!}
    {!! Form::select('school_id', $schools, null, ['class' => 'form-control select2', 'required']) !!}
</div>

<!-- Branch Field -->
<div class="form-group col-sm-6">
    {!! Form::label('branch_id', 'Branch:') !!}
    {!! Form::select('branch_id', $branches, null, ['class' => 'form-control select2', 'placeholder' => 'Select Branch']) !!}
</div>

<!-- Version Field -->
<div class="form-group col-sm-6">
    {!! Form::label('version_id', 'Version:') !!}
    {!! Form::select('version_id', $versions, null, ['class' => 'form-control select2', 'placeholder' => 'Select Version']) !!}
</div>

<!-- Shift Field -->
<div class="form-group col-sm-6">
    {!! Form::label('shift_id', 'Shift:') !!}
    {!! Form::select('shift_id', $shifts, null, ['class' => 'form-control select2', 'placeholder' => 'Select Shift']) !!}
</div>

<!-- Active Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('active_status', 'Status:') !!}
    {!! Form::select('active_status', [1 => 'Active', 0 => 'Inactive'], null, ['class' => 'form-control', 'required']) !!}
</div>

@push('page_scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap4',
        });
    });
</script>
@endpush
