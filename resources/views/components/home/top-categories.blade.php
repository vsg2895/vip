@if(isset($top_categories) && count($top_categories) > 0)
{{--    @dd($top_categories)--}}
<!-- Contenet -->
<div class="app-container my-2" id="topCatSection"  style="overflow: hidden;">
    <div class="row">
        <div class="custom-slider">
            @foreach($top_categories as $top_category)
                <!-- Slider Items -->
                <div class="custom-box">
                    <div class="item">
                        <div class="row cat_slide_item_content">
                            <!-- Info -->
                            <div class="col-lg-8 col-md-8 col-7 top-title">
                                <a href="{{ route('category', ['locale' => app()->getLocale(), 'id' => $top_category->id]) }}" class="text-dark">
                                    <!-- Title -->
                                    <h5 class="title">{{ mb_substr($top_category->{'title_'.app()->getLocale()} ,0 ,20) }}</h5>

                                    <!-- Short Description -->
{{--                                    <p class="text-muted h6">{{ getPostCountWithCategory($top_category->id).' '.translating('post') }}</p>--}}
                                </a>
                            </div>

                            <!-- Image -->
                            <div class="col-lg-4 col-md-4 col-5 col-cat-img">
                                <a href="{{ route('category', ['locale' => app()->getLocale(), 'id' => $top_category->id]) }}">
                                    <img src="{{ asset($assets_path.'/img/icons/'.$top_category->img) }}" class="w-100 responsive" alt="{{ $top_category->{'title_'.app()->getLocale()} }}">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif
