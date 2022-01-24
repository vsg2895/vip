<!-- Contenet -->
<div class="app-container">
    <div class="row">
        <!-- Title -->
        <h2 class="font-weight-bold mb-5 text-dark text-center h2 w-100">{{ translating('category-page-main-posts-title') }}</h2>

        <!-- Check data -->
        @if(isset($top_posts) && count($top_posts) > 0)
            <!-- Posts -->
            <div class="slick-wrapper">
                <div id="slick1" @if(Route::currentRouteName() == "home") class="home-slick1" @else class="no-home-slick1" @endif>
                    <!-- Loop from posts -->
                    @foreach($top_posts as $post)
                        <div class="slide-item">
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

<!-- Contenet -->
<div class="app-container bg-light">
    <div class="row">
        <!-- Lines Section -->
        <div class="row w-100 p-0 no-gutters my-5">
            <div class="col-5 p-0">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="16" viewBox="0 0 932.5 16">
                    <defs>
                        <filter id="Line_105" x="0" y="0" width="100%" height="16" filterUnits="userSpaceOnUse">
                        <feOffset dx="2" input="SourceAlpha"/>
                        <feGaussianBlur stdDeviation="2.5" result="blur"/>
                        <feFlood flood-opacity="0.161"/>
                        <feComposite operator="in" in2="blur"/>
                        <feComposite in="SourceGraphic"/>
                        </filter>
                    </defs>
                    <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#Line_105)">
                        <line id="Line_105-2" data-name="Line 105" x2="917.5" transform="translate(5.5 8)" fill="none" stroke="#919191" stroke-width="1"/>
                    </g>
                </svg>
            </div>

            <div class="col-5 offset-2 p-0">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="16" viewBox="0 0 932.5 16">
                    <defs>
                        <filter id="Line_105" x="0" y="0" width="100%" height="16" filterUnits="userSpaceOnUse">
                        <feOffset dx="2" input="SourceAlpha"/>
                        <feGaussianBlur stdDeviation="2.5" result="blur"/>
                        <feFlood flood-opacity="0.161"/>
                        <feComposite operator="in" in2="blur"/>
                        <feComposite in="SourceGraphic"/>
                        </filter>
                    </defs>
                    <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#Line_105)">
                        <line id="Line_105-2" data-name="Line 105" x2="917.5" transform="translate(5.5 8)" fill="none" stroke="#919191" stroke-width="1"/>
                    </g>
                </svg>
            </div>
        </div>

        <!-- Title -->
        <h2 class="font-weight-bold mb-5 text-dark text-center h2 w-100">{{ translating('category-page-posts-title') }}</h2>

         <!-- Content Loader -->
         <div class="load-content w-100 row">
            <!-- Check posts count -->
            @if(isset($posts) && count($posts) > 0)
                <!-- Loop from items -->
                @foreach($posts as $post)
                    <!-- Defile col size -->
                    @php $col_3 = true; @endphp

                    <!-- Get items -->
                    @include('items.grid')
                @endforeach

                <!-- Pagination -->
                <div class="row no-gutters d-block w-100 mt-5">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="alert alert-warning w-100 text-center" role="alert">
                    <strong>{{ translating('this-category-main-post-is-not-found') }}</strong>
                </div>
            @endif
        </div>
    </div>
</div>
