<!-- Chat Header -->
{{--@dd($friend);--}}
<div class="row w-100 no-gutters d-block position-relative conversetion-first-row">
    <!-- URL -->
    <a class="friend-link" href="{{ route('users', ['locale' => app()->getLocale(), 'id' => $friend->id]) }}">
        <!-- Check image -->
    @if($friend->role == 'facebook_user' ||  $friend->role == 'google_user') <!-- Facebook -->
        <!-- Image -->
        <img src="{{ $friend->img }}" class="rounded-circle responsive friend-image float-left" width="35px"
             alt="{{ $friend->first_name.' '.$friend->last_name }}">
    @else <!-- User -->
        <!-- Image -->
        <img src="{{ asset('assets/img/users'.'/'.$friend->img) }}"
             class="rounded-circle responsive friend-image float-left" width="35px"
             alt="{{ $friend->first_name.' '.$friend->last_name }}">
    @endif

    <!-- Fullname -->
        <h3 class="d-inline friend-user float-left ml-2 mt-1">{{ $friend->first_name.' '.$friend->last_name }}</h3>
    </a>

    <!-- Clear -->
    <div class="clearfix"></div>

    <!-- Break -->
    <hr>
</div>

<!-- Messages Section -->
<div class="row w-100 no-gutters d-block mt-3 messages-section">
    <!-- Check data -->
@if(isset($messages) && count($messages) > 0)
    <!-- Loop from messages -->
    @foreach($messages as $message)
        <!-- Check sender type -->
        @if($message->sender_id == $friend->id) <!-- Message from friend -->
            <!-- Contnet -->
            <div class="row no-gutters w-100 d-block py-4 m-item-m" data-item-id="{{ $message->id }}">
                <!-- URL -->
                <a href="{{ route('users', ['locale' => app()->getLocale(), 'id' => $friend->id]) }}">
                    <!-- Check image -->
                @if($friend->role == 'facebook_user' || $friend->role == 'google_user') <!-- Facebook -->
                    <!-- Image -->
                    <img src="{{ $friend->img }}" class="rounded-circle responsive float-left" width="35px"
                         alt="{{ $friend->first_name.' '.$friend->last_name }}"
                         title="{{ $friend->first_name.' '.$friend->last_name }}">
                @else <!-- User -->
                    <!-- Image -->
                    <img src="{{ asset('assets/img/users'.'/'.$friend->img) }}"
                         class="rounded-circle responsive float-left" width="35px"
                         alt="{{ $friend->first_name.' '.$friend->last_name }}"
                         title="{{ $friend->first_name.' '.$friend->last_name }}">
                    @endif
                </a>

                <!-- Friend Message -->
                <div class="p-2 rounded ml-2 float-left d-inline bg-light w-75">
                    <!-- Text -->
                {!! $message->message['message']  !!}

                <!-- Date Time -->
                    <div class="w-100 d-block">
                        <small class="text-muted"><i
                                class="far fa-clock"></i> {{ time_default_format($message->message['created_at']) }}
                        </small>
                    </div>

                </div>

                <!-- Clear -->
                <div class="clearfix"></div>
            </div>
        @else <!-- My message -->
            <!-- Contnet -->
            <div class="row no-gutters w-100 d-block mt-2 float-right my-4 position-relative m-item m-item-m"
                 data-item-id="{{ $message->id }}">
                <!-- URL -->
                <a href="{{ route('account-posts', ['locale' => app()->getLocale()]) }}">
                    <!-- Check image -->
                @if(Auth::user()->role == 'facebook_user' || Auth::user()->role == 'google_user')
                    <!-- My Image -->
                        <img class="my-user d-inline-block float-right rounded-circle" width="45px"
                             src="{{ Auth::user()->img }}"
                             title="{{ Auth::user()->first_name.' '.Auth::user()->last_name }}"
                             alt="{{ Auth::user()->first_name.' '.Auth::user()->last_name }}">
                @else
                    <!-- My Image -->
                        <img class="my-user d-inline-block float-right rounded-circle" width="45px"
                             src="{{ asset('assets/img/users'.'/'.Auth::user()->img) }}"
                             title="{{ Auth::user()->first_name.' '.Auth::user()->last_name }}"
                             alt="{{ Auth::user()->first_name.' '.Auth::user()->last_name }}">
                    @endif
                </a>

                <!-- My Message -->
                <div class="p-2 rounded mr-2 float-right d-inline bg-light w-75">
                        <span class="text-message">
                            <!-- Text -->
                            {!! $message->message['message'] !!}
                        </span>

                <!-- <span data-update-url="{{ route('account-messages-update-message', ['locale' => app()->getLocale(), 'message_id' => $message->id]) }}" data-edit-url="{{ route('account-messages-destroy-message', ['locale' => app()->getLocale(), 'message_id' => $message->id]) }}" data-toggle="modal" data-target="#exampleMessageActionsModalCenter" class="fa fa-ellipsis-v more-info-message"></span> -->

                    <!-- Date Time -->
                    <div class="w-100 d-block">
                        <small class="text-muted float-right"><i
                                class="far fa-clock"></i> {{ time_default_format($message->message['created_at']) }}
                        </small>
                    </div>
                </div>

                <!-- Clear -->
                <div class="clearfix"></div>
            </div>
        @endif
    @endforeach

    <!-- Modal -->
        <div class="modal fade" id="exampleMessageActionsModalCenter" tabindex="-1" role="dialog"
             aria-labelledby="exampleMessageActionsModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold"
                            id="exampleMessageActionsModalLongTitle">{{ translating('message-action-title') }}</h5>
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
                        <textarea form="editMessageForm" data-description="false" name="message" rows="5"
                                  class="message-content-description-edit input-default p-2 w-100"></textarea>
                    </div>
                    <div class="modal-footer">
                        <!-- Delete Message -->
                        <a href="{{ route('account-messages-destroy-message', ['locale' => app()->getLocale(), 'message_id' => $message->id]) }}"
                           class="message-action delete btn btn-danger">{{ translating('delete') }}</a>

                        <!-- Edit Message -->
                        <form id="editMessageForm"
                              action="{{ route('account-messages-update-message', ['locale' => app()->getLocale(), 'message_id' => $message->id]) }}"
                              method="post">
                            @csrf
                            <button form="editMessageForm" type="submit"
                                    class="message-action update btn btn-main text-light">{{ translating('save-changes') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@else <!-- Datas are not found -->
    <!-- Modal -->
    <div class="modal fade" id="exampleMessageActionsModalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleMessageActionsModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold"
                        id="exampleMessageActionsModalLongTitle">{{ translating('message-action-title') }}</h5>
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
                    <textarea form="editMessageForm" name="message" rows="5"
                              class="message-content-description-edit input-default p-2 w-100"></textarea>
                </div>
                <div class="modal-footer">
                    <!-- Delete Message -->
                    <a href="{{ route('account-messages-destroy-message', ['locale' => app()->getLocale(), 'message_id' => 0]) }}"
                       class="message-action delete btn btn-danger">{{ translating('delete') }}</a>

                    <!-- Edit Message -->
                    <form id="editMessageForm"
                          action="{{ route('account-messages-update-message', ['locale' => app()->getLocale(), 'message_id' => 0]) }}"
                          method="post">
                        @csrf
                        <button form="editMessageForm" type="submit"
                                class="message-action update btn btn-main text-light">{{ translating('save-changes') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Description -->
    <p class="w-100 text-center h4">{{ translating('you-are-not-any-conversation-with-user') }}
        <strong>{{ $friend->first_name.' '.$friend->last_name }}</strong></p>

    <!-- Start Chat Text -->
    <span class="w-100 text-center d-block h5 mt-2">{{ translating('start-your-chat-here') }} <i
            class="fa fa-arrow-down"></i></span>
@endif

<!-- New Message Content -->
    <div class="newMessageContnet" id="newMessageContnet{{ Auth::user()->id }}">

    </div>

    <!-- Clear -->
    <div class="clearfix"></div>
</div>
