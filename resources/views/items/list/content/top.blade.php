<!-- Contenet -->
<div class="app-container top-app-container">
    <div class="row">
        <!-- Title -->
        {{--        @dd($top_posts[0] instanceof App\SparePartsStore)--}}
        {{--        @dump(getCategoryChildren(\Request::segment(3))[0])--}}
        @if(isset($top_posts[0]) && $top_posts[0] instanceof App\SparePartsStore)

            @if(getCategoryChildren(\Request::segment(3))[0]->header_position != 8)
                {{--                @dd($top_posts[0]->category)--}}
                <h2 class="font-weight-bold mb-3 text-dark text-center h2 w-100">{{ translating('top')  . " " . " "  }}{{ translating('category-page-posts-title') }}
                </h2>
            @else
                <h2 class="font-weight-bold mb-3 text-dark text-center h2 w-100">{{ translating('url-home') }}
                </h2>
            @endif
        @else
            <h2 class="font-weight-bold mb-3 text-dark text-center h2 w-100">{{ translating('top')  . " " . " "  }}{{ translating('category-page-posts-title') }}
            </h2>
        @endif
    <!-- Check data -->
        @if(isset($top_posts) && count($top_posts) > 0)
            {{--            @dd($top_posts[0] instanceof App\SparePartsStore)--}}
            @if(count($top_posts) > 9 && count($top_posts) < 12)
                <input type="hidden" @if($top_posts[0] instanceof App\SparePartsStore) class="spare_show" @endif id="top_size" data-row="2"
                       data-show="@if($top_posts[0] instanceof App\SparePartsStore) 4 @else 6 @endif">
            @elseif(count($top_posts) < 9)
                <input type="hidden" @if($top_posts[0] instanceof App\SparePartsStore) class="spare_show" @endif id="top_size" data-row="1"
                       data-show="@if($top_posts[0] instanceof App\SparePartsStore) 4 @else 6 @endif">
            @else
                <input type="hidden" @if($top_posts[0] instanceof App\SparePartsStore) class="spare_show" @endif id="top_size" data-row="3"
                       data-show="@if($top_posts[0] instanceof App\SparePartsStore) 4 @else 6 @endif">
            @endif
            <div class="slick-wrapper">
                <div id="slick1" @if(Route::currentRouteName() == "home") class="home-slick1" @else class="no-home-slick1" @endif>
                    <!-- Loop from posts -->
                    @foreach($top_posts as $post)
                        <div class="slide-item top-items-spare">
                            <!-- Get items -->
                            @include('items.grid')
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="alert alert-warning w-100 text-center" role="alert">
                <strong>{{ translating('this-category-main-top-post-is-not-found') }}</strong>
            </div>
        @endif
    </div>
</div>
