<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Special Charset -->
    <meta charset="utf-8">
{{--    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">--}}
{{--    <link href='http://fonts.googleapis.com/css?family=Give+You+Glory&v2' rel='stylesheet' type='text/css'>--}}
{{--    <link href='http://fonts.googleapis.com/css?family=Wallpoet&v2' rel='stylesheet' type='text/css'>--}}
{{--    <link href='http://fonts.googleapis.com/css?family=Love+Ya+Like+A+Sister&v2' rel='stylesheet' type='text/css'>--}}
{{--    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro&v2' rel='stylesheet' type='text/css'>--}}
<!-- Responsive Design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Seo Optimization -->
@include('layouts.seo')
{{-- Pusher Code Start--}}
{{--    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>--}}
{{--    <script>--}}
{{--        // Pusher.logToConsole = true;--}}
{{--        // window.Echo.channel(`my-channel`)--}}
{{--        //     .listen('.my-event', (e) => {--}}
{{--        //         alert();--}}
{{--        //         console.log('ashxati ara');--}}
{{--        //     });--}}
{{--        // Enable pusher logging - don't include this in production--}}
{{--        Pusher.logToConsole = true;--}}
{{--        var pusher = new Pusher('2613f9e3161869dd2b76', {--}}
{{--            cluster: 'ap2'--}}
{{--        });--}}
{{--        var channel = pusher.subscribe('my-channel');--}}
{{--        channel.bind('my-event', function (data) {--}}
{{--            console.log('ashxati ara');--}}
{{--            alert(JSON.stringify(data));--}}
{{--        });--}}
{{--    </script>--}}
{{-- Pusher Code End--}}
<!-- Lazy Loading -->
    <script defer src="{{ asset($assets_path.'/js/jquery.lazy.min.js') }}"></script>

    <!-- Axios -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>

    <!-- Jquery -->
    <script src="{{ asset($assets_path.'/js/jquery.min.js') }}"></script>

    <!-- Pusher  -->
{{--    <script src="https://js.pusher.com/4.3/pusher.min.js"></script>--}}
{{--    <script src="https://js.pusher.com/4.2.2/pusher.min.js"></script>--}}
{{--    <script src="https://js.pusher.com/7.0.3/pusher.min.js"></script>--}}
<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset($assets_path.'/fontawesome/css/all.min.css') }}">

    <script src="https://fortawesome.github.io/Font-Awesome/get-started/"></script>

    <!-- Styles -->
    <link href="{{ asset($assets_path.'/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset($assets_path.'/css/main.css') }}" rel="stylesheet">

    <!-- Slick Slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset($assets_path.'/slick/slick.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset($assets_path.'/slick/slick-theme.css') }}"/>
    <script type="text/javascript" src="{{ asset($assets_path.'/slick/slick.min.js') }}" defer></script>

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset($assets_path.'/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset($assets_path.'/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset($assets_path.'/img/favicons/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
          href="{{ asset($assets_path.'/img/favicons/android-chrome-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
          href="{{ asset($assets_path.'/img/favicons/android-chrome-512x512.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset($assets_path.'/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/ico" sizes="16x16" href="{{ asset($assets_path.'/img/favicons/favicon.ico') }}">
    {!! NoCaptcha::renderJs() !!}

    <style type="text/css">
        body {
            font-family: sans-serif;
            font-family: 'Source Sans Pro';
        }

        p, h1 {
            font-size: 2em;
            background: #eee;
            padding: 1em;
            font-family: 'Source Sans Pro';
        }


    </style>
</head>
<body data-get-window-size="{{ route('get-window-width', ['locale' => app()->getLocale(), 'size' => '0']) }}">
<!-- Advertisement(Գովազդ) -->

{{--@if(\Request::route()->getName() == 'category' || \Request::route()->getName() == 'filter')--}}

{{--    @include('components.home.slider')--}}

{{--@endif--}}

<!-- Loader -->
@include('layouts.loader')
<!-- Header -->
@if(\Request::route()->getName() != 'create-post-level-3' && \Request::route()->getName() != 'create-post-level-3-spare')
    @include('layouts.header')
@endif

@if(\Request::route()->getName() == 'home' || \Request::route()->getName() == 'category' || \Request::route()->getName() == 'filter' || \Request::route()->getName() == 'filter.spare' || \Request::route()->getName() == 'search.global')

    <!-- Home Page -->
    @include('components.home.slider')

@endif


<!-- Content -->
<main>
    @if(Auth::check())
        <input type="hidden" id="auth_id" value="{{ Auth::user()->id }}">
    @endif
    <div class="container-fluid">
        @yield('content')

    </div>

</main>

<!-- Footer -->
@include('layouts.footer')

<!-- Responses -->
{{--@include('layouts.response-alerts')--}}

<!-- Modals -->
{{--@include('components.modals.log-in')--}}

<!-- Alerts -->
{{--@include('layouts.alerts')--}}

<!-- Scripts -->
<script src="{{ asset($assets_path.'/fontawesome/js/all.min.js') }}"></script>
<script src="{{ asset($assets_path.'/js/main.js') }}"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>

<!-- Sweet Alert 2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- Pagination Handler -->
<script src="{{ asset($assets_path.'/js/pagination.js')}}"></script>

<!-- Special Scripts -->
@if(\Request::route()->getName() == 'contacts')
    <!-- Contacts Page -->
    <script src="{{ asset($assets_path.'/js/pages/contacts.js')}}"></script>
@endif

{{--    || \Request::route()->getName() == 'category' || \Request::route()->getName() == 'filter'--}}
@if(\Request::route()->getName() == 'home')
    <!-- Home Page -->

    <script src="{{ asset($assets_path.'/js/pages/home.js')}}" defer></script>

@endif

@if(\Request::route()->getName() == 'items' && \Request::segment(2) != NULL)
    <!-- Detail Page -->
    <script src="{{ asset($assets_path.'/js/pages/detail.js')}}" defer></script>
@endif

@if(\Request::route()->getName() == 'category' && \Request::segment(2) != NULL || \Request::route()->getName() == 'top-posts' || \Request::route()->getName() == 'search.global' || \Request::route()->getName() == 'filter.spare' || \Request::route()->getName() == 'filter' || \Request::route()->getName() == 'items')
    <!-- List Page -->
    <script src="{{ asset($assets_path.'/js/pages/list.js')}}" defer></script>
@endif

@if(\Request::segment(2) == 'account')
    <!-- List Page -->
    <script src="{{ asset($assets_path.'/js/pages/account.js')}}"></script>
@endif

@if(\Request::segment(2) == 'user' && \Request::segment(3) != NULL)
    <!-- User Page -->
    <script src="{{ asset($assets_path.'/js/pages/users.js')}}"></script>
@endif

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- CK Editor -->
<script src="{{ asset($assets_path.'/ckeditor/ckeditor.js') }}"></script>

@if(\Request::segment(2) == 'create-post' || \Request::segment(2) == 'create')
    <!-- Create Post -->
    @routes
    <script type="module" src="{{ asset($assets_path.'/js/pages/create.js') }}" defer></script>
@endif

@if(\Request::segment(4) == 'edit')
    @routes
    <script type="module" src="{{ asset($assets_path.'/js/pages/create.js') }}" async></script>
@endif
@if(\Request::segment(2) == 'spare-parts')
    <!-- Create Post -->
    <script src="{{ asset($assets_path.'/js/pages/spare-parts.js') }}" defer></script>
@endif
<!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-database.js"></script>
{{--<script>--}}

{{--</script>--}}
<script src="{{ asset($assets_path.'/js/app.js') }}"></script>
{{--<script>--}}
{{--console.log(window.Echo)--}}
{{--    Pusher.logToConsole = true;--}}
{{--    window.Echo.channel('my-channel')--}}
{{--        .listen('.submited', (e) => {--}}
{{--            alert();--}}
{{--            console.log(e,'ashxatav');--}}
{{--        });--}}

{{--</script>--}}


{{--<script>--}}
{{--// var firebaseConfig = {--}}
{{--// apiKey: "AIzaSyB2F0JXi2fG2MW4yQXm-7QIpUirBIKQeQE",--}}
{{--// authDomain: "erevanvip-cf4d7.firebaseapp.com",--}}
{{--// // databaseURL: "https://erevanvip-cf4d7.firebaseio.com",--}}
{{--// databaseURL: "https://erevanvip-cf4d7-default-rtdb.firebaseio.com",--}}
{{--// projectId: "erevanvip-cf4d7",--}}
{{--// storageBucket: "erevanvip-cf4d7.appspot.com",--}}
{{--// messagingSenderId: "1062240295341",--}}
{{--// appId: "1:1062240295341:web:3b513d4f0846329a5b6924"--}}
{{--// };--}}
{{--// firebase.initializeApp(firebaseConfig);--}}

{{--</script>--}}
{{-- End Firebase Initialization--}}

<!-- CKEditor Initialization -->
<script>
    CKEDITOR.config.allowedContent = true;
    $("*[data-description='true']").each(function () {
        CKEDITOR.replace(this, {
            height: 100,
        });
        var self = $(this);
        $(this).parents('form').submit(function (e) {
            self.html(CKEDITOR.instances[self.attr('name')].gletData());
        });
    });
</script>
</body>
</html>
