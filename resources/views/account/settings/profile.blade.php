<!-- Navigation -->
@include('account.settings.navigation')
{{--@dd(\Illuminate\Support\Facades\Session::get('auth_name'))--}}

<!-- Email -->
<div class="row mt-4">
    <!-- Label -->
    <div class="col-lg-2">
        <label class="mt-14 w-100 d-block" for="email">
            <h6>{{ translating('your-email') }}</h6>
        </label>
    </div>

    <!-- Input -->
    <div class="col-lg-5">
        <div class="form-group">
            <input id="email" type="email" class="form-control border border-none" min="1" max="255"
                   placeholder="{{ translating('placeholder-email') }}" name="email" form="profileForm" readonly
                   value="{{ Auth::user()->email }}">
        </div>
    </div>
</div>

<!-- First Name -->
<div class="row">
    <!-- Label -->
    <div class="col-lg-2">
        <label class="mt-14 w-100 d-block" for="first-name">
            <h6>{{ translating('your-first-name') }}</h6>
        </label>
    </div>

    <!-- Input -->
    <div class="col-lg-5">
        <div class="form-group">
            <input id="first-name" type="text" class="form-control border border-none" required min="1" max="255"
                   placeholder="{{ translating('placeholder-first-name') }}" name="first_name" form="profileForm"
                   @if(\Illuminate\Support\Facades\Session::get('auth_name') != null && \Illuminate\Support\Facades\Session::get('auth_name') != Auth::user()->first_name) value="{{ \Illuminate\Support\Facades\Session::get('auth_name') }}"
                   @else value="{{ Auth::user()->first_name }}" @endif>
        </div>
    </div>
</div>

<!-- Last Name -->
<div class="row">
    <!-- Label -->
    <div class="col-lg-2">
        <label class="mt-14 w-100 d-block" for="last-name">
            <h6>{{ translating('your-last-name') }}</h6>
        </label>
    </div>

    <!-- Input -->
    <div class="col-lg-5">
        <div class="form-group">
            <input id="last-name" type="text" class="form-control border border-none" required min="1" max="255"
                   placeholder="{{ translating('placeholder-last-name') }}" name="last_name" form="profileForm"
                   @if(\Illuminate\Support\Facades\Session::get('auth_last') != null && \Illuminate\Support\Facades\Session::get('auth_last') != Auth::user()->last_name) value="{{ \Illuminate\Support\Facades\Session::get('auth_last') }}"
                   @else value="{{ Auth::user()->last_name }}" @endif>
        </div>
    </div>
</div>

<!-- Location -->
<div class="row">
    <!-- Label -->
    <div class="col-lg-2">
        <label class="mt-14 w-100 d-block" for="location">
            <h6>{{ translating('location') }}</h6>
        </label>
    </div>

    <!-- Input -->
    <div class="col-lg-5">
        <div class="form-group">
            <select id="location" class="form-control border border-none" name="location_id" form="profileForm">
                <!-- Check location data -->
            @if(isset($locations) && count($locations) > 0)
                <!-- Heading -->
                    <optgroup label="{{ translating('chosse-location') }}">
                        <!-- No Location -->
                        <option value="0"
                                @if(isset(Auth::user()->location_id) && Auth::user()->location_id == 0 && \Illuminate\Support\Facades\Session::get('auth_location') == null) selected @endif>{{ translating('no-location') }}</option>
                    </optgroup>
                    <!-- Loop from locations -->
                @foreach($locations as $location)
                    <!-- Check heading -->
                    @if($location->parent_id == 0)
                        <!-- Heading -->
                            <optgroup label="{{ $location->{'title_'.app()->getLocale()} }}">
                                <!-- Loop from subitems -->
                            @foreach($locations as $parent_location)
                                <!-- Check heading -->
                                @if($location->id == $parent_location->parent_id)
                                    <!-- Subitems -->
                                        <option value="{{ $parent_location->id }}"
                                                @if((isset(Auth::user()->location_id) && Auth::user()->location_id == $parent_location->id) || \Illuminate\Support\Facades\Session::get('auth_location') == $parent_location->id) selected @endif>{{ $parent_location->{'title_'.app()->getLocale()} }}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>
    </div>
</div>

<!-- Image -->
<div class="row">
    <!-- Label -->
    <div class="col-lg-2">
        <label class="mt-14 w-100 d-block">
            <h6>{{ translating('avatar') }}</h6>
        </label>
    </div>

    <!-- Check image data -->
@if(Auth::check() && Auth::user()->role == 'user') <!-- User -->
    <!-- Input -->
    <div class="col-lg-5">
        <div class="form-group img-change">
            <label for="img">
                <form id="profileImgForm" enctype="multipart/form-data" class="d-none"
                      action="{{ route('account-change-profile-img', ['locale' => app()->getLocale()]) }}"
                      method="post">
                    @csrf
                    <input id="img" type="file" required class="form-control border border-none" name="img"
                           form="profileImgForm">
                </form>
                <!-- Check image defult or no -->
            @if(isset(Auth::user()->img) && Auth::user()->img != 'user.png') <!-- Changed Image -->
                <img src="{{ asset('assets/img/users/'.'/'.Auth::user()->img) }}"
                     class="m-w-100 rounded user-img responsive"
                     alt="{{ Auth::user()->first_name.' '.Auth::user()->last_name }}"
                     title="{{ Auth::user()->first_name.' '.Auth::user()->last_name }}">
            @else <!-- Default Image -->
                <svg xmlns="http://www.w3.org/2000/svg" width="81.24" height="80.459" viewBox="0 0 81.24 80.459">
                    <g id="Group_1208" data-name="Group 1208" transform="translate(-239 -222)">
                        <ellipse id="Ellipse_13" data-name="Ellipse 13" cx="40.62" cy="40.23" rx="40.62" ry="40.23"
                                 transform="translate(239 222)" fill="#eceff1"/>
                        <path id="Path_299" data-name="Path 299"
                              d="M123.6,118.073a15.036,15.036,0,0,0-6.239-2.881l-11.105-2.228a2.5,2.5,0,0,1-2.005-2.481v-2.547a30.426,30.426,0,0,0,2.091-3.727,20.46,20.46,0,0,1,1.783-3.124c2.248-2.259,4.421-4.8,5.094-8.067a7.78,7.78,0,0,0-.714-5.975,44.857,44.857,0,0,0-.866-10.234c-.091-3.99-.815-6.234-2.638-8.2-1.286-1.393-3.18-1.717-4.7-1.975a8.22,8.22,0,0,1-1.727-.405A17.871,17.871,0,0,0,94.019,64c-6.669.273-14.868,4.517-17.612,12.083-.851,2.3-.765,6.087-.694,9.125l-.066,1.828a8.111,8.111,0,0,0-.663,5.975c.668,3.276,2.841,5.818,5.13,8.107a22.23,22.23,0,0,1,1.777,3.109A31.474,31.474,0,0,0,84,107.94v2.547a2.517,2.517,0,0,1-2.015,2.481L70.866,115.2a15.069,15.069,0,0,0-6.219,2.876,2.538,2.538,0,0,0-.3,3.687,40.316,40.316,0,0,0,59.552,0,2.537,2.537,0,0,0-.3-3.687Z"
                              transform="translate(185.599 167.131)" fill="#1876f2"/>
                    </g>
                </svg>
                @endif
            </label>
        </div>
    </div>
@else <!-- Facebook -->
    <label for="img">
        <form id="profileImgForm" enctype="multipart/form-data" class="d-none"
              action="{{ route('account-change-profile-img', ['locale' => app()->getLocale()]) }}" method="post">
            @csrf
            <input id="img" type="file" required class="form-control border border-none" name="img"
                   form="profileImgForm">
        </form>
        <img src="{{ Auth::user()->img }}" class="m-w-100 rounded responsive"
             title="{{ Auth::user()->name.' '.Auth::user()->surname }}"
             alt="{{ Auth::user()->name.' '.Auth::user()->surname }}">
    </label>
    @endif
</div>

<!-- Button -->
<div class="row w-100">
    <form id="profileForm" action="{{ route('account-change-profile-datas', ['locale' => app()->getLocale()]) }}"
          method="post" class="w-100">
        @csrf
        <button id="sendForm" type="submit" form="profileForm"
                class="float-right btn pl-3 pr-3 btn-main text-light btn-lg">{{ translating('save-changes') }}</button>
        <p class="clearfix"></p>
    </form>
</div>

@php

    \Illuminate\Support\Facades\Session::forget('auth_name');
    \Illuminate\Support\Facades\Session::forget('auth_last');
    \Illuminate\Support\Facades\Session::forget('auth_location');
@endphp
