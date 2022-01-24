<!-- Select Options -->
<div class="form-group col-md-12 col-sm-12 col-12">
    <div class="row no-gutters">
        <!-- Title -->
        <div class="col-lg-3">
            <label class="font-weight-bold">{{ $input_item->{'title_'.app()->getLocale()} }}</label>
        </div>

        <!-- Input -->
{{--        @if(isset())--}}
{{--        @dd($post->option[$input_key]['value'])--}}
        <div class="col-lg-8">
            <select name="input_{{ $input_item->id }}" form="addPostForm" class="input-default w-100 p-2">
                <!-- Default value -->
                <option value="#"  @if(!isset($post->option[$input_key]['value']) || $post->option[$input_key]['value'] == NULL || $post->option[$input_key]['value'] == '*') selected @endif>{{ $input_item->{'title_'.app()->getLocale()} }}</option>

                <!-- Options -->
                @if(isset($input_item->option) && count($input_item->option) > 0) <!--Check data -->
                    <!-- Loop from options -->
                    @foreach($input_item->option as $input_option)
                        <!-- Check data -->

                        @if(isset($post->option[$input_key]['value']) && $post->option[$input_key]['value'] == $input_option->{'title_'.app()->getLocale()})
                            <!-- Option -->
                            <option value="{{ $input_option->{'title_'.app()->getLocale()} }}" selected>{{ $input_option->{'title_'.app()->getLocale()} }}</option>
                        @else
                            <!-- Option -->
                            <option value="{{ $input_option->{'title_'.app()->getLocale()} }}">{{ $input_option->{'title_'.app()->getLocale()} }}</option>
                        @endif
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
