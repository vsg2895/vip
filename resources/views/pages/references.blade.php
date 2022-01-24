@extends('layouts.app')

@section('content')
    <!-- Check data -->
    @if(isset($item) && $item != null)    
        <div class="app-container mt-150 py-3">
            <!-- Title -->
            <h1 class="mt-5 h2">{{ $item->{'title_'.app()->getLocale()} }}</h1>
            
            <!-- Description -->
            <div>{!! $item->{'description_'.app()->getLocale()} !!}</div>
        </div>
    @endif
@endsection