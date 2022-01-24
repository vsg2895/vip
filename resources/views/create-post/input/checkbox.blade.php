<!-- Checkbox Input -->
<div class="form-group col-md-6 col-sm-6 col-12">
    <label>
        <span class="float-left font-weight-bold mt-10 mr-2 input-create-label">{{ $input_item->{'title_'.app()->getLocale()} }}</span>
        <input type="checkbox" name="input_{{ $input_item->id }}" form="addPostForm" class="mt-1-5 flaot-left" style="transform: scale(1.5);" @if(\Request::session()->has('add_post_input_'.$input_item->id) && \Request::session()->get('add_post_input_'.$input_item->id) == '1') checked @endif>
        @if(isset($input_item->unit) && $input_item->unit != NULL)
            <span class="font-weight-bold ml-1">{{ $input_item->unit['title_'.app()->getLocale()] }}</span>
        @endif
        <p class="clearfix"></p>
    </label>

    <!-- Check error -->
    @if(\Request::session()->has('error_checkbox_'.$input_item->id))
        <!-- Error Response -->
        <strong class="text-danger"><i class="fa fa-exclamation-triangle"></i> {{ translating('add-post-error-checkbox-'.$input_item->id) }}</strong class="text-danger">

        <!-- Forget session -->
        @php \Request::session()->forget('error_checkbox_'.$input_item->id); @endphp
    @endif
</div>
