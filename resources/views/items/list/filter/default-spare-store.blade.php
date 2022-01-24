<div class="row default-row mt-xl-2 mt-lg-2 mt-md-2 mt-3 justify-content-center">
    <!--Check data -->
    <div class="col-md-12 d-flex flex-wrap">

    @if(isset($locations) && count($locations) > 0)
        <!-- Location select option -->
            <div class="form-group col-md-3 col-sm-6 col-6">
                <!-- Label -->
                <!-- Select -->
                <select name="location_spare" form="filteringFormSpare" class="input-default w-100 p-2">
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

            <select name="brand" form="filteringFormSpare"
                    data-default-title="{{ translating('model-work') }}"
                    data-action="{{ route('get.brand.model',app()->getLocale()) }}"
                    class="input-default w-100 p-2">
                <!-- Default value -->
                <option value="default">{{ translating('spare-maknish') }}</option>
                @foreach($spare_models as $model)

                    <option value="{{ $model->id }}"
                            @if(\Request::session()->has('filtr_post_spare_brand') && \Request::session()->get('filtr_post_spare_brand') == $model->id) selected @endif>{{ $model['title_'.app()->getLocale()] }}</option>
                    <!-- Options -->
                @endforeach
            </select>

        </div>
        <div class="form-group col-md-3 col-sm-6 col-6">
            <!-- Select -->

            <select name="model" form="filteringFormSpare"
                    data-default-title="{{ translating('model-work') }}"
                    data-action="{{ route('get.brand.model',app()->getLocale()) }}"
                    class="input-default w-100 p-2">
                <!-- Default value -->
                <option value="default">{{ translating('model-work') }}</option>
                @foreach($spare_models_types as $model)

                    <option value="{{ $model->id }}"
                            @if(\Request::session()->has('filtr_post_spare_model') && \Request::session()->get('filtr_post_spare_model') == $model->id) selected @endif>{{ $model['title_'.app()->getLocale()] }}</option>
                    <!-- Options -->
                @endforeach
            </select>
        </div>

        <!-- Price Input -->
        <div class="form-group col-md-3 col-sm-6 col-6 padd-l-r-30 position-relative">
            <label class="w-100 d-block bg-white rounded">
                <div class="row bg-white price-small-center input-shadow">
                    <span class="col-4 mt-2 display-price-title">{{ translating('spare-year') }}</span>
                    <input oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                           form="filteringFormSpare" name="min_year_spare" type="text"
                           class="price-input col-xl-4 col-lg-6 col-md-6 col-6 offset-custom-1 p-2" min="0"
                           placeholder="{{ translating('placeholder-min-price') }}"
                           value="@if(\Request::session()->has('filter_min_year') && \Request::session()->get('filter_min_year') != NULL){{ rtrim(str_replace(' ', '', trim(preg_replace('/\s+/', ' ', \Request::session()->get('filter_min_year'))))) }}@endif">
                    <input oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                           form="filteringForm" name="max_year_spare" type="text"
                           class="price-input col-xl-4 col-lg-6 col-md-6 col-6 offset-custom-1 p-2" min="0"
                           placeholder="{{ translating('placeholder-max-price') }}"
                           value="@if(\Request::session()->has('filter_max_year') && \Request::session()->get('filter_max_year') != NULL){{ rtrim(str_replace(' ', '', trim(preg_replace('/\s+/', ' ', \Request::session()->get('filter_max_year'))))) }}@endif">

                </div>
            </label>
        </div>

    </div>
</div>

