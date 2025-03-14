<!-- ID Field -->
<div class="col-sm-12">
    <label>ID:</label>
    <p>{{ $sclClass->id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    <label>Name:</label>
    <p>{{ $sclClass->name }}</p>
</div>

<!-- Class Code Field -->
<div class="col-sm-12">
    <label>Class Code:</label>
    <p>{{ $sclClass->class_code ?? 'N/A' }}</p>
</div>

<!-- Class Level Field -->
<div class="col-sm-12">
    <label>Class Level:</label>
    <p>{{ $sclClass->class_level ?? 'N/A' }}</p>
</div>

<!-- School Field -->
<div class="col-sm-12">
    <label>School:</label>
    <p>{{ $sclClass->school ? $sclClass->school->name : 'N/A' }}</p>
</div>

<!-- Branch Field -->
<div class="col-sm-12">
    <label>Branch:</label>
    <p>{{ $sclClass->branch ? $sclClass->branch->name : 'N/A' }}</p>
</div>

<!-- Version Field -->
<div class="col-sm-12">
    <label>Version:</label>
    <p>{{ $sclClass->version ? $sclClass->version->name : 'N/A' }}</p>
</div>

<!-- Shift Field -->
<div class="col-sm-12">
    <label>Shift:</label>
    <p>{{ $sclClass->shift ? $sclClass->shift->name : 'N/A' }}</p>
</div>

<!-- Active Status Field -->
<div class="col-sm-12">
    <label>Status:</label>
    <p>{{ $sclClass->active_status ? 'Active' : 'Inactive' }}</p>
</div>

<!-- Created By Field -->
<div class="col-sm-12">
    <label>Created By:</label>
    <p>{{ $sclClass->createdBy ? $sclClass->createdBy->name : 'N/A' }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    <label>Created At:</label>
    <p>{{ $sclClass->created_at->format('Y-m-d H:i:s') }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    <label>Updated At:</label>
    <p>{{ $sclClass->updated_at->format('Y-m-d H:i:s') }}</p>
</div>
