@extends('layouts.app')

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
        @include('adminlte-templates::common.errors')

        <div class="card">
            {!! Form::open(['route' => 'admin.sclClasses.store']) !!}

            <div class="card-body">
                <div class="row">
                    @include('admin.sclClass.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('admin.sclClasses.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection
