<!-- Text Input -->
<div class="form-group col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
    <div class="row no-gutters">
        <!-- Title -->
        <div class="col-lg-3">
            <label class="font-weight-bold input-create-label">{{ $input_item->{'title_'.app()->getLocale()} }}</label>
        </div>

        <!-- Input -->
        <div class="col-xl-8 col-lg-8 col-md-11 col-sm-11 col-11">
            <input type="text" name="input_{{ $input_item->id }}" form="addPostForm" minlength="1" maxlength="255"
                   class="input-default w-100 p-2"
                   placeholder="@if(isset($input_item->has_placeholder) && $input_item->has_placeholder == 1) {{ $input_item->{'title_'.app()->getLocale()} }}  @endif"
                   value="@if(\Request::session()->has('add_post_input_'.$input_item->id) && \Request::session()->get('add_post_input_'.$input_item->id) != NULL) {{ \Request::session()->get('add_post_input_'.$input_item->id) }} @endif">

            <!-- Check error -->
        @if(\Request::session()->has('error_text_'.$input_item->id))
            <!-- Error Response -->
                <strong class="text-danger"><i
                        class="fa fa-exclamation-triangle"></i> {{ translating('add-post-error-text-'.$input_item->id) }}
                </strong class="text-danger">
        @endif

        <!-- Forget session -->
            @php \Request::session()->forget('error_text_'.$input_item->id); @endphp
        </div>

        <!-- Unit -->
        <div class="col-lg-1 col-xl-1 col-md-1 col-sm-1 col-1 text-right w-100">
            @if(isset($input_item->unit) && $input_item->unit != NULL)
                <span class="font-weight-bold">{{ $input_item->unit['title_'.app()->getLocale()] }}</span>
            @endif
        </div>
    </div>
</div>
