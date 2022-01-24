<!-- Content -->
<div class="row mt-2 p-0 input-filters justify-content-center hide_block">
    <div class="col-md-9 d-flex flex-wrap in_show hide_block">
        <!-- Loop from inputs -->
{{--        @dd(\Request::session()->get('filter_post_type'))--}}
    @foreach($category->input as $k => $input_item)
        <!-- Get input datat -->
        @if(isset($input_item->type) && $input_item->type != NULL)
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
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-9 d-flex flex-wrap d-flex justify-content-end padd-r-30">
        <div class="hide_part_text ml-3"><span
                class="ml-2">{{ translating('more-filter') }}</span>
        </div>
    </div>
</div>
