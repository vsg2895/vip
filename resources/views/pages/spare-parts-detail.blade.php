@extends('layouts.app')

@section('content')
    <div class="app-container mt-150 py-3">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <!-- Image -->
                <img src="{{ asset($assets_path.'/img/spare-parts/'.$item->img) }}" class="responsive w-50 rounded d-block mx-auto" title="{{ $item->first_name.' '.$item->last_name }}" alt="{{ $item->first_name.' '.$item->last_name }}">
            
                <!-- Fullname -->
                <h4 class="text-dark w-100 d-block text-center mt-4">{{ translating('fullname').': '.$item->first_name.' '.$item->last_name }}</h4>

                <!-- Location -->
                <h4 class="text-dark w-100 d-block text-center mt-4">{{ translating('location').': '.$item->location['title_'.app()->getLocale()] }}</h4>

                <!-- Model -->
                <h4 class="text-dark w-100 d-block text-center mt-4">{{ translating('model-work').': '.$item->model['title_'.app()->getLocale()] }}</h4>

                <!-- Email -->
                <h4 class="text-dark w-100 d-block text-center mt-4">{{ translating('email').': '.$item->email }}</h4>

                <!-- Phone -->
                <h4 class="text-dark w-100 d-block text-center mt-4">{{ translating('phone').': '.$item->phone }}</h4>
            </div>
        </div>
    </div>
@endsection