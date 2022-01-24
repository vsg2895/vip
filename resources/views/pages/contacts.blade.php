@extends('layouts.app')

@section('content')
    <!-- Page Content -->
    <div class="app-container mt-150 py-3">
        <div class="row no-gutters w-100">
            <!-- Page Description -->
            @include('components.contatcs.form')

            <!-- Map Section -->
            @include('components.contatcs.map')
        </div>
    </div>
@endsection