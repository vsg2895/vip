@extends('layouts.app')

@section('content')
<div class="auth-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 p-60 bg-white rounded">
                <!-- Title -->
                <h1 class="mb-3">{{ translating('log-in') }}</h1>

                <!-- Response -->
                @if(\Request::session()->has('password-changed') && \Request::session()->get('password-changed') != NULL)
                    <span class="alert alert-success text-center d-block w-100 mb-3" role="alert">
                        <strong><i class="fa fa-check"></i> {{ translating('your-password-changed-successfully-log-in-to-your-new-password') }}</strong>
                    </span>

                    <!-- Forget sessions -->
                    @php \Request::session()->forget('password-changed'); \Request::session()->forget('email'); \Request::session()->forget('phone'); @endphp
                @endif

                <!-- Email -->
                <div class="form-group mt-5">
                    <label class="w-100 d-block font-weight-bold @error('email') is-invalid @enderror">{{ translating('email') }}</label>
                    <input form="logInForm" type="email" class="input-default w-100 p-2 no-rounded" required min="1" max="255" name='email'>

                    @error('email')
                        <strong class="text-danger w-100">{{ translating('login-email-or-password-error') }}</strong>
                    @enderror

                    @if(\Request::session()->has('email_already_exists') && \Request::session()->get('email_already_exists') != NULL)
                        <strong class="text-danger w-100">{{ translating('email-already-registered-error') }}</strong>

                        @php \Request::session()->forget('email_already_exists'); @endphp
                    @endif
                </div>

                <!-- Password -->
                <div class="form-group mt-5 password-row">
                    <label class="w-100 d-block font-weight-bold @error('password') is-invalid @enderror">
                        <span class="text-left">{{ translating('password') }}</span>
                        <a class="text-right float-right" href="{{ route('forget-password', ['locale' => app()->getLocale()]) }}">{{ translating('forget-password-?') }}</a>
                    </label>

                    <!-- Lock or Unlock icon -->
                    <div class="lock-icons-area">
                        <!-- Lock icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="23.018" height="23.018" viewBox="0 0 23.018 23.018">
                            <g id="hide_1_" data-name="hide (1)" transform="translate(0 0)">
                                <g id="Group_161" data-name="Group 161" transform="translate(0 0)">
                                    <g id="Group_160" data-name="Group 160" transform="translate(0 0)">
                                        <path id="Path_15" data-name="Path 15" d="M22.877,21.521,1.5.141a.48.48,0,0,0-.678,0L.14.819a.479.479,0,0,0,0,.678L4.106,5.462a12.324,12.324,0,0,0-4.083,5.9.482.482,0,0,0,0,.293,12.085,12.085,0,0,0,11.486,8.485,11.851,11.851,0,0,0,5.779-1.5l4.233,4.233a.48.48,0,0,0,.678,0l.678-.678A.479.479,0,0,0,22.877,21.521Zm-11.368-3.3A6.7,6.7,0,0,1,6.137,7.494L8.222,9.579a3.757,3.757,0,0,0-.55,1.93,3.841,3.841,0,0,0,3.836,3.836,3.758,3.758,0,0,0,1.93-.55l2.085,2.085A6.7,6.7,0,0,1,11.509,18.223Z" transform="translate(0 0)" fill="#a2aebc"/>
                                        <path id="Path_16" data-name="Path 16" d="M246.2,171.044a.48.48,0,0,0,.1.525l3.316,3.316a.479.479,0,0,0,.819-.345,3.809,3.809,0,0,0-3.789-3.789A.523.523,0,0,0,246.2,171.044Z" transform="translate(-235.1 -163.074)" fill="#a2aebc"/>
                                        <path id="Path_17" data-name="Path 17" d="M156.728,66.484a.48.48,0,0,0,.546.094,6.642,6.642,0,0,1,2.888-.661,6.721,6.721,0,0,1,6.713,6.713,6.642,6.642,0,0,1-.661,2.888.48.48,0,0,0,.094.546l1.662,1.662a.479.479,0,0,0,.339.14h0a.482.482,0,0,0,.34-.142,12.5,12.5,0,0,0,3-4.948.482.482,0,0,0,0-.293A12.085,12.085,0,0,0,160.163,64a11.943,11.943,0,0,0-4.2.761.479.479,0,0,0-.171.788Z" transform="translate(-148.654 -61.122)" fill="#a2aebc"/>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>

                    <input form="logInForm" id="password" data-type="password" type="password" class="input-default w-100 p-2 no-rounded" required min="1" max="255" name='password'>

                    @error('password')
                            <strong class="text-danger">{{ translating('login-password-error') }}</strong>
                        </span>
                    @enderror

                    <input class="checkbox d-none" form="logInForm" checked name="remember" type="checkbox">
                </div>

                <!-- Form -->
                <form id="logInForm" action="{{ route('login', ['locale' => app()->getLocale()]) }}" method="post">
                    @csrf
                    <!-- Button -->
                    <button class="btn btn-main w-100 text-light" type="submit" form="logInForm">{{ translating('log-in') }}</button>
                </form>

                <!-- Other Methods Login -->
                <!-- Has'nt account ?> -->
                <p class="h5 mt-5 w-100 text-center">{{ translating('not-account-yet-?') }}&nbsp;<a class="btn btn-main text-light" href="{{  route('register', ['locale' => app()->getLocale()])}}">{{ translating('create-account') }}</a></p>
{{--                <h6 class="w-100 text-center my-3">{{ translating('speed-login') }}</h6>--}}
                <hr>

                <!-- Log in with google -->
                <a href="{{ route('login-google', ['locale' => app()->getLocale()]) }}" class="btn btn-light w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22.54" height="22.54" viewBox="0 0 22.54 22.54">
                        <g id="Group_150" data-name="Group 150" transform="translate(0)">
                            <g id="search" transform="translate(0)">
                            <path id="Path_7" data-name="Path 7" d="M5,145.8l-.785,2.929-2.868.061a11.29,11.29,0,0,1-.083-10.524h0l2.553.468,1.118,2.538A6.726,6.726,0,0,0,5,145.8Z" transform="translate(0 -132.181)" fill="#fbbb00"/>
                            <path id="Path_8" data-name="Path 8" d="M272.453,208.176a11.266,11.266,0,0,1-4.018,10.894h0l-3.216-.164-.455-2.841a6.717,6.717,0,0,0,2.89-3.43h-6.026v-4.458h10.825Z" transform="translate(-250.11 -199.011)" fill="#518ef8"/>
                            <path id="Path_9" data-name="Path 9" d="M47.491,315.846h0A11.273,11.273,0,0,1,30.509,312.4l3.652-2.99a6.7,6.7,0,0,0,9.659,3.432Z" transform="translate(-29.166 -295.788)" fill="#28b446"/>
                            <path id="Path_10" data-name="Path 10" d="M45.827,2.595,42.176,5.584A6.7,6.7,0,0,0,32.3,9.093L28.625,6.087h0a11.272,11.272,0,0,1,17.2-3.492Z" transform="translate(-27.364)" fill="#f14336"/>
                            </g>
                        </g>
                    </svg>
                    &nbsp;{{ translating('log-in-from-google') }}
                </a>

                <!-- Log in with facebook -->
                <a href="{{ route('login-facebook', ['locale' => app()->getLocale()]) }}" class="btn btn-facebook text-light w-100 my-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12.498" height="24.069" viewBox="0 0 12.498 24.069">
                        <g id="facebook-app-symbol_1_" data-name="facebook-app-symbol (1)" transform="translate(0 0)">
                            <path id="f_1_" d="M45.4,24.069V13.091h3.683l.553-4.28H45.4V6.079C45.4,4.841,45.746,4,47.524,4h2.264V.168A30.7,30.7,0,0,0,46.488,0c-3.267,0-5.5,1.994-5.5,5.655V8.811H37.29v4.28h3.695V24.069Z" transform="translate(-37.29 0)" fill="#fff"/>
                        </g>
                    </svg>
                    &nbsp;{{ translating('log-in-from-facebook') }}
                </a>



            </div>
        </div>
    </div>
</div>
@endsection
