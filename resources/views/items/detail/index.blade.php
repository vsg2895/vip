@extends('layouts.app')

@section('content')
    <div class="app-container detail-container my-5">
        <div class="row">
            <!-- Left Content -->
            <div class="mt-3 p-5-responsive detail-top-padd bg-white mb-5 col-lg-8">
                @include('items.detail.left')
            </div>

            <!-- Right sidebar -->
            <div class="mt-3 p-3 p-3 bg-white mb-5 col-lg-3 offset-lg-1 right-detail-sidebar">
                @include('items.detail.right')
            </div>
        </div>
    </div>
@endsection
