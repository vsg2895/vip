<div class="col-md-9 offset-md-3 chat-messenger-section">
    <!-- Write Message -->
    <div class="row w-100 d-block write-chat-area">
        <!-- Text Field -->
        <textarea placeholder="{{ translating('message...') }}" class="input-default p-2 w-100" rows="5"
                  data-description="false" form="sendMessageForm" name="message"></textarea>

        <!-- Send Button -->
        @if(isset($friend) && $friend != NULL)
            <form id="sendMessageForm" data-id="{{ Auth::user()->id }}"
                  action="{{ route('account-messages-send-message', ['locale' => app()->getLocale(), 'receiver_id' => $friend->id]) }}"
                  method="post">
                @else
                    <form id="sendMessageForm" data-id="{{ Auth::user()->id }}"
                          action="{{ route('account-messages-send-message', ['locale' => app()->getLocale(), 'receiver_id' => '0']) }}"
                          method="post">
                    @endif
                    @csrf

                    <!-- Button -->
                        <button form="sendMessageForm" type="submit"
                                class="btn btn-main text-light mt-2 btn-lg float-right">{{ translating('send') }}</button>

                        <!-- Clear -->
                        <div class="clearfix"></div>
                    </form>
    </div>
</div>
