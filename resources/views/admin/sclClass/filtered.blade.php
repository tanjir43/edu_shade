@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Filtered Classes</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('admin.sclClasses.create') }}">
                        Add New
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        @include('flash::message')
        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <form action="{{ route('admin.sclClasses.filter') }}" method="GET" class="form-inline">
                            <div class="form-group mx-sm-3 mb-2">
                                <input type="text" class="form-control" name="name" placeholder="Class Name" value="{{ $filters['name'] ?? '' }}">
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <select class="form-control" name="active_status">
                                    <option value="">-- Status --</option>
                                    <option value="1" {{ isset($filters['active_status']) && $filters['active_status'] == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ isset($filters['active_status']) && $filters['active_status'] == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Filter</button>
                            <a href="{{ route('admin.sclClasses.index') }}" class="btn btn-default mb-2 ml-2">Clear Filters</a>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Class Code</th>
                                <th>Class Level</th>
                                <th>School</th>
                                <th>Branch</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sclClasses as $sclClass)
                                <tr>
                                    <td>{{ $sclClass->id }}</td>
                                    <td>{{ $sclClass->name }}</td>
                                    <td>{{ $sclClass->class_code ?? 'N/A' }}</td>
                                    <td>{{ $sclClass->class_level ?? 'N/A' }}</td>
                                    <td>{{ $sclClass->school ? $sclClass->school->name : 'N/A' }}</td>
                                    <td>{{ $sclClass->branch ? $sclClass->branch->name : 'N/A' }}</td>
                                    <td>
                                        @if($sclClass->active_status)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['admin.sclClasses.destroy', $sclClass->id], 'method' => 'delete', 'id' => 'delete-form-'.$sclClass->id]) !!}
                                        <div class='btn-group'>
                                            <a href="{{ route('admin.sclClasses.show', $sclClass->id) }}" class='btn btn-default btn-xs'>
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.sclClasses.edit', $sclClass->id) }}" class='btn btn-default btn-xs'>
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            {!! Form::button('<i class="fa fa-trash"></i>', [
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-xs',
                                                'onclick' => "return confirm('Are you sure you want to delete this class?')"
                                            ]) !!}
                                        </div>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer clearfix">
                    <div class="float-right">
                        {{ $sclClasses->appends($filters)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
