<!-- Description, Price, Location Section -->
<div class="mt-3">
    <div class="row no-gutters">
        <div class="col-xl-9 col-lg-9 col-md-9 col-9 p-0 mb-2 d-flex">

            <!-- Price -->
{{--            @dd($post)--}}
            @if(!is_null($post->price))
                <strong
                    class="font-weight-bold h4 price-detail-desc">{{ $post->price.' '.$post->currency['simbol'] }}</strong>
            @endif
        <!-- Check Location Data -->
            @if(isset($post->location_id) && $post->location_id != NULL)
            <!-- Location -->
                <div class="ml-5-responsive">
                    <!-- Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="30" viewBox="0 0 33.484 50.226">
                        <g id="pin_1_" data-name="pin (1)" transform="translate(-85.333)">
                            <g id="Group_83" data-name="Group 83" transform="translate(85.333)">
                                <path id="Path_118" data-name="Path 118"
                                      d="M102.075,0A16.744,16.744,0,0,0,87.343,24.7l13.816,24.988a1.047,1.047,0,0,0,1.831,0l13.821-25A16.745,16.745,0,0,0,102.075,0Zm0,25.113a8.371,8.371,0,1,1,8.371-8.371A8.38,8.38,0,0,1,102.075,25.113Z"
                                      transform="translate(-85.333)" fill="#556080"/>
                            </g>
                        </g>
                    </svg>

                @if(isset($post->location['title_'.app()->getLocale()]) && $post->location['title_'.app()->getLocale()] != NULL)
                    <!-- Location -->
                        <span class="location-detail-desc" style="color: #28446A">
                        {{ $post->location['title_'.app()->getLocale()] }}

                        <!-- Address -->
                            @if(isset($post->address) && $post->address != NULL)
                                <i class="fa fa-angle-right"></i>
                                @if(strlen($post->address) > 35)
                                    {{ mb_substr($post->address, 0, 35)."..." }}

                                @else
                                    {{ $post->address }}
                                @endif

                            @endif
                    </span>
                    @endif
                </div>
            @endif

        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-3 p-0 mb-2">
            <!-- Share Post to social Accounts -->
            <div id="shatePostTosocialAccounts">
                <div class="card float-right float-left no-border">
                    <div class="bg-transparent p-0" style="z-index: 1;" id="headingsharePostToSocialAccounts">
                        <h5 class="mb-0">
                            <button class="btn btn-default share-button float-right dark-svg" data-toggle="collapse"
                                    data-target="#sharePostToSocialAccounts" aria-expanded="true"
                                    aria-controls="sharePostToSocialAccounts">
                                {{ translating('share') }}&nbsp;
                                <svg fill="#000" xmlns="http://www.w3.org/2000/svg" width="20.969" height="22.367"
                                     viewBox="0 0 20.969 22.367">
                                    <g id="share_1_" data-name="share (1)" transform="translate(-16)">
                                        <g id="Group_1178" data-name="Group 1178" transform="translate(16)">
                                            <path id="Path_417" data-name="Path 417"
                                                  d="M33.037,14.5a3.917,3.917,0,0,0-3.153,1.606l-6.2-3.173a3.709,3.709,0,0,0-.116-2.567l6.485-3.9a3.91,3.91,0,1,0-.952-2.535,3.9,3.9,0,0,0,.274,1.414l-6.5,3.914a3.925,3.925,0,1,0,.247,4.86L29.3,17.281a3.878,3.878,0,0,0-.193,1.154A3.932,3.932,0,1,0,33.037,14.5Z"
                                                  transform="translate(-16)"/>
                                        </g>
                                        <g id="Group_1187" data-name="Group 1187" transform="translate(16)">
                                            <path id="Path_417-2" data-name="Path 417"
                                                  d="M33.037,14.5a3.917,3.917,0,0,0-3.153,1.606l-6.2-3.173a3.709,3.709,0,0,0-.116-2.567l6.485-3.9a3.91,3.91,0,1,0-.952-2.535,3.9,3.9,0,0,0,.274,1.414l-6.5,3.914a3.925,3.925,0,1,0,.247,4.86L29.3,17.281a3.878,3.878,0,0,0-.193,1.154A3.932,3.932,0,1,0,33.037,14.5Z"
                                                  transform="translate(-16)"/>
                                        </g>
                                    </g>
                                </svg>
                            </button>
                        </h5>
                    </div>

                    <!-- Share Buttons -->
                    <div style="position: absolute;" id="sharePostToSocialAccounts" class="collapse"
                         aria-labelledby="headingsharePostToSocialAccounts" data-parent="#shatePostTosocialAccounts">
                        <div class="card-body mt-5 bg-white shadow-sm p-2">
                            <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                <!-- Facebook -->
                                <a style="width: 120px;"
                                   class="mb-2 text-dark d-block font-weight-bold a2a_button_facebook">&nbsp;{{ translating('facebook') }}</a>
                                <div class="clearfix"></div>

                                <!-- Whatsapp -->
                                <a style="width: 120px;"
                                   class="mb-2 text-dark d-block font-weight-bold a2a_button_whatsapp">&nbsp;{{ translating('whatsapp') }}</a>
                                <div class="clearfix"></div>

                                <!-- Viber -->
                                <a style="width: 120px;"
                                   class="mb-2 text-dark d-block font-weight-bold a2a_button_viber">&nbsp;{{ translating('viber') }}</a>
                                <div class="clearfix"></div>

                                <!-- Telegram -->
                                <a style="width: 120px;"
                                   class="mb-2 text-dark d-block font-weight-bold a2a_button_telegram">&nbsp;{{ translating('telegram') }}</a>
                                <div class="clearfix"></div>
                            </div>

                            <!-- Share Script -->
                            <script async src="https://static.addtoany.com/menu/page.js"></script>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Report Admins For Post Modal Button -->
            <button type="button" class="btn boxoq-button btn-default dark-svg float-right" data-toggle="modal"
                    data-target="#reportAdminsForPostCenter">
                {{ translating('report') }}&nbsp;
                <svg id="spam" fill="#000" xmlns="http://www.w3.org/2000/svg" width="22.367" height="22.367"
                     viewBox="0 0 22.367 22.367">
                    <g id="Group_1322" data-name="Group 1322">
                        <g id="Group_1321" data-name="Group 1321">
                            <path id="Path_619" data-name="Path 619"
                                  d="M236.879,368.747a.874.874,0,0,0,0-1.747h0a.874.874,0,0,0,0,1.747Z"
                                  transform="translate(-225.695 -350.967)"/>
                            <path id="Path_620" data-name="Path 620"
                                  d="M21.344,5.528l-4.5-4.5A3.472,3.472,0,0,0,14.368,0H8A3.472,3.472,0,0,0,5.528,1.024l-4.5,4.5A3.472,3.472,0,0,0,0,8v6.369A3.472,3.472,0,0,0,1.024,16.84l4.5,4.5A3.472,3.472,0,0,0,8,22.367h6.369a3.472,3.472,0,0,0,2.471-1.024l1.4-1.4A.874.874,0,1,0,17,18.708l-1.4,1.4a1.736,1.736,0,0,1-1.236.512H8a1.736,1.736,0,0,1-1.236-.512l-4.5-4.5a1.736,1.736,0,0,1-.512-1.236V8a1.736,1.736,0,0,1,.512-1.236l4.5-4.5A1.736,1.736,0,0,1,8,1.747h6.369a1.736,1.736,0,0,1,1.236.512l4.5,4.5A1.736,1.736,0,0,1,20.62,8v6.37a1.736,1.736,0,0,1-.512,1.236.874.874,0,1,0,1.236,1.236,3.472,3.472,0,0,0,1.024-2.471V8A3.472,3.472,0,0,0,21.344,5.528Z"/>
                            <path id="Path_621" data-name="Path 621"
                                  d="M237.747,109.48v-8.606a.874.874,0,1,0-1.747,0v8.606a.874.874,0,1,0,1.747,0Z"
                                  transform="translate(-225.69 -95.631)"/>
                        </g>
                    </g>
                </svg>
            </button>

            <!-- Report Admins For Post Modal Button -->
            <div class="modal fade" id="reportAdminsForPostCenter" tabindex="-1" role="dialog"
                 aria-labelledby="reportAdminsForPostCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold"
                                id="reportAdminsForPostLongTitle">{{ translating('report') }}</h5>
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
                            <!-- Name -->
                            <div class="form-group">
                                <input type="text" class="input-default w-100 p-2" required min="1" max="255"
                                       name="name" form="reportMessageSendForm"
                                       placeholder="{{ translating('placeholder-name') }}"
                                       @auth value="{{ Auth::user()->first_name.' '.Auth::user()->last_name }}"
                                       disabled @endauth>
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <input type="email" class="input-default w-100 p-2" required min="1" max="255"
                                       name="email" form="reportMessageSendForm"
                                       placeholder="{{ translating('placeholder-email') }}"
                                       @auth value="{{ Auth::user()->email }}" disabled @endauth>
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <textarea rows="5" class="input-default w-100 p-2" required min="1" max="99999"
                                          name="description" form="reportMessageSendForm"
                                          placeholder="{{ translating('placeholder-description') }}"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <form id="reportMessageSendForm"
                                  action="{{ route('detail-send-report', ['locale' => app()->getLocale(), 'post_id' => $post->id]) }}"
                                  class="w-100" method="post">
                                @csrf
                                <button form="reportMessageSendForm" id="sendReportForm" type="submit"
                                        class="btn btn-main d-block mx-auto text-light">{{ translating('submit') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    <div class="row no-gutters mt-2 align-items-baseline">--}}
{{--        <!-- Price -->--}}
{{--        <strong class="font-weight-bold h4">{{ $post->price.' '.$post->currency['simbol'] }}</strong>--}}

{{--        <!-- Check Location Data -->--}}
{{--    @if(isset($post->location_id) && $post->location_id != NULL)--}}
{{--        <!-- Location -->--}}
{{--            <div class="ml-5-responsive">--}}
{{--                <!-- Icon -->--}}
{{--                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="30" viewBox="0 0 33.484 50.226">--}}
{{--                    <g id="pin_1_" data-name="pin (1)" transform="translate(-85.333)">--}}
{{--                        <g id="Group_83" data-name="Group 83" transform="translate(85.333)">--}}
{{--                            <path id="Path_118" data-name="Path 118"--}}
{{--                                  d="M102.075,0A16.744,16.744,0,0,0,87.343,24.7l13.816,24.988a1.047,1.047,0,0,0,1.831,0l13.821-25A16.745,16.745,0,0,0,102.075,0Zm0,25.113a8.371,8.371,0,1,1,8.371-8.371A8.38,8.38,0,0,1,102.075,25.113Z"--}}
{{--                                  transform="translate(-85.333)" fill="#556080"/>--}}
{{--                        </g>--}}
{{--                    </g>--}}
{{--                </svg>--}}

{{--            @if(isset($post->location['title_'.app()->getLocale()]) && $post->location['title_'.app()->getLocale()] != NULL)--}}
{{--                <!-- Location -->--}}
{{--                    <span style="color: #28446A">--}}
{{--                        {{ $post->location['title_'.app()->getLocale()] }}--}}

{{--                        <!-- Address -->--}}
{{--                            @if(isset($post->address) && $post->address != NULL)--}}
{{--                                <i class="fa fa-angle-right"></i> {{ $post->address }}--}}
{{--                            @endif--}}
{{--                    </span>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </div>--}}

<!-- Description -->

    <div class="my-3 desc-detail">
        @if(is_null($post->description))
            @php echo nl2br(strip_tags($post->desc_spare)) @endphp
        @else
            @php echo nl2br(strip_tags($post->description)) @endphp
        @endif

    </div>
</div>
