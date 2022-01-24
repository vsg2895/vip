<!-- Check data -->
@if(isset($post->user) && $post->user != NULL)
    <!-- User Section -->
    <div class="row">
        <!-- User profile Page  -->
        <a href="javascript:void(0)" class="text-dark w-100 text-center d-block mx-auto">
            <!-- Check Image -->
            @if(Auth::check() && Auth::user()->role == 'facebook_user' || Auth::user()->role == 'google_user')
                <!-- Image -->
                <img src="{{ $post->user['img'] }}" class="w-25 d-block rounded-circle mx-auto" title="{{ $post->user['first_name'].' '.$post->user['last_name'] }}" alt="{{ $post->user['first_name'].' '.$post->user['last_name'] }}">
            @else
                <!-- Image -->
                <img src="{{ asset('assets/img/users'.'/'.$post->user['img']) }}" class="w-25 d-block rounded-circle mx-auto" title="{{ $post->user['first_name'].' '.$post->user['last_name'] }}" alt="{{ $post->user['first_name'].' '.$post->user['last_name'] }}">
            @endif

            <!-- Full Name -->
            <h4 class="w-100 text-center mt-3">{{ $post->user['first_name'].' '.$post->user['last_name'] }}</h4>
        </a>
    </div>
@endif

@auth
    <!-- Send Message To Post Auther User Modal Button -->
    <button type="button" class="btn btn-main shadow-sm text-light w-100">{{ translating('message') }}</button>

    <!-- Send Message To Post Auther User Modal Content -->
    <div class="modal fade" id="sendMessageToPostAutherUser" tabindex="-1" role="dialog" aria-labelledby="sendMessageToPostAutherUserTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <!-- Title -->
                <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">{{ translating('message') }}</h5>

                <!-- Close Button -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg id="close" xmlns="http://www.w3.org/2000/svg" width="31.808" height="31.807" viewBox="0 0 31.808 31.807">
                    <g id="Group_1179" data-name="Group 1179">
                        <g id="Group_1178" data-name="Group 1178">
                        <path id="Path_480" data-name="Path 480" d="M30.482,14.578A1.326,1.326,0,0,0,29.157,15.9a13.253,13.253,0,1,1-3.849-9.338A1.325,1.325,0,1,0,27.189,4.7,15.9,15.9,0,1,0,31.808,15.9,1.326,1.326,0,0,0,30.482,14.578Z" fill="#747474"/>
                        </g>
                    </g>
                    <g id="Group_1181" data-name="Group 1181" transform="translate(10.603 10.603)">
                        <g id="Group_1180" data-name="Group 1180">
                        <path id="Path_481" data-name="Path 481" d="M135.177,133.3l3.039-3.039a1.325,1.325,0,0,0-1.874-1.874l-3.039,3.039-3.039-3.039a1.325,1.325,0,0,0-1.874,1.874l3.039,3.039-3.039,3.039a1.325,1.325,0,1,0,1.874,1.874l3.039-3.039,3.039,3.039a1.325,1.325,0,0,0,1.874-1.874Z" transform="translate(-128.002 -128.002)" fill="#747474"/>
                        </g>
                    </g>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <!-- Name -->
                <div class="form-group">
                    <input type="text" disabled class="input-default w-100 p-2" value="{{ $post->user['first_name'].' '.$post->user['last_name'] }}" required min="1" max="255" name="name" form="sendMessageToPostAutherUserForm" placeholder="{{ translating('placeholder-name') }}">
                </div>

                <!-- Email -->
                <div class="form-group">
                    <input type="email" disabled class="input-default w-100 p-2" value="{{ $post->user['email'] }}" required min="1" max="255" name="email" form="sendMessageToPostAutherUserForm" placeholder="{{ translating('placeholder-email') }}">
                </div>

                <!-- Description -->
                <div class="form-group">
                    <textarea rows="5" class="input-default w-100 p-2" required min="1" max="99999" name="description" form="sendMessageToPostAutherUserForm" placeholder="{{ translating('placeholder-description') }}"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Cancel Message -->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ translating('cancel') }}</button>

                <!-- Send Message -->
                <form id="sendMessageToPostAutherUserForm" action="{{ route('detail-send-message', ['locale' => app()->getLocale(), 'geter_id' => $post->user_id]) }}" method="post">
                    @csrf
                    <button form="sendMessageToPostAutherUserForm" type="subimt" id="sendMessageForm{{Auth::user()->id}}" class="btn btn-main text-light">{{ translating('send-message') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@else
    <!-- Send Message To Post Auther User Modal Button With Login -->
    <button type="button" class="btn btn-main shadow-sm text-light w-100" data-toggle="modal" data-target="#sendMessageToPostAutherUserWithLogin">{{ translating('message') }}</button>

    <!-- Log in to add wishlist modal -->
    <div class="modal fade" id="sendMessageToPostAutherUserWithLogin" tabindex="-1" role="dialog" aria-labelledby="sendMessageToPostAutherUserWithLoginTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <!-- Title -->
                <h5 class="modal-title font-weight-bold" id="sendMessageToPostAutherUserWithLoginTitle">{{ translating('log-in-to-send-message-title') }}</h5>

                <!-- Close Button -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    <svg id="close" xmlns="http://www.w3.org/2000/svg" width="31.808" height="31.807" viewBox="0 0 31.808 31.807">
                    <g id="Group_1179" data-name="Group 1179">
                        <g id="Group_1178" data-name="Group 1178">
                        <path id="Path_480" data-name="Path 480" d="M30.482,14.578A1.326,1.326,0,0,0,29.157,15.9a13.253,13.253,0,1,1-3.849-9.338A1.325,1.325,0,1,0,27.189,4.7,15.9,15.9,0,1,0,31.808,15.9,1.326,1.326,0,0,0,30.482,14.578Z" fill="#747474"/>
                        </g>
                    </g>
                    <g id="Group_1181" data-name="Group 1181" transform="translate(10.603 10.603)">
                        <g id="Group_1180" data-name="Group 1180">
                        <path id="Path_481" data-name="Path 481" d="M135.177,133.3l3.039-3.039a1.325,1.325,0,0,0-1.874-1.874l-3.039,3.039-3.039-3.039a1.325,1.325,0,0,0-1.874,1.874l3.039,3.039-3.039,3.039a1.325,1.325,0,1,0,1.874,1.874l3.039-3.039,3.039,3.039a1.325,1.325,0,0,0,1.874-1.874Z" transform="translate(-128.002 -128.002)" fill="#747474"/>
                        </g>
                    </g>
                    </svg>
                </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-block mx-auto">
                    <!-- Description -->
                    <h5 class="w-100 text-center">{!! translating('log-in-to-send-message-description') !!}</h5>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Log In Url -->
                <a href="{{ route('login', ['locale' => app()->getLocale()]) }}" class="btn d-block mx-auto btn-primary">{{ translating('log-in-to-send-message-button') }}</a>
            </div>
            </div>
        </div>
    </div>
@endif

<!-- Phone Numbers Bar -->
<div id="togglePhoneNumbersBar">
    <div class="card mt-2">
        <!-- Buttton Heading -->
        <div class="card-header p-0 bg-white" id="headingPhoneNumbersBar">
            <h5 class="mb-0">
                <button class="btn btn-sec shodow-sm text-light w-100" data-toggle="collapse" data-target="#collapsePhoneNumbersBar" aria-expanded="true" aria-controls="collapsePhoneNumbersBar">
                    {{ translating('call') }}
                </button>
            </h5>
        </div>
{{--        @dd($post->user)--}}
        <!-- Phone Numbers -->
        <div id="collapsePhoneNumbersBar" class="collapse" aria-labelledby="headingPhoneNumbersBar" data-parent="#togglePhoneNumbersBar">
            <div class="card-body">
                <!-- Primary Phone Number -->
                <div class="w-100 d-blcok py-2">
                    <svg id="Group_908" data-name="Group 908" xmlns="http://www.w3.org/2000/svg" width="20.19" height="20.232" viewBox="0 0 20.19 20.232">
                        <path id="Path_381" data-name="Path 381" d="M20.2,14.848l-2.823-2.823a1.878,1.878,0,0,0-3.126.706,1.921,1.921,0,0,1-2.218,1.21A8.707,8.707,0,0,1,6.788,8.7,1.828,1.828,0,0,1,8,6.479,1.878,1.878,0,0,0,8.7,3.353L5.88.529a2.014,2.014,0,0,0-2.723,0L1.242,2.445c-1.916,2.017.2,7.361,4.941,12.1s10.084,6.958,12.1,4.941L20.2,17.571A2.014,2.014,0,0,0,20.2,14.848Z" transform="translate(-0.539 0)" fill="#959595"/>
                    </svg>
                    <a class="text-dark h5" href="tel: {{ '+'.$post->user['country']['code'].' '.$post->user['phone'] }}">{{ '+'.$post->user['country']['code'].' '.$post->user['phone'] }}</a>
                </div>

                <!-- Check phone numbers data -->
                @if(isset($post->user['phone_number']) && $post->user['phone_number'] != NULL)
                    <!-- Viber -->
                    @if(isset($post->user['phone_number']['viber']) && isset($post->user['phone_number']['viber_country_id']) && $post->user['phone_number']['viber'] != NULL && $post->user['phone_number']['viber_country_id'] != NULL)
                        <div class="w-100 d-blcok py-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24.001" height="24.808" viewBox="0 0 24.001 24.808">
                                <g id="Group_1392" data-name="Group 1392" transform="translate(-577.999 -2295.272)">
                                    <path id="Path_507" data-name="Path 507" d="M150.607,121.3c-5.275-1.274-10.559-2.764-15.968-.871-3.5,1.313-3.5,5.108-3.356,8.318,0,.876-1.021,2.043-.584,3.065.876,2.919,1.605,5.837,4.67,7.3.438.292,0,.876.292,1.313-.146,0-.438.146-.438.292a9.753,9.753,0,0,1,.105,2.459l5.5-4.064a25.521,25.521,0,0,0,8.537-1.581c.609-.105,1.947,1.164,2.366-2.706,1.053-9.722-.127.246,0-.507s.508-2.5.508-2.5v-2.06" transform="translate(448.794 2176.592)" fill="#512d84"/>
                                    <g id="Group_1210" data-name="Group 1210" transform="translate(577.999 2295.272)">
                                    <path id="Path_508" data-name="Path 508" d="M137.7,115.433l-.007-.029a8.274,8.274,0,0,0-5.587-5.375l-.027-.006a31.046,31.046,0,0,0-11.686,0l-.028.006a8.278,8.278,0,0,0-5.587,5.375l-.006.029a22.873,22.873,0,0,0,0,9.853l.006.029a8.346,8.346,0,0,0,5.279,5.3v2.613a1.05,1.05,0,0,0,1.808.728l2.647-2.752c.574.032,1.149.05,1.723.05a31.154,31.154,0,0,0,5.843-.554l.027-.006a8.275,8.275,0,0,0,5.587-5.375l.007-.029A22.875,22.875,0,0,0,137.7,115.433Zm-2.1,9.379a6.259,6.259,0,0,1-3.943,3.777,28.936,28.936,0,0,1-6.216.5.147.147,0,0,0-.11.045l-1.933,1.984-2.056,2.11a.241.241,0,0,1-.414-.166v-4.329a.149.149,0,0,0-.121-.146h0a6.26,6.26,0,0,1-3.943-3.777,20.756,20.756,0,0,1,0-8.905,6.26,6.26,0,0,1,3.943-3.776,28.915,28.915,0,0,1,10.851,0,6.257,6.257,0,0,1,3.943,3.776A20.734,20.734,0,0,1,135.6,124.812Z" transform="translate(-114.234 -109.468)" fill="#fff"/>
                                    <path id="Path_509" data-name="Path 509" d="M191.864,185.39c-.242-.074-.473-.123-.687-.212a15.609,15.609,0,0,1-5.882-3.931,15.264,15.264,0,0,1-2.25-3.443c-.289-.587-.532-1.2-.78-1.8a1.564,1.564,0,0,1,.458-1.54,3.617,3.617,0,0,1,1.212-.91.778.778,0,0,1,.973.231,12.543,12.543,0,0,1,1.505,2.107,1,1,0,0,1-.281,1.358c-.114.077-.218.168-.324.256a1.063,1.063,0,0,0-.244.258.706.706,0,0,0-.047.62,5.61,5.61,0,0,0,3.151,3.488,1.6,1.6,0,0,0,.807.2c.493-.058.653-.6,1-.882a.942.942,0,0,1,1.134-.05c.364.231.717.478,1.068.728a12.193,12.193,0,0,1,1.005.765.8.8,0,0,1,.239.987,3.338,3.338,0,0,1-1.434,1.58,3.468,3.468,0,0,1-.62.2C191.622,185.317,192.074,185.326,191.864,185.39Z" transform="translate(-176.438 -168.049)" fill="#fff"/>
                                    <path id="Path_510" data-name="Path 510" d="M250.411,165.414a5.9,5.9,0,0,1,5.8,4.88c.087.489.118.989.157,1.486a.349.349,0,0,1-.327.41c-.233,0-.337-.192-.353-.4-.03-.413-.051-.828-.108-1.238a5.189,5.189,0,0,0-4.179-4.338c-.324-.058-.656-.073-.984-.107-.207-.022-.479-.034-.525-.292a.354.354,0,0,1,.35-.4c.056,0,.112,0,.168,0C253.316,165.5,250.355,165.413,250.411,165.414Z" transform="translate(-238.405 -160.677)" fill="#fff"/>
                                    <path id="Path_511" data-name="Path 511" d="M260.592,187.923a1.328,1.328,0,0,1-.029.2.33.33,0,0,1-.621.034.875.875,0,0,1-.035-.281,3.518,3.518,0,0,0-.445-1.765,3.285,3.285,0,0,0-1.377-1.292,3.959,3.959,0,0,0-1.1-.337c-.165-.027-.333-.044-.5-.067a.316.316,0,0,1-.3-.355.312.312,0,0,1,.348-.308,4.566,4.566,0,0,1,1.9.5,3.848,3.848,0,0,1,2.094,2.99c.009.061.024.121.028.182.011.151.019.3.03.5C260.587,187.959,260.58,187.724,260.592,187.923Z" transform="translate(-244.172 -177.465)" fill="#fff"/>
                                    <path id="Path_512" data-name="Path 512" d="M263.557,205.056a.359.359,0,0,1-.4-.353,3.649,3.649,0,0,0-.068-.464,1.305,1.305,0,0,0-.482-.756,1.262,1.262,0,0,0-.392-.189c-.178-.052-.363-.037-.541-.081a.332.332,0,0,1-.269-.385.349.349,0,0,1,.368-.28,2,2,0,0,1,2.046,1.989.918.918,0,0,1,0,.282.289.289,0,0,1-.26.237C263.314,205.061,263.667,205.049,263.557,205.056Z" transform="translate(-248.943 -194.668)" fill="#fff"/>
                                    </g>
                                    <path id="Path_513" data-name="Path 513" d="M162.057,139.421l-.007-.029a7.706,7.706,0,0,0-2.494-3.717l-1.63,1.445a5.861,5.861,0,0,1,2.036,2.775,20.732,20.732,0,0,1,0,8.905,6.259,6.259,0,0,1-3.943,3.777,28.939,28.939,0,0,1-6.216.5.147.147,0,0,0-.11.045l-1.933,1.984-2.056,2.11a.241.241,0,0,1-.414-.166v-4.329a.149.149,0,0,0-.121-.146h0a5.859,5.859,0,0,1-2.711-1.746l-1.611,1.427a8.173,8.173,0,0,0,3.57,2.341v2.613a1.05,1.05,0,0,0,1.808.728l2.647-2.752c.574.032,1.149.05,1.723.05a31.154,31.154,0,0,0,5.843-.554l.027-.006a8.274,8.274,0,0,0,5.587-5.375l.007-.029A22.874,22.874,0,0,0,162.057,139.421Z" transform="translate(439.405 2161.815)" fill="#d1d1d1"/>
                                    <path id="Path_514" data-name="Path 514" d="M295.676,313.765c.21-.065-.242-.074,0,0Z" transform="translate(297.749 1998.847)" fill="#fff"/>
                                    <path id="Path_515" data-name="Path 515" d="M225.937,253.734a12.241,12.241,0,0,0-1.005-.765c-.351-.25-.7-.5-1.068-.728a.942.942,0,0,0-1.134.05c-.346.283-.506.824-1,.882a1.606,1.606,0,0,1-.807-.2,5.224,5.224,0,0,1-2.294-1.825l-1.2,1.062c.041.047.08.1.121.142a15.612,15.612,0,0,0,5.883,3.931c.214.089.445.138.687.212-.242-.074.211-.065,0,0a3.465,3.465,0,0,0,.62-.2,3.337,3.337,0,0,0,1.434-1.58A.8.8,0,0,0,225.937,253.734Z" transform="translate(369.303 2056.115)" fill="#d1d1d1"/>
                                    <g id="Group_1211" data-name="Group 1211" transform="translate(590.005 2300.007)">
                                    <path id="Path_516" data-name="Path 516" d="M256.072,165.427h0Z" transform="translate(-256.064 -165.427)" fill="#fff"/>
                                    <path id="Path_517" data-name="Path 517" d="M256.072,165.426h.007C256.24,165.432,258.862,165.5,256.072,165.426Z" transform="translate(-256.071 -165.426)" fill="#fff"/>
                                    </g>
                                    <g id="Group_1212" data-name="Group 1212" transform="translate(592.623 2301.738)">
                                    <path id="Path_518" data-name="Path 518" d="M299.759,185.837l-.511.453a5.128,5.128,0,0,1,1.515,2.956c.057.41.078.825.108,1.238.015.209.12.4.353.4a.349.349,0,0,0,.327-.41c-.039-.5-.07-1-.157-1.486A5.831,5.831,0,0,0,299.759,185.837Z" transform="translate(-298.21 -185.837)" fill="#d1d1d1"/>
                                    <path id="Path_519" data-name="Path 519" d="M288.729,199.1a3.877,3.877,0,0,0-1.228-2.389l-.51.452a3.311,3.311,0,0,1,.667.812,3.518,3.518,0,0,1,.445,1.765.876.876,0,0,0,.035.281.33.33,0,0,0,.621-.034,1.324,1.324,0,0,0,.029-.2c0,.036-.012-.2,0,0-.012-.2-.019-.35-.03-.5C288.753,199.225,288.738,199.165,288.729,199.1Z" transform="translate(-286.991 -195.794)" fill="#d1d1d1"/>
                                    </g>
                                    <g id="Group_1213" data-name="Group 1213" transform="translate(592.525 2305.648)">
                                    <path id="Path_520" data-name="Path 520" d="M308.143,232.142c-.012-.2,0,.036,0,0Z" transform="translate(-306.25 -232.061)" fill="#fff"/>
                                    <path id="Path_521" data-name="Path 521" d="M286.536,232.16l.011,0h-.042Z" transform="translate(-286.449 -232.149)" fill="#fff"/>
                                    <path id="Path_522" data-name="Path 522" d="M285.929,232.169l-.031,0C285.845,232.168,285.791,232.171,285.929,232.169Z" transform="translate(-285.842 -232.158)" fill="#fff"/>
                                    <path id="Path_523" data-name="Path 523" d="M286.883,232.157l-.011,0C286.9,232.158,286.9,232.157,286.883,232.157Z" transform="translate(-286.785 -232.149)" fill="#fff"/>
                                    </g>
                                    <path id="Path_524" data-name="Path 524" d="M275.2,207.525l-.519.46c.029.017.057.035.084.055a1.305,1.305,0,0,1,.482.756,3.678,3.678,0,0,1,.068.464.355.355,0,0,0,.367.351h.042a.288.288,0,0,0,.249-.235.92.92,0,0,0,0-.282A2.06,2.06,0,0,0,275.2,207.525Z" transform="translate(316.895 2096.046)" fill="#d1d1d1"/>
                                </g>
                            </svg>
                            <a target="_blank" class="text-dark h5" href="viber://chat/?number=+{{ $post->user['phone_number']['viber_country']['code'].''.$post->user['phone_number']['viber'] }}">{{ '+'.$post->user['phone_number']['viber_country']['code'].' '.$post->user['phone_number']['viber'] }}</a>
                        </div>
                    @endif

                    <!-- Whatsapp -->
                    @if(isset($post->user['phone_number']['whatsapp']) && isset($post->user['phone_number']['whatsapp_country_id']) && $post->user['phone_number']['whatsapp'] != NULL && $post->user['phone_number']['whatsapp_country_id'] != NULL)
                        <div class="w-100 d-blcok py-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22.163" height="22.163" viewBox="0 0 22.163 22.163">
                                <g id="Group_1393" data-name="Group 1393" transform="translate(-593.918 -2466.918)">
                                    <g id="whatsapp_1_" data-name="whatsapp (1)" transform="translate(593.943 2466.943)">
                                    <path id="Path_525" data-name="Path 525" d="M11.059,0h-.006A11.05,11.05,0,0,0,2.1,17.537L.727,21.645l4.25-1.359A11.055,11.055,0,1,0,11.059,0Z" fill="#4caf50" stroke="#fff" stroke-width="0.05"/>
                                    <path id="Path_526" data-name="Path 526" d="M120.124,127.644a3.12,3.12,0,0,1-2.17,1.56c-.578.123-1.332.221-3.873-.832a13.851,13.851,0,0,1-5.5-4.862,6.315,6.315,0,0,1-1.313-3.335,3.53,3.53,0,0,1,1.131-2.691,1.606,1.606,0,0,1,1.131-.4c.137,0,.26.007.37.012.325.014.488.033.7.546.267.643.916,2.229.994,2.392a.658.658,0,0,1,.047.6,1.911,1.911,0,0,1-.358.507c-.163.188-.318.332-.481.533-.149.176-.318.363-.13.688a9.814,9.814,0,0,0,1.794,2.229,8.128,8.128,0,0,0,2.593,1.6.7.7,0,0,0,.779-.123,13.383,13.383,0,0,0,.864-1.144.617.617,0,0,1,.793-.24c.3.1,1.878.885,2.2,1.046s.539.24.618.377A2.753,2.753,0,0,1,120.124,127.644Z" transform="translate(-102.631 -112.031)" fill="#fafafa" stroke="#fff" stroke-width="0.05"/>
                                    </g>
                                </g>
                            </svg>
                            <a target="_blank" class="text-dark h5" href="https://api.whatsapp.com/send?phone={{ '+'.$post->user['phone_number']['whatsapp_country']['code'].' '.$post->user['phone_number']['whatsapp'] }}">{{ '+'.$post->user['phone_number']['whatsapp_country']['code'].' '.$post->user['phone_number']['whatsapp'] }}</a>
                        </div>
                    @endif

                    <!-- Telegram -->
                    @if(isset($post->user['phone_number']['telegram']) && isset($post->user['phone_number']['telegram_country_id']) && $post->user['phone_number']['telegram'] != NULL && $post->user['phone_number']['telegram_country_id'] != NULL)
                        <div class="w-100 d-blcok py-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23">
                                <g id="telegram" transform="translate(0.232 0.232)">
                                    <circle id="Ellipse_27" data-name="Ellipse 27" cx="11.5" cy="11.5" r="11.5" transform="translate(-0.232 -0.232)" fill="#039be5"/>
                                    <path id="Path_643" data-name="Path 643" d="M5.445,11.4l10.69-4.122c.5-.179.929.121.769.871h0l-1.82,8.575c-.135.608-.5.756-1,.469l-2.772-2.043L9.974,16.434a.7.7,0,0,1-.559.273l.2-2.821,5.137-4.641c.224-.2-.05-.308-.345-.112l-6.348,4-2.737-.854c-.594-.188-.607-.594.126-.88Z" transform="translate(-0.371 -0.55)" fill="#fff"/>
                                </g>
                            </svg>
                            <a target="_blank" class="text-dark h5" href="https://t.me/{{ '+'.$post->user['phone_number']['telegram_country']['code'].' '.$post->user['phone_number']['telegram'] }}">{{ '+'.$post->user['phone_number']['telegram_country']['code'].' '.$post->user['phone_number']['telegram'] }}</a>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
