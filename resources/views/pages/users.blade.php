@extends('layouts.app')

@section('content')
    <!-- Page Content -->
    <div class="app-container mt-150 py-3">
        <div class="row">
           <!-- Main content -->
           <div class="col-lg-8 col-md-12 p-4 pl-5 pr-5 bg-white mb-5">
                <!-- Load Content -->
                <div class="load-content">
                    <!-- Check data -->
                    @if(isset($posts) && count($posts) > 0)
                        <!-- Loop from posts -->
                        @foreach($posts as $post)
                            <!-- Get content data -->
                            @include('items.row-with-like')
                        @endforeach                    
                    @else
                        <!-- Not data found -->
                        <h2 class="w-100 text-center">{{ translating('this-user-has-not-any-posts-yet') }}</h2>
                    @endif

                    <!-- Pagination -->
                    <div class="row no-gutters w-100 mt-5">
                        {{ $posts->links() }}
                    </div>
                </div>
           </div>

           <!-- Aside Menu -->
           @include('components.users.aside')
        </div>
    </div>
@endsection