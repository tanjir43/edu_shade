<!-- ID Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'ID:') !!}
    <p>{{ $sclClass->id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $sclClass->name }}</p>
</div>

<!-- Class Code Field -->
<div class="col-sm-12">
    {!! Form::label('class_code', 'Class Code:') !!}
    <p>{{ $sclClass->class_code ?? 'N/A' }}</p>
</div>

<!-- Class Level Field -->
<div class="col-sm-12">
    {!! Form::label('class_level', 'Class Level:') !!}
    <p>{{ $sclClass->class_level ?? 'N/A' }}</p>
</div>

<!-- School Field -->
<div class="col-sm-12">
    {!! Form::label('school_id', 'School:') !!}
    <p>{{ $sclClass->school ? $sclClass->school->name : 'N/A' }}</p>
</div>

<!-- Branch Field -->
<div class="col-sm-12">
    {!! Form::label('branch_id', 'Branch:') !!}
    <p>{{ $sclClass->branch ? $sclClass->branch->name : 'N/A' }}</p>
</div>

<!-- Version Field -->
<div class="col-sm-12">
    {!! Form::label('version_id', 'Version:') !!}
    <p>{{ $sclClass->version ? $sclClass->version->name : 'N/A' }}</p>
</div>

<!-- Shift Field -->
<div class="col-sm-12">
    {!! Form::label('shift_id', 'Shift:') !!}
    <p>{{ $sclClass->shift ? $sclClass->shift->name : 'N/A' }}</p>
</div>

<!-- Active Status Field -->
<div class="col-sm-12">
    {!! Form::label('active_status', 'Status:') !!}
    <p>{{ $sclClass->active_status ? 'Active' : 'Inactive' }}</p>
</div>

<!-- Created By Field -->
<div class="col-sm-12">
    {!! Form::label('created_by', 'Created By:') !!}
    <p>{{ $sclClass->createdBy ? $sclClass->createdBy->name : 'N/A' }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $sclClass->created_at->format('Y-m-d H:i:s') }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $sclClass->updated_at->format('Y-m-d H:i:s') }}</p>
</div>
