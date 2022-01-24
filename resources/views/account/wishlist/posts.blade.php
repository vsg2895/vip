<!-- Navigation -->
@include('account.wishlist.navigation')

<!-- Content -->
<div class="row mt-3 no-gutters">
    <!-- Check data -->
@if(isset($posts) && count($posts) > 0)
    <!-- Loop from wisheds -->
    @foreach($posts as $wisheds)
        <!-- Check data -->
        @if(isset($wisheds->post))
            <!-- Loop from posts -->
            @foreach($wisheds->post as $post)
                <!-- Get items -->
                    <div class="row mb-5 item-card-row" data-item-id="{{ $post->id }}">
                        <!-- Image -->
                        <div class="col-lg-3 col-sm-4">
                            <!-- URL -->
                            <a href="{{ route('items', ['locale' => app()->getLocale(), 'id' => $post->id]) }}">
                                <!-- Check image -->
                            @if(isset($post->img) && $post->img != NULL) <!-- Has Image -->
                                <img src="{{ asset($assets_path.'/img/items/placeholder/placeholder.gif') }}"
                                     data-src="{{ asset($assets_path.'/img/items/'.$post->img) }}"
                                     class="lazy w-100 responsive" title="{{ $post->title }}" alt="{{ $post->title }}">
                            @else <!-- Has not Image -->
                                <img src="{{ asset($assets_path.'/img/items/placeholder/placeholder.gif') }}"
                                     data-src="{{ asset($assets_path.'/img/items/placeholder/no-image.jpg') }}"
                                     class="lazy w-100 responsive" title="{{ $post->title }}" alt="{{ $post->title }}">
                                @endif
                            </a>
                        </div>

                        <!-- Content -->
                        <div class="col-lg-9 col-md-8 mt-0 mt-sm-2 col-sm-12">
                            <!-- Code -->
                            <div class="row no-gutters">
                                <!-- URL -->
                                <a class="text-dark"
                                   href="{{ route('items', ['locale' => app()->getLocale(), 'id' => $post->id]) }}">
                                    <h6 class="font-weight-bold">{{ translating('code').' #'.$post->code }}</h6>
                                </a>
                            </div>

                            <!-- Price -->
                            <div class="row no-gutters">
                                <span
                                    class="font-weight-bold">{{ mb_substr(price_handler($post->price, $post->currency_id), 0, 20) }}</span>
                            </div>

                            <!-- Title -->
                            <div class="row no-gutters mt-2">
                                <!-- URL -->
                                <a class="text-dark"
                                   href="{{ route('items', ['locale' => app()->getLocale(), 'id' => $post->id]) }}">
                                    <p class="card-title">{!! mb_substr($post->title,0, 300) !!}</p>
                                </a>
                            </div>


                            <!-- Actions -->
                            <div class="row no-gutters bottom-row-with-like">
                                <!-- Actions -->
                                <div class="like-button-container">
                                    <!-- Wishlist Button -->
                                @auth <!-- Add to wishlist -->
                                    <div class="like-action">
                                    @if(!isset($post->wishlist) || $post->wishlist == NULL)
                                        <!-- Not Liked -->
                                            <svg class="wishlist-action float-right"
                                                 data-url="{{ route('post-wishlist-action', ['locale' => app()->getLocale(), 'post_id' => $post->id]) }}"
                                                 xmlns="http://www.w3.org/2000/svg" width="22.507" height="23.154"
                                                 viewBox="0 0 22.507 23.154">
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
                                         xmlns="http://www.w3.org/2000/svg" width="22.507" height="23.154"
                                         viewBox="0 0 22.507 23.154">
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
                            </div>
                        </div>
                    </div>
            @endforeach
        @endif
    @endforeach

    <!-- Pagination -->
        <div class="row no-gutters w-100 mt-5">
            {{ $posts->links() }}
        </div>
@else
    <!-- Not data exists -->
        <p>{!! translating('wished-posts-not-data-found-description') !!}</p>
    @endif
</div>
