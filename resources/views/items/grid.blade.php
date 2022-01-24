<!-- Card -->
{{--@dump('dskfj')--}}
<div
    class="@if($post instanceof App\SparePartsStore) width-top-primary-100 d-flex spare_store_item @endif @if(isset($col_5) && $col_5 == true) item-card-show-5 @endif @if(isset($col_3) && $col_3 == true) item-card-show-3 @endif item-card @if(count($posts) <= 4) margin-l @endif"
    data-id="{{ $post->id }}">
    <!-- Check hurry -->
    @if(isset($post->hurry) && $post->hurry == 1)
        <span class="btn btn-danger btn-sm hurry-badge">{{ translating('hurry') }}</span>
    @endif

<!-- Image -->

    {{--        @dd($assets_path)--}}
    <a href="{{ route('items', ['locale' => app()->getLocale(), 'id' => $post->id]) }}">
        <!-- Check image -->
    @if(isset($post->img) && $post->img != NULL) <!-- Has Image -->
        <img src="{{ asset($assets_path.'/img/items/placeholder/placeholder.gif') }}"
             data-src="{{ asset($assets_path.'/img/items/'.$post->img) }}" class="lazy w-100 responsive"
             title="{{ $post->title }}" alt="{{ $post->title }}">
    @else <!-- Has not Image -->
        <img src="{{ asset($assets_path.'/img/items/placeholder/placeholder.gif') }}"
             data-src="{{ asset($assets_path.'/img/items/placeholder/no-image.jpg') }}" class="lazy w-100 responsive"
             title="{{ $post->title }}" alt="{{ $post->title }}">
        @endif
    </a>

    <!-- Content -->
    <div class="body pl-2 pr-1 pt-2 pb-3">

        <!-- Item Name -->
        <div class="row no-gutters w-100 h-20-px @if($post instanceof App\SparePartsStore) spare-block-row-1 @endif">
            @if(get_options($post->id) != null || get_options($post->id) != "")
                @if(strlen(get_options($post->id)) > 15)
                    <h5 class="post-title-get-option">{{ mb_substr(get_options($post->id), 0, 13)."..." }}</h5> @else
                    <h5 class="post-title-get-option">{{ get_options($post->id)}}</h5>  @endif
            @else

                @if(strlen($post->title) > 15)
                    <h5 class="post-title-get-option @if($post instanceof App\SparePartsStore) font-weight-bold @endif">{{ mb_substr($post->title, 0, 13)."..." }}</h5> @else
                    <h5 class="post-title-get-option @if($post instanceof App\SparePartsStore) font-weight-bold @endif">{{ $post->title}}</h5>  @endif
            @endif
        </div>

    @if(get_options($post->id) != null || get_options($post->id) != "")
        <!-- Options -->
            <div class="row no-gutters w-100 h-20-px item-desc">
                <div class="col-lg-11 col-11 font-weight-bold">
                    <a href="{{ route('items', ['locale' => app()->getLocale(), 'id' => $post->id]) }}">
                        <h6 class="item-title text-dark font-weight-bold">@if(strlen($post->title) > 15) {{ mb_substr($post->title, 0, 13)."..." }} @else {{ $post->title }} @endif</h6>
                    </a>
                </div>
            </div>
        @else
            @if($post instanceof App\Post)
                <div class="row no-gutters w-100 h-20-px item-desc">
                    <div class="col-lg-11 col-11 font-weight-bold">
                        <a href="{{ route('items', ['locale' => app()->getLocale(), 'id' => $post->id]) }}">
                            <h6 class="item-title text-dark font-weight-bold">@if(strlen($post->description) > 15) {{ mb_substr($post->description, 0, 13)."..." }} @else {{ $post->description }} @endif</h6>
                        </a>
                    </div>
                </div>
            @endif
        @endif

        @if($post instanceof App\SparePartsStore)
            <div
                class="row no-gutters w-100 h-20-px spare-stores-options item-desc @if($post instanceof App\SparePartsStore) spare-block-row-2 @endif">
                <div class="title-opt w-100 d-flex align-items-baseline">
                    <span
                        class="w-100 font-weight-bold text-start"> {{ "Հեռ՝ " . $post->phone }}
                 </span>

                    @if(!is_null($post->address))
                        @if(strlen($post->address) > 15)
                            <span
                                class="w-100 font-weight-bolder text-start">{{ mb_substr($post->address, 0, 13)."..." }}
                       </span>
                        @else
                            <span
                                class="w-100 font-weight-bolder text-start">{{ $post->address }}
                       </span>
                        @endif

                    @else

                        <span
                            class="w-100 font-weight-bolder text-start">{{ $post->location['title_'.app()->getLocale()] }}
                 </span>

                    @endif
                </div>

            </div>
    @endif

    <!-- Item Actions -->
        <div
            class="row no-gutters w-100 item-options @if($post instanceof App\SparePartsStore) spare-block-row-3 @endif">
            <!-- Item ID  and Price -->
            @if($post instanceof App\Post)
                <div class="col-lg-11 col-11 font-weight-bold">
                @if(isset($post->price) && !is_null($post->price))
                    <!-- Price -->
                        <span
                            class="w-100 text-left">{{ mb_substr($post->price.' '.$post->currency['simbol'], 0, 10) }}
                    </span>
                    @endif
                </div>
            @endif
        <!-- Wishlist Button -->
            @if($post)
                <div class="col-lg-1 col-1 like-button-container">
                @auth <!-- Add to wishlist -->
                    <div class="like-action">
                    @if(!isset($post->wishlist) || $post->wishlist == NULL)
                        <!-- Not Liked -->
                            <svg class="wishlist-action not-liked float-right"
                                 data-url="{{ route('post-wishlist-action', ['locale' => app()->getLocale(), 'post_id' => $post->id]) }}"
                                 xmlns="http://www.w3.org/2000/svg" width="24.523" height="24.557"
                                 viewBox="0 0 24.523 24.557">
                                <g id="like_" data-name="like " transform="translate(0 0.034)">
                                    <path id="Path_563" data-name="Path 563"
                                          d="M56.364,265.475v10.4a.936.936,0,0,1-.935.935h-3.9v.006a.936.936,0,0,1-.935-.935V265.475a.936.936,0,0,1,.935-.935h3.9A.936.936,0,0,1,56.364,265.475Z"
                                          transform="translate(-50.59 -252.544)" fill="#555555"/>
                                    <path id="Path_564" data-name="Path 564"
                                          d="M182.835,55.424a2.322,2.322,0,0,1-1.09,2.007.791.791,0,0,0-.271.883.065.065,0,0,0,.006.017,2.048,2.048,0,0,1-.158,1.49,3.642,3.642,0,0,1-2.564,1.474,15.205,15.205,0,0,1-4.207.129h-.1a57.239,57.239,0,0,1-7.54-.412H166.9l-.035,0a.569.569,0,0,1-.5-.571V51a2.406,2.406,0,0,0-.071-.577.572.572,0,0,1,.008-.3,4.815,4.815,0,0,1,1-1.8.55.55,0,0,1,.063-.058c2.593-2.1,5.118-9.007,5.228-9.308a.735.735,0,0,0,.035-.389,5.291,5.291,0,0,1-.047-1.094.564.564,0,0,1,.712-.505,1.873,1.873,0,0,1,1.044.7c.592.818.568,2.28-.07,4.218-.974,2.953-1.056,4.508-.284,5.192a1.259,1.259,0,0,0,1.238.236l.054-.016c.344-.078.671-.146.982-.2l.075-.017c1.781-.389,4.971-.627,6.079.383a1.669,1.669,0,0,1,.2,2.118.775.775,0,0,0,.139,1.009,2.2,2.2,0,0,1,.644,1.352,2.157,2.157,0,0,1-.725,1.566.779.779,0,0,0-.116.928l.015.026A2.421,2.421,0,0,1,182.835,55.424Z"
                                          transform="translate(-158.874 -36.98)" fill="#555555"/>
                                </g>
                            </svg>
                    @else
                        <!-- Liked -->
                            <svg class="wishlist-action float-right"
                                 data-url="{{ route('post-wishlist-action', ['locale' => app()->getLocale(), 'post_id' => $post->id]) }}"
                                 xmlns="http://www.w3.org/2000/svg" width="24.523" height="24.557"
                                 viewBox="0 0 24.523 24.557">
                                <g id="like_" data-name="like " transform="translate(0 0.034)">
                                    <path id="Path_563" data-name="Path 563"
                                          d="M56.364,265.475v10.4a.936.936,0,0,1-.935.935h-3.9v.006a.936.936,0,0,1-.935-.935V265.475a.936.936,0,0,1,.935-.935h3.9A.936.936,0,0,1,56.364,265.475Z"
                                          transform="translate(-50.59 -252.544)" fill="#1876f2"/>
                                    <path id="Path_564" data-name="Path 564"
                                          d="M182.835,55.424a2.322,2.322,0,0,1-1.09,2.007.791.791,0,0,0-.271.883.065.065,0,0,0,.006.017,2.048,2.048,0,0,1-.158,1.49,3.642,3.642,0,0,1-2.564,1.474,15.205,15.205,0,0,1-4.207.129h-.1a57.239,57.239,0,0,1-7.54-.412H166.9l-.035,0a.569.569,0,0,1-.5-.571V51a2.406,2.406,0,0,0-.071-.577.572.572,0,0,1,.008-.3,4.815,4.815,0,0,1,1-1.8.55.55,0,0,1,.063-.058c2.593-2.1,5.118-9.007,5.228-9.308a.735.735,0,0,0,.035-.389,5.291,5.291,0,0,1-.047-1.094.564.564,0,0,1,.712-.505,1.873,1.873,0,0,1,1.044.7c.592.818.568,2.28-.07,4.218-.974,2.953-1.056,4.508-.284,5.192a1.259,1.259,0,0,0,1.238.236l.054-.016c.344-.078.671-.146.982-.2l.075-.017c1.781-.389,4.971-.627,6.079.383a1.669,1.669,0,0,1,.2,2.118.775.775,0,0,0,.139,1.009,2.2,2.2,0,0,1,.644,1.352,2.157,2.157,0,0,1-.725,1.566.779.779,0,0,0-.116.928l.015.026A2.421,2.421,0,0,1,182.835,55.424Z"
                                          transform="translate(-158.874 -36.98)" fill="#1876f2"/>
                                </g>
                            </svg>
                        @endif
                    </div>
                @else <!-- Log in to add to wishlist -->
                    <svg data-toggle="modal" data-target="#logInToAddWishlistCenter" class="float-right"
                         xmlns="http://www.w3.org/2000/svg" width="24.523" height="24.557" viewBox="0 0 24.523 24.557">
                        <g id="like_" data-name="like " transform="translate(0 0.034)">
                            <path id="Path_563" data-name="Path 563"
                                  d="M56.364,265.475v10.4a.936.936,0,0,1-.935.935h-3.9v.006a.936.936,0,0,1-.935-.935V265.475a.936.936,0,0,1,.935-.935h3.9A.936.936,0,0,1,56.364,265.475Z"
                                  transform="translate(-50.59 -252.544)" fill="#555555"/>
                            <path id="Path_564" data-name="Path 564"
                                  d="M182.835,55.424a2.322,2.322,0,0,1-1.09,2.007.791.791,0,0,0-.271.883.065.065,0,0,0,.006.017,2.048,2.048,0,0,1-.158,1.49,3.642,3.642,0,0,1-2.564,1.474,15.205,15.205,0,0,1-4.207.129h-.1a57.239,57.239,0,0,1-7.54-.412H166.9l-.035,0a.569.569,0,0,1-.5-.571V51a2.406,2.406,0,0,0-.071-.577.572.572,0,0,1,.008-.3,4.815,4.815,0,0,1,1-1.8.55.55,0,0,1,.063-.058c2.593-2.1,5.118-9.007,5.228-9.308a.735.735,0,0,0,.035-.389,5.291,5.291,0,0,1-.047-1.094.564.564,0,0,1,.712-.505,1.873,1.873,0,0,1,1.044.7c.592.818.568,2.28-.07,4.218-.974,2.953-1.056,4.508-.284,5.192a1.259,1.259,0,0,0,1.238.236l.054-.016c.344-.078.671-.146.982-.2l.075-.017c1.781-.389,4.971-.627,6.079.383a1.669,1.669,0,0,1,.2,2.118.775.775,0,0,0,.139,1.009,2.2,2.2,0,0,1,.644,1.352,2.157,2.157,0,0,1-.725,1.566.779.779,0,0,0-.116.928l.015.026A2.421,2.421,0,0,1,182.835,55.424Z"
                                  transform="translate(-158.874 -36.98)" fill="#555555"/>
                        </g>
                    </svg>
                    @endauth
                </div>
            @endif
        </div>
    </div>
</div>

