<!-- Special Row -->
{{--@include('components.home.slider')--}}
@if(isset($category->special) && count($category->special) > 0)
    @include('items.list.filter.special.index')
@endif

<!-- Input Row -->


<!-- Default Filters -->
{{--@dd(count($category->input))--}}
@if(in_array($category->id,$transport_sub_cat_ids))

    @include('items.list.filter.default-transport')
@elseif(in_array($category->id,$real_estate_sub_cat_ids))

    @include('items.list.filter.default-estate')

    {{--@elseif(in_array($category->id,$elektronics_sub_cat_ids))--}}

@elseif(isset($spare_store_cat_ids) && $category->spare_store == '0')
    {{--@dd($category)--}}
    @include('items.list.filter.default-spare-store')

@else
    @if(!isset($spare_store_cat_ids) || !in_array($category->id,$spare_store_cat_ids))
        @include('items.list.filter.default-electronics')
    @endif
    {{--    @include('items.list.filter.default')--}}
@endif
{{--@dd($category)--}}
@if(isset($category->input) && count($category->input) > 0 && in_array($category->id,$transport_sub_cat_ids))
    {{--    @dd('uni')--}}
    {{--    @include('items.list.filter.default-transport')--}}
    {{--    @include('items.list.filter.default')--}}
    @include('items.list.filter.input.index-transport')

@elseif(isset($category->input) && count($category->input) > 0 && !in_array($category->id,$transport_sub_cat_ids))

    @include('items.list.filter.input.index')


@endif
@if((!isset($spare_store_cat_ids)) || ((\Request::segment(2) == 'filter' || \Request::segment(2) == 'category') && !in_array($category->id,$spare_store_cat_ids)))
    <div class="row no-gutters w-100 filter-button">
        <form id="filteringForm"
              action="{{ route('filter', ['locale' => app()->getLocale(), 'category_id' => 0, 'min_price' => 0, 'max_price' => 0, 'location' => 0, 'post_type' => 'default', 'auth_type' => 'default','estate_type' => 'default','electro_type'=>'default']) }}"
              method="post"
              class="offset-custom-filtr filtr-button @if(\Request::segment(2) == 'filter' && count($category->input) > 0) margin_top_minus @endif">
            @csrf
            <input type="text" class="d-none" name="category_id" value="{{ \Request::segment(3) }}"
                   form="filteringForm">
            <input type="text" class="d-none" name="filter_submit" value="1" form="filteringForm">
            <button type="submit" form="filteringForm" class="btn btn-main text-light">
                {{ translating('filtering') }}
            </button>
        </form>
    </div>

@else

    @if($category->spare_store == '0' || in_array($category->id,$spare_store_cat_ids))
        <div class="row no-gutters w-100 filter-button">
            <form id="filteringFormSpare"
                  action="{{ route('filter.spare', ['locale' => app()->getLocale(), 'category_id' => 0, 'min_year' => 0, 'max_year' => 0, 'location' => 0, 'brand' => 'default', 'model' => 'default']) }}"
                  method="post"
                  class="offset-custom-filtr @if(\Request::segment(2) == 'filter' && count($category->input) > 0) margin_top_minus @endif">
                @csrf
                <input type="text" class="d-none" name="category_id" value="{{ \Request::segment(3) }}"
                       form="filteringFormSpare">
                <input type="text" class="d-none" name="filter_submit" value="1" form="filteringFormSpare">
                @if($category->spare_store == '0')
                    <button type="submit" form="filteringFormSpare" class="btn btn-main text-light">
                        {{ translating('filtering') }}
                    </button>
                @endif
            </form>
        </div>
    @endif
@endif
