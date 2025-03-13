@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Classes</h1>
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
        {{-- @include('flash::message') --}}
        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <form action="{{ route('admin.sclClasses.filter') }}" method="GET" class="form-inline">
                            <div class="form-group mx-sm-3 mb-2">
                                <input type="text" class="form-control" name="name" placeholder="Class Name" value="{{ request('name') }}">
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <select class="form-control" name="active_status">
                                    <option value="">-- Status --</option>
                                    <option value="1" {{ request('active_status') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ request('active_status') == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Filter</button>
                        </form>
                    </div>
                </div>

                @include('admin.sclClass.table')

                <div class="card-footer clearfix">
                    <div class="float-right">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
