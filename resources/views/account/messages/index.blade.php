@extends('account.index')

@section('account-content')
    <!-- Load Content -->
    <div class="load-content">
        <!-- Get content data -->
        @include('account.messages.content')

        <!-- Get textarea data -->
        @include('account.messages.textarea')
    </div>
@endsection