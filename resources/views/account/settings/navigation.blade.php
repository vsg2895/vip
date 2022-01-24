<!-- Header Navigation -->
<ul class="nav nav-tabs mb-4" id="settingsTab" role="tablist">
    <!-- Profile Page -->
    <li class="nav-item">
        <a class="nav-link profile @if(\Request::segment(4) == NULL || \Request::segment(4) == 'profile') active @endif" data-url="{{ route('account-settings-main', ['locale' => app()->getLocale()]) }}" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="@if(\Request::segment(4) == NULL || \Request::segment(4) == 'profile') true @else false @endif">{{ translating('profile') }}</a>
    </li>

    <!-- Contacts Page -->
    <li class="nav-item">
        <a class="nav-link contacts @if(\Request::segment(4) == 'contacts') active @endif" data-url="{{ route('account-settings-contacts', ['locale' => app()->getLocale()]) }}" id="contacts-tab" data-toggle="tab" href="#contacts" role="tab" aria-controls="contacts" aria-selected="@if(\Request::segment(4) == 'contacts') true @else false @endif">{{ translating('contact-datas') }}</a>
    </li>

    <!-- Notifications Page -->
    <li class="nav-item">
        <a class="nav-link notifications  @if(\Request::segment(4) == 'notifications') active @endif" data-url="{{ route('account-settings-notifications', ['locale' => app()->getLocale()]) }}" id="notifications-tab" data-toggle="tab" href="#notifications" role="tab" aria-controls="notifications" aria-selected="@if(\Request::segment(4) == 'notifications') true @else false @endif">{{ translating('notifications') }}</a>
    </li>

    <!-- Blocked Users Page -->
    <li class="nav-item d-none">
        <a class="nav-link blocked-users @if(\Request::segment(4) == 'blocked-users') active @endif" data-url="{{ route('account-settings-blocked-users', ['locale' => app()->getLocale()]) }}" id="blocked-users-tab" data-toggle="tab" href="#blocked-users" role="tab" aria-controls="blocked-users" aria-selected="@if(\Request::segment(4) == 'blocked-users') true @else false @endif">{{ translating('blocked-users') }}</a>
    </li>

    <!-- Account Page -->
    <li class="nav-item">
        <a class="nav-link account @if(\Request::segment(4) == 'account') active @endif" data-url="{{ route('account-settings-account', ['locale' => app()->getLocale()]) }}" id="account-tab" data-toggle="tab" href="#account" role="tab" aria-controls="account" aria-selected="@if(\Request::segment(4) == 'account') true @else false @endif">{{ translating('account') }}</a>
    </li>
</ul>