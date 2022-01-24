<aside class="app-navbar">
    <!-- begin sidebar-nav -->
    <div class="sidebar-nav scrollbar scroll_light">
        <ul class="metismenu" id="sidebarNav">
            <li class="nav-static-title">Dashboard</li>

            <!-- Posts -->
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-pencil-alt"></i><span class="nav-title">Posts</span>
                <span class="nav-label label label-primary">{{ '1' }}</span>
            </a>
                <ul aria-expanded="false">
                    <li> <a href="{{ route('post-admin-index', ['locale' => app()->getLocale()]) }}">All Posts
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>

                    <li> <a href="{{ route('post-images-admin-index', ['locale' => app()->getLocale()]) }}">Post Images
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>

                    <li> <a href="{{ route('post-options-admin-index', ['locale' => app()->getLocale()]) }}">Post Options
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>

                    <li> <a href="{{ route('post-reports-admin-index', ['locale' => app()->getLocale()]) }}">Post Reports
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>

                    <!--li> <a href="#">Image Originals
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li-->
                </ul>
            </li>

            <!-- Documents -->
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-credit-card"></i><span class="nav-clipboard">Documents</span>
                <span class="nav-label label label-primary">{{ '2' }}</span>
            </a>
                <ul aria-expanded="false">
                    <li> <a href="{{ route('references-admin-index', ['locale' => app()->getLocale()]) }}">References</a> </li>

                    <li> <a href="{{ route('terms-and-conditions-admin-index', ['locale' => app()->getLocale()]) }}">Terms and Conditions</a> </li>
                </ul>
            </li>

            <!-- Site Data -->
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-panel"></i><span class="nav-title">Site Data</span>
                <span class="nav-label label label-primary">{{ '1' }}</span>
            </a>
                <ul aria-expanded="false">
                    <li> <a href="{{ route('seo-admin-index', ['locale' => app()->getLocale()]) }}">Seo
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>

                    <li> <a href="{{ route('site-data-admin-index', ['locale' => app()->getLocale()]) }}">Site Datas
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>

                    <li> <a href="{{ route('social-accounts-admin-index', ['locale' => app()->getLocale()]) }}">Social Accounts
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>
                </ul>
            </li>

            <!-- Locations -->
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-location-pin"></i><span class="nav-title">Locations</span>
                <span class="nav-label label label-primary">{{ '1' }}</span>
            </a>
                <ul aria-expanded="false">
                    <li> <a href="{{ route('countries-admin-index', ['locale' => app()->getLocale()]) }}">Countries
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>

                    <li> <a href="{{ route('locations-admin-index', ['locale' => app()->getLocale()]) }}">Locations
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>
                </ul>
            </li>

            <!-- Money -->
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-money"></i><span class="nav-title">Money</span>
                <span class="nav-label label label-primary">{{ '1' }}</span>
            </a>
                <ul aria-expanded="false">
                    <li> <a href="{{ route('currencies-admin-index', ['locale' => app()->getLocale()]) }}">Currencies
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>

                    <li> <a href="{{ route('currency-api-admin-index', ['locale' => app()->getLocale()]) }}">Currency API
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>
                </ul>
            </li>

            <!-- Menu -->
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-menu-alt"></i><span class="nav-title">Menu</span>
                <span class="nav-label label label-primary">{{ '1' }}</span>
            </a>
                <ul aria-expanded="false">
                
                    <li> <a href="{{ route('filters-admin-index', ['locale' => app()->getLocale()]) }}">Categories
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>

                    <li> <a href="#">Filter Inputs
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>

                    <li> <a href="#">Filter Input Options
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>

                    <li> <a href="#">Filter Specials
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>

                    <li> <a href="#">Filter Speicla Options
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>
                </ul>
            </li>

            <!-- Wallet -->
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-wallet"></i><span class="nav-title">Wallet</span>
                <span class="nav-label label label-primary">{{ '1' }}</span>
            </a>
                <ul aria-expanded="false">
                    <li> <a href="#">Wallets
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>

                    <li> <a href="#">Wallet Operations
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>

                    <li> <a href="#">Wallet Payments
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>
                </ul>
            </li>

            <!-- Wishlist -->
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-heart"></i><span class="nav-title">Wishlist</span>
                <span class="nav-label label label-primary">{{ '1' }}</span>
            </a>
                <ul aria-expanded="false">
                    <li> <a href="{{ route('wishlist-posts-admin-index', ['locale' => app()->getLocale()]) }}">Wishlist Posts
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>

                    <li> <a href="{{ route('wishlist-searches-admin-index', ['locale' => app()->getLocale()]) }}">Wishlist Searches
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>
                    
                    <li> <a href="{{ route('wishlist-users-admin-index', ['locale' => app()->getLocale()]) }}">Wishlist Users
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>
                </ul>
            </li>

            <!-- Users -->
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-user"></i><span class="nav-title">Users</span>
                <span class="nav-label label label-primary">{{ '1' }}</span>
            </a>
                <ul aria-expanded="false">
                    <li> <a href="{{ route('users-admin-index', ['locale' => app()->getLocale()]) }}">All Users
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>

                    <li> <a href="{{ route('spare-parts-admin-index', ['locale' => app()->getLocale()]) }}">Spare Parts
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>

                    <li> <a href="{{ route('user-messages-admin-index', ['locale' => app()->getLocale()]) }}">User Messages
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>

                    <li> <a href="{{ route('notifications-admin-index', ['locale' => app()->getLocale()]) }}">User Notifications
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>

                    <!--li> <a href="#">User Phone Numbers
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li-->

                    <li> <a href="{{ route('ratings-admin-index', ['locale' => app()->getLocale()]) }}">User Ratings
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>

                    <li> <a href="{{ route('blocked-users-admin-index', ['locale' => app()->getLocale()]) }}">Blocked Users
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>
                </ul>
            </li>

            <!-- Payment Systems -->
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-credit-card"></i><span class="nav-title">Payment Systems</span>
                <span class="nav-label label label-primary">{{ '1' }}</span>
            </a>
                <ul aria-expanded="false">
                    <li> <a href="#">Payment Metohds
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>

                    <li> <a href="#">Payment Metohd Operations
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>
                </ul>
            </li>

            <!-- Messages -->
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-comments"></i><span class="nav-title">Messages</span>
                <span class="nav-label label label-primary">{{ '1' }}</span>
            </a>
                <ul aria-expanded="false">
                    <li> <a href="{{ route('messages-admin-index', ['locale' => app()->getLocale()]) }}">All Chat Messages
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>

                    <!-- <li> <a href="#">Chat Messages
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li>

                    <li> <a href="#">Chat User Messages 
                        <span class="nav-label label label-primary">{{ '1' }}</span>
                    </a> </li> -->
                </ul>
            </li>

            <!-- Translations -->
            <li><a href="{{ route('translations-admin-index', ['locale' => app()->getLocale()]) }}" aria-expanded="false"><i class="nav-icon ti ti-world"></i> <span class="nav-title">Translations</span>   
                <span class="nav-label label label-primary">{{ '1' }}</span>
            </a></li>

            <!-- Slider -->
            <li><a href="{{ route('slider-admin-index', ['locale' => app()->getLocale()]) }}" aria-expanded="false"><i class="nav-icon ti ti-layout-slider"></i> <span class="nav-title">Slider</span>   
                <span class="nav-label label label-primary">{{ '1' }}</span>
            </a></li>

            <!-- Ads -->
            <li><a href="{{ route('ads-admin-index', ['locale' => app()->getLocale()]) }}" aria-expanded="false"><i class="nav-icon ti ti-layout-grid2"></i> <span class="nav-title">Ads</span>   
                <span class="nav-label label label-primary">{{ '1' }}</span>
            </a></li>

            <!-- Personal Links -->
            <li class="nav-static-title">Personal</li>

            <!-- Admin Setting -->
            <li><a href="{{ route('profile-admin-index', ['locale' => app()->getLocale()]) }}" aria-expanded="false"><i class="nav-icon ti ti-key"></i> <span class="nav-title">Admin Settings</span></a> </li>

            <!-- Copyright -->
            <li class="sidebar-banner p-2 bg-gradient text-center m-3 d-block rounded">
                <h5 class="text-white mb-1">ArmCoding</h5>
                <p class="font-13 text-white line-20">Admin Dashboard</p>
                <a class="btn btn-square btn-inverse-light btn-xs d-inline-block mt-2 mb-0" href="http://armcoding.com" target="_blank">See More</a>
            </li>
        </ul>
    </div>
    <!-- end sidebar-nav -->
</aside>
