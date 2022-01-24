@extends('account.index')

@section('account-content')
    <!-- Load Content -->
    <div class="load-content">
        <!-- Get content data -->
        @include('account.wishlist.content')
    </div>
@endsection