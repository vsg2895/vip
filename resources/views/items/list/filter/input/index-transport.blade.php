<!-- Content -->
<div class="row input-filters justify-content-center hide_block">
    <div class="col-md-9 d-flex flex-wrap in_show hide_block">

{{--    @dd(translating('post-type') )--}}
        <!-- Loop from inputs -->
    {{--    @dd($category->input)--}}
    @foreach($category->input as $k => $input_item)
        <!-- Get input datat -->
        @if(isset($input_item->type) && $input_item->type != NULL && !in_array($input_item->id,[1,7,24]))
            <!-- Input -->
                <div class="form-group col-md-3 col-sm-6 col-6 in_show hide_block">

                    @include('items.list.filter.input.'.$input_item->type)
                </div>
            @endif
        @endforeach
        <div class="form-group col-md-3 col-sm-6 col-6 in_show hide_block">

            <select name="post_type" form="filteringForm" class="input-default w-100 p-2">
                <!-- Default value -->

                <option value="default"
                        @if(\Request::session()->has('filter_post_type') && \Request::session()->get('filter_post_type') == 'default') selected @endif>{{ translating('post-type') }}</option>

                <!-- Other Values -->
                <option value="0"
                        @if(\Request::session()->has('filter_post_type') && \Request::session()->get('filter_post_type') == '0') selected @endif>{{ translating('filter-suggesting-type-value') }}</option>
                <option value="1"
                        @if(\Request::session()->has('filter_post_type') && \Request::session()->get('filter_post_type') == '1') selected @endif>{{ translating('filter-changing-type-value') }}</option>
                <option value="2"
                        @if(\Request::session()->has('filter_post_type') && \Request::session()->get('filter_post_type') == '2') selected @endif>{{ translating('filter-hiring-type-value') }}</option>

            </select>
        </div>


        @if(isset($locations) && count($locations) > 0)
        <!-- Location select option -->
            <div class="form-group col-md-3 col-sm-6 col-6 in_show hide_block">
                <!-- Label -->
            {{--            <label class="w-100 d-block">{{ translating('location') }}</label>--}}

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

        <div class="form-group col-md-3 col-sm-6 col-6 in_show hide_block">
            <!-- Label -->
        {{--        <label class="w-100 d-block">{{ translating('auth-type') }}</label>--}}

        <!-- Select -->
            <select name="auth_type" form="filteringForm" class="input-default w-100 p-2">

                <!-- Default value -->
                <option value="default"
                        @if(\Request::session()->has('filter_auth_type') && \Request::session()->get('filter_auth_type') == 'default') selected @endif>{{ translating('auth-type') }}</option>

                <!-- Other Values -->
                <option value="0"
                        @if(\Request::session()->has('filter_auth_type') && \Request::session()->get('filter_auth_type') == '0')  selected @endif>{{ translating('filter-owner-type-value') }}</option>
                <option value="1"
                        @if(\Request::session()->has('filter_auth_type') && \Request::session()->get('filter_auth_type') == '1')  selected @endif>{{ translating('filter-agancy-type-value') }}</option>
            </select>
        </div>
        <!-- Select Post Type -->


    </div>

</div>
<div class="row justify-content-center">
    <div class="col-md-9 d-flex flex-wrap d-flex padd-r-30 justify-content-end">
        <div class="hide_part_text ml-3"><span
                class="ml-2">{{ translating('more-filter') }}</span>
        </div>
    </div>
</div>
