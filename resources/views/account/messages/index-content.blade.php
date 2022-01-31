<!-- Load Content -->
<div class="load-content">
    <!-- Tab Content -->
    <div class="tab-content mt-2" id="messagesTabContent">
        <!-- Get Messages -->
        <div class="row chat-row mt-3">
            <div class="col-md-3 aside-container">
                @include('account.messages.aside')
            </div>

            <div class="col-md-9 chat-section">
                <h2 class="w-100 text-center"><i class="far fa-envelope"></i> {{ translating('please-select-chat-to-begin-conversation') }}</h2>
            </div>
        </div>
    </div>

    <!-- Get textarea data -->
    <div class="col-md-9 offset-md-3 chat-messenger-section">
        <!-- Write Message -->
        <div class="row w-100 d-block write-chat-area">
            <!-- Text Field -->
            <textarea class="input-default p-2 w-100" data-description="false" form="sendMessageForm" name="message" rows="3"></textarea>

            <!-- Send Button -->
            <form id="sendMessageForm" data-id="{{ Auth::user()->id }}" action="{{ route('account-messages-send-message', ['locale' => app()->getLocale(), 'receiver_id' => '0']) }}" method="post">
                @csrf
                <!-- Button -->
                <button form="sendMessageForm" type="submit" class="btn btn-main text-light mt-2 btn-lg float-right">{{ translating('send') }}</button>
                <!-- Clear -->
                <div class="clearfix"></div>
            </form>
        </div>
    </div>

</div>
