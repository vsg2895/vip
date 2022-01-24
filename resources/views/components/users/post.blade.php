<!-- Check posts count -->
@if(isset($posts) && count($posts) > 0)
    <!-- Loop from items -->
    @foreach($posts as $post)
        <!-- Get items -->
        @include('items.row-with-like')
    @endforeach

    <!-- Pagination -->
    <div class="row no-gutters w-100 mt-5">
        {{ $posts->links() }}
    </div>
@endif