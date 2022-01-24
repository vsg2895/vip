@extends('account.messages.index')

@section('chat-section')
    <!-- Get messages -->
    @include('account.messages.conversation-only')
@endsection
