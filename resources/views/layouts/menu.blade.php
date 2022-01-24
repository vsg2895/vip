<!-- Menu geting function -->
@php function cats($cats, $locale, $level = 0){
    foreach($cats as $cat){
        if($cat['has_subcategory'] == 1 && $cat['parent_id'] == 0){ @endphp
<!-- Item -->
<li class="main-menu-item d-inline-block">
    <!-- Check image -->
@if($cat['img'] != NULL && $cat['root'] == 1)
    <!-- Icon -->
        <img src="{{ asset('assets/img/icons/'.$cat['img']) }}" class="d-inline ml-auto menu-cat-icon"
             alt="{{ $cat['title_'.app()->getLocale()] }}">
@endif

<!-- Title -->
    {{--    @dump($cat)--}}

    <span class="menu-item-text">{{ $cat['title_'.app()->getLocale()] }}</span>
    <!-- Check children categories -->
    @php if(count($cat['children']) > 0){ @endphp
<!-- Submenu -->
    <ul class="submenu shadow-sm">
        <!-- Recursion call -->
        @php cats($cat['children'], $locale, $level+1); @endphp
    </ul>
    @php } @endphp
</li>

@php }
else if ($cat['title_hy'] == "Ծառայություններ" && $cat['img'] != NULL){ @endphp
{{--<li class="main-menu-item d-inline-block">--}}


{{--    <a href="{{ route('category', ['locale' => app()->getLocale(), 'id' => $cat['id']]) }}" class="text-dark">--}}

{{--        <img src="{{ asset('public/assets/img/icons/'.$cat['img']) }}" class="d-inline ml-auto menu-cat-icon"--}}
{{--             alt="{{ $cat['title_'.app()->getLocale()] }}">--}}
{{--        <span class="pl-1 text-dark main-meu-item-text">{{ $cat['title_'.app()->getLocale()] }}</span>--}}
{{--    </a>--}}

{{--</li>--}}
@php }
else { @endphp <!-- Children -->
<!-- Item -->
<li class="w-100 align-items-center">
    <!-- URL -->
    <a href="{{ route('category', ['locale' => app()->getLocale(), 'id' => $cat['id']]) }}" class="text-dark">
        <!-- Check image -->
    @if($cat['img'] != NULL && $cat['root'] == 1)
        <!-- Icon -->
            <img src="{{ asset('assets/img/icons/'.$cat['img']) }}" class="d-inline ml-auto menu-cat-icon"
                 alt="{{ $cat['title_'.app()->getLocale()] }}">
    @endif
    {{--    @php if ($cat['title_hy'] == "Ծառայություններ" && $cat['img'] != NULL) {@endphp--}}
    {{--    <!-- Icon -->--}}
    {{--        <img src="{{ asset('public/assets/img/icons/'.$cat['img']) }}" class="d-inline ml-auto menu-cat-icon"--}}
    {{--             alt="{{ $cat['title_'.app()->getLocale()] }}">--}}
    {{--    @php } @endphp--}}
    <!-- Title -->
        <span class="pl-1 text-dark main-meu-item-text">{{ $cat['title_'.app()->getLocale()] }}</span>

        <!-- Check has subcategory -->
    @php if(count($cat['children']) > 0){ @endphp
    <!-- Arrow -->
        <svg xmlns="http://www.w3.org/2000/svg" width="6.24" height="12.337" viewBox="0 0 6.24 12.337">
            <g id="left-arrow" transform="translate(6.24 12.337) rotate(180)">
                <g id="Group_9" data-name="Group 9" transform="translate(0)">
                    <path id="Path_5" data-name="Path 5"
                          d="M132.613,11.515l-5-5.005a.483.483,0,0,1,0-.682L132.613.823a.482.482,0,0,0-.682-.681l-4.994,5a1.447,1.447,0,0,0,0,2.044l4.995,5.005a.482.482,0,0,0,.682-.681Z"
                          transform="translate(-126.514 0)"/>
                    <path id="Path_14" data-name="Path 14"
                          d="M132.613,11.515l-5-5.005a.483.483,0,0,1,0-.682L132.613.823a.482.482,0,0,0-.682-.681l-4.994,5a1.447,1.447,0,0,0,0,2.044l4.995,5.005a.482.482,0,0,0,.682-.681Z"
                          transform="translate(-126.514 0)"/>
                </g>
            </g>
        </svg>
        @php } @endphp
    </a>
    <!-- Check children categories -->
@php if(count($cat['children']) > 0){ @endphp
<!-- Submenu -->
    <ul class="submenu shadow-sm">
        <!-- Recursion call -->
        @php cats($cat['children'], $locale, $level+1); @endphp
    </ul>
    @php } @endphp
</li>
@php } }
} @endphp

<!-- Check categories data -->
@if(isset($categories)&& count($categories) > 0)
    <ul class="w-auto">
        <!-- Call emnu -->

    {{ cats($categories, $locale) }}

    <!-- Loop from hader menu items -->

    @foreach($header_categories as $category_item)
        <!-- Item -->
            <li class="main-menu-item d-inline-block">
                <!-- Check image -->
            @if($category_item->img != NULL)
                <!-- Icon -->
                    <img src="{{ asset('assets/img/icons/'.$category_item->img) }}"
                         class="d-inline ml-auto menu-cat-icon"
                         alt="{{ $category_item->{'title_'.app()->getLocale()} }}">
            @endif

            <!-- Title -->
                <a href="{{ route('category', ['locale' => app()->getLocale(), 'id' => $category_item->id]) }}"
                   class="menu-item-text text-dark">{{ $category_item['title_'.app()->getLocale()] }}</a>
            </li>
        @endforeach
    </ul>
@endif
