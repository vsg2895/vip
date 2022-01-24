<!-- Tab Content -->
<div class="tab-content mt-2" id="postsTabContent">
    @if(\Request::segment(4) == NULL || \Request::segment(4) == 'all')
        <!-- All Posts -->
        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
            <!-- Navigation -->
            @include('account.post.navigation')

            <!-- Check data -->
            @if(isset($collection) && count($collection) > 0)
                <!-- Updated item area -->
                <div class="last-update-item-area"></div>

                <!-- Loop from posts -->

                @foreach($collection as $post)
{{--                    @dd($post_priorities)--}}
                    <!-- Get items -->

                    @include('items.row')
                @endforeach

                <!-- Pagination -->
                <div class="row no-gutters w-100 mt-5">
                    {{ $collection->links() }}
                </div>
            @else
                <!-- Not data exists -->
                <p>{!! translating('posts-all-not-data-found-description') !!}</p>
            @endif
        </div>
    @else
        <!-- All Posts -->
        <div class="tab-pane fade" id="all" role="tabpanel" aria-labelledby="all-tab">
            <!-- Loading Gif -->
            <div class="spinner-border mt-5 d-block mx-auto" role="status">
                <span class="sr-only">{{ translating('loading') }}...</span>
            </div>
        </div>
    @endif

    @if(\Request::segment(4) == 'active')
        <!-- Active Posts -->
        <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
            <!-- Navigation -->
            @include('account.post.navigation')

            <!-- Check data -->
            @if(isset($collection) && count($collection) > 0)
                <!-- Updated item area -->
                <div class="last-update-item-area"></div>

                <!-- Loop from posts -->
                @foreach($collection as $post)
                    <!-- Get items -->
                    @include('items.row')
                @endforeach

                <!-- Pagination -->
                <div class="row no-gutters w-100 mt-5">
                    {{ $collection->links() }}
                </div>
            @else
                <!-- Not data exists -->
                <p>{!! translating('posts-active-not-data-found-description') !!}</p>
            @endif
        </div>
    @else
        <!-- Active Posts -->
        <div class="tab-pane fade" id="active" role="tabpanel" aria-labelledby="active-tab">
            <!-- Loading Gif -->
            <div class="spinner-border mt-5 d-block mx-auto" role="status">
                <span class="sr-only">{{ translating('loading') }}...</span>
            </div>
        </div>
    @endif

    @if(\Request::segment(4) == 'passive')
        <!-- Passive Posts -->
        <div class="tab-pane fade show active" id="passive" role="tabpanel" aria-labelledby="passive-tab">
            <!-- Navigation -->
            @include('account.post.navigation')

            <!-- Check data -->
            @if(isset($collection) && count($collection) > 0)
                <!-- Updated item area -->
                <div class="last-update-item-area"></div>

                <!-- Loop from posts -->
                @foreach($collection as $post)
                    <!-- Get items -->
                    @include('items.row')
                @endforeach

                <!-- Pagination -->
                <div class="row no-gutters w-100 mt-5">
                    {{ $collection->links() }}
                </div>
            @else
                <!-- Not data exists -->
                <p>{!! translating('posts-passives-not-data-found-description') !!}</p>
            @endif
        </div>
    @else
        <!-- Passive Posts -->
        <div class="tab-pane fade" id="passive" role="tabpanel" aria-labelledby="passive-tab">
            <!-- Loading Gif -->
            <div class="spinner-border mt-5 d-block mx-auto" role="status">
                <span class="sr-only">{{ translating('loading') }}...</span>
            </div>
        </div>
    @endif

    @if(\Request::segment(4) == 'moderation')
        <!-- Moderation Posts -->
        <div class="tab-pane fade show active" id="moderation" role="tabpanel" aria-labelledby="moderation-tab">
            <!-- Navigation -->
            @include('account.post.navigation')

            <!-- Check data -->
            @if(isset($collection) && count($collection) > 0)
                <!-- Updated item area -->
                <div class="last-update-item-area"></div>

                <!-- Loop from posts -->
                @foreach($collection as $post)
                    <!-- Get items -->
                    @include('items.row')
                @endforeach

                <!-- Pagination -->
                <div class="row no-gutters w-100 mt-5">
                    {{ $collection->links() }}
                </div>
            @else
                <!-- Not data exists -->
                <p>{!! translating('posts-moderation-not-data-found-description') !!}</p>
            @endif
        </div>
    @else
        <!-- Moderation Posts -->
        <div class="tab-pane fade" id="moderation" role="tabpanel" aria-labelledby="moderation-tab">
            <!-- Loading Gif -->
            <div class="spinner-border mt-5 d-block mx-auto" role="status">
                <span class="sr-only">{{ translating('loading') }}...</span>
            </div>
        </div>
    @endif
</div>
