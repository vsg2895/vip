<!-- Contenet -->
<div class="app-container category-app-posts">
    <div class="row">

        <!-- Check data -->
    @if(isset($top_posts))
        <!-- Lines Section -->
            <div class="row w-100 p-0 no-gutters my-3">
                <div class="col-5 p-0">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%"
                         height="16" viewBox="0 0 932.5 16">
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
                            <line id="Line_105-2" data-name="Line 105" x2="917.5" transform="translate(5.5 8)"
                                  fill="none" stroke="#919191" stroke-width="1"/>
                        </g>
                    </svg>
                </div>

                <div class="col-5 offset-2 p-0">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%"
                         height="16" viewBox="0 0 932.5 16">
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
                            <line id="Line_105-2" data-name="Line 105" x2="917.5" transform="translate(5.5 8)"
                                  fill="none" stroke="#919191" stroke-width="1"/>
                        </g>
                    </svg>
                </div>
            </div>
    @endif

    <!-- Title -->
        <h2 class="font-weight-bold mb-3 text-dark text-center load-content-scroll w-100 h2">{{ translating('category-page-posts-title') }}</h2>

        <!-- Items -->
    @if(isset($posts) && count($posts) > 0)

        <!-- Content Loader -->
            <div class="load-content row">
                <!-- Define column size -->
            {{--            @php $col_3 = true;  @endphp--}}

            <!-- Loop from items -->
            {{--                @foreach($posts as $post)--}}
            {{--                    <!-- Get items -->--}}
            {{--                    @include('items.grid')--}}


            <!-- Posts -->
            {{--                @dd(count($posts));--}}
            @if(count($posts) >= 5)
                @php $col_5 = true;  @endphp
            @endif
            @foreach($posts as $post)
                <!-- Get items -->
                @include('items.grid')
            @endforeach


            <!-- Pagination -->
                <div class="row no-gutters d-block w-100 mt-5">
                    {{ $posts->links() }}
                </div>
            </div>
        @else
            <div class="alert alert-warning w-100 text-center" role="alert">
                <strong>{{ translating('this-category-post-is-not-found') }}</strong>
            </div>
        @endif
    </div>
</div>
