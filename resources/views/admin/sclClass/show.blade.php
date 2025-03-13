@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Class Details</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('admin.sclClasses.index') }}">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('admin.sclClass.show_fields')
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.sclClasses.edit', $sclClass->id) }}" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>
@endsection
