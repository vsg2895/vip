<!-- Tab Content -->
<div class="tab-content mt-2" id="wishlistTabContent">
    @if(\Request::segment(4) == NULL || \Request::segment(4) == 'posts')
        <!-- Posts Page -->
        <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts">
            @include('account.wishlist.posts')
        </div>
    @else
        <!-- Wallet Page -->
        <div class="tab-pane fade" id="posts" role="tabpanel" aria-labelledby="posts-tab">
            <!-- Loading Gif -->
            <div class="spinner-border mt-5 d-block mx-auto" role="status">
                <span class="sr-only">{{ translating('loading') }}...</span>
            </div>
        </div>
    @endif

    @if(\Request::segment(4) == 'users')
        <!-- Users Page -->
        <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="users">
            @include('account.wishlist.users')
        </div>
    @else
        <!-- Users Page -->
        <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
            <!-- Loading Gif -->
            <div class="spinner-border mt-5 d-block mx-auto" role="status">
                <span class="sr-only">{{ translating('loading') }}...</span>
            </div>
        </div>
    @endif

    @if(\Request::segment(4) == 'searchs')
        <!-- Searchs Page -->
        <div class="tab-pane fade show active" id="searchs" role="tabpanel" aria-labelledby="searchs">
            @include('account.wishlist.searchs')
        </div>
    @else
        <!-- Searchs Page -->
        <div class="tab-pane fade" id="searchs" role="tabpanel" aria-labelledby="searchs-tab">
            <!-- Loading Gif -->
            <div class="spinner-border mt-5 d-block mx-auto" role="status">
                <span class="sr-only">{{ translating('loading') }}...</span>
            </div>
        </div>
    @endif
</div>
