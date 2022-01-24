<!-- Theme Color -->
<meta name="theme-color" content="#FFFFFF">
    
<!-- Alternate Links -->
<link rel="alternate" hreflang="en" href="{{ route('home', ['locale' => 'en']) }}">
<link rel="alternate" hreflang="ru" href="{{ route('home', ['locale' => 'ru']) }}">
<link rel="alternate" hreflang="hy" href="{{ route('home', ['locale' => 'hy']) }}">

<!-- Browser Bots -->
<meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
<meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">

<!-- Robots -->
<meta name="robots" content="index, follow">

<!-- Canonical -->
<link rel="canonical" href="{{ route('home', ['locale' => app()->getLocale()]) }}">

<!-- Open Graph Localization -->
<meta property="og:locale" content="{{app()->getLocale()}}_{{strtoupper(app()->getLocale())}}">

<!-- Google Verafication -->
<meta name="google-site-verification" content="{{__('GooleVerafication')}}">
    
<!-- Yandex Verafication -->
<meta name="yandex-verification" content="{{__('GooleVerafication')}}">

<!-- Open Graph Sitename -->
<meta property="og:site_name" content="Yerevan.vip - Yerevan.vip">

<!-- Open Graph Page Url -->
<meta property="og:url" content="\Request::url()">

<!-- Check page type -->
@if(\Request::route()->getName() == 'home')
    <meta property="og:type" content="website">
@else 
    <meta property="og:type" content="article">
@endif

@if(isset($seo) && $seo != null)
    <!-- Page Title -->
    <title>{{ $seo->{'title_'.app()->getLocale()} }}</title>

    <!-- Open Graph Page Title -->
    <meta property="og:title" content="{{ $seo->{'title_'.app()->getLocale()} }}">

    <!-- Description -->
    <meta name="description" content="{{ html_entity_decode(strip_tags($seo->{'description_'.app()->getLocale()})) }}">

    <!-- Open Graph Page Description -->
    <meta property="og:description" content="{{ html_entity_decode(strip_tags($seo->{'description_'.app()->getLocale()})) }}">

    <!-- Open Graph Image -->
    <meta property="og:image" content="{{ asset($assets_path.'/img/seo/'.$seo->img) }}">

    <!-- Open Graph Image Sizes -->
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="800">
@endif