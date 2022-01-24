<!-- Card -->

<div class="row mb-5 item-card-row post-activation-type-{{ $post['active'] }}" data-item-id="{{ $post['id'] }}"
     data-item-update-date="{{ date_default_format($post['updated_at']) }}"
     @if(isset($post['updates'])) data-item-updates="{{ $post['updates'] }}" @endif>
    <!-- Image -->
    <div class="col-lg-3 col-sm-4">
        <!-- URL -->
        <a class="@if($post["active"] == 2) moderation-post @endif"
           href="{{ route('items', ['locale' => app()->getLocale(), 'id' => $post['id']]) }}">
            <!-- Check image -->
        @if(isset($post["img"]) && $post["img"] != NULL) <!-- Has Image -->
            <img src="{{ asset($assets_path.'/img/items/placeholder/placeholder.gif') }}"
                 data-src="{{ asset($assets_path.'/img/items/'.$post["img"]) }}" class="lazy w-100 responsive"
                 title="{{ $post['title'] }}" alt="{{ $post['title'] }}">
        @else <!-- Has not Image -->
            <img src="{{ asset($assets_path.'/img/items/placeholder/placeholder.gif') }}"
                 data-src="{{ asset($assets_path.'/img/items/placeholder/no-image.jpg') }}"
                 class="lazy w-100 responsive" title="{{ $post['title'] }}" alt="{{ $post['title'] }}">
            @endif
        </a>
    </div>

    <!-- Content -->
    <div class="col-lg-9 col-md-8 mt-0 mt-sm-2 col-sm-12">
        <!-- Code -->
        <div class="row no-gutters w-100">
            <!-- URL -->
            <a class="text-dark @if($post["active"] == 2) moderation-post @endif"
               href="{{ route('items', ['locale' => app()->getLocale(), 'id' => $post['id']]) }}">
                <h6 class="font-weight-bold">{{ translating('code').' #'.$post['code'] }}</h6>
            </a>
        </div>

        <!-- Title -->
        <div class="row no-gutters w-100 mt-2">
            <!-- URL -->
            <a class="text-dark @if($post['active'] == 2) moderation-post @endif"
               href="{{ route('items', ['locale' => app()->getLocale(), 'id' => $post['id']]) }}">
                <p class="card-title">{!! mb_substr($post["title"],0, 300) !!}</p>
            </a>
        </div>

        <!-- Price and Actions -->
        <div class="row no-gutters w-100 bottom-row">
            <!-- Price -->
            <div class="col-sm-6">
                <span
                    class="font-weight-bold">@if(isset($post["price"]) && isset($post["currency"])) {{ mb_substr($post["price"].' '.$post["currency"]['simbol'], 0, 20) }} @endif </span>
            </div>

            <!-- Actions -->
            <div class="col-sm-6 float-right">
                <!-- Delete -->
                <svg data-toggle="modal" data-target="#deletPostModalCenter"
                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                     class="action delete float-right ml-3 my_posts_action_icons delete-acount-icon"
                     id="Layer_1" x="0px" y="0px" viewBox="0 0 60.963 60.842"
                     style="enable-background:new 0 0 60.963 60.842;" xml:space="preserve">
                     <path id="delete" style="fill:#f11;"
                           d="M59.595,52.861L37.094,30.359L59.473,7.98c1.825-1.826,1.825-4.786,0-6.611  c-1.826-1.825-4.785-1.825-6.611,0L30.483,23.748L8.105,1.369c-1.826-1.825-4.785-1.825-6.611,0c-1.826,1.826-1.826,4.786,0,6.611  l22.378,22.379L1.369,52.861c-1.826,1.826-1.826,4.785,0,6.611c0.913,0.913,2.109,1.369,3.306,1.369s2.393-0.456,3.306-1.369  l22.502-22.502l22.501,22.502c0.913,0.913,2.109,1.369,3.306,1.369s2.393-0.456,3.306-1.369  C61.42,57.647,61.42,54.687,59.595,52.861z"/>
                    <title>{{ translating('delete') }}</title>
                </svg>
            {{--                <svg data-toggle="modal" data-target="#deletPostModalCenter" class="action delete float-right ml-3 my_posts_action_icons"--}}
            {{--                     xmlns="http://www.w3.org/2000/svg" width="25.601" height="29.999" viewBox="0 0 25.601 29.999">--}}
            {{--                    <title>{{ translating('delete') }}</title>--}}
            {{--                    <g id="delete" transform="translate(0)">--}}
            {{--                        <path id="Path_491" data-name="Path 491"--}}
            {{--                              d="M223.025,154.7a.627.627,0,0,0-.627.627v11.85a.627.627,0,0,0,1.254,0V155.33A.627.627,0,0,0,223.025,154.7Zm0,0"--}}
            {{--                              transform="translate(-205.829 -141.776)" fill="#f11"/>--}}
            {{--                        <path id="Path_492" data-name="Path 492"--}}
            {{--                              d="M105.025,154.7a.627.627,0,0,0-.627.627v11.85a.627.627,0,0,0,1.254,0V155.33A.627.627,0,0,0,105.025,154.7Zm0,0"--}}
            {{--                              transform="translate(-96.62 -141.776)" fill="#f11"/>--}}
            {{--                        <path id="Path_493" data-name="Path 493"--}}
            {{--                              d="M2.093,8.93V26.239a3.774,3.774,0,0,0,1.083,2.673A3.725,3.725,0,0,0,5.814,30H19.781a3.724,3.724,0,0,0,2.638-1.085A3.774,3.774,0,0,0,23.5,26.239V8.93a2.69,2.69,0,0,0,2.073-2.941,2.777,2.777,0,0,0-2.8-2.337H19V2.774A2.694,2.694,0,0,0,18.146.8,2.978,2.978,0,0,0,16.075,0H9.52A2.978,2.978,0,0,0,7.448.8,2.694,2.694,0,0,0,6.6,2.774v.878H2.817a2.777,2.777,0,0,0-2.8,2.337A2.69,2.69,0,0,0,2.093,8.93ZM19.781,28.592H5.814A2.273,2.273,0,0,1,3.57,26.239V8.991H22.025V26.239a2.273,2.273,0,0,1-2.244,2.354ZM8.073,2.774A1.32,1.32,0,0,1,8.492,1.8,1.46,1.46,0,0,1,9.52,1.4h6.555A1.46,1.46,0,0,1,17.1,1.8a1.319,1.319,0,0,1,.419.976v.878H8.073ZM2.817,5.057H22.778a1.3,1.3,0,0,1,1.329,1.265,1.3,1.3,0,0,1-1.329,1.265H2.817A1.3,1.3,0,0,1,1.488,6.322,1.3,1.3,0,0,1,2.817,5.057Zm0,0"--}}
            {{--                              transform="translate(0.003 0.002)" fill="#f11"/>--}}
            {{--                        <path id="Path_494" data-name="Path 494"--}}
            {{--                              d="M164.025,154.7a.627.627,0,0,0-.627.627v11.85a.627.627,0,0,0,1.254,0V155.33A.627.627,0,0,0,164.025,154.7Zm0,0"--}}
            {{--                              transform="translate(-151.224 -141.776)" fill="#f11"/>--}}
            {{--                    </g>--}}
            {{--                </svg>--}}

            <!-- Edit -->
                <a data-id="{{ $post['id'] }}" class="edit-post"
                   href="{{ route('account-posts-edit', ['locale' => app()->getLocale(), 'id' => $post['id']]) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" id="i-edit" viewBox="0 0 32 32" fill="none" stroke="#0a8dd3"
                         stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         class="action edit float-right ml-3 in_blue_icons my_posts_action_icons">
                        <path d="M30 7 L25 2 5 22 3 29 10 27 Z M21 6 L26 11 Z M5 22 L10 27 Z"/>
                    </svg>
                    {{--                    <svg class="action edit float-right ml-3" xmlns="http://www.w3.org/2000/svg" width="30.383"--}}
                    {{--                         height="30.231" viewBox="0 0 30.383 30.231">--}}
                    {{--                        <title>{{ translating('edit') }}</title>--}}
                    {{--                        <g id="edit" transform="translate(0 0.001)">--}}
                    {{--                            <path id="Path_478" data-name="Path 478"--}}
                    {{--                                  d="M28.043,55.2a.757.757,0,0,0-.757.757v6.719a2.272,2.272,0,0,1-2.27,2.27H3.784a2.272,2.272,0,0,1-2.27-2.27V42.956a2.273,2.273,0,0,1,2.27-2.27H10.5a.757.757,0,1,0,0-1.513H3.784A3.788,3.788,0,0,0,0,42.956V62.675a3.788,3.788,0,0,0,3.784,3.784H25.016A3.788,3.788,0,0,0,28.8,62.675V55.956a.757.757,0,0,0-.757-.757Zm0,0"--}}
                    {{--                                  transform="translate(0 -36.229)" fill="#0b3363"/>--}}
                    {{--                            <path id="Path_479" data-name="Path 479"--}}
                    {{--                                  d="M128.5,1.258a3.405,3.405,0,0,0-4.816,0l-13.5,13.5a.756.756,0,0,0-.194.333L108.218,21.5a.757.757,0,0,0,.931.931l6.409-1.776a.756.756,0,0,0,.333-.194l13.5-13.5a3.409,3.409,0,0,0,0-4.816ZM111.836,15.25,122.885,4.2l3.563,3.563L115.4,18.813Zm-.712,1.428,2.847,2.847-3.938,1.091Zm17.2-10.787-.8.8-3.564-3.564.8-.8a1.892,1.892,0,0,1,2.675,0l.888.888A1.894,1.894,0,0,1,128.321,5.892Zm0,0"--}}
                    {{--                                  transform="translate(-100.003 -0.262)" fill="#0b3363"/>--}}
                    {{--                        </g>--}}
                    {{--                    </svg>--}}
                </a>
            @if($post["active"] == 1)
                <!-- Check Update Access -->
                @if(getPostLastUpdate($post["id"]) == true)
                    <!-- Update Access Allowed -->
                        <svg data-item-update-date-new="{{ date_default_format(Date('Y-m-d H:i:s')) }}"
                             data-toggle="modal"
                             data-target="#updatePostModalCenter"
                             class="action update float-right ml-3 in_blue_icons my_posts_action_icons"
                             xmlns="http://www.w3.org/2000/svg" width="24.416" height="30.818"
                             viewBox="0 0 24.416 30.818">
                            <title>{{ translating('update') }}</title>
                            <g id="surface1" transform="translate(0 0.001)">
                                <path id="Path_482" data-name="Path 482"
                                      d="M17.107.238A.746.746,0,0,0,16.571,0H4.549A4.067,4.067,0,0,0,.5,4.042V26.776a4.067,4.067,0,0,0,4.049,4.042H20.866a4.067,4.067,0,0,0,4.05-4.042V8.724A.8.8,0,0,0,24.7,8.2Zm.216,2.39,5.084,5.337H19.1a1.773,1.773,0,0,1-1.779-1.772Zm3.543,26.7H4.549a2.578,2.578,0,0,1-2.561-2.553V4.042A2.578,2.578,0,0,1,4.549,1.489H15.834v4.7A3.257,3.257,0,0,0,19.1,9.454h4.325V26.776A2.573,2.573,0,0,1,20.866,29.329Zm0,0"
                                      transform="translate(-0.5 -0.001)" fill="#09b387"/>
                                <path id="Path_483" data-name="Path 483"
                                      d="M102.169,401.934H89.916a.744.744,0,1,0,0,1.489h12.26a.744.744,0,1,0-.008-1.489Zm0,0"
                                      transform="translate(-83.834 -377.742)" fill="#09b387"/>
                                <path id="Path_484" data-name="Path 484"
                                      d="M119.683,176.23l3.067-3.3v8.129a.744.744,0,0,0,1.489,0v-8.129l3.067,3.3a.743.743,0,0,0,1.087-1.012l-4.362-4.682a.739.739,0,0,0-1.087,0l-4.362,4.682a.742.742,0,0,0,.037,1.05A.759.759,0,0,0,119.683,176.23Zm0,0"
                                      transform="translate(-111.286 -160.048)" fill="#09b387"/>
                            </g>
                        </svg>
                @else
                    {{--                @dd($post->active)--}}

                    <!-- Update Access Disabled -->
                        <svg data-item-update-date-new="{{ date_default_format(Date('Y-m-d H:i:s')) }}"
                             data-toggle="modal"
                             data-target="#updatePostModalDisabledCenter"
                             class="action update access-disabled float-right ml-3" xmlns="http://www.w3.org/2000/svg"
                             width="24.416" height="30.818" viewBox="0 0 24.416 30.818">
                            <title>{{ translating('update-disabled') }}</title>
                            <g id="surface1" transform="translate(0 0.001)">
                                <path id="Path_482" data-name="Path 482"
                                      d="M17.107.238A.746.746,0,0,0,16.571,0H4.549A4.067,4.067,0,0,0,.5,4.042V26.776a4.067,4.067,0,0,0,4.049,4.042H20.866a4.067,4.067,0,0,0,4.05-4.042V8.724A.8.8,0,0,0,24.7,8.2Zm.216,2.39,5.084,5.337H19.1a1.773,1.773,0,0,1-1.779-1.772Zm3.543,26.7H4.549a2.578,2.578,0,0,1-2.561-2.553V4.042A2.578,2.578,0,0,1,4.549,1.489H15.834v4.7A3.257,3.257,0,0,0,19.1,9.454h4.325V26.776A2.573,2.573,0,0,1,20.866,29.329Zm0,0"
                                      transform="translate(-0.5 -0.001)" fill="#707070"/>
                                <path id="Path_483" data-name="Path 483"
                                      d="M102.169,401.934H89.916a.744.744,0,1,0,0,1.489h12.26a.744.744,0,1,0-.008-1.489Zm0,0"
                                      transform="translate(-83.834 -377.742)" fill="#707070"/>
                                <path id="Path_484" data-name="Path 484"
                                      d="M119.683,176.23l3.067-3.3v8.129a.744.744,0,0,0,1.489,0v-8.129l3.067,3.3a.743.743,0,0,0,1.087-1.012l-4.362-4.682a.739.739,0,0,0-1.087,0l-4.362,4.682a.742.742,0,0,0,.037,1.05A.759.759,0,0,0,119.683,176.23Zm0,0"
                                      transform="translate(-111.286 -160.048)" fill="#707070"/>
                            </g>
                        </svg>
                @endif

                <!-- Check Activation Action -->
                @if($post["active"] == 'passive')
                    <!-- Post Make Active -->
                        <svg data-toggle="modal"
                             data-target="#activationActionPostModalCenter"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-repeat action activation float-right ml-3 in_blue_icons my_posts_action_icons"
                             id="reload">
                            <polyline points="17 1 21 5 17 9"/>
                            <path d="M3 11V9a4 4 0 0 1 4-4h14"/>
                            <polyline points="7 23 3 19 7 15"/>
                            <path d="M21 13v2a4 4 0 0 1-4 4H3"/>
                            <title>{{ translating('post-make-active') }}</title>
                        </svg>
                    {{--                        <svg data-toggle="modal" data-target="#activationActionPostModalCenter"--}}
                    {{--                             class="action activation float-right ml-3" id="reload" xmlns="http://www.w3.org/2000/svg"--}}
                    {{--                             width="28.122" height="30.757" viewBox="0 0 28.122 30.757">--}}
                    {{--                            <title>{{ translating('post-make-active') }}</title>--}}
                    {{--                            <g id="Group_1161" data-name="Group 1161" transform="translate(0 0)">--}}
                    {{--                                <path id="Path_458" data-name="Path 458"--}}
                    {{--                                      d="M26.709,6.1A12.262,12.262,0,0,1,42.65,5.678L39,5.817a.848.848,0,0,0,.031,1.7h.031l5.6-.207a.846.846,0,0,0,.816-.848v-.1h0L45.275.817a.848.848,0,0,0-1.7.063l.132,3.473a13.946,13.946,0,0,0-18.139.49,13.95,13.95,0,0,0-4.2,13.635.844.844,0,0,0,.823.647.735.735,0,0,0,.2-.025.849.849,0,0,0,.622-1.024A12.254,12.254,0,0,1,26.709,6.1Z"--}}
                    {{--                                      transform="translate(-20.982 0)" fill="#09b387"/>--}}
                    {{--                                <path id="Path_459" data-name="Path 459"--}}
                    {{--                                      d="M101.487,185.861a.847.847,0,1,0-1.646.4,12.252,12.252,0,0,1-19.728,12.317l3.693-.333a.848.848,0,0,0-.157-1.69l-5.584.5a.847.847,0,0,0-.766.923l.5,5.584a.846.846,0,0,0,.842.773.306.306,0,0,0,.075-.006.847.847,0,0,0,.766-.923l-.3-3.4a13.852,13.852,0,0,0,8.058,3.071c.239.013.477.019.71.019a13.948,13.948,0,0,0,13.535-17.241Z"--}}
                    {{--                                      transform="translate(-73.759 -173.581)" fill="#09b387"/>--}}
                    {{--                            </g>--}}
                    {{--                        </svg>--}}
                @else
                    <!-- Post Make Passive -->
                        <svg data-toggle="modal"
                             data-target="#passivationActionPostModalCenter"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-repeat action activation float-right ml-3 in_gray_color my_posts_action_icons"
                             id="reload">
                            <polyline points="17 1 21 5 17 9"/>
                            <path d="M3 11V9a4 4 0 0 1 4-4h14"/>
                            <polyline points="7 23 3 19 7 15"/>
                            <path d="M21 13v2a4 4 0 0 1-4 4H3"/>
                            <title>{{ translating('post-make-passive') }}</title>
                        </svg>
                    {{--                        <svg data-toggle="modal" data-target="#passivationActionPostModalCenter"--}}
                    {{--                             class="action passivation float-right ml-3" id="reload" xmlns="http://www.w3.org/2000/svg"--}}
                    {{--                             width="28.122" height="30.757" viewBox="0 0 28.122 30.757">--}}
                    {{--                            <title>{{ translating('post-make-passive') }}</title>--}}
                    {{--                            <g id="Group_1161" data-name="Group 1161" transform="translate(0 0)">--}}
                    {{--                                <path id="Path_458" data-name="Path 458"--}}
                    {{--                                      d="M26.709,6.1A12.262,12.262,0,0,1,42.65,5.678L39,5.817a.848.848,0,0,0,.031,1.7h.031l5.6-.207a.846.846,0,0,0,.816-.848v-.1h0L45.275.817a.848.848,0,0,0-1.7.063l.132,3.473a13.946,13.946,0,0,0-18.139.49,13.95,13.95,0,0,0-4.2,13.635.844.844,0,0,0,.823.647.735.735,0,0,0,.2-.025.849.849,0,0,0,.622-1.024A12.254,12.254,0,0,1,26.709,6.1Z"--}}
                    {{--                                      transform="translate(-20.982 0)" fill="#707070"/>--}}
                    {{--                                <path id="Path_459" data-name="Path 459"--}}
                    {{--                                      d="M101.487,185.861a.847.847,0,1,0-1.646.4,12.252,12.252,0,0,1-19.728,12.317l3.693-.333a.848.848,0,0,0-.157-1.69l-5.584.5a.847.847,0,0,0-.766.923l.5,5.584a.846.846,0,0,0,.842.773.306.306,0,0,0,.075-.006.847.847,0,0,0,.766-.923l-.3-3.4a13.852,13.852,0,0,0,8.058,3.071c.239.013.477.019.71.019a13.948,13.948,0,0,0,13.535-17.241Z"--}}
                    {{--                                      transform="translate(-73.759 -173.581)" fill="#707070"/>--}}
                    {{--                            </g>--}}
                    {{--                        </svg>--}}
                @endif

                <!-- Check Top Status -->
                @if($post["top"] == '0')
                    <!-- Post Make Top -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-star action makeTop float-right ml-3 in_blue_icons my_posts_action_icons"
                             data-toggle="modal"
                             data-url="{{ route('account-post-make-top', ['locale' => app()->getLocale(), 'id' => $post['id']]) }}"
                             data-target="#postChangePrioritettop_{{$post['id']}}">
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            <title>{{ translating('post-make-top') }}</title>
                        </svg>
                    {{--                        <svg data-toggle="modal"--}}
                    {{--                             data-url="{{ route('account-post-make-top', ['locale' => app()->getLocale(), 'id' => $post['id']]) }}"--}}
                    {{--                             data-target="#postChangePrioritettop_{{$post['id']}}"--}}
                    {{--                             class="action makeTop float-right ml-3"--}}
                    {{--                             xmlns="http://www.w3.org/2000/svg" width="29.726" height="33.438"--}}
                    {{--                             viewBox="0 0 29.726 33.438">--}}
                    {{--                            <title>{{ translating('post-make-top') }}</title>--}}
                    {{--                            <g id="fast-forward" transform="matrix(-0.017, -1, 1, -0.017, -62.938, 34.03)">--}}
                    {{--                                <path id="Path_679" data-name="Path 679"--}}
                    {{--                                      d="M225.046,77.236l-9.162-12.8a.941.941,0,0,0-.757-.425h-6.108a1.039,1.039,0,0,0-.93.758,1.543,1.543,0,0,0,.173,1.377l8.549,11.943-8.549,11.941a1.539,1.539,0,0,0-.173,1.377,1.038,1.038,0,0,0,.93.76h6.108a.952.952,0,0,0,.757-.422l9.162-12.8A1.534,1.534,0,0,0,225.046,77.236Z"--}}
                    {{--                                      transform="translate(-193.446)" fill="none" stroke="#09b387" stroke-width="1"/>--}}
                    {{--                                <path id="Path_680" data-name="Path 680"--}}
                    {{--                                      d="M17.046,77.236l-9.162-12.8a.941.941,0,0,0-.757-.425H1.019a1.039,1.039,0,0,0-.93.758,1.543,1.543,0,0,0,.173,1.377L8.81,78.091.262,90.031a1.539,1.539,0,0,0-.173,1.377,1.038,1.038,0,0,0,.93.76H7.127a.952.952,0,0,0,.757-.422l9.162-12.8A1.534,1.534,0,0,0,17.046,77.236Z"--}}
                    {{--                                      transform="translate(0)" fill="none" stroke="#09b387" stroke-width="1"/>--}}
                    {{--                            </g>--}}
                    {{--                        </svg>--}}
                @else
                    <!-- Post is list of Top -->
                        <svg data-toggle="modal"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-star action postIsTop float-right ml-3 in_gray_color my_posts_action_icons"
                             {{--                             data-url="{{ route('account-post-make-top', ['locale' => app()->getLocale(), 'id' => $post['id']]) }}"--}}
                             data-target="#posIsTopActionPostModalCenter">
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            <title>{{ translating('post-is-list-of-top') }}</title>
                        </svg>
                    {{--                        <svg data-toggle="modal" data-target="#posIsTopActionPostModalCenter"--}}
                    {{--                             class="action postIsTop float-right ml-3" xmlns="http://www.w3.org/2000/svg" width="29.726"--}}
                    {{--                             height="33.438" viewBox="0 0 29.726 33.438">--}}
                    {{--                            <title>{{ translating('post-is-list-of-top') }}</title>--}}
                    {{--                            <g id="fast-forward" transform="matrix(-0.017, -1, 1, -0.017, -62.938, 34.03)">--}}
                    {{--                                <path id="Path_679" data-name="Path 679"--}}
                    {{--                                      d="M225.046,77.236l-9.162-12.8a.941.941,0,0,0-.757-.425h-6.108a1.039,1.039,0,0,0-.93.758,1.543,1.543,0,0,0,.173,1.377l8.549,11.943-8.549,11.941a1.539,1.539,0,0,0-.173,1.377,1.038,1.038,0,0,0,.93.76h6.108a.952.952,0,0,0,.757-.422l9.162-12.8A1.534,1.534,0,0,0,225.046,77.236Z"--}}
                    {{--                                      transform="translate(-193.446)" fill="none" stroke="#707070" stroke-width="1"/>--}}
                    {{--                                <path id="Path_680" data-name="Path 680"--}}
                    {{--                                      d="M17.046,77.236l-9.162-12.8a.941.941,0,0,0-.757-.425H1.019a1.039,1.039,0,0,0-.93.758,1.543,1.543,0,0,0,.173,1.377L8.81,78.091.262,90.031a1.539,1.539,0,0,0-.173,1.377,1.038,1.038,0,0,0,.93.76H7.127a.952.952,0,0,0,.757-.422l9.162-12.8A1.534,1.534,0,0,0,17.046,77.236Z"--}}
                    {{--                                      transform="translate(0)" fill="none" stroke="#707070" stroke-width="1"/>--}}
                    {{--                            </g>--}}
                    {{--                        </svg>--}}
                @endif
                {{-- Check primary status --}}
                @if($post["primary"] == '0')
                    <!-- Post Make Primary -->
                        <svg
                            data-toggle="modal"
                            xmlns="http://www.w3.org/2000/svg" id="_19269646621617453692"
                            data-name="19269646621617453692" width="29.726" height="33.438" viewBox="0 1.5 22 21"
                            data-url="{{ route('account-post-make-primary', ['locale' => app()->getLocale(), 'id' => $post['id']]) }}"
                            data-target="#postChangePrioritetprimary_{{$post['id']}}"
                            class="action makePrimary float-right ml-3 in_blue_icons my_posts_action_icons">
                            <path id="Контур_670" data-name="Контур 670" d="M0,0H24V24H0Z" fill="none"/>
                            <path id="Контур_671" data-name="Контур 671" fill="#0a8dd3"
                                  d="M2,5,7,8.5,12,2l5,6.5L22,5V17H2ZM4,8.841V15H20V8.841l-3.42,2.394L12,5.28,7.42,11.235,4,8.84Z"
                                  transform="translate(0 3)"/>
                            <title>{{ translating('post-make-primary') }}</title>
                        </svg>
                    {{--                        <svg data-toggle="modal"--}}
                    {{--                             data-url="{{ route('account-post-make-primary', ['locale' => app()->getLocale(), 'id' => $post['id']]) }}"--}}
                    {{--                             data-target="#postChangePrioritetprimary_{{$post['id']}}"--}}
                    {{--                             class="action makePrimary float-right ml-3 "--}}
                    {{--                             xmlns="http://www.w3.org/2000/svg" width="29.726" height="33.438"--}}
                    {{--                             viewBox="0 0 29.726 33.438">--}}
                    {{--                            <title>{{ translating('post-make-primary') }}</title>--}}
                    {{--                            <g id="fast-forward" transform="matrix(-0.017, -1, 1, -0.017, -62.938, 34.03)">--}}
                    {{--                                <path id="Path_679" data-name="Path 679"--}}
                    {{--                                      d="M225.046,77.236l-9.162-12.8a.941.941,0,0,0-.757-.425h-6.108a1.039,1.039,0,0,0-.93.758,1.543,1.543,0,0,0,.173,1.377l8.549,11.943-8.549,11.941a1.539,1.539,0,0,0-.173,1.377,1.038,1.038,0,0,0,.93.76h6.108a.952.952,0,0,0,.757-.422l9.162-12.8A1.534,1.534,0,0,0,225.046,77.236Z"--}}
                    {{--                                      transform="translate(-193.446)" fill="none" stroke="#09d452" stroke-width="1"/>--}}
                    {{--                                <path id="Path_680" data-name="Path 680"--}}
                    {{--                                      d="M17.046,77.236l-9.162-12.8a.941.941,0,0,0-.757-.425H1.019a1.039,1.039,0,0,0-.93.758,1.543,1.543,0,0,0,.173,1.377L8.81,78.091.262,90.031a1.539,1.539,0,0,0-.173,1.377,1.038,1.038,0,0,0,.93.76H7.127a.952.952,0,0,0,.757-.422l9.162-12.8A1.534,1.534,0,0,0,17.046,77.236Z"--}}
                    {{--                                      transform="translate(0)" fill="none" stroke="#09d452" stroke-width="1"/>--}}
                    {{--                            </g>--}}
                    {{--                        </svg>--}}
                @else
                    <!-- Post is list of Primary -->
                        <svg
                            data-toggle="modal"
                            xmlns="http://www.w3.org/2000/svg" id="_19269646621617453692"
                            data-name="19269646621617453692" width="29.726" height="33.438" viewBox="0 1.5 22 21"
                            {{--                            data-url="{{ route('account-post-make-primary', ['locale' => app()->getLocale(), 'id' => $post['id']]) }}"--}}
                            data-target="#posIsPrimaryActionPostModalCenter"
                            class="action postIsTop float-right ml-3 my_posts_action_icons">
                            <path id="Контур_670" data-name="Контур 670" d="M0,0H24V24H0Z" fill="none"/>
                            <path id="Контур_671" fill="#707070" data-name="Контур 671"
                                  d="M2,5,7,8.5,12,2l5,6.5L22,5V17H2ZM4,8.841V15H20V8.841l-3.42,2.394L12,5.28,7.42,11.235,4,8.84Z"
                                  transform="translate(0 3)"/>
                            <title>{{ translating('post-is-list-of-primary') }}</title>
                        </svg>
                    {{--                        <svg data-toggle="modal" data-target="#posIsPrimaryActionPostModalCenter"--}}
                    {{--                             class="action postIsTop float-right ml-3" xmlns="http://www.w3.org/2000/svg" width="29.726"--}}
                    {{--                             height="33.438" viewBox="0 0 29.726 33.438">--}}
                    {{--                            <title>{{ translating('post-is-list-of-primary') }}</title>--}}
                    {{--                            <g id="fast-forward" transform="matrix(-0.017, -1, 1, -0.017, -62.938, 34.03)">--}}
                    {{--                                <path id="Path_679" data-name="Path 679"--}}
                    {{--                                      d="M225.046,77.236l-9.162-12.8a.941.941,0,0,0-.757-.425h-6.108a1.039,1.039,0,0,0-.93.758,1.543,1.543,0,0,0,.173,1.377l8.549,11.943-8.549,11.941a1.539,1.539,0,0,0-.173,1.377,1.038,1.038,0,0,0,.93.76h6.108a.952.952,0,0,0,.757-.422l9.162-12.8A1.534,1.534,0,0,0,225.046,77.236Z"--}}
                    {{--                                      transform="translate(-193.446)" fill="none" stroke="#727480" stroke-width="1"/>--}}
                    {{--                                <path id="Path_680" data-name="Path 680"--}}
                    {{--                                      d="M17.046,77.236l-9.162-12.8a.941.941,0,0,0-.757-.425H1.019a1.039,1.039,0,0,0-.93.758,1.543,1.543,0,0,0,.173,1.377L8.81,78.091.262,90.031a1.539,1.539,0,0,0-.173,1.377,1.038,1.038,0,0,0,.93.76H7.127a.952.952,0,0,0,.757-.422l9.162-12.8A1.534,1.534,0,0,0,17.046,77.236Z"--}}
                    {{--                                      transform="translate(0)" fill="none" stroke="#727480" stroke-width="1"/>--}}
                    {{--                            </g>--}}
                    {{--                        </svg>--}}
                @endif
                <!-- Check Hurry Status -->
                @if(isset($post['hurry']))
                    @if($post['hurry'] == '0')
                        <!-- Post Make Hurry -->
                            <svg
                                class="action makeHurry float-right ml-3 in_blue_icons my_posts_action_icons"
                                data-toggle="modal"
                                data-target="#postChangePrioritethurry_{{$post['id']}}"
                                data-url="{{ route('account-post-make-hurry', ['locale' => app()->getLocale(), 'id' => $post['id']]) }}"
                                xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 510 430"
                                fill="none">
                                <g clip-path="url(#clip0_28:261)">
                                    <path
                                        d="M330.667 437.333C230.677 437.333 149.333 355.99 149.333 256C149.333 156.01 230.677 74.667 330.667 74.667C430.657 74.667 512 156.01 512 256C512 355.99 430.656 437.333 330.667 437.333ZM330.667 117.333C254.208 117.333 192 179.536 192 256C192 332.464 254.208 394.667 330.667 394.667C407.126 394.667 469.333 332.464 469.333 256C469.333 179.536 407.125 117.333 330.667 117.333V117.333Z"
                                        fill="#0a8dd3"/>
                                    <path
                                        d="M394.667 277.333H330.667C325.009 277.333 319.583 275.085 315.582 271.085C311.581 267.084 309.333 261.658 309.333 256V160C309.372 154.367 311.636 148.978 315.633 145.009C319.629 141.04 325.034 138.812 330.667 138.812C336.299 138.812 341.704 141.04 345.7 145.009C349.697 148.978 351.961 154.367 352 160V234.667H394.667C397.468 234.667 400.243 235.219 402.831 236.291C405.419 237.363 407.771 238.934 409.752 240.915C411.733 242.896 413.304 245.248 414.376 247.836C415.448 250.424 416 253.198 416 256C416 258.801 415.448 261.576 414.376 264.164C413.304 266.752 411.733 269.104 409.752 271.085C407.771 273.066 405.419 274.637 402.831 275.709C400.243 276.781 397.468 277.333 394.667 277.333Z"
                                        fill="#0a8dd3"/>
                                    <path
                                        d="M117.333 192H42.6671C39.8532 192.019 37.0634 191.482 34.4582 190.418C31.8529 189.355 29.4839 187.786 27.4873 185.803C25.4908 183.821 23.9063 181.462 22.825 178.864C21.7437 176.267 21.187 173.48 21.187 170.667C21.187 167.853 21.7437 165.067 22.825 162.469C23.9063 159.871 25.4908 157.512 27.4873 155.53C29.4839 153.547 31.8529 151.978 34.4582 150.915C37.0634 149.851 39.8532 149.314 42.6671 149.333H117.333C120.147 149.314 122.937 149.851 125.542 150.915C128.147 151.978 130.516 153.547 132.513 155.53C134.509 157.512 136.094 159.871 137.175 162.469C138.256 165.067 138.813 167.853 138.813 170.667C138.813 173.48 138.256 176.267 137.175 178.864C136.094 181.462 134.509 183.821 132.513 185.803C130.516 187.786 128.147 189.355 125.542 190.418C122.937 191.482 120.147 192.019 117.333 192V192Z"
                                        fill="#0a8dd3"/>
                                    <path
                                        d="M106.667 277.333H21.333C15.6751 277.333 10.249 275.085 6.24829 271.085C2.24758 267.084 0 261.658 0 256C0 250.342 2.24758 244.916 6.24829 240.915C10.249 236.915 15.6751 234.667 21.333 234.667H106.667C112.325 234.667 117.751 236.915 121.752 240.915C125.752 244.916 128 250.342 128 256C128 261.658 125.752 267.084 121.752 271.085C117.751 275.085 112.325 277.333 106.667 277.333V277.333Z"
                                        fill="#0a8dd3"/>
                                    <path
                                        d="M117.333 362.667H74.6671C71.8532 362.686 69.0634 362.149 66.4582 361.085C63.8529 360.022 61.4839 358.453 59.4873 356.47C57.4908 354.488 55.9063 352.129 54.825 349.531C53.7437 346.934 53.187 344.147 53.187 341.334C53.187 338.52 53.7437 335.733 54.825 333.136C55.9063 330.538 57.4908 328.179 59.4873 326.197C61.4839 324.214 63.8529 322.645 66.4582 321.582C69.0634 320.518 71.8532 319.981 74.6671 320H117.333C120.147 319.981 122.937 320.518 125.542 321.582C128.147 322.645 130.516 324.214 132.513 326.197C134.509 328.179 136.094 330.538 137.175 333.136C138.256 335.733 138.813 338.52 138.813 341.334C138.813 344.147 138.256 346.934 137.175 349.531C136.094 352.129 134.509 354.488 132.513 356.47C130.516 358.453 128.147 360.022 125.542 361.085C122.937 362.149 120.147 362.686 117.333 362.667V362.667Z"
                                        fill="#0a8dd3"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_28:261">
                                        <rect width="512" height="512" fill="white"/>
                                    </clipPath>
                                </defs>
                                <title>{{ translating('post-make-hurry') }}</title>
                            </svg>


                        {{--                            <svg class="action makeHurry float-right ml-3" data-toggle="modal"--}}
                        {{--                                 data-target="#postChangePrioritethurry_{{$post['id']}}"--}}
                        {{--                                 data-url="{{ route('account-post-make-hurry', ['locale' => app()->getLocale(), 'id' => $post['id']]) }}"--}}
                        {{--                                 id="XMLID_1045_" xmlns="http://www.w3.org/2000/svg" width="30.589" height="30.589"--}}
                        {{--                                 viewBox="0 0 30.589 30.589">--}}
                        {{--                                <title>{{ translating('post-make-hurry') }}</title>--}}
                        {{--                                <path id="XMLID_1426_"--}}
                        {{--                                      d="M26.109,4.48a15.293,15.293,0,0,0-21.2-.414L3.622,2.777A.6.6,0,0,0,2.6,3.2V8.716a.6.6,0,0,0,.6.6H8.716a.6.6,0,0,0,.423-1.02L7.786,6.941a11.232,11.232,0,1,1-3.723,8.353.6.6,0,0,0-.6-.6H.6a.6.6,0,0,0-.6.6A15.294,15.294,0,0,0,26.109,26.109a15.295,15.295,0,0,0,0-21.63ZM15.294,29.394a14.117,14.117,0,0,1-14.087-13.5H2.882A12.428,12.428,0,1,0,6.508,6.508a.6.6,0,0,0,0,.845l.766.766H3.8V4.642l.684.684a.6.6,0,0,0,.845,0,14.1,14.1,0,1,1,9.969,24.069Z"--}}
                        {{--                                      transform="translate(0 0)" fill="#0b3363"/>--}}
                        {{--                                <path id="XMLID_1430_"--}}
                        {{--                                      d="M141.153,93.665a.6.6,0,0,0-.845.845l1.634,1.634a2.51,2.51,0,1,0,3.88-.51l3.083-5.355a.6.6,0,1,0-1.035-.6l-3.082,5.353a2.5,2.5,0,0,0-2,.264Z"--}}
                        {{--                                      transform="translate(-128.793 -82.15)" fill="#0b3363"/>--}}
                        {{--                                <path id="XMLID_1480_" d="M289.574,182.812a.6.6,0,1,0,0-1.195h-.818a.6.6,0,0,0,0,1.195Z"--}}
                        {{--                                      transform="translate(-264.84 -166.92)" fill="#0b3363"/>--}}
                        {{--                                <path id="XMLID_1483_" d="M66.384,182.812a.6.6,0,1,0,0-1.195h-.818a.6.6,0,1,0,0,1.195Z"--}}
                        {{--                                      transform="translate(-59.711 -166.92)" fill="#0b3363"/>--}}
                        {{--                                <path id="XMLID_1568_"--}}
                        {{--                                      d="M181.617,288.76v.818a.6.6,0,1,0,1.195,0v-.818a.6.6,0,1,0-1.195,0Z"--}}
                        {{--                                      transform="translate(-166.92 -264.843)" fill="#0b3363"/>--}}
                        {{--                                <path id="XMLID_1569_"--}}
                        {{--                                      d="M182.812,66.655v-.818a.6.6,0,1,0-1.195,0v.818a.6.6,0,1,0,1.195,0Z"--}}
                        {{--                                      transform="translate(-166.92 -59.96)" fill="#0b3363"/>--}}
                        {{--                            </svg>--}}
                    @else
                        <!-- Post is list of hurry -->

                            <svg
                                class="action makeIdhurry float-right ml-3 my_posts_action_icons" data-toggle="modal"
                                data-target="#posIsHurryActionPostModalCenter"
                                {{--                                data-url="{{ route('account-post-make-hurry', ['locale' => app()->getLocale(), 'id' => $post['id']]) }}"--}}
                                xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 510 430"
                                fill="none">
                                <g clip-path="url(#clip0_28:261)">
                                    <path
                                        d="M330.667 437.333C230.677 437.333 149.333 355.99 149.333 256C149.333 156.01 230.677 74.667 330.667 74.667C430.657 74.667 512 156.01 512 256C512 355.99 430.656 437.333 330.667 437.333ZM330.667 117.333C254.208 117.333 192 179.536 192 256C192 332.464 254.208 394.667 330.667 394.667C407.126 394.667 469.333 332.464 469.333 256C469.333 179.536 407.125 117.333 330.667 117.333V117.333Z"
                                        fill="#707070"/>
                                    <path
                                        d="M394.667 277.333H330.667C325.009 277.333 319.583 275.085 315.582 271.085C311.581 267.084 309.333 261.658 309.333 256V160C309.372 154.367 311.636 148.978 315.633 145.009C319.629 141.04 325.034 138.812 330.667 138.812C336.299 138.812 341.704 141.04 345.7 145.009C349.697 148.978 351.961 154.367 352 160V234.667H394.667C397.468 234.667 400.243 235.219 402.831 236.291C405.419 237.363 407.771 238.934 409.752 240.915C411.733 242.896 413.304 245.248 414.376 247.836C415.448 250.424 416 253.198 416 256C416 258.801 415.448 261.576 414.376 264.164C413.304 266.752 411.733 269.104 409.752 271.085C407.771 273.066 405.419 274.637 402.831 275.709C400.243 276.781 397.468 277.333 394.667 277.333Z"
                                        fill="#707070"/>
                                    <path
                                        d="M117.333 192H42.6671C39.8532 192.019 37.0634 191.482 34.4582 190.418C31.8529 189.355 29.4839 187.786 27.4873 185.803C25.4908 183.821 23.9063 181.462 22.825 178.864C21.7437 176.267 21.187 173.48 21.187 170.667C21.187 167.853 21.7437 165.067 22.825 162.469C23.9063 159.871 25.4908 157.512 27.4873 155.53C29.4839 153.547 31.8529 151.978 34.4582 150.915C37.0634 149.851 39.8532 149.314 42.6671 149.333H117.333C120.147 149.314 122.937 149.851 125.542 150.915C128.147 151.978 130.516 153.547 132.513 155.53C134.509 157.512 136.094 159.871 137.175 162.469C138.256 165.067 138.813 167.853 138.813 170.667C138.813 173.48 138.256 176.267 137.175 178.864C136.094 181.462 134.509 183.821 132.513 185.803C130.516 187.786 128.147 189.355 125.542 190.418C122.937 191.482 120.147 192.019 117.333 192V192Z"
                                        fill="#707070"/>
                                    <path
                                        d="M106.667 277.333H21.333C15.6751 277.333 10.249 275.085 6.24829 271.085C2.24758 267.084 0 261.658 0 256C0 250.342 2.24758 244.916 6.24829 240.915C10.249 236.915 15.6751 234.667 21.333 234.667H106.667C112.325 234.667 117.751 236.915 121.752 240.915C125.752 244.916 128 250.342 128 256C128 261.658 125.752 267.084 121.752 271.085C117.751 275.085 112.325 277.333 106.667 277.333V277.333Z"
                                        fill="#707070"/>
                                    <path
                                        d="M117.333 362.667H74.6671C71.8532 362.686 69.0634 362.149 66.4582 361.085C63.8529 360.022 61.4839 358.453 59.4873 356.47C57.4908 354.488 55.9063 352.129 54.825 349.531C53.7437 346.934 53.187 344.147 53.187 341.334C53.187 338.52 53.7437 335.733 54.825 333.136C55.9063 330.538 57.4908 328.179 59.4873 326.197C61.4839 324.214 63.8529 322.645 66.4582 321.582C69.0634 320.518 71.8532 319.981 74.6671 320H117.333C120.147 319.981 122.937 320.518 125.542 321.582C128.147 322.645 130.516 324.214 132.513 326.197C134.509 328.179 136.094 330.538 137.175 333.136C138.256 335.733 138.813 338.52 138.813 341.334C138.813 344.147 138.256 346.934 137.175 349.531C136.094 352.129 134.509 354.488 132.513 356.47C130.516 358.453 128.147 360.022 125.542 361.085C122.937 362.149 120.147 362.686 117.333 362.667V362.667Z"
                                        fill="#707070"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_28:261">
                                        <rect width="512" height="512" fill="white"/>
                                    </clipPath>
                                </defs>
                                <title>{{ translating('post-is-list-of-hurries') }}</title>
                            </svg>

                            {{--                            <svg data-toggle="modal" data-target="#posIsHurryActionPostModalCenter"--}}
                            {{--                                 class="makeIdhurry action float-right ml-3" id="XMLID_1045_"--}}
                            {{--                                 xmlns="http://www.w3.org/2000/svg"--}}
                            {{--                                 width="30.589" height="30.589" viewBox="0 0 30.589 30.589">--}}
                            {{--                                <title>{{ translating('post-is-list-of-hurries') }}</title>--}}
                            {{--                                <path id="XMLID_1426_"--}}
                            {{--                                      d="M26.109,4.48a15.293,15.293,0,0,0-21.2-.414L3.622,2.777A.6.6,0,0,0,2.6,3.2V8.716a.6.6,0,0,0,.6.6H8.716a.6.6,0,0,0,.423-1.02L7.786,6.941a11.232,11.232,0,1,1-3.723,8.353.6.6,0,0,0-.6-.6H.6a.6.6,0,0,0-.6.6A15.294,15.294,0,0,0,26.109,26.109a15.295,15.295,0,0,0,0-21.63ZM15.294,29.394a14.117,14.117,0,0,1-14.087-13.5H2.882A12.428,12.428,0,1,0,6.508,6.508a.6.6,0,0,0,0,.845l.766.766H3.8V4.642l.684.684a.6.6,0,0,0,.845,0,14.1,14.1,0,1,1,9.969,24.069Z"--}}
                            {{--                                      transform="translate(0 0)" fill="707070"/>--}}
                            {{--                                <path id="XMLID_1430_"--}}
                            {{--                                      d="M141.153,93.665a.6.6,0,0,0-.845.845l1.634,1.634a2.51,2.51,0,1,0,3.88-.51l3.083-5.355a.6.6,0,1,0-1.035-.6l-3.082,5.353a2.5,2.5,0,0,0-2,.264Z"--}}
                            {{--                                      transform="translate(-128.793 -82.15)" fill="#707070"/>--}}
                            {{--                                <path id="XMLID_1480_" d="M289.574,182.812a.6.6,0,1,0,0-1.195h-.818a.6.6,0,0,0,0,1.195Z"--}}
                            {{--                                      transform="translate(-264.84 -166.92)" fill="#707070"/>--}}
                            {{--                                <path id="XMLID_1483_" d="M66.384,182.812a.6.6,0,1,0,0-1.195h-.818a.6.6,0,1,0,0,1.195Z"--}}
                            {{--                                      transform="translate(-59.711 -166.92)" fill="#707070"/>--}}
                            {{--                                <path id="XMLID_1568_"--}}
                            {{--                                      d="M181.617,288.76v.818a.6.6,0,1,0,1.195,0v-.818a.6.6,0,1,0-1.195,0Z"--}}
                            {{--                                      transform="translate(-166.92 -264.843)" fill="#707070"/>--}}
                            {{--                                <path id="XMLID_1569_"--}}
                            {{--                                      d="M182.812,66.655v-.818a.6.6,0,1,0-1.195,0v.818a.6.6,0,1,0,1.195,0Z"--}}
                            {{--                                      transform="translate(-166.92 -59.96)" fill="#707070"/>--}}
                            {{--                            </svg>--}}
                        @endif
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
{{--@dump($post)--}}
<!-- Delete Modal -->
<div class="modal fade" id="deletPostModalCenter" tabindex="-1" role="dialog"
     aria-labelledby="deletPostModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold"
                    id="deletPostModalLongTitle">{{ translating('post-delete-are-you-sure-?') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg id="close" xmlns="http://www.w3.org/2000/svg" width="31.808" height="31.807"
                         viewBox="0 0 31.808 31.807">
                        <g id="Group_1179" data-name="Group 1179">
                            <g id="Group_1178" data-name="Group 1178">
                                <path id="Path_480" data-name="Path 480"
                                      d="M30.482,14.578A1.326,1.326,0,0,0,29.157,15.9a13.253,13.253,0,1,1-3.849-9.338A1.325,1.325,0,1,0,27.189,4.7,15.9,15.9,0,1,0,31.808,15.9,1.326,1.326,0,0,0,30.482,14.578Z"
                                      fill="#747474"/>
                            </g>
                        </g>
                        <g id="Group_1181" data-name="Group 1181" transform="translate(10.603 10.603)">
                            <g id="Group_1180" data-name="Group 1180">
                                <path id="Path_481" data-name="Path 481"
                                      d="M135.177,133.3l3.039-3.039a1.325,1.325,0,0,0-1.874-1.874l-3.039,3.039-3.039-3.039a1.325,1.325,0,0,0-1.874,1.874l3.039,3.039-3.039,3.039a1.325,1.325,0,1,0,1.874,1.874l3.039-3.039,3.039,3.039a1.325,1.325,0,0,0,1.874-1.874Z"
                                      transform="translate(-128.002 -128.002)" fill="#747474"/>
                            </g>
                        </g>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <!-- Content -->
                <div class="row">
                    <!-- Image -->
                    <div class="col-md-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="d-block mx-auto" width="73.641" height="92.949"
                             viewBox="0 0 73.641 92.949">
                            <g id="delete" transform="translate(0)">
                                <path id="Path_491" data-name="Path 491"
                                      d="M223.025,154.7a.627.627,0,0,0-.627.627v11.85a.627.627,0,0,0,1.254,0V155.33A.627.627,0,0,0,223.025,154.7Zm0,0"
                                      transform="translate(-205.829 -141.776)" fill="#f11"/>
                                <path id="Path_492" data-name="Path 492"
                                      d="M105.025,154.7a.627.627,0,0,0-.627.627v11.85a.627.627,0,0,0,1.254,0V155.33A.627.627,0,0,0,105.025,154.7Zm0,0"
                                      transform="translate(-96.62 -141.776)" fill="#f11"/>
                                <path id="Path_493" data-name="Path 493"
                                      d="M2.093,8.93V26.239a3.774,3.774,0,0,0,1.083,2.673A3.725,3.725,0,0,0,5.814,30H19.781a3.724,3.724,0,0,0,2.638-1.085A3.774,3.774,0,0,0,23.5,26.239V8.93a2.69,2.69,0,0,0,2.073-2.941,2.777,2.777,0,0,0-2.8-2.337H19V2.774A2.694,2.694,0,0,0,18.146.8,2.978,2.978,0,0,0,16.075,0H9.52A2.978,2.978,0,0,0,7.448.8,2.694,2.694,0,0,0,6.6,2.774v.878H2.817a2.777,2.777,0,0,0-2.8,2.337A2.69,2.69,0,0,0,2.093,8.93ZM19.781,28.592H5.814A2.273,2.273,0,0,1,3.57,26.239V8.991H22.025V26.239a2.273,2.273,0,0,1-2.244,2.354ZM8.073,2.774A1.32,1.32,0,0,1,8.492,1.8,1.46,1.46,0,0,1,9.52,1.4h6.555A1.46,1.46,0,0,1,17.1,1.8a1.319,1.319,0,0,1,.419.976v.878H8.073ZM2.817,5.057H22.778a1.3,1.3,0,0,1,1.329,1.265,1.3,1.3,0,0,1-1.329,1.265H2.817A1.3,1.3,0,0,1,1.488,6.322,1.3,1.3,0,0,1,2.817,5.057Zm0,0"
                                      transform="translate(0.003 0.002)" fill="#f11"/>
                                <path id="Path_494" data-name="Path 494"
                                      d="M164.025,154.7a.627.627,0,0,0-.627.627v11.85a.627.627,0,0,0,1.254,0V155.33A.627.627,0,0,0,164.025,154.7Zm0,0"
                                      transform="translate(-151.224 -141.776)" fill="#f11"/>
                            </g>
                        </svg>
                    </div>

                    <!-- Information -->
                    <div class="col-md-9 offset-md-1 pr-5">
                        <!-- Title -->
                        <h5 class="w-100 font-weight-bold delete-modal-title">{{ $post['title'] }}</h5>

                        <!-- Description -->
                        <p class="w-100 mt-2">{!! translating('post-delete-modal-description') !!}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <!-- Delete -->
                <a data-href="{{ route('account-post-delete', ['locale' => app()->getLocale()]) }}"
                   href="{{ route('account-post-delete', ['locale' => app()->getLocale()]) }}"
                   class="d-block btn delete-action btn-danger">{{ translating('delete-post') }}</a>
            </div>
        </div>
    </div>
</div>

<!-- Update Access Modal -->
<div class="modal fade" id="updatePostModalCenter" tabindex="-1" role="dialog"
     aria-labelledby="updatePostModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold"
                    id="updatePostModalLongTitle">{{ translating('post-updated') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg id="close" xmlns="http://www.w3.org/2000/svg" width="31.808" height="31.807"
                         viewBox="0 0 31.808 31.807">
                        <g id="Group_1179" data-name="Group 1179">
                            <g id="Group_1178" data-name="Group 1178">
                                <path id="Path_480" data-name="Path 480"
                                      d="M30.482,14.578A1.326,1.326,0,0,0,29.157,15.9a13.253,13.253,0,1,1-3.849-9.338A1.325,1.325,0,1,0,27.189,4.7,15.9,15.9,0,1,0,31.808,15.9,1.326,1.326,0,0,0,30.482,14.578Z"
                                      fill="#747474"/>
                            </g>
                        </g>
                        <g id="Group_1181" data-name="Group 1181" transform="translate(10.603 10.603)">
                            <g id="Group_1180" data-name="Group 1180">
                                <path id="Path_481" data-name="Path 481"
                                      d="M135.177,133.3l3.039-3.039a1.325,1.325,0,0,0-1.874-1.874l-3.039,3.039-3.039-3.039a1.325,1.325,0,0,0-1.874,1.874l3.039,3.039-3.039,3.039a1.325,1.325,0,1,0,1.874,1.874l3.039-3.039,3.039,3.039a1.325,1.325,0,0,0,1.874-1.874Z"
                                      transform="translate(-128.002 -128.002)" fill="#747474"/>
                            </g>
                        </g>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <!-- Content -->
                <div class="row">
                    <!-- Image -->
                    <div class="col-md-2">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             width="73.641" height="92.949" viewBox="0 0 73.641 92.949">
                            <defs>
                                <clipPath id="clip-path">
                                    <rect width="73.641" height="92.949" fill="none"/>
                                </clipPath>
                            </defs>
                            <g id="surface1" clip-path="url(#clip-path)">
                                <g id="surface1-2" data-name="surface1" transform="translate(-0.5)">
                                    <path id="Path_483" data-name="Path 483"
                                          d="M128.372,401.934H91.417a2.245,2.245,0,1,0,0,4.49h36.978a2.245,2.245,0,1,0-.023-4.49Zm0,0"
                                          transform="translate(-72.574 -328.966)" fill="#09b387"/>
                                    <g id="Group_1457" data-name="Group 1457">
                                        <g id="Group_1456" data-name="Group 1456">
                                            <path id="Path_482" data-name="Path 482"
                                                  d="M50.589.718A2.249,2.249,0,0,0,48.973,0H12.714A12.265,12.265,0,0,0,.5,12.191V80.758A12.265,12.265,0,0,0,12.714,92.949H61.927A12.265,12.265,0,0,0,74.141,80.758V26.313a2.416,2.416,0,0,0-.651-1.571Zm.651,7.207,15.335,16.1H56.606A5.347,5.347,0,0,1,51.24,18.68ZM61.927,88.459H12.714a7.777,7.777,0,0,1-7.723-7.7V12.191a7.777,7.777,0,0,1,7.723-7.7H46.75V18.68a9.822,9.822,0,0,0,9.856,9.834H69.65V80.758A7.762,7.762,0,0,1,61.927,88.459Zm0,0"
                                                  fill="#09b387"/>
                                        </g>
                                        <path id="Path_484" data-name="Path 484"
                                              d="M122.306,188.191l9.25-9.947v24.517a2.245,2.245,0,0,0,4.49,0V178.244l9.25,9.947a2.24,2.24,0,0,0,3.278-3.054l-13.157-14.122a2.229,2.229,0,0,0-3.278,0l-13.157,14.122a2.237,2.237,0,0,0,.112,3.165A2.291,2.291,0,0,0,122.306,188.191Zm0,0"
                                              transform="translate(-96.48 -139.381)" fill="#09b387"/>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>

                    <!-- Information -->
                    <div class="col-md-9 offset-md-1 pr-5">
                        <!-- Title -->
                        <h5 class="w-100 font-weight-bold card-title">{{ $post['title'] }}</h5>

                        <!-- Description -->
                        <p class="w-100 mt-2">{!! translating('post-update-modal-description') !!}</p>

                        <!-- Process -->
                        <div class="w-100 mt-5">
                            <!-- Updates -->
                            <div class="row w-100 no-gutters">
                                <span class="w-50 text-left float-left">{{ translating('updates') }}</span>
                                <span class="w-50 text-right float-right updates-count">0</span>
                            </div>
                            <hr>

                            <!-- Update Price -->
                            <div class="row w-100 no-gutters">
                                <span class="w-50 text-left float-left">{{ translating('update-price') }}</span>
                                <span class="w-50 text-right float-right">{{ translating('free') }}</span>
                            </div>
                            <hr>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <!-- Update -->
                <a data-href="{{ route('account-post-update', ['locale' => app()->getLocale()]) }}"
                   href="{{ route('account-post-update', ['locale' => app()->getLocale()]) }}"
                   class="update-action d-block btn btn-main text-light">{{ translating('update-post') }}</a>
            </div>
        </div>
    </div>
</div>

<!-- Update Access Disabled Modal -->
<div class="modal fade" id="updatePostModalDisabledCenter" tabindex="-1" role="dialog"
     aria-labelledby="updatePostModalDisabledCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold"
                    id="updatePostModalDisabledLongTitle">{{ translating('post-updated') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg id="close" xmlns="http://www.w3.org/2000/svg" width="31.808" height="31.807"
                         viewBox="0 0 31.808 31.807">
                        <g id="Group_1179" data-name="Group 1179">
                            <g id="Group_1178" data-name="Group 1178">
                                <path id="Path_480" data-name="Path 480"
                                      d="M30.482,14.578A1.326,1.326,0,0,0,29.157,15.9a13.253,13.253,0,1,1-3.849-9.338A1.325,1.325,0,1,0,27.189,4.7,15.9,15.9,0,1,0,31.808,15.9,1.326,1.326,0,0,0,30.482,14.578Z"
                                      fill="#747474"/>
                            </g>
                        </g>
                        <g id="Group_1181" data-name="Group 1181" transform="translate(10.603 10.603)">
                            <g id="Group_1180" data-name="Group 1180">
                                <path id="Path_481" data-name="Path 481"
                                      d="M135.177,133.3l3.039-3.039a1.325,1.325,0,0,0-1.874-1.874l-3.039,3.039-3.039-3.039a1.325,1.325,0,0,0-1.874,1.874l3.039,3.039-3.039,3.039a1.325,1.325,0,1,0,1.874,1.874l3.039-3.039,3.039,3.039a1.325,1.325,0,0,0,1.874-1.874Z"
                                      transform="translate(-128.002 -128.002)" fill="#747474"/>
                            </g>
                        </g>
                    </svg>
                </button>
            </div>
            <div class="modal-body pb-4">
                <!-- Content -->
                <div class="row">
                    <!-- Image -->
                    <div class="col-md-2">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             width="73.641" height="92.949" viewBox="0 0 73.641 92.949">
                            <defs>
                                <clipPath id="clip-path">
                                    <rect width="73.641" height="92.949" fill="none"/>
                                </clipPath>
                            </defs>
                            <g id="surface1" clip-path="url(#clip-path)">
                                <g id="surface1-2" data-name="surface1" transform="translate(-0.5)">
                                    <path id="Path_483" data-name="Path 483"
                                          d="M128.372,401.934H91.417a2.245,2.245,0,1,0,0,4.49h36.978a2.245,2.245,0,1,0-.023-4.49Zm0,0"
                                          transform="translate(-72.574 -328.966)" fill="#707070"/>
                                    <g id="Group_1457" data-name="Group 1457">
                                        <g id="Group_1456" data-name="Group 1456">
                                            <path id="Path_482" data-name="Path 482"
                                                  d="M50.589.718A2.249,2.249,0,0,0,48.973,0H12.714A12.265,12.265,0,0,0,.5,12.191V80.758A12.265,12.265,0,0,0,12.714,92.949H61.927A12.265,12.265,0,0,0,74.141,80.758V26.313a2.416,2.416,0,0,0-.651-1.571Zm.651,7.207,15.335,16.1H56.606A5.347,5.347,0,0,1,51.24,18.68ZM61.927,88.459H12.714a7.777,7.777,0,0,1-7.723-7.7V12.191a7.777,7.777,0,0,1,7.723-7.7H46.75V18.68a9.822,9.822,0,0,0,9.856,9.834H69.65V80.758A7.762,7.762,0,0,1,61.927,88.459Zm0,0"
                                                  fill="#707070"/>
                                        </g>
                                        <path id="Path_484" data-name="Path 484"
                                              d="M122.306,188.191l9.25-9.947v24.517a2.245,2.245,0,0,0,4.49,0V178.244l9.25,9.947a2.24,2.24,0,0,0,3.278-3.054l-13.157-14.122a2.229,2.229,0,0,0-3.278,0l-13.157,14.122a2.237,2.237,0,0,0,.112,3.165A2.291,2.291,0,0,0,122.306,188.191Zm0,0"
                                              transform="translate(-96.48 -139.381)" fill="#707070"/>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>

                    <!-- Information -->
                    <div class="col-md-9 offset-md-1 pr-5">
                        <!-- Title -->
                        <h5 class="w-100 font-weight-bold card-title">{{ translating('your-post-updated-at') }}
                            &nbsp;<span class="last-update-date pl-2">00 / 00 / 00</span></h5>

                        <!-- Description -->
                        <h6 class="w-100 mt-2 text-center text-dark">{!! translating('post-update-modal-description') !!}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Post Make Passive Modal -->
<div class="modal fade" id="passivationActionPostModalCenter" tabindex="-1" role="dialog"
     aria-labelledby="passivationActionPostModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold"
                    id="passivationActionPostModalLongTitle">{{ translating('post-passivation-title') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg id="close" xmlns="http://www.w3.org/2000/svg" width="31.808" height="31.807"
                         viewBox="0 0 31.808 31.807">
                        <g id="Group_1179" data-name="Group 1179">
                            <g id="Group_1178" data-name="Group 1178">
                                <path id="Path_480" data-name="Path 480"
                                      d="M30.482,14.578A1.326,1.326,0,0,0,29.157,15.9a13.253,13.253,0,1,1-3.849-9.338A1.325,1.325,0,1,0,27.189,4.7,15.9,15.9,0,1,0,31.808,15.9,1.326,1.326,0,0,0,30.482,14.578Z"
                                      fill="#747474"/>
                            </g>
                        </g>
                        <g id="Group_1181" data-name="Group 1181" transform="translate(10.603 10.603)">
                            <g id="Group_1180" data-name="Group 1180">
                                <path id="Path_481" data-name="Path 481"
                                      d="M135.177,133.3l3.039-3.039a1.325,1.325,0,0,0-1.874-1.874l-3.039,3.039-3.039-3.039a1.325,1.325,0,0,0-1.874,1.874l3.039,3.039-3.039,3.039a1.325,1.325,0,1,0,1.874,1.874l3.039-3.039,3.039,3.039a1.325,1.325,0,0,0,1.874-1.874Z"
                                      transform="translate(-128.002 -128.002)" fill="#747474"/>
                            </g>
                        </g>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <!-- Content -->
                <div class="row">
                    <!-- Image -->
                    <div class="col-md-2">
                        <svg class="d-block mx-auto" id="reload" xmlns="http://www.w3.org/2000/svg" width="73.094"
                             height="79.944" viewBox="0 0 73.094 79.944">
                            <g id="Group_1161" data-name="Group 1161" transform="translate(0 0)">
                                <path id="Path_458" data-name="Path 458"
                                      d="M35.866,15.853A31.87,31.87,0,0,1,77.3,14.759l-9.485.359a2.2,2.2,0,0,0,.082,4.408h.082l14.562-.539a2.2,2.2,0,0,0,2.122-2.2v-.261h0l-.539-14.4a2.205,2.205,0,0,0-4.408.163l.343,9.028a36.247,36.247,0,0,0-47.146,1.273,36.26,36.26,0,0,0-10.9,35.441,2.194,2.194,0,0,0,2.139,1.681,1.91,1.91,0,0,0,.522-.065,2.207,2.207,0,0,0,1.616-2.661A31.851,31.851,0,0,1,35.866,15.853Z"
                                      transform="translate(-20.982 0)" fill="#707070"/>
                                <path id="Path_459" data-name="Path 459"
                                      d="M140.173,186.9a2.2,2.2,0,1,0-4.277,1.045,31.846,31.846,0,0,1-51.276,32.013l9.6-.865a2.205,2.205,0,0,0-.408-4.391L79.3,216a2.2,2.2,0,0,0-1.992,2.4l1.306,14.513a2.2,2.2,0,0,0,2.188,2.008.8.8,0,0,0,.2-.016,2.2,2.2,0,0,0,1.992-2.4l-.784-8.832a36,36,0,0,0,20.945,7.983c.62.033,1.241.049,1.845.049a36.253,36.253,0,0,0,35.18-44.811Z"
                                      transform="translate(-68.103 -154.978)" fill="#707070"/>
                            </g>
                        </svg>
                    </div>

                    <!-- Information -->
                    <div class="col-md-9 offset-md-1 pr-5">
                        <!-- Title -->
                        <h5 class="w-100 font-weight-bold passivation-modal-title">{{ $post['title'] }}</h5>

                        <!-- Description -->
                        <p class="w-100 mt-4">{!! translating('post-passivation-modal-description') !!}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <!-- Passivation -->
                <a data-href="{{ route('account-post-make-passive', ['locale' => app()->getLocale()]) }}"
                   href="{{ route('account-post-make-passive', ['locale' => app()->getLocale()]) }}"
                   class="d-block btn passivation-action btn-secondary text-light">{{ translating('passivate-post') }}</a>
            </div>
        </div>
    </div>
</div>

<!-- Post Make Active Modal -->
<div class="modal fade" id="activationActionPostModalCenter" tabindex="-1" role="dialog"
     aria-labelledby="activationActionPostModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold"
                    id="activationActionPostModalLongTitle">{{ translating('post-activation-title') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg id="close" xmlns="http://www.w3.org/2000/svg" width="31.808" height="31.807"
                         viewBox="0 0 31.808 31.807">
                        <g id="Group_1179" data-name="Group 1179">
                            <g id="Group_1178" data-name="Group 1178">
                                <path id="Path_480" data-name="Path 480"
                                      d="M30.482,14.578A1.326,1.326,0,0,0,29.157,15.9a13.253,13.253,0,1,1-3.849-9.338A1.325,1.325,0,1,0,27.189,4.7,15.9,15.9,0,1,0,31.808,15.9,1.326,1.326,0,0,0,30.482,14.578Z"
                                      fill="#747474"/>
                            </g>
                        </g>
                        <g id="Group_1181" data-name="Group 1181" transform="translate(10.603 10.603)">
                            <g id="Group_1180" data-name="Group 1180">
                                <path id="Path_481" data-name="Path 481"
                                      d="M135.177,133.3l3.039-3.039a1.325,1.325,0,0,0-1.874-1.874l-3.039,3.039-3.039-3.039a1.325,1.325,0,0,0-1.874,1.874l3.039,3.039-3.039,3.039a1.325,1.325,0,1,0,1.874,1.874l3.039-3.039,3.039,3.039a1.325,1.325,0,0,0,1.874-1.874Z"
                                      transform="translate(-128.002 -128.002)" fill="#747474"/>
                            </g>
                        </g>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <!-- Content -->
                <div class="row">
                    <!-- Image -->
                    <div class="col-md-2">
                        <svg class="d-block mx-auto" id="reload" xmlns="http://www.w3.org/2000/svg" width="73.094"
                             height="79.944" viewBox="0 0 73.094 79.944">
                            <g id="Group_1161" data-name="Group 1161" transform="translate(0 0)">
                                <path id="Path_458" data-name="Path 458"
                                      d="M35.866,15.853A31.87,31.87,0,0,1,77.3,14.759l-9.485.359a2.2,2.2,0,0,0,.082,4.408h.082l14.562-.539a2.2,2.2,0,0,0,2.122-2.2v-.261h0l-.539-14.4a2.205,2.205,0,0,0-4.408.163l.343,9.028a36.247,36.247,0,0,0-47.146,1.273,36.26,36.26,0,0,0-10.9,35.441,2.194,2.194,0,0,0,2.139,1.681,1.91,1.91,0,0,0,.522-.065,2.207,2.207,0,0,0,1.616-2.661A31.851,31.851,0,0,1,35.866,15.853Z"
                                      transform="translate(-20.982 0)" fill="#707070"/>
                                <path id="Path_459" data-name="Path 459"
                                      d="M140.173,186.9a2.2,2.2,0,1,0-4.277,1.045,31.846,31.846,0,0,1-51.276,32.013l9.6-.865a2.205,2.205,0,0,0-.408-4.391L79.3,216a2.2,2.2,0,0,0-1.992,2.4l1.306,14.513a2.2,2.2,0,0,0,2.188,2.008.8.8,0,0,0,.2-.016,2.2,2.2,0,0,0,1.992-2.4l-.784-8.832a36,36,0,0,0,20.945,7.983c.62.033,1.241.049,1.845.049a36.253,36.253,0,0,0,35.18-44.811Z"
                                      transform="translate(-68.103 -154.978)" fill="#707070"/>
                            </g>
                        </svg>
                    </div>

                    <!-- Information -->
                    <div class="col-md-9 offset-md-1 pr-5">
                        <!-- Title -->
                        <h5 class="w-100 font-weight-bold activation-modal-title">{{ $post['title'] }}</h5>

                        <!-- Description -->
                        <p class="w-100 mt-4">{!! translating('post-activation-modal-description') !!}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <!-- Activation -->
                <a data-href="{{ route('account-post-make-active', ['locale' => app()->getLocale()]) }}"
                   href="{{ route('account-post-make-active', ['locale' => app()->getLocale()]) }}"
                   class="d-block btn activation-action btn-main text-light">{{ translating('activate-post') }}</a>
            </div>
        </div>
    </div>
</div>


<!-- Check data -->

@if(isset($post_priorities) && count($post_priorities) > 0)
    <!-- Loop from posts -->

    @foreach($post_priorities as $key => $priority)
        {{--        @dump($priority)--}}
        <!-- Post Make Top Modal -->
        <div class="modal fade" id="postChangePrioritet{{ $priority->type }}_{{$post['id']}}" tabindex="-1"
             role="dialog"
             aria-labelledby="postChangePrioritet{{ $priority->type }}Title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold"
                            id="postChangePrioritetLongTitle{{ $priority->type }}">{{ translating('create-post-more-important-process') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <svg id="close" xmlns="http://www.w3.org/2000/svg" width="31.808" height="31.807"
                                 viewBox="0 0 31.808 31.807">
                                <g id="Group_1179" data-name="Group 1179">
                                    <g id="Group_1178" data-name="Group 1178">
                                        <path id="Path_480" data-name="Path 480"
                                              d="M30.482,14.578A1.326,1.326,0,0,0,29.157,15.9a13.253,13.253,0,1,1-3.849-9.338A1.325,1.325,0,1,0,27.189,4.7,15.9,15.9,0,1,0,31.808,15.9,1.326,1.326,0,0,0,30.482,14.578Z"
                                              fill="#747474"/>
                                    </g>
                                </g>
                                <g id="Group_1457" data-name="Group 1457">
                                    <g id="Group_1181" data-name="Group 1181" transform="translate(10.603 10.604)">
                                        <g id="Group_1180" data-name="Group 1180">
                                            <path id="Path_481" data-name="Path 481"
                                                  d="M135.177,133.3l3.039-3.039a1.325,1.325,0,0,0-1.874-1.874l-3.039,3.039-3.039-3.039a1.325,1.325,0,0,0-1.874,1.874l3.039,3.039-3.039,3.039a1.325,1.325,0,1,0,1.874,1.874l3.039-3.039,3.039,3.039a1.325,1.325,0,0,0,1.874-1.874Z"
                                                  transform="translate(-128.002 -128.002)" fill="#747474"/>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body w-100 text-center">
                        <!-- Descripiton -->
                        <p>{!! $priority->{'description_'.app()->getLocale()} !!}</p>

                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-border table-hover">
                                <tbody>
                                <tr>
                                    <td class="font-weight-bold">{{ translating('balance') }}</td>
                                    <td class="font-weight-bold">{{ price_handler(Auth::user()->wallet['balance'], $currency['id']) }}</td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold">{{ translating('action-price') }}</td>
                                    <td class="font-weight-bold">{{ price_handler($priority->price, $currency['id']) }}</td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold">{{ translating('pay-now') }}</td>
                                    <td class="font-weight-bold">
                                        <!-- Get Field Name -->
                                    @php $field_name = $priority->type; @endphp

                                    <!-- Check data -->
                                    {{--                                    @dump($field_name)--}}
                                    @if(isset($post[$field_name]) && $post[$field_name] == 1)

                                        <!-- Already  maked -->
                                            <a href="javascript:void(0)" disabled
                                               data-id="{{ $post['id'] }}"
                                               class="disbled btn btn-secondary text-light w-100">{{ translating('your-post-is-maked-'.$priority->type) }}</a>
                                    @else


                                        <!-- Pay Button -->
                                            <a post-maked-top-text="{{ translating('post-maked-top-text') }}"
                                               href="{{ route('account-post-make-'.$priority->type, ['locale' => app()->getLocale(), 'id' => $post['id']]) }}"
                                               class="makeTopAction btn btn-success text-light w-100"
                                               post-maked-top-text="{{ translating('post-maked-top-text') }}">{{ translating('pay') }}</a>
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

<!-- Post is list of tops Modal -->
<div class="modal fade" id="posIsTopActionPostModalCenter" tabindex="-1" role="dialog"
     aria-labelledby="posIsTopActionPostModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold"
                    id="posIsTopActionPostModalLongTitle">{{ translating('post-is-list-of-tops') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg id="close" xmlns="http://www.w3.org/2000/svg" width="31.808" height="31.807"
                         viewBox="0 0 31.808 31.807">
                        <g id="Group_1179" data-name="Group 1179">
                            <g id="Group_1178" data-name="Group 1178">
                                <path id="Path_480" data-name="Path 480"
                                      d="M30.482,14.578A1.326,1.326,0,0,0,29.157,15.9a13.253,13.253,0,1,1-3.849-9.338A1.325,1.325,0,1,0,27.189,4.7,15.9,15.9,0,1,0,31.808,15.9,1.326,1.326,0,0,0,30.482,14.578Z"
                                      fill="#747474"/>
                            </g>
                        </g>
                        <g id="Group_1181" data-name="Group 1181" transform="translate(10.603 10.603)">
                            <g id="Group_1180" data-name="Group 1180">
                                <path id="Path_481" data-name="Path 481"
                                      d="M135.177,133.3l3.039-3.039a1.325,1.325,0,0,0-1.874-1.874l-3.039,3.039-3.039-3.039a1.325,1.325,0,0,0-1.874,1.874l3.039,3.039-3.039,3.039a1.325,1.325,0,1,0,1.874,1.874l3.039-3.039,3.039,3.039a1.325,1.325,0,0,0,1.874-1.874Z"
                                      transform="translate(-128.002 -128.002)" fill="#747474"/>
                            </g>
                        </g>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <!-- Content -->
                <div class="row">
                    <!-- Image -->
                    <div class="col-md-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="85.729" height="96.541"
                             viewBox="0 0 85.729 96.541">
                            <g id="fast-forward" transform="matrix(-0.017, -1, 1, -0.017, -61.362, 96.594)">
                                <path id="Path_679" data-name="Path 679"
                                      d="M257.693,102.562l-26.709-37.31a2.744,2.744,0,0,0-2.208-1.239H210.971a3.029,3.029,0,0,0-2.712,2.209,4.5,4.5,0,0,0,.5,4.015l24.922,34.818-24.922,34.81a4.487,4.487,0,0,0-.5,4.015,3.027,3.027,0,0,0,2.712,2.216h17.806a2.775,2.775,0,0,0,2.208-1.231l26.709-37.31A4.473,4.473,0,0,0,257.693,102.562Z"
                                      transform="translate(-165.571 0)" fill="none" stroke="#707070" stroke-width="2"/>
                                <path id="Path_680" data-name="Path 680"
                                      d="M49.693,102.562,22.985,65.252a2.745,2.745,0,0,0-2.208-1.239H2.971A3.029,3.029,0,0,0,.259,66.222a4.5,4.5,0,0,0,.5,4.015l24.922,34.818L.763,139.864a4.487,4.487,0,0,0-.5,4.015A3.027,3.027,0,0,0,2.971,146.1H20.777a2.776,2.776,0,0,0,2.208-1.231l26.709-37.31A4.473,4.473,0,0,0,49.693,102.562Z"
                                      transform="translate(0 0)" fill="none" stroke="#707070" stroke-width="2"/>
                            </g>
                        </svg>
                    </div>

                    <!-- Description -->
                    <div class="col-10">
                        <p class="w-100 mt-4 text-center">{!! translating('post-is-list-of-tops-modal-description') !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Post is list of hurries Modal -->
<div class="modal fade" id="posIsHurryActionPostModalCenter" tabindex="-1" role="dialog"
     aria-labelledby="posIsHurryActionPostModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold"
                    id="posIsHurryActionPostModalLongTitle">{{ translating('post-is-list-of-hurries') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg id="close" xmlns="http://www.w3.org/2000/svg" width="31.808" height="31.807"
                         viewBox="0 0 31.808 31.807">
                        <g id="Group_1179" data-name="Group 1179">
                            <g id="Group_1178" data-name="Group 1178">
                                <path id="Path_480" data-name="Path 480"
                                      d="M30.482,14.578A1.326,1.326,0,0,0,29.157,15.9a13.253,13.253,0,1,1-3.849-9.338A1.325,1.325,0,1,0,27.189,4.7,15.9,15.9,0,1,0,31.808,15.9,1.326,1.326,0,0,0,30.482,14.578Z"
                                      fill="#747474"/>
                            </g>
                        </g>
                        <g id="Group_1181" data-name="Group 1181" transform="translate(10.603 10.603)">
                            <g id="Group_1180" data-name="Group 1180">
                                <path id="Path_481" data-name="Path 481"
                                      d="M135.177,133.3l3.039-3.039a1.325,1.325,0,0,0-1.874-1.874l-3.039,3.039-3.039-3.039a1.325,1.325,0,0,0-1.874,1.874l3.039,3.039-3.039,3.039a1.325,1.325,0,1,0,1.874,1.874l3.039-3.039,3.039,3.039a1.325,1.325,0,0,0,1.874-1.874Z"
                                      transform="translate(-128.002 -128.002)" fill="#747474"/>
                            </g>
                        </g>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <!-- Content -->
                <div class="row">
                    <!-- Image -->
                    <div class="col-md-2">
                        <svg id="XMLID_1045_" xmlns="http://www.w3.org/2000/svg" width="92.2" height="92.201"
                             viewBox="0 0 92.2 92.201">
                            <path id="XMLID_1426_"
                                  d="M78.7,13.5a46.1,46.1,0,0,0-63.9-1.247L10.917,8.37A1.8,1.8,0,0,0,7.843,9.644V26.271a1.8,1.8,0,0,0,1.8,1.8H26.271A1.8,1.8,0,0,0,27.544,25l-4.076-4.076A33.855,33.855,0,1,1,12.245,46.1a1.8,1.8,0,0,0-1.8-1.8H1.8A1.8,1.8,0,0,0,0,46.1,46.1,46.1,0,0,0,78.7,78.7a46.1,46.1,0,0,0,0-65.2ZM46.1,88.6A42.552,42.552,0,0,1,3.639,47.9H8.686A37.46,37.46,0,1,0,19.615,19.615a1.8,1.8,0,0,0,0,2.547l2.308,2.308H11.445V13.991l2.06,2.06a1.8,1.8,0,0,0,2.547,0A42.5,42.5,0,1,1,46.1,88.6Z"
                                  transform="translate(0 0)" fill="#707070"/>
                            <path id="XMLID_1430_"
                                  d="M143.207,102.289a1.8,1.8,0,1,0-2.547,2.547l4.926,4.926a7.565,7.565,0,1,0,11.7-1.537l9.294-16.142a1.8,1.8,0,1,0-3.121-1.8l-9.29,16.135a7.542,7.542,0,0,0-6.032.794Z"
                                  transform="translate(-105.953 -67.581)" fill="#707070"/>
                            <path id="XMLID_1480_" d="M292.424,185.219a1.8,1.8,0,1,0,0-3.6h-2.465a1.8,1.8,0,0,0,0,3.6Z"
                                  transform="translate(-217.872 -137.318)" fill="#707070"/>
                            <path id="XMLID_1483_" d="M69.235,185.219a1.8,1.8,0,1,0,0-3.6H66.77a1.8,1.8,0,1,0,0,3.6Z"
                                  transform="translate(-49.122 -137.318)" fill="#707070"/>
                            <path id="XMLID_1568_"
                                  d="M181.617,289.963v2.465a1.8,1.8,0,1,0,3.6,0v-2.465a1.8,1.8,0,1,0-3.6,0Z"
                                  transform="translate(-137.318 -217.875)" fill="#707070"/>
                            <path id="XMLID_1569_"
                                  d="M185.219,69.506V67.04a1.8,1.8,0,1,0-3.6,0v2.465a1.8,1.8,0,1,0,3.6,0Z"
                                  transform="translate(-137.318 -49.327)" fill="#707070"/>
                        </svg>
                    </div>

                    <!-- Description -->
                    <div class="col-10">
                        <p class="w-100 mt-4 text-center">{!! translating('post-is-list-of-hurries-modal-description') !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Post is list of primary Modal -->
<div class="modal fade" id="posIsPrimaryActionPostModalCenter" tabindex="-1" role="dialog"
     aria-labelledby="posIsPrimaryActionPostModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold"
                    id="posIsPrimaryActionPostModalLongTitle">{{ translating('post-is-list-of-primary') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg id="close" xmlns="http://www.w3.org/2000/svg" width="31.808" height="31.807"
                         viewBox="0 0 31.808 31.807">
                        <g id="Group_1179" data-name="Group 1179">
                            <g id="Group_1178" data-name="Group 1178">
                                <path id="Path_480" data-name="Path 480"
                                      d="M30.482,14.578A1.326,1.326,0,0,0,29.157,15.9a13.253,13.253,0,1,1-3.849-9.338A1.325,1.325,0,1,0,27.189,4.7,15.9,15.9,0,1,0,31.808,15.9,1.326,1.326,0,0,0,30.482,14.578Z"
                                      fill="#747474"/>
                            </g>
                        </g>
                        <g id="Group_1181" data-name="Group 1181" transform="translate(10.603 10.603)">
                            <g id="Group_1180" data-name="Group 1180">
                                <path id="Path_481" data-name="Path 481"
                                      d="M135.177,133.3l3.039-3.039a1.325,1.325,0,0,0-1.874-1.874l-3.039,3.039-3.039-3.039a1.325,1.325,0,0,0-1.874,1.874l3.039,3.039-3.039,3.039a1.325,1.325,0,1,0,1.874,1.874l3.039-3.039,3.039,3.039a1.325,1.325,0,0,0,1.874-1.874Z"
                                      transform="translate(-128.002 -128.002)" fill="#747474"/>
                            </g>
                        </g>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <!-- Content -->
                <div class="row">
                    <!-- Image -->
                    <div class="col-md-2">
                        <svg id="XMLID_1045_" xmlns="http://www.w3.org/2000/svg" width="92.2" height="92.201"
                             viewBox="0 0 92.2 92.201">
                            <path id="XMLID_1426_"
                                  d="M78.7,13.5a46.1,46.1,0,0,0-63.9-1.247L10.917,8.37A1.8,1.8,0,0,0,7.843,9.644V26.271a1.8,1.8,0,0,0,1.8,1.8H26.271A1.8,1.8,0,0,0,27.544,25l-4.076-4.076A33.855,33.855,0,1,1,12.245,46.1a1.8,1.8,0,0,0-1.8-1.8H1.8A1.8,1.8,0,0,0,0,46.1,46.1,46.1,0,0,0,78.7,78.7a46.1,46.1,0,0,0,0-65.2ZM46.1,88.6A42.552,42.552,0,0,1,3.639,47.9H8.686A37.46,37.46,0,1,0,19.615,19.615a1.8,1.8,0,0,0,0,2.547l2.308,2.308H11.445V13.991l2.06,2.06a1.8,1.8,0,0,0,2.547,0A42.5,42.5,0,1,1,46.1,88.6Z"
                                  transform="translate(0 0)" fill="#707070"/>
                            <path id="XMLID_1430_"
                                  d="M143.207,102.289a1.8,1.8,0,1,0-2.547,2.547l4.926,4.926a7.565,7.565,0,1,0,11.7-1.537l9.294-16.142a1.8,1.8,0,1,0-3.121-1.8l-9.29,16.135a7.542,7.542,0,0,0-6.032.794Z"
                                  transform="translate(-105.953 -67.581)" fill="#707070"/>
                            <path id="XMLID_1480_" d="M292.424,185.219a1.8,1.8,0,1,0,0-3.6h-2.465a1.8,1.8,0,0,0,0,3.6Z"
                                  transform="translate(-217.872 -137.318)" fill="#707070"/>
                            <path id="XMLID_1483_" d="M69.235,185.219a1.8,1.8,0,1,0,0-3.6H66.77a1.8,1.8,0,1,0,0,3.6Z"
                                  transform="translate(-49.122 -137.318)" fill="#707070"/>
                            <path id="XMLID_1568_"
                                  d="M181.617,289.963v2.465a1.8,1.8,0,1,0,3.6,0v-2.465a1.8,1.8,0,1,0-3.6,0Z"
                                  transform="translate(-137.318 -217.875)" fill="#707070"/>
                            <path id="XMLID_1569_"
                                  d="M185.219,69.506V67.04a1.8,1.8,0,1,0-3.6,0v2.465a1.8,1.8,0,1,0,3.6,0Z"
                                  transform="translate(-137.318 -49.327)" fill="#707070"/>
                        </svg>
                    </div>

                    <!-- Description -->
                    <div class="col-10">
                        <p class="w-100 mt-4 text-center">{!! translating('post-is-list-of-primary-modal-description') !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
