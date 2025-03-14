@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Create Class</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <form action="{{ route('admin.sclClasses.store') }}" method="POST">
                @csrf

                <div class="card-body">
                    <div class="row">
                        @include('admin.sclClass.fields')
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('admin.sclClasses.index') }}" class="btn btn-default">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
