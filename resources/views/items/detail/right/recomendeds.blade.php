<!-- Recomendeds Section -->
@if(isset($recomendeds) && count($recomendeds) > 0)
    <div class="row before-ipad-pro">
        @foreach($recomendeds as $recomended)
            <div class="col-lg-12 col-sm-6 col-12">
                <div class="bg-white rounded shadow-sm mt-3 recomended-item">
                    <div class="row">
                        <!-- Content -->
                        <div class="col-lg-6 mb-2 order-2 order-lg-1">
                            <!-- Code -->
                            <div class="row no-gutters w-100 pl-1 pr-1 py-1">
                                <a class="text-dark w-100"
                                   href="{{ route('items', ['locale' => app()->getLocale(), 'id' => $recomended->id]) }}">{{ translating('code').' #'.mb_substr($recomended->code, 0, 10) }}</a>
                            </div>

                            <!-- Price -->
                            <div class="row no-gutters w-100 pl-1 pr-1 py-1 font-weight-bold">
                                <a class="text-dark w-100"
                                   href="{{ route('items', ['locale' => app()->getLocale(), 'id' => $recomended->id]) }}">
                                    {{ mb_substr($recomended->price.' '.$recomended->currency['simbol'], 0, 10) }}
                                </a>
                            </div>

                            <!-- Title -->
                            <div class="row no-gutters w-100 pl-1 pr-1 py-1 font-weight-bold">
                                <a class="text-dark w-100"
                                   href="{{ route('items', ['locale' => app()->getLocale(), 'id' => $recomended->id]) }}">
                                @if(strlen($recomended->title) > 12)
                                    {{ mb_substr($recomended->title, 0, 12)."..." }}
                                @else
                                    {{ $recomended->title }}  @endif
                                {{--                                    {{ mb_substr($recomended->title, 0, 12) }}</a>--}}
                            </div>


                        </div>

                        <!-- Image -->
                        <div class="col-lg-6 mb-2 order-1 order-lg-2">
                            <!-- URL -->
                            <a href="{{ route('items', ['locale' => app()->getLocale(), 'id' => $recomended->id]) }}">
                                <!-- Check image -->
                            @if(isset($recomended->img) && $recomended->img != NULL)  <!-- Exists image -->
                                <img src="{{ asset('assets/img/items'.'/'.$recomended->img) }}"
                                     class="w-100 rounded responsive" title="{{ $recomended->title }}"
                                     alt="{{ $recomended->title }}">
                            @else  <!-- Image is not exists -->
                                <img src="{{ asset('assets/img/items/placeholder/no-image.jpg') }}"
                                     class="w-100 rounded responsive" title="{{ $recomended->title }}"
                                     alt="{{ $recomended->title }}">
                                @endif
                            </a>
                                     <!-- Wishlist Action -->
                            <div class="row no-gutters w-100 pl-1 pr-1 py-3 justify-content-end like-button-container">
                            @auth <!-- Add to wishlist -->
                                <div class="like-action">
                                @if(!isset($recomended->wishlist) || $recomended->wishlist == NULL)
                                    <!-- Not Liked -->
                                        <svg class="wishlist-action float-right"
                                             data-url="{{ route('post-wishlist-action', ['locale' => app()->getLocale(), 'post_id' => $recomended->id]) }}"
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
                                             data-url="{{ route('post-wishlist-action', ['locale' => app()->getLocale(), 'post_id' => $recomended->id]) }}"
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
                                     xmlns="http://www.w3.org/2000/svg" width="24.523" height="24.557"
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
            </div>
        @endforeach
    </div>
    <div class="row after-ipad-pro">
        @foreach($recomendeds as $recomended)
            <div class="col-lg-12 col-sm-12 col-12">
                <div class="bg-white rounded shadow-sm mt-3 recomended-item">
                    <div class="row column-reverse">

                        <!-- Image -->
                        <div class="col-xl-6 col-lg-12 col-sm-12 mb-2 order-1 order-lg-2">
                            <!-- URL -->
                            <a href="{{ route('items', ['locale' => app()->getLocale(), 'id' => $recomended->id]) }}">
                                <!-- Check image -->
                            @if(isset($recomended->img) && $recomended->img != NULL)  <!-- Exists image -->
                                <img src="{{ asset('assets/img/items'.'/'.$recomended->img) }}"
                                     class="w-100 rounded responsive" title="{{ $recomended->title }}"
                                     alt="{{ $recomended->title }}">
                            @else  <!-- Image is not exists -->
                                <img src="{{ asset('assets/img/items/placeholder/no-image.jpg') }}"
                                     class="w-100 rounded responsive" title="{{ $recomended->title }}"
                                     alt="{{ $recomended->title }}">
                                @endif
                            </a>
                        </div>

                        <!-- Content -->
                        <div class="col-xl-6 col-lg-12 col-sm-12 mb-2 order-2 order-lg-1 recomended-contenmt">
                            <!-- Code -->
                            <div class="row no-gutters justify-content-center w-100 pl-1 pr-1 py-1">
                                <a class="text-dark w-100"
                                   href="{{ route('items', ['locale' => app()->getLocale(), 'id' => $recomended->id]) }}">{{ translating('code').' #'.mb_substr($recomended->code, 0, 10) }}</a>
                            </div>

                            <!-- Price -->
                            <div class="row no-gutters justify-content-center w-100 pl-1 pr-1 py-1 font-weight-bold">
                                <a class="text-dark w-100"
                                   href="{{ route('items', ['locale' => app()->getLocale(), 'id' => $recomended->id]) }}">
                                    {{ mb_substr($recomended->price.' '.$recomended->currency['simbol'], 0, 10) }}
                                </a>
                            </div>

                            <!-- Title -->
                            <div class="row no-gutters justify-content-center w-100 pl-1 pr-1 py-1 font-weight-bold">
                                <a class="text-dark w-100"
                                   href="{{ route('items', ['locale' => app()->getLocale(), 'id' => $recomended->id]) }}">
                                @if(strlen($recomended->title) > 12)
                                    {{ mb_substr($recomended->title, 0, 12)."..." }}
                                @else
                                    {{ $recomended->title }}  @endif
                                {{--                                    {{ mb_substr($recomended->title, 0, 12) }}</a>--}}
                            </div>

                            <!-- Wishlist Action -->
                            <div class="row no-gutters justify-content-end w-100 pl-1 pr-1 py-1 like-button-container">
                            @auth <!-- Add to wishlist -->
                                <div class="like-action">
                                @if(!isset($recomended->wishlist) || $recomended->wishlist == NULL)
                                    <!-- Not Liked -->
                                        <svg class="wishlist-action float-right"
                                             data-url="{{ route('post-wishlist-action', ['locale' => app()->getLocale(), 'post_id' => $recomended->id]) }}"
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
                                             data-url="{{ route('post-wishlist-action', ['locale' => app()->getLocale(), 'post_id' => $recomended->id]) }}"
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
                                     xmlns="http://www.w3.org/2000/svg" width="24.523" height="24.557"
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
            </div>
        @endforeach
    </div>
@endif
