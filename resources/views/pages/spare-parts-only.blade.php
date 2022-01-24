<!-- Check data -->
@if(isset($items) && count($items) > 0)
    <!-- Loop from items -->
    @foreach($items  as $item)
        <!-- Card -->
        <a href="{{ route('spare-parts', ['locale' => app()->getLocale(), 'id' => $item->id]) }}" class="d-block  col-lg-3 col-md-6 col-12 mb-5">
            <!-- Image -->
            <img src="{{ asset($assets_path.'/img/spare-parts/'.$item->img) }}" class="responsive w-50 rounded d-block mx-auto" title="{{ $item->first_name.' '.$item->last_name }}" alt="{{ $item->first_name.' '.$item->last_name }}">
        
            <!-- Fullname -->
            <h4 class="text-dark w-100 d-block text-center mt-2">{{ $item->first_name.' '.$item->last_name }}</h4>

            <!-- Model -->
            <span class="text-dark d-block w-100 text-center h6">{{ $item->location['title_'.app()->getLocale()].' | '.$item->model['title_'.app()->getLocale()] }}</span>
        </a>
    @endforeach

    <!-- Paginatin -->
    <div class="row no-gutters d-block w-100 mt-5">
        {{ $items->links() }}
    </div>
@else
    <h1 class="w-100 text-center align-items-center justify-content-center mt-5">{{ translating('spare-parts-data-are-not-found') }}</h1>
@endif