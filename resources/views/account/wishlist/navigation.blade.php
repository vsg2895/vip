<!-- Header Navigation -->
<ul class="nav nav-tabs mb-4" id="wishlistTab" role="tablist">
    <!-- Posts Page -->
    <li class="nav-item">
        <a class="nav-link posts @if(\Request::segment(4) == NULL || \Request::segment(4) == 'posts') active @endif" data-url="{{ route('account-wishlist', ['locale' => app()->getLocale()]) }}" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="@if(\Request::segment(4) == NULL || \Request::segment(4) == 'posts') true @else false @endif">{{ translating('posts') }}</a>
    </li>

    <!-- Users Page -->
    <li class="nav-item">
        <a class="nav-link users @if(\Request::segment(4) == 'users') active @endif" data-url="{{ route('account-wishlist-users', ['locale' => app()->getLocale()]) }}" id="users-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="@if(\Request::segment(4) == 'users') true @else false @endif">{{ translating('users') }}</a>
    </li>

    <!-- Searhchs Page -->
    <li class="nav-item">
        <a class="nav-link searchs @if(\Request::segment(4) == 'searchs') active @endif" data-url="{{ route('account-wishlist-searchs', ['locale' => app()->getLocale()]) }}" id="searchs-tab" data-toggle="tab" href="#searchs" role="tab" aria-controls="searchs" aria-selected="@if(\Request::segment(4) == 'searchs') true @else false @endif">{{ translating('searchs') }}</a>
    </li>
</ul>