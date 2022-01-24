@extends('layouts.app')

@section('content')
    <!-- Content -->
    <div class="app-container mt-150 py-3">
        <div class="row">
            <!-- Filter -->
            <div class="col-lg-3 col-md-8 col-12 mb-5">
                <!-- Title -->
                <h3><i class="fa fa-filter"></i> {{ translating('filtering') }}</h3>

                <!-- Break -->
                <hr>
                <form id="spareForm" action="{{ route('spare-parts-filter', ['locale' => app()->getLocale()]) }}" method="post">
                    @csrf
                    <!-- Location -->
                    <div class="form-group mt-2">
                        <!-- Label -->
                        <label class="w-100 d-block">{{ translating('location') }}</label>

                        <!-- Input -->
                        <select name="spare_location" form="spareForm" class="p-2 w-100 input-default spareInput mb-2">
                            <!-- Default -->
                            <option value="#">{{ translating('all') }}</option>
                            
                            <!-- Check data -->
                            @if(isset($locations) && count($locations) > 0)
                                <!-- Loop from items -->
                                @foreach($locations  as $location)
                                    <!-- Option -->
                                    <option value="{{ $location->id }}">{{ $location->{'title_'.app()->getLocale()} }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <!-- Model -->
                    <div class="form-group mt-2">
                        <!-- Label -->
                        <label class="w-100 d-block">{{ translating('model') }}</label>

                        <!-- Input -->
                        <select name="spare_model" form="spareForm" class="p-2 w-100 spareInput input-default mb-2">
                            <!-- Default -->
                            <option value="#">{{ translating('all') }}</option>
                            
                            <!-- Check data -->
                            @if(isset($models) && count($models) > 0)
                                <!-- Loop from items -->
                                @foreach($models  as $model)
                                    <!-- Option -->
                                    <option value="{{ $model->id }}">{{ $model->{'title_'.app()->getLocale()} }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                <form>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9  col-md-8 col-12">
                <!-- Load Contnet -->
                <div class="row load-content">
                    <!-- Items -->
                    @include('pages.spare-parts-only')
                </div>
            </div>
        </div>
    </div>
@endsection