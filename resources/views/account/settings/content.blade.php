<!-- Tab Content -->
<div class="tab-content mt-2" id="settingsTabContent">
    @if(\Request::segment(4) == NULL || \Request::segment(4) == 'profile')
        <!-- Profile Page -->
        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile">
            @include('account.settings.profile')
        </div>
    @else
        <!-- Profile Page -->
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <!-- Loading Gif -->
            <div class="spinner-border mt-5 d-block mx-auto" role="status">
                <span class="sr-only">{{ translating('loading') }}...</span>
            </div>
        </div>
    @endif

    @if(\Request::segment(4) == 'contacts')
        <!-- Contacts Page -->
        <div class="tab-pane fade show active" id="contacts" role="tabpanel" aria-labelledby="contacts">
            @include('account.settings.contacts')
        </div>
    @else
        <!-- Contacts Page -->
        <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
            <!-- Loading Gif -->
            <div class="spinner-border mt-5 d-block mx-auto" role="status">
                <span class="sr-only">{{ translating('loading') }}...</span>
            </div>
        </div>
    @endif

    @if(\Request::segment(4) == 'notifications')
        <!-- Notifications Page -->
        <div class="tab-pane fade show active" id="notifications" role="tabpanel" aria-labelledby="notifications">
            @include('account.settings.notifications')
        </div>
    @else
        <!-- Notifications Page -->
        <div class="tab-pane fade" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">
            <!-- Loading Gif -->
            <div class="spinner-border mt-5 d-block mx-auto" role="status">
                <span class="sr-only">{{ translating('loading') }}...</span>
            </div>
        </div>
    @endif

    @if(\Request::segment(4) == 'blocked-users')
        <!-- Blocked Users Page -->
        <div class="tab-pane fade show active" id="blocked-users" role="tabpanel" aria-labelledby="blocked-users">
            @include('account.settings.blocked-users')
        </div>
    @else
        <!-- Blocked Users Page -->
        <div class="tab-pane fade" id="blocked-users" role="tabpanel" aria-labelledby="blocked-users-tab">
            <!-- Loading Gif -->
            <div class="spinner-border mt-5 d-block mx-auto" role="status">
                <span class="sr-only">{{ translating('loading') }}...</span>
            </div>
        </div>
    @endif

    @if(\Request::segment(4) == 'account')
        <!-- Account Page -->
        <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account">
            @include('account.settings.account')
        </div>
    @else
        <!-- Account Page -->
        <div class="tab-pane fade" id="account" role="tabpanel" aria-labelledby="account-tab">
            <!-- Loading Gif -->
            <div class="spinner-border mt-5 d-block mx-auto" role="status">
                <span class="sr-only">{{ translating('loading') }}...</span>
            </div>
        </div>
    @endif

</div>
