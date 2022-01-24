@if(isset($auto_brands) && count($auto_brands) > 0)

    <!-- Contenet -->
    <div class="app-container mt-2 mb-1 mt-md-0 mb-md-0" id="auto-brands" style="overflow: hidden;">
        <div class="row">
            <div class="custom-slider-auto">
            @foreach($auto_brands as $auto_brand)
                <!-- Slider Items -->
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="custom-box">

                            <div class="item brand-item auto-brand-item"
                                 data-brand="{{ $auto_brand['title_'.app()->getLocale()] }}" style="height: 100%">


                            <!-- Image -->
                                <div>
                                    {{--                                    {{ route('category', ['locale' => app()->getLocale(), 'id' => $top_category->id]) }}--}}
                                    <a>
                                        @if($auto_brand->logo != null)
                                            <img src="{{ asset($assets_path.'/img/auto-brand/'.$auto_brand->logo) }}"
                                                 class="w-100 responsive"
                                                 alt="{{ $auto_brand->{'title_'.app()->getLocale()} }}">
                                        @endif
                                    </a>
                                </div>
                                {{--                            </div>--}}
                            </div>
                        </div>

                    </div>

                @endforeach
            </div>
        </div>
    </div>
@endif
