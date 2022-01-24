<!-- Contenet -->
<div class="app-container mt-0 mb-3 main-posts">
    <div class="row">
        @if(isset($top_posts))
            @if(count($top_posts) > 9 && count($top_posts) < 12)

                <input type="hidden" id="top_size" data-row="2" data-show="6">

            @elseif(count($top_posts) < 9)

                <input type="hidden" id="top_size" data-row="1" data-show="6">

            @else

                <input type="hidden" id="top_size" data-row="3" data-show="6">
            @endif
        @endif
    <!-- Title -->
        <h2 class="font-weight-bold mb-3 text-dark text-center h2 w-100">{{ translating('home-section-main-posts-title') }}</h2>

        <!-- Posts -->
        {{--            @dd(Route::currentRouteName())--}}
        <div class="slick-wrapper">
            <div id="slick1" @if(Route::currentRouteName() == "home") class="home-slick1" @else class="no-home-slick1" @endif>
                <!-- Check data -->
            {{--                @dd(count($top_posts))--}}
            @if(isset($top_posts) && count($top_posts) > 0)
                <!-- Loop from posts -->
                {{--                @if(isset($top_posts) && count($top_posts) > 0)--}}
                <!-- Posts -->
                    {{--            @dd($top_posts)--}}

                    @foreach($top_posts as $post)
                        <div class="slide-item">
                            <!-- Get items -->
                            @include('items.grid')
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- See More Button -->
        @if(count($top_posts_all) > 60)
            <div class="row no-gutters w-100 my-2 top-more-button">
                <a href="{{ route('primary-posts', ['locale' => app()->getLocale()]) }}"
                   class="btn btn-main d-block mx-auto btn-lg pl-4 pr-4 text-light rounded-all">{{ translating('see-more') }}</a>
            </div>
        @endif
    </div>
</div>
