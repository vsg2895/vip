<!-- Content -->
<div class="row no-gutters">
    <!-- Title -->
    <h5 class="w-100 d-block h3">{{ translating('users') }}
        <button type="button" data-close="<i class='far fa-user'></i> {{ translating('close-users-list') }}"
                data-show="<i class='far fa-user'></i> {{ translating('show-users-list') }}"
                class="see-users-list float-right btn btn-dark btn-sm"><i
                class="far fa-user"></i> {{ translating('show-users-list') }}</button>
    </h5>

    <span
        data-modal-url="{{ route('account-messages-destroy-message', ['locale' => app()->getLocale(), 'message_id' => 0]) }}"
        data-update-url="{{ route('account-messages-update-message', ['locale' => app()->getLocale(), 'message_id' => 0]) }}"
        data-edit-url="{{ route('account-messages-destroy-message', ['locale' => app()->getLocale(), 'message_id' => 0]) }}"
        data-toggle="modal" data-target="#exampleMessageActionsModalCenter"
        class="fa fa-ellipsis-v more-info-message d-none"></span>

    <!-- Check image -->
@if(Auth::user()->role == 'facebook_user' || Auth::user()->role == 'google_user')
    <!-- My Image -->
        <img class="my-image d-none" src="{{ Auth::user()->img }}">
@else
    <!-- My Image -->
        <img class="my-image d-none" src="{{ asset('assets/img/users'.'/'.Auth::user()->img) }}">
@endif

<!-- Users List -->
    <ul class="list-group list-chat-item aside">
        <!-- Check data -->
    @if(isset($users) && count($users) > 0)
        <!-- Loop from users -->
        @foreach($users as $user)
            <!-- User Item -->
                <li class="chat-user-list" id="chat-user-list{{ $user->id }}">
                    <!-- URL -->
                    <a data-id="{{ $user->id }}" data-role="{{ $user->id }}" data-image="{{ $user->img }}"
                       data-authRole="{{ Auth::user()->role }}" data-authImage="{{ Auth::user()->img }}"
                       data-authFullName="{{ Auth::user()->first_name.' '.Auth::user()->last_name }}"
                       href="{{ route('account-messages-conversation',['locale' => app()->getLocale(), 'user_id' => $user->id]) }}">
                        <!-- Image and Status -->
                        <div class="chat-image">
                            <!-- Check image -->
                        @if($user->role == 'facebook_user' || $user->role == 'google_user') <!-- Facebook or Google -->
                            <!-- Image -->
                            <img src="{{ $user->img }}" width="50px" class="rounded-circle responsive"
                                 alt="{{ $user->first_name.' '.$user->last_name }}">
                        @else <!-- User -->
                            <!-- Image -->
                            <img src="{{ asset('assets/img/users'.'/'.$user->img) }}" width="50px"
                                 class="rounded-circle responsive" alt="{{ $user->first_name.' '.$user->last_name }}">
                            @endif
                        </div>

                        <!-- Fullname -->
                        <div class="chat-name font-weight-bold">
                            {{ $user->first_name.' '.$user->last_name }}
                        </div>
                    </a>
                    @if(isset($auth_user_unread_messages) && count($auth_user_unread_messages) != 0)
                        @foreach($auth_user_unread_messages as $author_unread_message)
                            @if($user->id == $author_unread_message->sender_id)
                                <span class="real-message-impuls">
                                  <i class="fas fa-circle new-message-in-user-list" id="new-message-in-user-list"></i>
                                </span>
                            @endif
                        @endforeach
                    @endif
                </li>
            @endforeach
        @endif
    </ul>
</div>
