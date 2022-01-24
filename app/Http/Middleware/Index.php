<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Currency;
use App\SocialAccount;
use App\CurrencyApi;
use App\SiteData;
use App\Seo;
use App\ChatUserMessage;
use App\Category;
use App\Post;
use App\Location;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class Index
{
    // Allowed localizations
    public static $localizations = ['hy', 'en', 'ru'];

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        dump(Route::getRoutes()->match(
//            Request::create(URL::previous())
//        )->getName());
//        dump(Route::currentRouteName());
        // Admin validation
        if ($request->segment(2) == 'admin' && Auth::user()->role != 'admin') {
            // Redirect to home
            return redirect()->route('home', ['locale' => app()->getLocale()]);
        }

        // Admin validation
        if ($request->segment(2) != 'admin' && Auth::check() && Auth::user()->role == 'admin') {
            // Redirect to home
            return redirect()->route('home-admin-index', ['locale' => app()->getLocale()]);
        }

        // Check user role
        if (Auth::check() && Auth::user()->role == 'admin' && $request->segment(2) == 'admin') {

            // Make data
            $data = array(
                'assets_path' => '/assets',
                'image_path' => '/assets/img',
            );

            // Make request
            $request->data = $data;

            // Send data to controller
            return $next($request);
        } else {

            // Check localization
            if (!in_array($request->segment(1), self::$localizations)) { // Wrong localization
                // Redirect home with current localization
                return redirect()->route('home', ['locale' => app()->getLocale()]);
            } else {
                // Set locaization
                app()->setLocale($request->segment(1));
            }

            // Check auth confirmation in auth pages
            if (Auth::check() && Auth::user()->confirm != 1 && $request->segment(2) == 'account' && $request->segment(3) != NULL && $request->segment(3) != 'resend-email' && $request->segment(3) != 'verify' && $request->segment(3) != 'log-out') {
                // Redirect to confirmstion page
                return redirect()->route('account', ['locale' => app()->getLocale()]);
            }

            // Currency
            if ($request->session()->has('currency') && $request->session()->get('currency') != null) { // Already isset
                // Get currency session
                $request->session()->get('currency');
            } else { // Not isset yet
                // Make currency session
                $request->session()->put('currency', 'amd');
            }

            // Check currency reuqest
            if ($request->has('set_currency') && $request->set_currency != null) {
                // Set currency
                $request->session()->put('currency', $request->set_currency);
            }

            // Get currency data
            $currency = Currency::where('type', $request->session()->get('currency'))->first();

            // Get all currencies data
            $currencies = Currency::orderBy('id', 'desc')->get();

            // Get seo data
            $seo = Seo::where('route', $request->route()->getName())->first();

            // Check currency data
            if (!isset($currency) || $currency == null) {
                // Currency array
                $currency = array(
                    'name_en' => translating('amd-en'),
                    'name_ru' => translating('amd-ru'),
                    'name_hy' => translating('amd-hy'),
                    'simbol' => translating('amd-simbol'),
                    'type' => 'amd',
                    'value' => 1,
                );

                // Currencies array similar to crrency array
                $currencies = $currency;
            }

            // Get social accounts
            $social_accounts = SocialAccount::orderBy('position_id', 'asc')->get();

            // Get site main data
            $site_data = SiteData::first();

            // Check data
            if ($request->segment(2) != 'create-post' && $request->session()->has('post_creating_start')) {
                // Make session
                $request->session()->forget('post_creating_start');
            }

            // Get api data
            $api_data = CurrencyApi::first();

            // Auth check
            if (Auth::check()) {
                // Get unreaded messages
                $user_unreaded_messages_count = ChatUserMessage::where(['receiver_id' => Auth::user()->id, 'seen_status' => 0])->count();

                // Get unrededed alerts
                $user_unreaded_alerts = ChatUserMessage::with(['sender', 'message'])->where(['receiver_id' => Auth::user()->id, 'seen_status' => 0])->orderBy('id', 'desc')->limit(3)->get();
            } else {
                $user_unreaded_messages_count = 0;
                $user_unreaded_alerts = NULL;
            }

            // Get categories
            $categories = $this->getCategoriesByParentID();
            $add_post_categories = $this->getCategoriesAdding();
            $all_type_category = Category::where('header_position',1)->first();
            // Header catrgories
            $header_categories = Category::whereIn('top', [1, 2])->where('header_position', '!=', null)->orderBy("header_position", 'asc')->limit(5)->get();

            // Check filter data
            if (!$request->session()->has('filter_category_id') || $request->session()->get('filter_category_id') == NULL) {
                // Check page
                if ($request->segment(2) == 'category' && $request->segment(3) != NULL) {
                    $request->session()->put('filter_category_id', $request->segment(3));
                }
            } else {
                $request->session()->put('filter_category_id', $request->segment(3));
            }

            if (!$request->session()->has('filter_min_price') || $request->session()->get('filter_min_price') == NULL) {
                $request->session()->put('filter_min_price', 0);
            }

            if (!$request->session()->has('filter_max_price') || $request->session()->get('filter_max_price') == NULL) {
                // Get data
                $post_price = Post::orderBy('price', 'desc')->first();

                // Check data
                if (isset($post_price->price) && $post_price->price != NULl) { // OK
                    $request->session()->put('filter_max_price', $post_price->price);
                } else { // Data not found
                    $request->session()->put('filter_max_price', 0);
                }
            }

            if (!$request->session()->has('filter_location')) {
                $request->session()->put('filter_location', 'default');
            }

            if (!$request->session()->has('filter_post_type')) {
                $request->session()->put('filter_post_type', 'default');
            }

            if (!$request->session()->has('filter_auth_type')) {
                $request->session()->put('filter_auth_type', 'default');
            }

            // $request->session()->forget('filter_category_id');
            // $request->session()->forget('filter_min_price');
            // $request->session()->forget('filter_max_price');
            // $request->session()->forget('filter_location');
            // $request->session()->forget('filter_post_type');
            // $request->session()->forget('filter_auth_type');
            // $request->session()->save();

            // Get maximum price value
            $max_price_value = Post::orderBy('price', 'desc')->first('price');

            // Chekc data
            if (isset($max_price_value->price) && $max_price_value->price != NULl) { // Ok
                $max_price_value = $max_price_value->price;
            } else { // Data not founf
                $max_price_value = 0;
            }

            // Make data
            $data = array(
                'locale' => app()->getLocale(),
                'currency' => $currency,
                'currencies' => $currencies,
                'social_accounts' => $social_accounts,
                'seo' => $seo,
                'site_data' => $site_data,
                'user_unreaded_messages_count' => $user_unreaded_messages_count,
                'categories' => $categories,
                'user_unreaded_alerts' => $user_unreaded_alerts,
                'header_categories' => $header_categories,
                'max_price_value' => $max_price_value,
                'api_data' => $api_data,
                'assets_path' => '/assets',
                'add_post_categories' => $add_post_categories,
                'all_type_category' => $all_type_category,
            );

            // Make request
            $request->data = $data;

            // Check last currency api update datetime
            if (strtotime('now') - strtotime($api_data->updated_at) < strtotime('+1 day')) {
                // Curl start
                $ch = curl_init();

                // Sndrequest to api
                curl_setopt($ch, CURLOPT_URL, "http://api.exchangeratesapi.io/v1/latest?access_key=a9d6bab40815a42cf8f7ca17e52a1a4b");
                curl_setopt($ch, CURLOPT_POST, 1);

                // Receive server response ...
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                // Get output
                $server_output = curl_exec($ch);

                // Decode output
                $server_output = json_decode($server_output);

                // Close curl
                curl_close($ch);

                // Check data
                if ($server_output != '' && $server_output != NULL && isset($server_output->rates) && $server_output->rates != NULL) {
                    // Make data
                    $currency_api = CurrencyApi::first();
                    $currency_api->amd = $server_output->rates->AMD;
                    $currency_api->usd = $server_output->rates->USD;
                    $currency_api->eur = $server_output->rates->EUR;
                    $currency_api->rub = $server_output->rates->RUB;

                    // Save data
                    $currency_api->save();
                }
            }

            // Send data to controller
            return $next($request);
        }
    }

    private function getCategoriesByParentID($parentID = 0)
    {
        // Get categories which parent id = $parentID
        $categories = Category::where('parent_id', $parentID)->orderBy('position_id', 'asc')->get()->toArray();

        // Loop from categories
        foreach ($categories as &$category) {
            // Geyt item
            $category['children'] = $this->getCategoriesByParentID($category['id']);
        }

        // Return full menu
        return $categories;
    }

    private function getCategoriesAdding($parentID = 73)
    {
        // Get categories which parent id = $parentID
        $add_post_categories = Category::where('parent_id', $parentID)
            ->where(function ($q) {
                $q->from('categories')
                    ->whereNotIn('header_position', ['4'])
                    ->orWhere('header_position', '=', null);
            })
            ->get()->toArray();

        foreach ($add_post_categories as &$category) {
            // Geyt item

            $category['children'] = $this->getCategoriesByParentID($category['id']);

        }
        // Return full menu
        return $add_post_categories;
    }
}
