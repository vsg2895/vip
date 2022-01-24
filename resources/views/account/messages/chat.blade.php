<div class="row chat-row mt-3">
    <div class="col-lg-3 col-md-4 col-12 aside-container">
        @include('account.messages.aside')
    </div>

    <div class="col-lg-9 col-md-8 col-12 chat-section" id="in_current_chat">
        @yield('chat-section')
    </div>
</div>
