<!-- Date Input -->
<div class="form-group col-md-12 col-sm-12 col-12">
    <div class="row no-gutters">
        <!-- Title -->
        <div class="col-lg-3">
            <label class="font-weight-bold">{{ $input_item->{'title_'.app()->getLocale()} }}</label>
        </div>

        <!-- Input -->
        <div class="col-lg-8">  
            <!-- Check session -->
            @if(isset($post->option[$input_key]['value']) && $post->option[$input_key]['value'] != NULL)
                <input type="date" name="input_{{ $input_item->id }}" form="addPostForm" minlength="1" maxlength="255" class="input-default w-100 p-2" placeholder="@if(isset($input_item->has_placeholder) && $input_item->has_placeholder == 1) {{ $input_item->{'title_'.app()->getLocale()} }}  @endif" value="{{ $post->option[$input_key]['value'] }}">
            @else
                <input type="date" name="input_{{ $input_item->id }}" form="addPostForm" minlength="1" maxlength="255" class="input-default w-100 p-2" placeholder="@if(isset($input_item->has_placeholder) && $input_item->has_placeholder == 1) {{ $input_item->{'title_'.app()->getLocale()} }}  @endif">
            @endif
        
            <!-- Check error -->
            @if(\Request::session()->has('error_date_'.$input_item->id))
                <!-- Error Response -->
                <strong class="text-danger"><i class="fa fa-exclamation-triangle"></i> {{ translating('add-post-error-date-'.$input_item->id) }}</strong class="text-danger">
            
                <!-- Forget session -->
                @php \Request::session()->forget('error_date_'.$input_item->id); @endphp
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