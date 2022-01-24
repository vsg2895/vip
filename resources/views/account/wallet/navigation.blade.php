<!-- Header Navigation -->
<ul class="nav nav-tabs mb-4" id="walletTab" role="tablist">
    <!-- Wallet Page -->
    <li class="nav-item">
        <a class="nav-link wallet @if(\Request::segment(4) == NULL || \Request::segment(4) == 'main') active @endif" data-url="{{ route('account-wallet', ['locale' => app()->getLocale()]) }}" id="main-tab" data-toggle="tab" href="#main" role="tab" aria-controls="main" aria-selected="@if(\Request::segment(4) == NULL || \Request::segment(4) == 'main') true @else false @endif">{{ translating('wallet') }}</a>
    </li>

    <!-- Payments Page -->
    <li class="nav-item">
        <a class="nav-link payments @if(\Request::segment(4) == 'payments') active @endif" data-url="{{ route('account-wallet-payments', ['locale' => app()->getLocale()]) }}" id="payments-tab" data-toggle="tab" href="#payments" role="tab" aria-controls="payments" aria-selected="@if(\Request::segment(4) == 'payments') true @else false @endif">{{ translating('payments') }}</a>
    </li>

    <!-- Operations Page -->
    <li class="nav-item">
        <a class="nav-link operations @if(\Request::segment(4) == 'operations') active @endif" data-url="{{ route('account-wallet-operations', ['locale' => app()->getLocale()]) }}" id="operations-tab" data-toggle="tab" href="#operations" role="tab" aria-controls="operations" aria-selected="@if(\Request::segment(4) == 'operations') true @else false @endif">{{ translating('operations') }}</a>
    </li>
</ul>