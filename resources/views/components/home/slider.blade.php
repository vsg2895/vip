<!-- Check data -->

@if(isset($sidebar_ads) && count($sidebar_ads) > 0)
    <div id="homeSlider" class="slider-container-home @if(\Request::route()->getName() == 'home') in-home-slide @else no-home-slide @endif">
        <div id="drag-container">
            <div id="spin-container">
                @foreach($sidebar_ads as $sidebar_ad_left)
                    <a href="{{ $sidebar_ad_left->url }}" target="_blank" rel="nofollow" class="cont">
                        <img src="{{ asset('assets/img/ads'.'/'.$sidebar_ad_left->img) }}"
                             alt="{{ $sidebar_ad_left->img }}">
                    </a>
                @endforeach
            </div>
            <div id="ground"></div>
        </div>
    </div>
@endif
