@extends('layouts.app')

@section('content')
    {{--    @dd(Auth::check())--}}
{{--    <div class="container-fluid">--}}
        <!-- Main Slider -->


    <!-- Top Categories -->
    @include('components.home.top-categories')
{{--    @dd($categories)--}}
    <!-- Main Posts -->
    @include('components.home.main-posts')

    <!-- Break -->
    @include('components.home.break')

    <!-- Services -->
    @include('components.home.services')

    <!-- Hurry Posts -->
    @include('components.home.hurry')

    <!-- Posts -->
        @include('components.home.posts')
{{--        <hr/>--}}

        <!-- Spare Parts -->
{{--        @include('components.home.spare-parts-slider')--}}

{{--    </div>--}}


@endsection

