<!-- Select Options -->
<div class="form-group col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
    <div class="row no-gutters">
        <!-- Title -->
        <div class="col-xl-3 col-lg-3 col-12">
            <label class="font-weight-bold input-create-label">{{ $input_item->{'title_'.app()->getLocale()} }}</label>
        </div>
{{--    @dd($input_item->option[0])--}}
        <!-- Input -->
{{--        @dd(\Request::session()->get('add_post_input_1'))--}}
        <div class="col-lg-8 col-md-12">
{{--            @if(!\Request::session()->has('add_post_input_'.$input_item->id)) selected @endif--}}
            <select name="input_{{ $input_item->id }}" form="addPostForm" class="input-default w-100 p-2">
                <!-- Default value -->
                <option value="*" >{{ $input_item->{'title_'.app()->getLocale()} }}</option>

                <!-- Options -->
                @if(isset($input_item->option) && count($input_item->option) > 0) <!--Check data -->
                    <!-- Loop from options -->
                    @foreach($input_item->option as $input_option)
                        <!-- Option -->

                        <option value="{{ $input_option->{'title_'.app()->getLocale()} }}" @if(\Request::session()->has('add_post_input_'.$input_item->id) && \Request::session()->get('add_post_input_'.$input_item->id) == $input_option->{'title_'.app()->getLocale()}) selected @endif>{{ $input_option->{'title_'.app()->getLocale()} }}</option>
                    @endforeach
                @endif
            </select>

            <!-- Check error -->
            @if(\Request::session()->has('error_select_'.$input_item->id))
                <!-- Error Response -->
                <strong class="text-danger"><i class="fa fa-exclamation-triangle"></i> {{ translating('add-post-error-select-'.$input_item->id) }}</strong class="text-danger">
            @endif

            <!-- Forget session -->
            @php \Request::session()->forget('error_select_'.$input_item->id); @endphp
        </div>

        <!-- Unit -->
        <div class="col-lg-1 text-right w-100">
            @if(isset($input_item->unit) && $input_item->unit != NULL)
                <span class="font-weight-bold">{{ $input_item->unit['title_'.app()->getLocale()] }}</span>
            @endif
        </div>
    </div>
</div>
