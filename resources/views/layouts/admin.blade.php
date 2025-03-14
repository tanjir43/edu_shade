<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" translate="{{ env('TRANSLATE', 0) }}">

<head>
    <x-admin-meta-component />

    <title>{{ config('app.name', 'Edu Shade') }}</title>

    <x-admin-style-component />

    @yield('css')
</head>

<body class="show" data-layout-color="light" data-layout-mode="fluid" data-rightbar-onstart="true"
    data-leftbar-theme="dark">

    <div class="wrapper">
        @include('layouts.sidebar')
        <div class="content-page">
            <div class="content">
                @include('layouts.topbar')

                <div class="container-fluid mt-2">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <x-admin-script-component />

    <script>
        @if(session('success'))
            toastr.success('{{ session('success') }}', 'Success!');
        @endif

        @if(session('error'))
            toastr.error('{{ session('error') }}', 'Error!');
        @endif

        @if(session('info'))
            toastr.info('{{ session('info') }}', 'Info!');
        @endif

        @if(session('warning'))
            toastr.warning('{{ session('warning') }}', 'Warning!');
        @endif
    </script>
</body>

</html>
