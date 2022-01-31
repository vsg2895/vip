<!-- Aside -->
<button class="btn btn-dark w-100 show-account-aside-menu d-block d-lg-none" data-show="{{ translating('account-aside-menu-show-text') }}" data-hide="{{ translating('account-aside-menu-hide-text') }}" type="button"><i class="fa fa-bars"></i> {{ translating('account-aside-menu-show-text') }}</button>

<aside class="col-lg-3 col-12 account-aside">
    <!-- Links -->
    <ul class="w-100" data-locale="{{ app()->getLocale() }}">
        <!-- Posts -->
        <li class="w-100 d-block mb-1 w-100 text-center shadow-sm">
            <a href="{{ route('account-posts', ['locale' => app()->getLocale()]) }}" data-segment="my-posts" class="p-3 d-block account-aside-url @if(isset($page_name_account_aside) && $page_name_account_aside == 'posts') active @endif">{{ translating('posts') }}</a>
        </li>

        <!-- Messages -->
        <li class="w-100 d-block mb-1 w-100 text-center shadow-sm">
            <a href="{{ route('account-messages', ['locale' => app()->getLocale()]) }}" data-segment="messages" class="p-3 d-block account-aside-url @if(isset($page_name_account_aside) && $page_name_account_aside == 'messages') active @endif">{{ translating('messages') }}</a>
        </li>

        <!-- Settings -->
        <li class="w-100 d-block mb-1 w-100 text-center shadow-sm">
            <a href="{{ route('account-settings-main', ['locale' => app()->getLocale()]) }}" data-segment="settings/profile" class="p-3 d-block account-aside-url @if(isset($page_name_account_aside) && $page_name_account_aside == 'settings') active @endif">{{ translating('settings') }}</a>
        </li>

        <!-- Wallet -->
        <li class="w-100 d-block mb-1 w-100 text-center shadow-sm">
            <a href="{{ route('account-wallet', ['locale' => app()->getLocale()]) }}" data-segment="wallet/main" class="p-3 d-block account-aside-url @if(isset($page_name_account_aside) && $page_name_account_aside == 'wallet') active @endif">{{ translating('wallet') }}</a>
        </li>

        <!-- Wishlist -->
        <li class="w-100 d-block mb-1 w-100 text-center shadow-sm">
            <a href="{{ route('account-wishlist', ['locale' => app()->getLocale()]) }}" data-segment="wishlist/posts" class="p-3 d-block account-aside-url @if(isset($page_name_account_aside) && $page_name_account_aside == 'wishlist') active @endif">{{ translating('wishlist') }}</a>
        </li>
    </ul>
</aside>
