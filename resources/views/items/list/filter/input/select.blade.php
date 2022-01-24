<!-- Select Options -->
<div class="form-group col-md-11 col-sm-12 col-12 padding-no">
{{--    @dump(\Request::session()->get('saved_input_'.$input_item->id))--}}
    <select name="input_{{ $input_item->id }}" form="filteringForm" class="input-default filterSpecialInput w-100 p-2">
        <!-- Default value -->
        <option value="filterValue">{{ $input_item->{'title_'.app()->getLocale()} }}</option>

        <!-- Options -->
        @if(isset($input_item->option) && count($input_item->option) > 0) <!--Check data -->
            <!-- Loop from options -->
            @foreach($input_item->option as $input_option)
                <!-- Option -->
                <option value="{{ $input_option->{'title_'.app()->getLocale()} }}" @if(\Request::session()->has('saved_input_'.$input_item->id) && \Request::session()->get('saved_input_'.$input_item->id) == $input_option->{'title_'.app()->getLocale()}) selected @endif>{{ $input_option->{'title_'.app()->getLocale()} }}</option>
            @endforeach
        @endif
    </select>
</div>
