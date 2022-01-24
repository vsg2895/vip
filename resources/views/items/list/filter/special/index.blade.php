<!-- Contenet -->
<div class="custom-slider-2 cat-specitems mb-2">
    <!-- Loop from special filter items -->
    @foreach($category->special as $special_item)
        <!-- Slider Items -->
        <div class="item" data-url="{{ route('filter', ['locale' => app()->getLocale(), 'category_id' => 0, 'location' => \Request::session()->get('filter_location'), 'min_price' => \Request::session()->get('filter_min_price'), 'max_price' => \Request::session()->get('filter_max_price'), 'post_type' => \Request::session()->get('filter_post_type'), 'auth_type' => \Request::session()->get('filter_auth_type'),'estate_type'=>\Request::session()->get('filter_post_estate_type'),'estate_type'=>\Request::session()->get('filter_post_estate_type'),'electro_type'=>\Request::session()->get('filter_post_elec_type')]) }}">
            <!-- Image -->
            <img src="{{ asset('assets/img/icons/'.$special_item->img) }}" class="w-100 responsive" alt="{{ $special_item->{'title_'.app()->getLocale()} }}">
        </div>
    @endforeach
</div>
