@php
    $div = isset($div) ? $div : 'col-lg-4';
    $mt = isset($mt) ? $mt : 'mb-15';
    $required = $required ?? [];
    $selected = isset($selected) ? $selected : null;
    $country_id = $selected && isset($selected['country_id']) ? $selected['country_id'] : null;
    $city_id = $selected && isset($selected['city_id']) ? $selected['city_id'] : null;
    $cities = $country_id ? cities($country_id) : null;
    $visible = $visible ?? [];
@endphp

@if (in_array('country', $visible))
    <div class="{{ $div . ' ' . $mt }}" id="common_select_country_div">
        <div class="primary_input mb-25">
            <label class="primary_input_label" for="">{{ __('msg.country') }}
                <span class="text-danger">{{ in_array('country', $required) ? '*' : '' }}</span>
            </label>
            <select class="primary_select form-control{{ $errors->has('country_id') ? ' is-invalid' : '' }}"
                name="country_id" id="common_select_country">
                <option data-display="@lang('msg.select_country') {{ in_array('country', $required) ? '*' : '' }}" value="">
                    {{ __('msg.select_country') }} {{ in_array('country', $required) ? '*' : '' }}</option>
                    @if (isset($countries))
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}"
                                {{ isset($country_id) ? ($country_id == $country->id ? 'selected' : '') : '' }}>
                                {{ $country->name }}
                            </option>
                        @endforeach
                    @elseif (isset($record['model']) && $record['model'])
                        @foreach ($record['countries'] as $country)
                            <option value="{{ $country->id }}"
                                {{ isset($record['model']->country_id) && $record['model']->country_id == $country->id ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                        @endforeach
                    @endif
            </select>
            <div class="pull-right loader loader_style" id="common_select_country_loader">
                <img class="loader_img_style" src="{{ asset('gif/wait.gif') }}" alt="loader">
            </div>
        </div>
    </div>
@endif

@if (in_array('city', $visible))
    <div class="{{ $div . ' ' . $mt }}" id="common_select_city_div">
        <label class="primary_input_label" for="">{{ __('msg.city') }}
            <span class="text-danger">{{ in_array('city', $required) ? '*' : '' }}</span>
        </label>
        <select class="primary_select form-control{{ $errors->has('city_id') ? ' is-invalid' : '' }} select_city"
            id="common_select_city" name="city_id">
            <option data-display="@lang('msg.select_city') {{ in_array('city', $required) ? '*' : '' }}" value="">
                @lang('msg.select_city') {{ in_array('city', $required) ? '*' : '' }}</option>
            @if(isset($cities))
                @foreach ($cities as $city)
                    <option value="{{ $cities->id }}"
                        {{ isset($city_id) ? ($city_id == $city->id ? 'selected' : '') : '' }}>
                        {{ $city->name }}
                    </option>
                @endforeach
            @elseif (isset($record['model']) && $record['model'])
                @foreach ($record['cities'] as $city)
                    <option value="{{ $city->id }}"
                        {{ isset($record['model']->city_id) && $record['model']->city_id == $city->id ? 'selected' : '' }}>
                        {{ $city->name }}
                    </option>
                @endforeach
        @endif
        </select>
        <div class="pull-right loader loader_style" id="common_select_city_loader">
            <img src="{{ asset('gif/wait.gif') }}" alt="" style="width: 28px;height:28px;">
        </div>



    </div>
@endif

@push('scripts')
    <script>
        $(document).ready(function() {
            let country_required = "{{ in_array('country', $required) ? ' *' : '' }}";
            let city_required = "{{ in_array('city', $required) ? ' *' : '' }}";

            $("#common_select_country").on("change", function() {
                var i = 0;
                var formData = {
                    id: $(this).val(),
                };
                $.ajax({
                    type: "GET",
                    data: formData,
                    dataType: "json",
                    url: "{{ route('ajaxSelectCountryGetCity') }}",

                    beforeSend: function() {
                        $('#common_select_city_loader').addClass('pre_loader').removeClass(
                            'loader');
                    },
                    success: function(data) {
                        $("#common_select_city").empty().append(
                            $("<option>", {
                                value: '',
                                text: window.jsLang('select_city') + city_required,
                            })
                        );

                        if (data[0].length) {
                            $.each(data[0], function(i, city) {
                                $("#common_select_city").append(
                                    $("<option>", {
                                        value: city.id,
                                        text: city.name,
                                    })
                                );
                            });
                        }
                        $('#common_select_city').niceSelect('update');
                        $('#common_select_city').trigger('change');

                    },
                    error: function(data) {
                        console.log("Error:", data);
                    },
                    complete: function() {
                        i--;
                        if (i <= 0) {
                            $('#common_select_city_loader').removeClass('pre_loader')
                                .addClass('loader');
                        }
                    }
                });
            });
        });
    </script>
@endpush
