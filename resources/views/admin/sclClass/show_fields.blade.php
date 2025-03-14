<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Class Details</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th scope="row">ID:</th>
                            <td>{{ $sclClass->id }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Name:</th>
                            <td>{{ $sclClass->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Class Code:</th>
                            <td>{{ $sclClass->class_code ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">School:</th>
                            <td>{{ $sclClass->school ? $sclClass->school->name : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Branch:</th>
                            <td>{{ $sclClass->branch ? $sclClass->branch->name : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Version:</th>
                            <td>{{ $sclClass->version ? $sclClass->version->name : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Shift:</th>
                            <td>{{ $sclClass->shift ? $sclClass->shift->name : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Status:</th>
                            <td>
                                <span class="badge {{ $sclClass->active_status ? 'badge-success' : 'badge-danger' }}">
                                    {{ $sclClass->active_status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Created By:</th>
                            <td>{{ $sclClass->createdBy ? $sclClass->createdBy->name : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Created At:</th>
                            <td>{{ $sclClass->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Updated At:</th>
                            <td>{{ $sclClass->updated_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('admin.sclClasses.edit', $sclClass->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('admin.sclClasses.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </div>
</div>
