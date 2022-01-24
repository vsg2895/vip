<?php

use App\Events\MessageSubmited;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Redirect to localization route
Route::redirect('/', app()->getLocale());

// Route::get('/link', function () {
//   $target = '/home/public_html/storage/app/public';
//   $shortcut = '/home/public_html/public/storage';
//   symlink($target, $shortcut);
// });

Route::get('/clear-cache', function() {
    $exitCode = \Illuminate\Support\Facades\Artisan::call('cache:clear');
    $exitCode = \Illuminate\Support\Facades\Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

// Make route group that included localization an go to controller from middleware Index
Route::group([
    'prefix' => '{locale?}',
//    'middleware' => 'Index',
    'middleware' => ['Index', 'CheckPostFailed']
], function () {
    // ------------------- PAGES --------------------------

    // Home
    Route::get('/', 'IndexController@index')->name('home');

    // API for getting spare parts
//    Route::get('/ss/{id}', 'IndexController@spare_parts_index')->name('home_spare_parts_index');

    // Contacts
    Route::get('/contacts', 'ContactController@index')->name('contacts');

    // Post ( Posts List ) / Detail Page
    Route::get('/items/{id?}', 'ItemController@index')->name('items');
    Route::get('/posts', 'ItemController@posts')->name('posts');

    // Post Services
    Route::get('/services', 'ItemController@services')->name('services');

    // Post Top Items
    Route::get('/top-posts', 'ItemController@top')->name('top-posts');
    Route::get('/primary-posts', 'ItemController@primary')->name('primary-posts');

    // Search
    Route::get('/search', 'ItemController@search')->name('search');

    // Post Hurry Items
    Route::get('/hurry-posts', 'ItemController@hurry')->name('hurry-posts');

    // Category ( Posts List )
    Route::get('/category/{id}', 'ItemController@category')->name('category');
    Route::post('/search', 'ItemController@global_search')->name('search.global');

    // Profile
    Route::get('/profile', 'ProfileController@index')->name('profile');

    // Terms and Conditions
    Route::get('/terms-and-conditions', 'TermsAndConditionsController@index')->name('terms-and-conditions');

    // Reference
    Route::get('/reference', 'ReferencesController@index')->name('reference');

    // Spare Parts
    Route::get('/spare-parts/{id?}', 'SparePartsController@index')->name('spare-parts');

    // -------------------------- USER PROFILE PAGE -------------------------
    Route::get('/user/{id}', 'UserController@index')->name('user');

    // -------------------------- ACTIONS -------------------------
    // Set currency
    Route::get('/set-currency/{set_currency}', 'Actions\CurrencyController@index')->name('set-currency');

    // Set languge
    Route::get('/set-languege/{new_locale}', 'Actions\LanguagesController@index')->name('set-languege');

    // Get currency change api data
    Route::post('/get-currency-api-data', 'Actions\CurrencyApiController@index')->name('get-currency-api');

    // Get window width
    Route::get('/get-window-width/{size}', 'Actions\WindowController@index')->name('get-window-width');

    // Send message from contacts page
    Route::post('/send-message', 'Actions\MessageController@index')->name('send-message');

    // Posts wishlist action
    Route::get('/post-wishlist-action/{post_id}', 'Actions\WishlistController@index')->name('post-wishlist-action');

    // Users wishlist action
    Route::get('/post-users-action/{user_id}', 'Actions\WishlistController@users')->name('users-wishlist-action');

    // Searchs wishlist action
    Route::get('/post-searchs-action/{post_id}', 'Actions\WishlistController@searchs')->name('searchs-wishlist-action');

    // Detail send message
    Route::post('/send-message-to-user/{geter_id}', 'Actions\DetailController@message')->name('detail-send-message');

    // Detail send report
    Route::post('/send-report-to-user/{post_id}', 'Actions\DetailController@report')->name('detail-send-report');

    // User page send reveiw
    Route::post('/send-review/{user_id}', 'Actions\UsersController@send_review')->name('user-page-send-review');

    // Account change phone numbers
    Route::post('/account/change/phone-numbers', 'Actions\AccountController@phone_number_update')->name('account-change-phone-numbers');

    // Account change profile datas
    Route::post('/account/change/profile-datas', 'Actions\AccountController@profile_datas_update')->name('account-change-profile-datas');

    // Account change profile datas
    Route::post('/account/change/profile-img', 'Actions\AccountController@profile_img_update')->name('account-change-profile-img');

    // Account change notifications datas
    Route::post('/account/change/notifications-data', 'Actions\AccountController@notifications_data_update')->name('account-change-notifications-data');

    // Filiter spare parts data
    Route::post('/spare-parts-filter', 'Actions\SparePartsController@index')->name('spare-parts-filter');

    // ----------------------- PAYMENT SYSTEMS -------------------------------
    // IDRAM PAYMENT SYSTEM
    Route::post('/idram', [App\Http\Controllers\Payment\IdramController::class, 'index'])->name('idram');
    Route::any('/idram/payOrder', [App\Http\Controllers\Payment\IdramController::class, 'payOrder'])->name('idramPayOrder');
    Route::post('/idram/success', [App\Http\Controllers\Payment\IdramController::class, 'success'])->name('idramSuccess');
    Route::post('/idram/error', [App\Http\Controllers\Payment\IdramController::class, 'error'])->name('idramError');

    // AMERIA PAYMENT SYSTEM
    Route::post('/ameria', [App\Http\Controllers\Payment\AmeriaController::class, 'index'])->name('ameria');
    Route::any('/ameria/payOrder', [App\Http\Controllers\Payment\AmeriaController::class, 'payOrder'])->name('ameriaPayOrder');

    // ------------------------- AUTH -----------------------
    Auth::routes();

    // Log in with faceook
    Route::get('login/facebook', [App\Http\Controllers\Auth\LoginController::class, 'redirectToFacebookProvider'])->name('login-facebook');
    Route::get('login/facebook/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleProviderFacebookCallback']);

    // Log in with google
    Route::get('login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogleProvider'])->name('login-google');
    Route::get('login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleProviderGoogleCallback']);

    // Login Registration
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::get('/login/admin', [App\Http\Controllers\Auth\LoginController::class, 'showAdminForm'])->name('login-admin');
    Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');

    // Forget password
    Route::get('/login/forget-password', [App\Http\Controllers\Auth\LoginController::class, 'showForgetPasswordForm'])->name('forget-password');
    Route::post('/login/forget-password-send', [App\Http\Controllers\Auth\LoginController::class, 'forget_password_send'])->name('forget-password-send');
    Route::get('/login/reset-password/{email}/{phone}', [App\Http\Controllers\Auth\LoginController::class, 'reset_password'])->name('reset-password-login');
    Route::post('/login/reset-password-send', [App\Http\Controllers\Auth\LoginController::class, 'reset_password_send'])->name('reset-password-send');

    // ------------------- ACCOUNT ------------------------
    // Index
    Route::get('/account', [App\Http\Controllers\Account\IndexController::class, 'index'])->name('account');
    Route::post('/account/resend-email', [App\Http\Controllers\Account\IndexController::class, 'resend_email'])->name('resend-email');
    Route::get('/account/verify/{email}', [App\Http\Controllers\Account\IndexController::class, 'verify'])->name('verify');
    Route::post('/account/reset-passsword', [App\Http\Controllers\Account\IndexController::class, 'reset_password'])->name('reset-password');

    // Posts
    Route::get('/account/my-posts/{type?}', [App\Http\Controllers\Account\PostsController::class, 'index'])->name('account-posts');
    Route::get('/account/post/edit/{id}', [App\Http\Controllers\Account\PostsController::class, 'edit'])->name('account-posts-edit');
    Route::post('/account/post/update-content/{id}', [App\Http\Controllers\Account\PostsController::class, 'update_content'])->name('account-posts-update-content');
    Route::get('/account/post/delete/{id?}', [App\Http\Controllers\Account\PostsController::class, 'delete'])->name('account-post-delete');
    Route::get('/account/post/update/{id?}', [App\Http\Controllers\Account\PostsController::class, 'update'])->name('account-post-update');
    Route::get('/account/post/make-active/{id?}', [App\Http\Controllers\Account\PostsController::class, 'make_active'])->name('account-post-make-active');
    Route::get('/account/post/make-passive/{id?}', [App\Http\Controllers\Account\PostsController::class, 'make_passive'])->name('account-post-make-passive');
    Route::get('/account/post/make-top/{id?}', [App\Http\Controllers\Account\PostsController::class, 'make_top'])->name('account-post-make-top');
    Route::get('/account/post/make-primary/{id?}', [App\Http\Controllers\Account\PostsController::class, 'make_primary'])->name('account-post-make-primary');
    Route::get('/account/post/make-hurry/{id?}', [App\Http\Controllers\Account\PostsController::class, 'make_hurry'])->name('account-post-make-hurry');

    // Messages Sending
    Route::get('/account/messages/{type?}', [App\Http\Controllers\Account\MessagesController::class, 'index'])->name('account-messages');
    Route::get('/account/messages/conversation/{user_id}', [App\Http\Controllers\Account\MessagesController::class, 'conversation'])->name('account-messages-conversation');
    Route::post('/account/messages/send-message/{receiver_id}', [App\Http\Controllers\Account\MessagesController::class, 'send_message'])->name('account-messages-send-message');
    Route::post('/account/messages/update/{message_id}', [App\Http\Controllers\Account\MessagesController::class, 'update'])->name('account-messages-update-message');
    Route::get('/account/messages/destroy/{message_id}', [App\Http\Controllers\Account\MessagesController::class, 'destroy'])->name('account-messages-destroy-message');
//    Route::get('/event',function (){
//        event(new MessageSubmited('asas','5','4'));
//    });

    // Settings Main
//    Route::get('/account/settings', [App\Http\Controllers\Account\SettingsController::class, 'index'])->name('account-settings-main');
    Route::get('/account/settings/profile', [App\Http\Controllers\Account\SettingsController::class, 'index'])->name('account-settings-main');

    // Settings Contacts
    Route::get('/account/settings/contacts', [App\Http\Controllers\Account\SettingsController::class, 'contacts'])->name('account-settings-contacts');

    // Settings Notifications
    Route::get('/account/settings/notifications', [App\Http\Controllers\Account\SettingsController::class, 'notifications'])->name('account-settings-notifications');

    // Settings Blocked Users
    Route::get('/account/settings/blocked-users', [App\Http\Controllers\Account\SettingsController::class, 'blocked_users'])->name('account-settings-blocked-users');
    Route::get('/account/settings/blocked-users/delete/{id?}', [App\Http\Controllers\Account\SettingsController::class, 'delete_blocked_users'])->name('account-settings-blocked-users-delete');

    // Settings Account
    Route::get('/account/settings/account', [App\Http\Controllers\Account\SettingsController::class, 'account'])->name('account-settings-account');
    Route::post('/account/settings/account/change-password', [App\Http\Controllers\Account\SettingsController::class, 'change_password'])->name('account-settings-account-change-password');
    Route::post('/account/settings/account/change-email', [App\Http\Controllers\Account\SettingsController::class, 'change_email'])->name('account-settings-account-change-email');
    Route::post('/account/settings/account/deete', [App\Http\Controllers\Account\SettingsController::class, 'delete_account'])->name('account-settings-delete-account');

    // Wallet
//    Route::get('/account/wallet', [App\Http\Controllers\Account\WalletController::class, 'index'])->name('account-wallet');
    Route::get('/account/wallet/main', [App\Http\Controllers\Account\WalletController::class, 'index'])->name('account-wallet');
    Route::get('/account/wallet/payments', [App\Http\Controllers\Account\WalletController::class, 'payments'])->name('account-wallet-payments');
    Route::get('/account/wallet/operations', [App\Http\Controllers\Account\WalletController::class, 'operations'])->name('account-wallet-operations');

    // Wishlist
    Route::get('/account/wishlist', [App\Http\Controllers\Account\WishlistController::class, 'index'])->name('account-wishlist');
    Route::get('/account/wishlist/posts', [App\Http\Controllers\Account\WishlistController::class, 'index'])->name('account-wishlist-posts');
    Route::get('/account/wishlist/users', [App\Http\Controllers\Account\WishlistController::class, 'users'])->name('account-wishlist-users');
    Route::get('/account/wishlist/searchs', [App\Http\Controllers\Account\WishlistController::class, 'searchs'])->name('account-wishlist-searchs');
    // Create Post
    Route::get('/create', [App\Http\Controllers\CreatePost\IndexController::class, 'type_start'])->name('create-type');
    Route::get('/create-post', [App\Http\Controllers\CreatePost\IndexController::class, 'index'])->name('create-post');
    Route::get('/create-post/spare-store', [App\Http\Controllers\CreatePost\IndexController::class, 'sel_spare_store'])->name('sel-spare-store');
//    Route::get('/create-post/level1', [App\Http\Controllers\CreatePost\IndexController::class, 'index'])->name('create-post-level-1');
    Route::get('/create-post/level2/{category_id}', [App\Http\Controllers\CreatePost\IndexController::class, 'level2'])->name('create-post-level-2');
    Route::get('/create-post/level3/{id}', [App\Http\Controllers\CreatePost\IndexController::class, 'level3'])->name('create-post-level-3');
    Route::get('/create-post/level3-spare/{id}', [App\Http\Controllers\CreatePost\IndexController::class, 'level3_spare'])->name('create-post-level-3-spare');
    Route::get('/create-post/level4/{id}', [App\Http\Controllers\CreatePost\IndexController::class, 'level4'])->name('create-post-level-4');
    Route::post('/create-post/store', [App\Http\Controllers\CreatePost\IndexController::class, 'store'])->name('add-post-store');
    Route::post('/create-post/store-spare', [App\Http\Controllers\CreatePost\IndexController::class, 'store_spare'])->name('add-post-store-spare');
    Route::get('/create-post/destroy/{id}', [App\Http\Controllers\CreatePost\IndexController::class, 'destroy'])->name('add-post-destroy');
    Route::get('/create-post/destroy-image/{id}', [App\Http\Controllers\CreatePost\IndexController::class, 'destroy_image'])->name('add-post-destroy-image');
    Route::post('/create-post/get-modeltype', [App\Http\Controllers\CreatePost\IndexController::class, 'get_model_type'])->name('get.brand.model');
    Route::post('/get-video/{name?}', [App\Http\Controllers\CreatePost\IndexController::class, 'getVideo'])->name('show.video');
    Route::post('/del-video', [App\Http\Controllers\CreatePost\IndexController::class, 'del_Video'])->name('del.video');
    Route::post('/create-signature', [App\Http\Controllers\CreatePost\IndexController::class, 'generate_signature'])->name('cloudinary.signature');
    Route::post('/create-post/delete-failed', [App\Http\Controllers\CreatePost\IndexController::class, 'destroy_failed'])->name('del-failed-post');
    // Log Out
    Route::post('c',function (){

        $video_comand = new \App\Console\Commands\ProcessVideoCommand;
        $video_comand->handle();

    });
    Route::get('log-out', [App\Http\Controllers\Account\SettingsController::class, 'log_out'])->name('account-log-out');

//    Admin Logout
    Route::get('admin/log-out', [App\Http\Controllers\Account\SettingsController::class, 'admin_log_out'])->name('admin-log-out');


    // --------------------- Users -------------------
    Route::get('/user/{id}', [App\Http\Controllers\UsersController::class, 'index'])->name('users');
    Route::post('/check_phone', [App\Http\Controllers\UsersController::class, 'check_phone_num'])->name('check.reg.phone');

    // --------------------- Filter ---------------------
    Route::any('/filter/{category_id?}/{min_price?}/{max_price?}/{location?}/{post_type?}/{auth_type?}/{estate_type?}/{electro_type?}/{search_value?}/{request_type?}', [App\Http\Controllers\ItemController::class, 'filter'])->name('filter');

    Route::any('/filter-spare/{category_id?}/{min_year?}/{max_year?}/{location?}/{brand?}/{model?}/{search_value?}/{request_type?}', [App\Http\Controllers\ItemController::class, 'filter_spare'])->name('filter.spare');

    // ADMIN PANEL
    // Home
    Route::get('/admin/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home-admin-index');

    // Ads
    Route::get('/admin/ads', [App\Http\Controllers\Admin\AdsController::class, 'index'])->name('ads-admin-index');
    Route::get('/admin/ads/show/{id}', [App\Http\Controllers\Admin\AdsController::class, 'show'])->name('ads-admin-show');
    Route::post('/admin/ads/update/{id}', [App\Http\Controllers\Admin\AdsController::class, 'update'])->name('ads-admin-update');
    Route::post('/admin/ads/store', [App\Http\Controllers\Admin\AdsController::class, 'store'])->name('ads-admin-store');
    Route::get('/admin/ads/destroy/{id}', [App\Http\Controllers\Admin\AdsController::class, 'destroy'])->name('ads-admin-destroy');

    // References
    Route::get('/admin/references', [App\Http\Controllers\Admin\ReferencesController::class, 'index'])->name('references-admin-index');
    Route::get('/admin/references/show/{id}', [App\Http\Controllers\Admin\ReferencesController::class, 'show'])->name('references-admin-show');
    Route::post('/admin/references/update/{id}', [App\Http\Controllers\Admin\ReferencesController::class, 'update'])->name('references-admin-update');

    // Terms and Conditions
    Route::get('/admin/terms-and-conditions', [App\Http\Controllers\Admin\TermsAndConditionsController::class, 'index'])->name('terms-and-conditions-admin-index');
    Route::get('/admin/terms-and-conditions/show/{id}', [App\Http\Controllers\Admin\TermsAndConditionsController::class, 'show'])->name('terms-and-conditions-admin-show');
    Route::post('/admin/terms-and-conditions/update/{id}', [App\Http\Controllers\Admin\TermsAndConditionsController::class, 'update'])->name('terms-and-conditions-admin-update');

    // Contact Datas Social Accounts
    Route::get('/admin/social-accounts', [App\Http\Controllers\Admin\SocialAccountsController::class, 'index'])->name('social-accounts-admin-index');
    Route::get('/admin/social-accounts/show/{id}', [App\Http\Controllers\Admin\SocialAccountsController::class, 'show'])->name('social-accounts-admin-show');
    Route::post('/admin/social-accounts/update/{id}', [App\Http\Controllers\Admin\SocialAccountsController::class, 'update'])->name('social-accounts-admin-update');
    Route::post('/admin/social-accounts/store', [App\Http\Controllers\Admin\SocialAccountsController::class, 'store'])->name('social-accounts-admin-store');
    Route::get('/admin/social-accounts/destroy/{id}', [App\Http\Controllers\Admin\SocialAccountsController::class, 'destroy'])->name('social-accounts-admin-destroy');

    // Countries
    Route::get('/admin/countries', [App\Http\Controllers\Admin\CountriesController::class, 'index'])->name('countries-admin-index');
    Route::get('/admin/countries/show/{id}', [App\Http\Controllers\Admin\CountriesController::class, 'show'])->name('countries-admin-show');
    Route::post('/admin/countries/update/{id}', [App\Http\Controllers\Admin\CountriesController::class, 'update'])->name('countries-admin-update');
    Route::post('/admin/countries/store', [App\Http\Controllers\Admin\CountriesController::class, 'store'])->name('countries-admin-store');
    Route::get('/admin/countries/destroy/{id}', [App\Http\Controllers\Admin\CountriesController::class, 'destroy'])->name('countries-admin-destroy');

    // Locations
    Route::get('/admin/locations', [App\Http\Controllers\Admin\LocationsController::class, 'index'])->name('locations-admin-index');
    Route::get('/admin/locations/show/{id}', [App\Http\Controllers\Admin\LocationsController::class, 'show'])->name('locations-admin-show');
    Route::post('/admin/locations/update/{id}', [App\Http\Controllers\Admin\LocationsController::class, 'update'])->name('locations-admin-update');
    Route::post('/admin/locations/store', [App\Http\Controllers\Admin\LocationsController::class, 'store'])->name('locations-admin-store');
    Route::get('/admin/locations/destroy/{id}', [App\Http\Controllers\Admin\LocationsController::class, 'destroy'])->name('locations-admin-destroy');

    // Currencies
    Route::get('/admin/currencies', [App\Http\Controllers\Admin\CurrenciesController::class, 'index'])->name('currencies-admin-index');
    Route::get('/admin/currencies/show/{id}', [App\Http\Controllers\Admin\CurrenciesController::class, 'show'])->name('currencies-admin-show');
    Route::post('/admin/currencies/update/{id}', [App\Http\Controllers\Admin\CurrenciesController::class, 'update'])->name('currencies-admin-update');
    Route::post('/admin/currencies/store', [App\Http\Controllers\Admin\CurrenciesController::class, 'store'])->name('currencies-admin-store');
    Route::get('/admin/currencies/destroy/{id}', [App\Http\Controllers\Admin\CurrenciesController::class, 'destroy'])->name('currencies-admin-destroy');

    // Currency API
    Route::get('/admin/currency-api', [App\Http\Controllers\Admin\CurrencyApiController::class, 'index'])->name('currency-api-admin-index');
    Route::get('/admin/currency-api/show/{id}', [App\Http\Controllers\Admin\CurrencyApiController::class, 'show'])->name('currency-api-admin-show');
    Route::post('/admin/currency-api/update/{id}', [App\Http\Controllers\Admin\CurrencyApiController::class, 'update'])->name('currency-api-admin-update');
    Route::post('/admin/currency-api/store', [App\Http\Controllers\Admin\CurrencyApiController::class, 'store'])->name('currency-api-admin-store');
    Route::get('/admin/currency-api/destroy/{id}', [App\Http\Controllers\Admin\CurrencyApiController::class, 'destroy'])->name('currency-api-admin-destroy');

    // Spate Parts
    Route::get('/admin/spare-parts', [App\Http\Controllers\Admin\SparePartsController::class, 'index'])->name('spare-parts-admin-index');
    Route::get('/admin/spare-parts/show/{id}', [App\Http\Controllers\Admin\SparePartsController::class, 'show'])->name('spare-parts-admin-show');
    Route::post('/admin/spare-parts/update/{id}', [App\Http\Controllers\Admin\SparePartsController::class, 'update'])->name('spare-parts-admin-update');
    Route::post('/admin/spare-parts/store', [App\Http\Controllers\Admin\SparePartsController::class, 'store'])->name('spare-parts-admin-store');
    Route::get('/admin/spare-parts/destroy/{id}', [App\Http\Controllers\Admin\SparePartsController::class, 'destroy'])->name('spare-parts-admin-destroy');

    // Site Data
    Route::get('/admin/site-data', [App\Http\Controllers\Admin\SiteDataController::class, 'index'])->name('site-data-admin-index');
    Route::get('/admin/site-data/show/{id}', [App\Http\Controllers\Admin\SiteDataController::class, 'show'])->name('site-data-admin-show');
    Route::post('/admin/site-data/update/{id}', [App\Http\Controllers\Admin\SiteDataController::class, 'update'])->name('site-data-admin-update');
    Route::post('/admin/site-data/store', [App\Http\Controllers\Admin\SiteDataController::class, 'store'])->name('site-data-admin-store');
    Route::get('/admin/site-data/destroy/{id}', [App\Http\Controllers\Admin\SiteDataController::class, 'destroy'])->name('site-data-admin-destroy');

    // Card Datas
    Route::get('/admin/card-datas', [App\Http\Controllers\Admin\CardDatasController::class, 'index'])->name('card-datas-admin-index');
    Route::get('/admin/card-datas/show/{id}', [App\Http\Controllers\Admin\CardDatasController::class, 'show'])->name('card-datas-admin-show');
    Route::post('/admin/card-datas/update/{id}', [App\Http\Controllers\Admin\CardDatasController::class, 'update'])->name('card-datas-admin-update');
    Route::post('/admin/card-datas/store', [App\Http\Controllers\Admin\CardDatasController::class, 'store'])->name('card-datas-admin-store');
    Route::get('/admin/card-datas/destroy/{id}', [App\Http\Controllers\Admin\CardDatasController::class, 'destroy'])->name('card-datas-admin-destroy');

    // Messages
    Route::get('/admin/messages', [App\Http\Controllers\Admin\MessagesController::class, 'index'])->name('messages-admin-index');
    Route::get('/admin/user-messages', [App\Http\Controllers\Admin\MessagesController::class, 'index2'])->name('user-messages-admin-index');
    Route::get('/admin/messages/show/{id}', [App\Http\Controllers\Admin\MessagesController::class, 'show'])->name('messages-admin-show');
    Route::get('/admin/messages/update/{id}', [App\Http\Controllers\Admin\MessagesController::class, 'update'])->name('messages-admin-update');
    Route::post('/admin/messages/store', [App\Http\Controllers\Admin\MessagesController::class, 'store'])->name('messages-admin-store');
    Route::get('/admin/messages/destroy/{id}', [App\Http\Controllers\Admin\MessagesController::class, 'destroy'])->name('messages-admin-destroy');

    // Notifications
    Route::get('/admin/notifications', [App\Http\Controllers\Admin\NotificationsController::class, 'index'])->name('notifications-admin-index');
    Route::get('/admin/notifications/show/{id}', [App\Http\Controllers\Admin\NotificationsController::class, 'show'])->name('notifications-admin-show');
    Route::post('/admin/notifications/update/{id}', [App\Http\Controllers\Admin\NotificationsController::class, 'update'])->name('notifications-admin-update');
    Route::post('/admin/notifications/store', [App\Http\Controllers\Admin\NotificationsController::class, 'store'])->name('notifications-admin-store');
    Route::get('/admin/notifications/destroy/{id}', [App\Http\Controllers\Admin\NotificationsController::class, 'destroy'])->name('notifications-admin-destroy');

    // User Ratings
    Route::get('/admin/ratings', [App\Http\Controllers\Admin\UserRatingController::class, 'index'])->name('ratings-admin-index');
    // Route::get('/admin/ratings/show/{id}', [App\Http\Controllers\Admin\UserRatingController::class, 'show'])->name('ratings-admin-show');
    // Route::post('/admin/ratings/update/{id}', [App\Http\Controllers\Admin\UserRatingController::class, 'update'])->name('ratings-admin-update');
    // Route::post('/admin/ratings/store', [App\Http\Controllers\Admin\UserRatingController::class, 'store'])->name('ratings-admin-store');
    // Route::get('/admin/ratings/destroy/{id}', [App\Http\Controllers\Admin\UserRatingController::class, 'destroy'])->name('ratings-admin-destroy');

    // Blocked Users
    Route::get('/admin/blocked-users', [App\Http\Controllers\Admin\BlockedUserController::class, 'index'])->name('blocked-users-admin-index');
    // Route::get('/admin/blocked-users/show/{id}', [App\Http\Controllers\Admin\BlockedUserController::class, 'show'])->name('blocked-users-admin-show');
    // Route::post('/admin/blocked-users/update/{id}', [App\Http\Controllers\Admin\BlockedUserController::class, 'update'])->name('blocked-users-admin-update');
    // Route::post('/admin/blocked-users/store', [App\Http\Controllers\Admin\BlockedUserController::class, 'store'])->name('blocked-users-admin-store');
    Route::get('/admin/blocked-users/destroy/{id}', [App\Http\Controllers\Admin\BlockedUserController::class, 'destroy'])->name('blocked-users-admin-destroy');

    // Wish List
    Route::get('/admin/wishlist/users', [App\Http\Controllers\Admin\WishedController::class, 'index_users'])->name('wishlist-users-admin-index');
    Route::get('/admin/wishlist/postes', [App\Http\Controllers\Admin\WishedController::class, 'index_posts'])->name('wishlist-posts-admin-index');
    Route::get('/admin/wishlist/searches', [App\Http\Controllers\Admin\WishedController::class, 'index_searches'])->name('wishlist-searches-admin-index');
    Route::get('/admin/wishlist/users/destroy/{id}', [App\Http\Controllers\Admin\WishedController::class, 'destroy_user'])->name('wishlist-users-admin-destroy');
    Route::get('/admin/wishlist/posts/destroy/{id}', [App\Http\Controllers\Admin\WishedController::class, 'destroy_post'])->name('wishlist-posts-admin-destroy');
    Route::get('/admin/wishlist/searches/destroy/{id}', [App\Http\Controllers\Admin\WishedController::class, 'destroy_search'])->name('wishlist-searches-admin-destroy');

    // Wish List
    Route::get('/admin/posts', [App\Http\Controllers\Admin\PostController::class, 'index_posts'])->name('post-admin-index');
    Route::get('/admin/posts/images', [App\Http\Controllers\Admin\PostController::class, 'index_post_images'])->name('post-images-admin-index');
    Route::get('/admin/posts/options', [App\Http\Controllers\Admin\PostController::class, 'index_post_options'])->name('post-options-admin-index');
    Route::get('/admin/posts/reports', [App\Http\Controllers\Admin\PostController::class, 'index_post_reports'])->name('post-reports-admin-index');
    Route::get('/admin/posts/destroy/{id}', [App\Http\Controllers\Admin\PostController::class, 'admin_destroy_posts'])->name('posts-admin-destroy');
    Route::get('/admin/posts/images/destroy/{id}', [App\Http\Controllers\Admin\PostController::class, 'admin_destroy_post_images'])->name('posts-images-admin-destroy');
    Route::get('/admin/posts/options/destroy/{id}', [App\Http\Controllers\Admin\PostController::class, 'admin_destroy_post_options'])->name('posts-options-admin-destroy');
    Route::get('/admin/posts/reports/destroy/{id}', [App\Http\Controllers\Admin\PostController::class, 'admin_destroy_post_reports'])->name('posts-reports-admin-destroy');
    Route::get('/admin/posts/hurry/{id}', [App\Http\Controllers\Admin\PostController::class, 'admin_hurry_posts'])->name('posts-hurry-admin-update');
    Route::get('/admin/posts/top/{id}', [App\Http\Controllers\Admin\PostController::class, 'admin_top_post'])->name('posts-top-admin-update');
    Route::get('/admin/posts/active/{id}', [App\Http\Controllers\Admin\PostController::class, 'admin_active_post'])->name('posts-active-admin-update');


    // Filters
    Route::get('/admin/filters/categories', [App\Http\Controllers\Admin\FiltersController::class, 'index_categories'])->name('filters-admin-index');
    Route::get('/admin/filters/categories/show/{id}', [App\Http\Controllers\Admin\FiltersController::class, 'show_categories'])->name('filters-categories-admin-show');
    // Route::get('/admin/filters', [App\Http\Controllers\Admin\FiltersController::class, 'update'])->name('menu-admin-update');
    // Route::post('/admin/filters', [App\Http\Controllers\Admin\FiltersController::class, 'store'])->name('menu-admin-store');
    Route::get('/admin/filters/categories/destroy/{id}', [App\Http\Controllers\Admin\FiltersController::class, 'destroy_categories'])->name('filters-categories-admin-destroy');

    // Menu
    Route::get('/admin/menu', [App\Http\Controllers\Admin\MenuController::class, 'index'])->name('menu-admin-index');
    Route::get('/admin/menu/show/{id}', [App\Http\Controllers\Admin\MenuController::class, 'show'])->name('menu-admin-show');
    Route::get('/admin/menu/update/{id}', [App\Http\Controllers\Admin\MenuController::class, 'update'])->name('menu-admin-update');
    Route::post('/admin/menu/store', [App\Http\Controllers\Admin\MenuController::class, 'store'])->name('menu-admin-store');
    Route::get('/admin/menu/destroy/{id}', [App\Http\Controllers\Admin\MenuController::class, 'destroy'])->name('menu-admin-destroy');

    // Slider
    Route::get('/admin/slider', [App\Http\Controllers\Admin\SliderController::class, 'index'])->name('slider-admin-index');
    Route::get('/admin/slider/show/{id}', [App\Http\Controllers\Admin\SliderController::class, 'show'])->name('slider-admin-show');
    Route::post('/admin/slider/update/{id}', [App\Http\Controllers\Admin\SliderController::class, 'update'])->name('slider-admin-update');
    Route::post('/admin/slider/store', [App\Http\Controllers\Admin\SliderController::class, 'store'])->name('slider-admin-store');
    Route::get('/admin/slider/destroy/{id}', [App\Http\Controllers\Admin\SliderController::class, 'destroy'])->name('slider-admin-destroy');

    // Privacy Policy
    Route::get('/admin/privacy-policy', [App\Http\Controllers\Admin\PrivacyPolicyController::class, 'index'])->name('privacy-policy-admin-index');
    Route::get('/admin/privacy-policy/show/{id}', [App\Http\Controllers\Admin\PrivacyPolicyController::class, 'show'])->name('privacy-policy-admin-show');
    Route::post('/admin/privacy-policy/update/{id}', [App\Http\Controllers\Admin\PrivacyPolicyController::class, 'update'])->name('privacy-policy-admin-update');
    Route::post('/admin/privacy-policy/store', [App\Http\Controllers\Admin\PrivacyPolicyController::class, 'store'])->name('privacy-policy-admin-store');
    Route::get('/admin/privacy-policy/destroy/{id}', [App\Http\Controllers\Admin\PrivacyPolicyController::class, 'destroy'])->name('privacy-policy-admin-destroy');

    // Translations
    Route::get('/admin/translations', [App\Http\Controllers\Admin\TranslationsController::class, 'index'])->name('translations-admin-index');
    Route::get('/admin/translations/show/{id}', [App\Http\Controllers\Admin\TranslationsController::class, 'show'])->name('translations-admin-show');
    Route::post('/admin/translations/update/{id}', [App\Http\Controllers\Admin\TranslationsController::class, 'update'])->name('translations-admin-update');
    Route::post('/admin/translations/store', [App\Http\Controllers\Admin\TranslationsController::class, 'store'])->name('translations-admin-store');
    Route::get('/admin/translations/destroy/{id}', [App\Http\Controllers\Admin\TranslationsController::class, 'destroy'])->name('translations-admin-destroy');

    // SEO
    Route::get('/admin/seo', [App\Http\Controllers\Admin\SeoController::class, 'index'])->name('seo-admin-index');
    Route::get('/admin/seo/show/{id}', [App\Http\Controllers\Admin\SeoController::class, 'show'])->name('seo-admin-show');
    Route::post('/admin/seo/update/{id}', [App\Http\Controllers\Admin\SeoController::class, 'update'])->name('seo-admin-update');
    Route::post('/admin/seo/store', [App\Http\Controllers\Admin\SeoController::class, 'store'])->name('seo-admin-store');
    Route::get('/admin/seo/destroy/{id}', [App\Http\Controllers\Admin\SeoController::class, 'destroy'])->name('seo-admin-destroy');

    // Site Datas
    Route::get('/admin/site-data', [App\Http\Controllers\Admin\SiteDataController::class, 'index'])->name('site-data-admin-index');
    Route::get('/admin/site-data/show/{id}', [App\Http\Controllers\Admin\SiteDataController::class, 'show'])->name('site-data-admin-show');
    Route::post('/admin/site-data/update/{id}', [App\Http\Controllers\Admin\SiteDataController::class, 'update'])->name('site-data-admin-update');
    Route::post('/admin/site-data/store', [App\Http\Controllers\Admin\SiteDataController::class, 'store'])->name('site-data-admin-store');
    Route::get('/admin/site-data/destroy/{id}', [App\Http\Controllers\Admin\SiteDataController::class, 'destroy'])->name('site-data-admin-destroy');

    // Users
    Route::get('/admin/users', [App\Http\Controllers\Admin\UsersController::class, 'index'])->name('users-admin-index');
    Route::get('/admin/users/show/{id}', [App\Http\Controllers\Admin\UsersController::class, 'show'])->name('users-admin-show');
    Route::post('/admin/users/update/{id}', [App\Http\Controllers\Admin\UsersController::class, 'update'])->name('users-admin-update');
    Route::post('/admin/users/update-password/{id}', [App\Http\Controllers\Admin\UsersController::class, 'update_password'])->name('users-admin-update-password');
    Route::post('/admin/users/store', [App\Http\Controllers\Admin\UsersController::class, 'store'])->name('users-admin-store');
    Route::get('/admin/users/destroy/{id}', [App\Http\Controllers\Admin\UsersController::class, 'destroy'])->name('users-admin-destroy');

    // Locations
    Route::get('/admin/locations', [App\Http\Controllers\Admin\LocationsController::class, 'index'])->name('locations-admin-index');
    Route::get('/admin/locations/show/{id}', [App\Http\Controllers\Admin\LocationsController::class, 'show'])->name('locations-admin-show');
    Route::post('/admin/locations/update/{id}', [App\Http\Controllers\Admin\LocationsController::class, 'update'])->name('locations-admin-update');
    Route::post('/admin/locations/store', [App\Http\Controllers\Admin\LocationsController::class, 'store'])->name('locations-admin-store');
    Route::get('/admin/locations/destroy/{id}', [App\Http\Controllers\Admin\LocationsController::class, 'destroy'])->name('locations-admin-destroy');

    // Currrencies
    Route::get('/admin/currencies', [App\Http\Controllers\Admin\CurrenciesController::class, 'index'])->name('currencies-admin-index');
    Route::get('/admin/currencies/show/{id}', [App\Http\Controllers\Admin\CurrenciesController::class, 'show'])->name('currencies-admin-show');
    Route::post('/admin/currencies/update/{id}', [App\Http\Controllers\Admin\CurrenciesController::class, 'update'])->name('currencies-admin-update');
    Route::post('/admin/currencies/store', [App\Http\Controllers\Admin\CurrenciesController::class, 'store'])->name('currencies-admin-store');
    Route::get('/admin/currencies/destroy/{id}', [App\Http\Controllers\Admin\CurrenciesController::class, 'destroy'])->name('currencies-admin-destroy');

    // Products
    Route::get('/admin/products', [App\Http\Controllers\Admin\ProductsController::class, 'index'])->name('products-admin-index');
    Route::get('/admin/products/create', [App\Http\Controllers\Admin\ProductsController::class, 'create'])->name('products-admin-create');
    Route::get('/admin/products/show/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'show'])->name('products-admin-show');
    Route::post('/admin/products/update/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'update'])->name('products-admin-update');
    Route::post('/admin/products/update-image/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'update_image'])->name('products-admin-update-image');
    Route::post('/admin/products/update-embed/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'update_embed'])->name('products-admin-update-embed');
    Route::post('/admin/products/update-option/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'update_option'])->name('products-admin-update-option');
    Route::post('/admin/products/update-category/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'update_category'])->name('products-admin-update-category');
    Route::post('/admin/products/store', [App\Http\Controllers\Admin\ProductsController::class, 'store'])->name('products-admin-store');
    Route::post('/admin/products/store-option', [App\Http\Controllers\Admin\ProductsController::class, 'store_option'])->name('products-admin-store-option');
    Route::post('/admin/products/store-category/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'store_category'])->name('products-admin-store-category');
    Route::get('/admin/products/destroy/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'destroy'])->name('products-admin-destroy');
    Route::get('/admin/products/destroy-image/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'destroy_image'])->name('products-admin-destroy-image');
    Route::get('/admin/products/destroy-embed/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'destroy_embed'])->name('products-admin-destroy-embed');
    Route::get('/admin/products/destroy-option/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'destroy_option'])->name('products-admin-destroy-option');
    Route::get('/admin/products/destroy-category/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'destroy_category'])->name('products-admin-destroy-category');

    // Profile
    Route::get('/admin/profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile-admin-index');
    Route::get('/admin/profile/show/{id}', [App\Http\Controllers\Admin\ProfileController::class, 'show'])->name('profile-admin-show');
    Route::post('/admin/profile/update', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile-admin-update');
    Route::post('/admin/profile/update-img', [App\Http\Controllers\Admin\ProfileController::class, 'update_img'])->name('profile-admin-update-img');
    Route::post('/admin/profile/store', [App\Http\Controllers\Admin\ProfileController::class, 'store'])->name('profile-admin-store');
    Route::get('/admin/profile/destroy', [App\Http\Controllers\Admin\ProfileController::class, 'destroy'])->name('profile-admin-destroy');
});
