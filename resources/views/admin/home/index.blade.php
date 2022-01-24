@extends('admin.layouts.app')

@section('content')
{{--    @dd(Auth::check())--}}
    <h2 class="w-100 d-block text-center">Hello {{ Auth::user()->first_name.' '.Auth::user()->last_name }} 🖐</h2>
@endsection
