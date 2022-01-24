<!-- Cjeckbox Input -->
<div class="form-group col-md-1 col-sm-3 col-6">
    <label>
        <span class="float-left mt-10 mr-2">{{ $input_item->{'title_'.app()->getLocale()} }}</span>
        <input form="filteringForm" type="checkbox" name="input_{{ $input_item->id }}" class="filterSpecialInput mt-1-5 flaot-left" style="transform: scale(1.5);">
    </label>
</div>