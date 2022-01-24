<!-- Content -->
<div class="alerts-section">
    <!-- Check alert data page -->
    @if(\Request::route()->getName() != 'account-messages' && \Request::route()->getName() != 'account-messages-conversation')
        <!-- Check data -->
        @if(isset($user_unreaded_alerts) && count($user_unreaded_alerts) > 0)
            <!-- Loop from items -->
            @foreach($user_unreaded_alerts as $user_unreaded_alert)
                <!-- Alert -->
                <a href="{{ route('account-messages-conversation', ['locale' => app()->getLocale(), 'user_id' => $user_unreaded_alert->sender_id]) }}" class="alert alert-warning alert-dismissible fade show w-100 d-block" role="alert">
                    <!-- Sender Data -->
                    <strong>{{ $user_unreaded_alert->sender['first_name'].' '. $user_unreaded_alert->sender['last_name'] }}</strong> 

                    <!-- Description -->
                    <div class="w-100 d-block clearfix">
                        {{ mb_substr(html_entity_decode(strip_tags($user_unreaded_alert->message['message'])), 0, 300) }}
                    </div>

                    <!-- Break -->
                    <hr>

                    <!-- Time -->
                    <div class="w-100 d-block clearfix">
                        <i class="far fa-calendar"></i> {{ date_default_format($user_unreaded_alert->created_at) }} | <i class="far fa-clock"></i> {{ time_default_format($user_unreaded_alert->created_at) }}
                    </div>
                    
                    <!-- Close Button -->
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </a>
            @endforeach

            <!-- Check max data -->
            @if(isset($user_unreaded_messages_count) && intval($user_unreaded_messages_count) > 3)
                <!-- Alert -->
                <div class="alert alert-warning alert-dismissible fade show w-100 d-block text-center" role="alert">
                    <!-- Url -->
                    <a href="{{ route('account-messages', ['locale' => app()->getLocale()]) }}" class="text-dark"><i class="far fa-envelope"></i> {{ translating('view-all-messages') }}</a>
                
                    <!-- Close Button -->
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            @endif
        @endif
    @endif
</div>

