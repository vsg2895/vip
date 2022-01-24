<div class="row default-row mt-xl-2 mt-lg-2 mt-md-2 mt-3 justify-content-center">
    <!--Check data -->
    <div class="col-md-12 d-flex flex-wrap">

    @if(isset($locations) && count($locations) > 0)
        <!-- Location select option -->
            <div class="form-group col-md-3 col-sm-6 col-6">
                <!-- Label -->
                <!-- Select -->
                <select name="location" form="filteringForm" class="input-default w-100 p-2">
                    <!-- Default value -->
                    <option value="0"
                            @if(\Request::session()->has('filter_location') && \Request::session()->get('filter_location') == '0') selected @endif>{{ translating('location') }}</option>

                    <!-- Loop from options -->
                @foreach($locations as $location)
                    <!-- Option -->
                        <option value="{{ $location->id }}"
                                @if(\Request::session()->has('filter_location') && \Request::session()->get('filter_location') == $location->id) selected @endif>{{ $location->{'title_'.app()->getLocale()} }}</option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="form-group col-md-3 col-sm-6 col-6">

            <select name="electro_type" form="filteringForm" class="input-default w-100 p-2">
            {{-- adds controllers category and filtr functions new session filter_post_estate_type--}}
            <!-- Default value -->
                <option value="default"
                        @if(\Request::session()->has('filter_post_elec_type') && \Request::session()->get('filter_post_elec_type') == 'default') selected @endif>{{ translating('post_estate_type') }}</option>
                <!-- Other Values -->
                <option value="0"
                        @if(\Request::session()->has('filter_post_elec_type') && \Request::session()->get('filter_post_elec_type') == '0')  selected @endif>{{ translating('filter-elec-new') }}</option>
                <option value="1"
                        @if(\Request::session()->has('filter_post_elec_type') && \Request::session()->get('filter_post_elec_type') == '1')  selected @endif>{{ translating('filter-elec-old') }}</option>
            </select>

        </div>
        <div class="form-group col-md-3 col-sm-6 col-6">
            <!-- Select -->
            <select name="auth_type" form="filteringForm" class="input-default w-100 p-2">

                <!-- Default value -->
                <option value="default"
                        @if(\Request::session()->has('filter_auth_type') && \Request::session()->get('filter_auth_type') == 'default') selected @endif>{{ translating('auth-type') }}</option>

                <!-- Other Values -->
                <option value="0"
                        @if(\Request::session()->has('filter_auth_type') && \Request::session()->get('filter_auth_type') == '0')  selected @endif>{{ translating('filter-owner-type-value') }}</option>
                <option value="1"
                        @if(\Request::session()->has('filter_auth_type') && \Request::session()->get('filter_auth_type') == '1')  selected @endif>{{ translating('filtr_magazin_electronics') }}</option>

            </select>
        </div>

        <!-- Price Input -->
        <div class="form-group col-md-3 col-sm-6 col-6 padd-l-r-30 position-relative">
            <label class="w-100 d-block bg-white rounded">
                <div class="row bg-white price-small-center input-shadow">
                    <span class="col-4 mt-2 display-price-title">{{ translating('placeholder-price') }}</span>
                    <input oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                           form="filteringForm" name="min_price" type="text"
                           class="price-input col-xl-4 col-lg-6 col-md-6 col-6 offset-custom-1 p-2" min="0"
                           placeholder="{{ translating('placeholder-min-price') }}"
                           value="@if(\Request::session()->has('filter_min_price') && \Request::session()->get('filter_min_price') != NULL){{ rtrim(str_replace(' ', '', trim(preg_replace('/\s+/', ' ', \Request::session()->get('filter_min_price'))))) }}@endif">
                    <input oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                           form="filteringForm" name="max_price" type="text"
                           class="price-input col-xl-4 col-lg-6 col-md-6 col-6 offset-custom-1 p-2" min="0"
                           placeholder="{{ translating('placeholder-max-price') }}"
                           value="@if(\Request::session()->has('filter_max_price') && \Request::session()->get('filter_max_price') != NULL){{ rtrim(str_replace(' ', '', trim(preg_replace('/\s+/', ' ', \Request::session()->get('filter_max_price'))))) }}@endif">

                </div>
            </label>
        </div>

    </div>
</div>

