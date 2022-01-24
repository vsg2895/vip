<!-- Ads Section -->
@if(isset($ads) && count($ads) > 0)
    <div class="row">
        <!-- Loop from ads -->
        @foreach($ads as $ad)
            <!-- Url -->
            <a class="w-100 col-lg-12 col-sm-12 col-12 d-block mt-5" target="_blank" rel="nofollow" href="{{ $ad->url }}">
                <!-- Image -->
                <img src="{{ asset('assets/img/ads'.'/'.$ad->img) }}" class="responsive w-100 rounded" title="{{ $ad->url }}" alt="{{ $ad->url }}">
            </a>
    @endforeach
    </div>
@endif
