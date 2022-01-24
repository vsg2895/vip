
<div class="row default-row mt-xl-2 mt-lg-2 mt-md-2 mt-3 justify-content-center">
    <!--Check data -->
    {{--@dd($default_transport_filter)--}}
    <div class="col-md-12 d-flex flex-wrap">


    @foreach($default_transport_filter as $k => $input_item)
        <!-- Get input datat -->

        @if(isset($input_item->type) && $input_item->type != NULL)
            <!-- Input -->
                <div class="form-group col-md-3 col-sm-4 col-6">

                    @include('items.list.filter.input.'.$input_item->type)
                </div>
        @endif

    @endforeach

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

