@extends('layouts.app')

@section('content')
    <!-- Contenet -->
    <div class="app-container bg-light">
        <div class="row">
            <!-- Title -->
            <h2 class="font-weight-bold mb-5 mt-5 text-dark text-center load-content-scroll w-100 h2">{{ $page_name }}</h2>
            <!-- Items -->
            @if(isset($posts) && count($posts) > 0)
                <div class="load-content row">
                @if(count($posts) >= 5)
                    @php $col_5 = true;  @endphp
                @endif
                @foreach($posts as $post)
                    <!-- Get items -->
                    @include('items.grid')
                @endforeach


                <!-- Pagination -->
                    <div class="row no-gutters d-block w-100 mt-5">
                        {{ $posts->links() }}
                    </div>
                </div>
            @else
                <div class="alert alert-warning w-100 text-center" role="alert">
                    <strong>{{ translating('this-category-post-is-not-found') }}</strong>
                </div>
            @endif
        </div>
    </div>

@endsection
