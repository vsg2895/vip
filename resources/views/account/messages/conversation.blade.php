@extends('account.messages.index')

@section('chat-section')
    <!-- Get messages -->
    @if(isset($active_chat_user) && !is_null($active_chat_user))
        <input type="hidden" value="{{ $active_chat_user }}" id="active_chat_user">
    @endif
    @include('account.messages.conversation-only')
@endsection
