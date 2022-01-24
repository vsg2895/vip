<!-- Check posts count -->
{{--@include('components.home.slider')--}}

@if(isset($posts) && count($posts) > 0)
    <!-- Loop from items -->
    @foreach($posts as $post)
        <!-- Defile col size -->
        @php $col_5 = true; @endphp

        <!-- Get items -->
        @include('items.grid')
    @endforeach

    <!-- Pagination -->
    <div class="row no-gutters d-block w-100 mt-5">
        {{ $posts->links() }}
    </div>
@else
    <div class="d-block alert-warning w-100 text-center" role="alert">
        <strong>{{ translating('this-category-main-post-is-not-found') }}</strong>
    </div>
@endif
