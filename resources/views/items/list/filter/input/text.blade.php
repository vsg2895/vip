<!-- Text Input -->
<div class="form-group col-md-12 col-sm-12 col-12 padding-no">
    <input form="filteringForm" type="text" name="input_{{ $input_item->id }}" minlength="1" maxlength="255" class="filterSpecialInput input-default w-100 p-2" placeholder="@if(isset($input_item->has_placeholder) && $input_item->has_placeholder == 1) {{ $input_item->{'title_'.app()->getLocale()} }}  @endif" value="@if(\Request::session()->has('saved_input_'.$input_item->id)) {{ \Request::session()->get('saved_input_'.$input_item->id) }} @endif">
</div>
