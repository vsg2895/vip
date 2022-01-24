<!-- Contenet -->
@if(count(getCategoryChildren(\Request::segment(3))) > 7)
    <div class="row" id="in_slider_variant">
        <div class="custom-slider cat-subitems custom-width">
            <!-- Lopp from childrens -->
            <input type="hidden" id="sub_cats_count" value="{{ count(getCategoryChildren(\Request::segment(3))) }}">
        @if(\Request::segment(2) == 'filter' || \Request::segment(2) == 'category' || Request::segment(2) == 'filter-spare')
                @if(!is_null(getCategoryChildren(\Request::segment(3))[0]->spare_store))

                    @php

                        $child = getCategoryChildren(\Request::segment(3))[0];

                        $parent = [];

                        $parent_cat_spare = getParents($child->id,$parent);

                         $par_cat = getCat($parent_cat_spare[0]);
                    @endphp
                    {{--                    @dd($par_cat);--}}

                    <div
                        class="custom-box-parent-spare @if(\Request::segment(3) == $par_cat->id) active @endif col-2">
                        <a href="{{ route('category', ['locale' => app()->getLocale(), 'id' => $par_cat->id]) }}" class="link-spare-header-cat d-none">
                        </a>
                        <!-- Content -->
                        <div class="item">
                            <div class="row cat_slide_item_content">
                                <div class="col-lg-8 col-md-8 col-7 top-title">
                                    <a href="{{ route('category', ['locale' => app()->getLocale(), 'id' => $par_cat->id]) }}"
                                       class="d-flex align-items-center text-dark">
                                        <!-- Title -->
                                        <h5 class="title d-flex align-items-center title-sub-cat">{{ mb_substr($par_cat->{'title_'.app()->getLocale()} ,0 ,20) }}</h5>
                                        <!-- Check image     -->

                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-4 col-5 col-cat-img">
                                    @if(isset($par_cat->img) && $par_cat->img != NULL)
                                        <a href="{{ route('category', ['locale' => app()->getLocale(), 'id' => $par_cat->id]) }}">

                                            <!-- Image -->
                                            <img src="{{ asset('assets/img/icons/'.$par_cat->img) }}"
                                                 class="ml-auto responsive d-block"
                                                 alt="{{ $par_cat->{'title_'.app()->getLocale()} }}">

                                        </a>
                                    @endif
                                </div>

                            </div>
                        </div>


                    </div>


                @endif
            @foreach(getCategoryChildren(\Request::segment(3)) as $top_category)
                <!-- Slider Items -->

                    {{--                in_array($category->id,$spare_store_cat_ids)--}}
                    <div
                        class="@if(!is_null(getCategoryChildren(\Request::segment(3))[0]->spare_store) || getCategoryChildren(\Request::segment(3))[0]->header_position == 8)
                            custom-box-2 @else custom-box @endif @if(\Request::segment(3) == $top_category->id) active @endif"
                        data-id="{{ $top_category->id }}"
                        @if($top_category->header_position == 8 || !is_null($top_category->spare_store))
                        data-url="{{ route('filter.spare', ['locale' => app()->getLocale(), 'category_id' => $top_category->id, 'min_year' => \Request::session()->get('filter_min_year'), 'max_year' => \Request::session()->get('filter_max_year'), 'location' => \Request::session()->get('filter_location'), 'brand' => \Request::session()->get('filtr_post_spare_brand'), 'model' => \Request::session()->get('filtr_post_spare_model')]) }}">
                        @else
                            data-url="{{ route('filter', ['locale' => app()->getLocale(), 'category_id' => $top_category->id, 'location' => \Request::session()->get('filter_location'), 'min_price' => \Request::session()->get('filter_min_price'), 'max_price' => \Request::session()->get('filter_max_price'), 'post_type' => \Request::session()->get('filter_post_type'), 'auth_type' => \Request::session()->get('filter_auth_type'),'estate_type'=>\Request::session()->get('filter_post_estate_type'),'electro_type'=>\Request::session()->get('filter_post_elec_type')]) }}
                            ">
                    @endif                <!-- Content -->
                        <div class="item">
                            <div class="row cat_slide_item_content">
                                <div class="col-lg-8 col-md-8 col-7 top-title">
                                    <a href="{{ route('category', ['locale' => app()->getLocale(), 'id' => $top_category->id]) }}"
                                       class="d-flex align-items-center text-dark">
                                        <!-- Title -->
                                        <h5 class="title d-flex align-items-center title-sub-cat">{{ mb_substr($top_category->{'title_'.app()->getLocale()} ,0 ,20) }}</h5>
                                        <!-- Check image     -->

                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-4 col-5 col-cat-img">
                                    @if(isset($top_category->img) && $top_category->img != NULL)
                                        <a href="{{ route('category', ['locale' => app()->getLocale(), 'id' => $top_category->id]) }}"

                                        <!-- Image -->
                                        <img src="{{ asset('assets/img/icons/'.$top_category->img) }}"
                                             class="ml-auto responsive d-block"
                                             alt="{{ $top_category->{'title_'.app()->getLocale()} }}">

                                        </a>
                                    @endif
                                </div>

                            </div>
                        </div>


                    </div>
                @endforeach

            @else
                @foreach(getCategoryChildren($category->id) as $top_category)
                <!-- Slider Items -->
                    <div class="@if(!is_null(getCategoryChildren(\Request::segment(3))[0]->spare_store) || getCategoryChildren(\Request::segment(3))[0]->header_position == 8)
                        custom-box-2 @else custom-box @endif" data-id="{{ $top_category->id }}"
                         @if($top_category->header_position == 8 || !is_null($top_category->spare_store))
                         data-url="{{ route('filter.spare', ['locale' => app()->getLocale(), 'category_id' => $top_category->id, 'min_year' => \Request::session()->get('filter_min_year'), 'max_year' => \Request::session()->get('filter_max_year'), 'location' => \Request::session()->get('filter_location'), 'brand' => \Request::session()->get('filtr_post_spare_brand'), 'model' => \Request::session()->get('filtr_post_spare_model')]) }}">
                        @else
                            data-url="{{ route('filter', ['locale' => app()->getLocale(), 'category_id' => $top_category->id, 'location' => \Request::session()->get('filter_location'), 'min_price' => \Request::session()->get('filter_min_price'), 'max_price' => \Request::session()->get('filter_max_price'), 'post_type' => \Request::session()->get('filter_post_type'), 'auth_type' => \Request::session()->get('filter_auth_type'),'estate_type'=>\Request::session()->get('filter_post_estate_type'),'electro_type'=>\Request::session()->get('filter_post_elec_type')]) }}
                            ">
                        @endif
                        <div class="item">
                            <div class="row cat_slide_item_content">
                                <div class="col-lg-8 col-md-8 col-7 top-title">
                                    <!-- Content -->
                                    <a href="{{ route('category', ['locale' => app()->getLocale(), 'id' => $top_category->id]) }}"
                                       class="align-items-center text-dark">
                                        <h5 class="title mt-2 w-100 d-flex align-items-center text-center">{{ mb_substr($top_category->{'title_'.app()->getLocale()} ,0 ,20) }}</h5>

                                        <!-- Check image     -->

                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-4 col-5 col-cat-img">

                                @if(isset($top_category->img) && $top_category->img != NULL)
                                    <!-- Image -->
                                        <img src="{{ asset('assets/img/icons/'.$top_category->img) }}"
                                             class="w-50 mx-auto responsive d-block mx-auto"
                                             alt="{{ $top_category->{'title_'.app()->getLocale()} }}">
                                    @endif
                                </div>
                            </div>

                        </div>


                    </div>
                @endforeach
            @endif
        </div>
    </div>
@else

    <div class="row justify-content-center" id="in_slider_variant_2">
        <!--count(getCategoryChildren(\Request::segment(3)))-->
        <div class="custom-slider-col cat-subitems d-flex justify-content-center
   @if(count(getCategoryChildren(\Request::segment(3))) > 5) col-11 @else col-12 @endif">
            <!-- Lopp from childrens -->

            <input type="hidden" id="sub_cats_count" value="{{ count(getCategoryChildren(\Request::segment(3))) }}">
            @if(\Request::segment(2) == 'filter' || \Request::segment(2) == 'category' || Request::segment(2) == 'filter-spare')

                @if(!is_null(getCategoryChildren(\Request::segment(3))[0]->spare_store))

                    @php

                       $child = getCategoryChildren(\Request::segment(3))[0];

                       $parent = [];

                       $parent_cat_spare = getParents($child->id,$parent);

                        $par_cat = getCat($parent_cat_spare[0]);
                    @endphp
{{--                    @dd($par_cat);--}}

                    <div
                        class="custom-box-parent-spare @if(\Request::segment(3) == $par_cat->id) active @endif col-2">
                        <a href="{{ route('category', ['locale' => app()->getLocale(), 'id' => $par_cat->id]) }}" class="link-spare-header-cat d-none">
                        </a>
                    <!-- Content -->
                        <div class="item">
                            <div class="row cat_slide_item_content">
                                <div class="col-lg-8 col-md-8 col-7 top-title">
                                    <a href="{{ route('category', ['locale' => app()->getLocale(), 'id' => $par_cat->id]) }}"
                                       class="d-flex align-items-center text-dark">
                                        <!-- Title -->
                                        <h5 class="title d-flex align-items-center title-sub-cat">{{ mb_substr($par_cat->{'title_'.app()->getLocale()} ,0 ,20) }}</h5>
                                        <!-- Check image     -->

                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-4 col-5 col-cat-img">
                                    @if(isset($par_cat->img) && $par_cat->img != NULL)
                                        <a href="{{ route('category', ['locale' => app()->getLocale(), 'id' => $par_cat->id]) }}">

                                            <!-- Image -->
                                            <img src="{{ asset('assets/img/icons/'.$par_cat->img) }}"
                                                 class="ml-auto responsive d-block"
                                                 alt="{{ $par_cat->{'title_'.app()->getLocale()} }}">

                                        </a>
                                    @endif
                                </div>

                            </div>
                        </div>


                    </div>


                 @endif


                @foreach(getCategoryChildren(\Request::segment(3)) as $top_category)
                <!-- Slider Items -->

                    {{--                in_array($category->id,$spare_store_cat_ids)--}}
{{--                    @dump($top_category->header_position)--}}
                    <div
                        class="@if(!is_null(getCategoryChildren(\Request::segment(3))[0]->spare_store) || getCategoryChildren(\Request::segment(3))[0]->header_position == 8)
                            custom-box-2 @else custom-box @endif @if(\Request::segment(3) == $top_category->id) active @endif col-2"
                        data-id="{{ $top_category->id }}"
                        @if($top_category->header_position == 8 || !is_null($top_category->spare_store))
                        data-url="{{ route('filter.spare', ['locale' => app()->getLocale(), 'category_id' => $top_category->id, 'min_year' => \Request::session()->get('filter_min_year'), 'max_year' => \Request::session()->get('filter_max_year'), 'location' => \Request::session()->get('filter_location'), 'brand' => \Request::session()->get('filtr_post_spare_brand'), 'model' => \Request::session()->get('filtr_post_spare_model')]) }}">
                        @else
                            data-url="{{ route('filter', ['locale' => app()->getLocale(), 'category_id' => $top_category->id, 'location' => \Request::session()->get('filter_location'), 'min_price' => \Request::session()->get('filter_min_price'), 'max_price' => \Request::session()->get('filter_max_price'), 'post_type' => \Request::session()->get('filter_post_type'), 'auth_type' => \Request::session()->get('filter_auth_type'),'estate_type'=>\Request::session()->get('filter_post_estate_type'),'electro_type'=>\Request::session()->get('filter_post_elec_type')]) }}
                            ">
                    @endif
                    <!-- Content -->
                        <div class="item">
                            <div class="row cat_slide_item_content">
                                <div class="col-lg-8 col-md-8 col-7 top-title">
                                    <a href="{{ route('category', ['locale' => app()->getLocale(), 'id' => $top_category->id]) }}"
                                       class="d-flex align-items-center text-dark">
                                        <!-- Title -->
                                        <h5 class="title d-flex align-items-center title-sub-cat">{{ mb_substr($top_category->{'title_'.app()->getLocale()} ,0 ,20) }}</h5>
                                        <!-- Check image     -->

                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-4 col-5 col-cat-img">
                                    @if(isset($top_category->img) && $top_category->img != NULL)
                                        <a href="{{ route('category', ['locale' => app()->getLocale(), 'id' => $top_category->id]) }}">

                                        <!-- Image -->
                                        <img src="{{ asset('assets/img/icons/'.$top_category->img) }}"
                                             class="ml-auto responsive d-block"
                                             alt="{{ $top_category->{'title_'.app()->getLocale()} }}">

                                        </a>
                                    @endif
                                </div>

                            </div>
                        </div>


                    </div>
                @endforeach

            @else
                @foreach(getCategoryChildren($category->id) as $top_category)
                <!-- Slider Items -->
                    <div class="@if(!is_null(getCategoryChildren(\Request::segment(3))[0]->spare_store) || getCategoryChildren(\Request::segment(3))[0]->header_position == 8)
                        custom-box-2 @else custom-box @endif @if(count(getCategoryChildren(\Request::segment(3))) < 4) col-3  @else
                        col-2  @endif" data-id="{{ $top_category->id }}"
                         @if($top_category->header_position == 8 || !is_null($top_category->spare_store))
                         data-url="{{ route('filter.spare', ['locale' => app()->getLocale(), 'category_id' => $top_category->id, 'min_year' => \Request::session()->get('filter_min_year'), 'max_year' => \Request::session()->get('filter_max_year'), 'location' => \Request::session()->get('filter_location'), 'brand' => \Request::session()->get('filtr_post_spare_brand'), 'model' => \Request::session()->get('filtr_post_spare_model')]) }}">
                        @else
                            data-url="{{ route('filter', ['locale' => app()->getLocale(), 'category_id' => $top_category->id, 'location' => \Request::session()->get('filter_location'), 'min_price' => \Request::session()->get('filter_min_price'), 'max_price' => \Request::session()->get('filter_max_price'), 'post_type' => \Request::session()->get('filter_post_type'), 'auth_type' => \Request::session()->get('filter_auth_type'),'estate_type'=>\Request::session()->get('filter_post_estate_type'),'electro_type'=>\Request::session()->get('filter_post_elec_type')]) }}
                            ">
                        @endif
                        <div class="item">
                            <div class="row cat_slide_item_content">
                                <div class="col-lg-8 col-md-8 col-7 top-title">
                                    <!-- Content -->
                                    <a href="{{ route('category', ['locale' => app()->getLocale(), 'id' => $top_category->id]) }}"
                                       class="align-items-center text-dark">
                                        <h5 class="title mt-2 w-100 d-flex align-items-center text-center">{{ mb_substr($top_category->{'title_'.app()->getLocale()} ,0 ,20) }}</h5>

                                        <!-- Check image     -->

                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-4 col-5 col-cat-img">

                                @if(isset($top_category->img) && $top_category->img != NULL)
                                    <!-- Image -->
                                        <img src="{{ asset('assets/img/icons/'.$top_category->img) }}"
                                             class="w-50 mx-auto responsive d-block mx-auto"
                                             alt="{{ $top_category->{'title_'.app()->getLocale()} }}">
                                    @endif
                                </div>
                            </div>

                        </div>


                    </div>
                @endforeach
            @endif
        </div>
    </div>


@endif

<div class="row" id="in_slider_variant_mob">
    <div class="custom-slider cat-subitems custom-width">
        <!-- Lopp from childrens -->
        <input type="hidden" id="sub_cats_count" value="{{ count(getCategoryChildren(\Request::segment(3))) }}">
    @if(\Request::segment(2) == 'filter' || \Request::segment(2) == 'category' || Request::segment(2) == 'filter-spare')


            @if(!is_null(getCategoryChildren(\Request::segment(3))[0]->spare_store))
                @php

                    $child = getCategoryChildren(\Request::segment(3))[0];

                    $parent = [];

                    $parent_cat_spare = getParents($child->id,$parent);

                     $par_cat = getCat($parent_cat_spare[0]);
                @endphp


                <div
                    class="custom-box-parent-spare @if(\Request::segment(3) == $par_cat->id) active @endif col-2">
                    <a href="{{ route('category', ['locale' => app()->getLocale(), 'id' => $par_cat->id]) }}" class="link-spare-header-cat d-none">
                    </a>
                    <!-- Content -->
                    <div class="item">
                        <div class="row cat_slide_item_content">
                            <div class="col-lg-8 col-md-8 col-7 top-title">
                                <a href="{{ route('category', ['locale' => app()->getLocale(), 'id' => $par_cat->id]) }}"
                                   class="d-flex align-items-center text-dark">
                                    <!-- Title -->
                                    <h5 class="title d-flex align-items-center title-sub-cat">{{ mb_substr($par_cat->{'title_'.app()->getLocale()} ,0 ,20) }}</h5>
                                    <!-- Check image     -->

                                </a>
                            </div>
                            <div class="col-lg-4 col-md-4 col-5 col-cat-img">
                                @if(isset($par_cat->img) && $par_cat->img != NULL)
                                    <a href="{{ route('category', ['locale' => app()->getLocale(), 'id' => $par_cat->id]) }}">

                                        <!-- Image -->
                                        <img src="{{ asset('assets/img/icons/'.$par_cat->img) }}"
                                             class="ml-auto responsive d-block"
                                             alt="{{ $par_cat->{'title_'.app()->getLocale()} }}">

                                    </a>
                                @endif
                            </div>

                        </div>
                    </div>


                </div>


            @endif
        @foreach(getCategoryChildren(\Request::segment(3)) as $top_category)
            <!-- Slider Items -->

                {{--                in_array($category->id,$spare_store_cat_ids)--}}

                <div
                    class="@if(!is_null(getCategoryChildren(\Request::segment(3))[0]->spare_store) || getCategoryChildren(\Request::segment(3))[0]->header_position == 8)
                        custom-box-2 @else custom-box @endif
                    @if(\Request::segment(3) == $top_category->id) active @endif"
                    data-id="{{ $top_category->id }}"
                    @if($top_category->header_position == 8 || !is_null($top_category->spare_store))
                    data-url="{{ route('filter.spare', ['locale' => app()->getLocale(), 'category_id' => $top_category->id, 'min_year' => \Request::session()->get('filter_min_year'), 'max_year' => \Request::session()->get('filter_max_year'), 'location' => \Request::session()->get('filter_location'), 'brand' => \Request::session()->get('filtr_post_spare_brand'), 'model' => \Request::session()->get('filtr_post_spare_model')]) }}">
                    @else
                        data-url="{{ route('filter', ['locale' => app()->getLocale(), 'category_id' => $top_category->id, 'location' => \Request::session()->get('filter_location'), 'min_price' => \Request::session()->get('filter_min_price'), 'max_price' => \Request::session()->get('filter_max_price'), 'post_type' => \Request::session()->get('filter_post_type'), 'auth_type' => \Request::session()->get('filter_auth_type'),'estate_type'=>\Request::session()->get('filter_post_estate_type'),'electro_type'=>\Request::session()->get('filter_post_elec_type')]) }}
                        ">
                @endif
                <!-- Content -->
                    <div class="item">
                        <div class="row cat_slide_item_content">
                            <div class="col-lg-8 col-md-8 col-7 top-title">
                                <a href="{{ route('category', ['locale' => app()->getLocale(), 'id' => $top_category->id]) }}"
                                   class="d-flex align-items-center text-dark">
                                    <!-- Title -->
                                    <h5 class="title d-flex align-items-center title-sub-cat">{{ mb_substr($top_category->{'title_'.app()->getLocale()} ,0 ,20) }}</h5>
                                    <!-- Check image     -->

                                </a>
                            </div>
                            <div class="col-lg-4 col-md-4 col-5 col-cat-img">
                                @if(isset($top_category->img) && $top_category->img != NULL)
                                    <a href="{{ route('category', ['locale' => app()->getLocale(), 'id' => $top_category->id]) }}">

                                    <!-- Image -->
                                    <img src="{{ asset('assets/img/icons/'.$top_category->img) }}"
                                         class="ml-auto responsive d-block"
                                         alt="{{ $top_category->{'title_'.app()->getLocale()} }}">

                                    </a>
                                @endif
                            </div>

                        </div>
                    </div>


                </div>
            @endforeach

        @else
            @foreach(getCategoryChildren($category->id) as $top_category)
            <!-- Slider Items -->
                <div class="@if(!is_null(getCategoryChildren(\Request::segment(3))[0]->spare_store) || getCategoryChildren(\Request::segment(3))[0]->header_position == 8)
                    custom-box-2 @else custom-box @endif" data-id="{{ $top_category->id }}"
                     @if($top_category->header_position == 8 || !is_null($top_category->spare_store))
                     data-url="{{ route('filter.spare', ['locale' => app()->getLocale(), 'category_id' => $top_category->id, 'min_year' => \Request::session()->get('filter_min_year'), 'max_year' => \Request::session()->get('filter_max_year'), 'location' => \Request::session()->get('filter_location'), 'brand' => \Request::session()->get('filtr_post_spare_brand'), 'model' => \Request::session()->get('filtr_post_spare_model')]) }}">
                    @else
                        data-url="{{ route('filter', ['locale' => app()->getLocale(), 'category_id' => $top_category->id, 'location' => \Request::session()->get('filter_location'), 'min_price' => \Request::session()->get('filter_min_price'), 'max_price' => \Request::session()->get('filter_max_price'), 'post_type' => \Request::session()->get('filter_post_type'), 'auth_type' => \Request::session()->get('filter_auth_type'),'estate_type'=>\Request::session()->get('filter_post_estate_type'),'electro_type'=>\Request::session()->get('filter_post_elec_type')]) }}
                        ">
                    @endif
                    <div class="item">
                        <div class="row cat_slide_item_content">
                            <div class="col-lg-8 col-md-8 col-7 top-title">
                                <!-- Content -->
                                <a href="{{ route('category', ['locale' => app()->getLocale(), 'id' => $top_category->id]) }}"
                                   class="align-items-center text-dark">
                                    <h5 class="title mt-2 w-100 d-flex align-items-center text-center">{{ mb_substr($top_category->{'title_'.app()->getLocale()} ,0 ,20) }}</h5>

                                    <!-- Check image     -->

                                </a>
                            </div>
                            <div class="col-lg-4 col-md-4 col-5 col-cat-img">

                            @if(isset($top_category->img) && $top_category->img != NULL)
                                <!-- Image -->
                                    <img src="{{ asset('assets/img/icons/'.$top_category->img) }}"
                                         class="w-50 mx-auto responsive d-block mx-auto"
                                         alt="{{ $top_category->{'title_'.app()->getLocale()} }}">
                                @endif
                            </div>
                        </div>

                    </div>


                </div>
            @endforeach
        @endif
    </div>
</div>


{{-- New Content--}}

