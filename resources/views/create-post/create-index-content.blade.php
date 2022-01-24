<!-- Menu geting function -->
@php function cats_select($cats_select, $locale, $level = 0){
    foreach($cats_select as $cat){ @endphp
@php if ($cat['root'] != 2){ @endphp
{{--@dump($cat)--}}
<!-- Item -->
{{--@if($cat['root'])--}}
<div class="@if($level == 0) col-lg-4 col-md-6 @else col-lg-12 @endif mt-3 mt-md-1 single-cat-add-post">
    <li class="py-2 px-2 @if(count($cat['children']) == 0) selectcategory @endif bg-white shadow hovered li-{{ $level }} @if(count($cat['children']) == 0) finishCat @endif"
        category_id="{{ $cat['id'] }}">
        <!-- Title -->
        <span class="text-dark"
              href="{{ route('category', ['locale' => app()->getLocale(), 'id' => $cat['id']]) }}">{{ $cat['title_'.app()->getLocale()] }}</span>

        <!-- Check children categories -->
    @php if(count($cat['children']) > 0){ @endphp
    <!-- Icon -->
        <i class="float-right fa fa-angle-down"></i>
        <!-- Submenu -->
        <ul class="submenu-select" id="submenu-select-{{$level}}">
            <!-- Recursion call -->
            @php cats_select($cat['children'], $locale, $level+1); @endphp
        </ul>
        @php } @endphp
    </li>
</div>
@php } @endphp
@php }
} @endphp
<!-- Content -->
{{--@dd('sdfsd)--}}
<div class="categories-content categories-content-edit"
     action="{{ route('create-post-level-2', ['locale' => app()->getLocale(), 'category_id' => 0]) }}">
@if(\Request::session()->has('post_canceled') && \Request::session()->get('post_canceled') != NULL)
    <!-- Response -->
        <div class="alert alert-success text-center w-100" role="alert">
            <strong><i class="fa fa-check"></i> {{ translating('post-creating-process-canceled') }}</strong>
        </div>

        <!-- Clear session -->
    @php \Request::session()->forget('post_canceled'); @endphp
@endif

<!-- Navigation -->
    <div class="app-container">
        <div class="row">
            <nav class="mt-5 create-post-cats w-100">
                <div class="row">
                    <!-- Check categories data -->
                    {{--                @dd($add_post_categories)--}}
                    @if(isset($add_post_categories)&& count($add_post_categories) > 0)
                        <div class="col-lg-12 all-col-sel-cat">
                            <ul class="p-2 rounded add-cat-ul d-flex flex-wrap">
                                {{--                        @dd($add_post_categories[0]['children'])--}}

                                {{ cats_select($add_post_categories, $locale) }}
                            </ul>
                        </div>
                    @endif
                </div>
            </nav>
        </div>
        <div class="mt-3 row w-100">
            <input type="hidden" name="main_name" value="">
            <input type="hidden" name="category_id" value="">
        <!-- <button class="selectcategory btn btn-main text-light btn-lg">{{ translating('continue') }}</button> -->
        </div>
    </div>
</div>
