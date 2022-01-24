<!-- Color Input -->
<div class="form-group col-md-4 col-sm-6 col-12">
    <input form="filteringForm" type="color" name="input_{{ $input_item->id }}" minlength="1" maxlength="255" class="filterSpecialInput input-default w-100 p-2" placeholder="@if(isset($input_item->has_placeholder) && $input_item->has_placeholder == 1) {{ $input_item->{'title_'.app()->getLocale()} }}  @endif">
</div>