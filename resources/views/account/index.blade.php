@extends('layouts.app')

@section('content')
    <!-- Page Content -->
    <div class="app-container mt-150 py-3">
        <div class="row">
           <!-- Aside Menu -->
           @include('account.aside')

           <!-- Main content -->
           <div class="col-lg-9 col-md-12 bg-white account-content">
                @yield('account-content')
           </div>
        </div>
    </div>
@endsection