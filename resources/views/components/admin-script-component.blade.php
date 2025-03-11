<script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('saas/js/vendor.min.js') }}"></script>
<script src="{{ asset('saas/js/app.min.js') }}"></script>
<script src="{{ asset('js/jsLang.js') }}"></script>

<script>
    const openLeft = $('#open_left');
    const topSearch = $('#top-search');
    const searchDropdown = $('#search-dropdown');

    $(document).ready(function () {
        openLeft.on('click', function () {
            setTimeout(() => {
                let srcwidth = topSearch.css('width');
                searchDropdown.attr('style', `width:${srcwidth}`)
            }, 200);
        });
    });
</script>

{{--Alert JS Start--}}
<script  src="{{asset('common/js/sweetalert2.min.js')}}"></script>
<script  src="{{asset('common/js/toastr.min.js')}}"></script>
<script  src="{{asset('common/js/alert.js')}}"></script>
<script  src="{{asset('common/js/ajax.js')}}"></script>
<script  src="{{asset('common/js/common.js')}}"></script>
{{--Alert JS End--}}

@include('common.sweetalert-msg')

@if(session('alert_type') == 'toastr')
    @if($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                toastr.error('{{ $error }}', 'Error!');
            </script>
        @endforeach
    @endif
@endif
@stack('scripts')
