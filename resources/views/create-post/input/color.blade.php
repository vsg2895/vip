<!-- Color Input -->
<div class="form-group col-md-6 col-sm-12 col-12">
    <div class="row no-gutters">
        <!-- Title -->
        <div class="col-lg-3">
            <label class="font-weight-bold input-create-label">{{ $input_item->{'title_'.app()->getLocale()} }}</label>
        </div>

        <!-- Input -->
        <div class="col-lg-8">
            <!-- Check session -->
            @if(\Request::session()->has('add_post_input_'.$input_item->id) && \Request::session()->get('add_post_input_'.$input_item->id) != NULL)
                <input type="color" name="input_{{ $input_item->id }}" form="addPostForm" minlength="1" maxlength="255" class="input-default w-100 p-2" placeholder="@if(isset($input_item->has_placeholder) && $input_item->has_placeholder == 1) {{ $input_item->{'title_'.app()->getLocale()} }}  @endif" value="{{ \Request::session()->get('add_post_input_'.$input_item->id) }}">
            @else
                <input type="color" name="input_{{ $input_item->id }}" form="addPostForm" minlength="1" maxlength="255" class="input-default w-100 p-2" placeholder="@if(isset($input_item->has_placeholder) && $input_item->has_placeholder == 1) {{ $input_item->{'title_'.app()->getLocale()} }}  @endif">
            @endif

            <!-- Check error -->
            @if(\Request::session()->has('error_color_'.$input_item->id))
                <!-- Error Response -->
                <strong class="text-danger"><i class="fa fa-exclamation-triangle"></i> {{ translating('add-post-error-color-'.$input_item->id) }}</strong class="text-danger">

                <!-- Forget session -->
                @php \Request::session()->forget('error_color_'.$input_item->id); @endphp
            @endif
        </div>

        <!-- Unit -->
        <div class="col-lg-1 text-right w-100">
            @if(isset($input_item->unit) && $input_item->unit != NULL)
                <span class="font-weight-bold">{{ $input_item->unit['title_'.app()->getLocale()] }}</span>
            @endif
        </div>
    </div>
</div>
