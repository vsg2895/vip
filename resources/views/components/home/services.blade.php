<!-- Contenet -->
<div class="app-container my-3 services-posts">
    <div class="row">
        <!-- Title -->
        <h2 class="font-weight-bold mb-3 text-dark text-center h2 w-100">{{ translating('home-section-services-title') }}</h2>

        <!-- Items -->
    @if(isset($services) && count($services) > 0)
        <!-- Define column size -->
        @php $col_5 = true;  @endphp
        @foreach($services as $post)
            <!-- Get items -->
            @include('items.grid')
        @endforeach

        <!-- See More Button -->
{{--            @if(count($services_all) > 20)--}}
                <div class="row no-gutters w-100 my-2 top-more-button">
                    <a href="{{ route('services', ['locale' => app()->getLocale()]) }}"
                       class="btn btn-main  d-block mx-auto btn-lg pl-4 pr-4 text-light rounded-all">{{ translating('see-more') }}</a>
                </div>
{{--            @endif--}}
        @endif
    </div>
</div>
