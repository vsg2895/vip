<!-- Navigation -->
@include('account.settings.navigation')

<!-- Content -->
<div class="container-fluid mt-3">
    <!-- Description Section -->
    <div class="row no-gutters">
        <p class="h5 text-dark w-100">{{ translating('account-notifications-page-description') }}</p>
    </div>

    <!-- Notifications Settings -->
    <div class="row">
        <div class="col-lg-10">
            <div class="table-responsive mt-5">
                <table class="table notifications-table">
                    <tbody>
                        <!-- New Messages and Responses -->
                        <tr>
                            <!-- Title -->
                            <td class="h5">{{ translating('new-messages-and-responses-notifications') }}</td>
                            
                            <!-- Phone -->
                            <td>
                                <label for="new-messages-phone">
                                    <span class="h5">{{ translating('phone') }}</span>
                                    <input form="userNotificationChangeForm" id="new-messages-phone" type="radio" value="phone" class="checkbox" name="new_messages" @if(isset(Auth::user()->notification) && Auth::user()->notification['new_messages'] == 'phone') checked @endif>
                                </label>
                            </td>

                            <!-- Email -->
                            <td>
                                <label for="new-messages-email">
                                    <span class="h5">{{ translating('email') }}</span>
                                    <input form="userNotificationChangeForm" id="new-messages-email" type="radio" value="email" class="checkbox" name="new_messages" @if(isset(Auth::user()->notification) && Auth::user()->notification['new_messages'] == 'email') checked @endif>
                                </label>
                            </td>
                        </tr>

                        <!-- Wished Posts Upadtes -->
                        <tr>
                            <!-- Title -->
                            <td class="h5">{{ translating('wished-posts-updates') }}</td>
                            
                            <!-- Phone -->
                            <td>
                                <label for="wished-posts-phone">
                                    <span class="h5">{{ translating('phone') }}</span>
                                    <input form="userNotificationChangeForm" id="wished-posts-phone" type="radio" value="phone" class="checkbox" name="wished_posts" @if(isset(Auth::user()->notification) && Auth::user()->notification['wished_posts'] == 'phone') checked @endif>
                                </label>
                            </td>

                            <!-- Email -->
                            <td>
                                <label for="wished-posts-email">
                                    <span class="h5">{{ translating('email') }}</span>
                                    <input form="userNotificationChangeForm" id="wished-posts-email" type="radio" value="email" class="checkbox" name="wished_posts" @if(isset(Auth::user()->notification) && Auth::user()->notification['wished_posts'] == 'email') checked @endif>
                                </label>
                            </td>
                        </tr>

                        <!-- Wished Users Update -->
                        <tr>
                            <!-- Title -->
                            <td class="h5">{{ translating('wished-users-updates') }}</td>
                            
                            <!-- Phone -->
                            <td>
                                <label for="wished-users-phone">
                                    <span class="h5">{{ translating('phone') }}</span>
                                    <input form="userNotificationChangeForm" id="wished-users-phone" type="radio" value="phone" class="checkbox" name="wished_users" @if(isset(Auth::user()->notification) && Auth::user()->notification['wished_users'] == 'phone') checked @endif>
                                </label>
                            </td>

                            <!-- Email -->
                            <td>
                                <label for="wished-users-email">
                                    <span class="h5">{{ translating('email') }}</span>
                                    <input form="userNotificationChangeForm" id="wished-users-email" type="radio" value="email" class="checkbox" name="wished_users" @if(isset(Auth::user()->notification) && Auth::user()->notification['wished_users'] == 'email') checked @endif>
                                </label>
                            </td>
                        </tr>

                        <!-- Wished Search Update -->
                        <tr>
                            <!-- Title -->
                            <td class="h5">{{ translating('wished-searchs-updates') }}</td>
                            
                            <!-- Phone -->
                            <td>
                                <label for="wished-searchs-phone">
                                    <span class="h5">{{ translating('phone') }}</span>
                                    <input form="userNotificationChangeForm" id="wished-searchs-phone" type="radio" value="phone" class="checkbox" name="wished_searchs" @if(isset(Auth::user()->notification) && Auth::user()->notification['wished_searchs'] == 'phone') checked @endif>
                                </label>
                            </td>

                            <!-- Email -->
                            <td>
                                <label for="wished-searchs-email">
                                    <span class="h5">{{ translating('email') }}</span>
                                    <input form="userNotificationChangeForm" id="wished-searchs-email" type="radio" value="email" class="checkbox" name="wished_searchs" @if(isset(Auth::user()->notification) && Auth::user()->notification['wished_searchs'] == 'email') checked @endif>
                                </label>
                            </td>
                        </tr>

                        <!-- Wished Reviews -->
                        <tr>
                            <!-- Title -->
                            <td class="h5">{{ translating('new-reviews-and-ratings') }}</td>
                            
                            <!-- Phone -->
                            <td>
                                <label for="new-reviews-phone">
                                    <span class="h5">{{ translating('phone') }}</span>
                                    <input form="userNotificationChangeForm" id="new-reviews-phone" type="radio" value="phone" class="checkbox" name="new_reviews" @if(isset(Auth::user()->notification) && Auth::user()->notification['new_reviews'] == 'phone') checked @endif>
                                </label>
                            </td>

                            <!-- Email -->
                            <td>
                                <label for="new-reviews-email">
                                    <span class="h5">{{ translating('email') }}</span>
                                    <input form="userNotificationChangeForm" id="new-reviews-email" type="radio" value="email" class="checkbox" name="new_reviews" @if(isset(Auth::user()->notification) && Auth::user()->notification['new_reviews'] == 'email') checked @endif>
                                </label>
                            </td>
                        </tr>

                        <!-- Remembers and Other Informations -->
                        <tr>
                            <!-- Title -->
                            <td class="h5">{{ translating('remembers-and-other-informations') }}</td>
                            
                            <!-- Phone -->
                            <td>
                                <label for="remembers-phone">
                                    <span class="h5">{{ translating('phone') }}</span>
                                    <input form="userNotificationChangeForm" id="remembers-phone" type="radio" value="phone" class="checkbox" name="remembers" @if(isset(Auth::user()->notification) && Auth::user()->notification['remembers'] == 'phone') checked @endif>
                                </label>
                            </td>

                            <!-- Email -->
                            <td>
                                <label for="remembers-email">
                                    <span class="h5">{{ translating('email') }}</span>
                                    <input form="userNotificationChangeForm" id="remembers-email" type="radio" value="email" class="checkbox" name="remembers" @if(isset(Auth::user()->notification) && Auth::user()->notification['remembers'] == 'email') checked @endif>
                                </label>
                            </td>
                        </tr>

                        <!-- Website Updates and News -->
                        <tr>
                            <!-- Title -->
                            <td class="h5">{{ translating('website-updates-and-news') }}</td>
                            
                            <!-- Phone -->
                            <td>
                                <label for="website-updates-phone">
                                    <span class="h5">{{ translating('phone') }}</span>
                                    <input form="userNotificationChangeForm" id="website-updates-phone" type="radio" value="phone" class="checkbox" name="website_updates" @if(isset(Auth::user()->notification) && Auth::user()->notification['website_updates'] == 'phone') checked @endif>
                                </label>
                            </td>

                            <!-- Email -->
                            <td>
                                <label for="website-updates-email">
                                    <span class="h5">{{ translating('email') }}</span>
                                    <input form="userNotificationChangeForm" id="website-updates-email" type="radio" value="email" class="checkbox" name="website_updates" @if(isset(Auth::user()->notification) && Auth::user()->notification['website_updates'] == 'email') checked @endif>
                                </label>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Button -->
    <div class="row w-100">
        <form id="userNotificationChangeForm" action="{{ route('account-change-notifications-data', ['locale' => app()->getLocale()]) }}" method="post" class="w-100">
            @csrf
            <button id="sendForm" type="submit" form="userNotificationChangeForm" class="float-right btn pl-3 pr-3 btn-main text-light btn-lg">{{ translating('save-changes') }}</button>
            <p class="clearfix"></p>
        </form>
    </div>
</div>