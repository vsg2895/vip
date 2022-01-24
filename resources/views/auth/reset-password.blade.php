@extends('layouts.app')

@section('content')
<div class="auth-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 p-60 bg-white rounded">
                <!-- Title -->
                <h1 class="mb-3">{{ translating('choose-a-new-password') }}</h1>

                <!-- Response -->
                @if(\Request::session()->has('error') && \Request::session()->get('error') != NULL)
                    <span class="alert alert-danger text-center d-block w-100 mb-3" role="alert">
                        <strong><i class="fa fa-times"></i> {{ translating('password-not-correct') }}</strong>
                    </span>                 

                    <!-- Forget this session -->
                    @php \Request::session()->forget('error'); @endphp
                @endif

                <!-- Password -->
                <div class="form-group mt-5 password-row">
                    <label class="w-100 d-block font-weight-bold @error('password') is-invalid @enderror">
                        <span class="text-left">{{ translating('password') }}</span>
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

                    <input form="resetPasswordForm" type="password" data-type="password" class="input-default w-100 p-2 no-rounded" required min="1" max="255" placeholder="{{ translating('placeholder-password') }}" name='password'>
                
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ translating('choos-a-new-password-error') }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group mt-5 password-row">
                    <label class="w-100 d-block font-weight-bold @error('password') is-invalid @enderror">
                        <span class="text-left">{{ translating('repeat-password') }}</span>
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

                    <input data-type="password" form="resetPasswordForm" type="password" class="input-default w-100 p-2 no-rounded" required min="1" max="255" placeholder="{{ translating('placeholder-password') }}" name='password_confirmation'>
                </div>

                <!-- Form -->
                <form id="resetPasswordForm" action="{{ route('reset-password-send', ['locale' => app()->getLocale()]) }}" method="post">
                    @csrf
                    <!-- Button -->
                    <button class="btn btn-main w-100 text-light" type="submit" form="resetPasswordForm">{{ translating('reset-now') }}</button>
                </form>

                <!-- Log In Now ?> -->
                <p class="h5 mt-5 w-100 text-center">{{ translating('log-in-now-title') }}&nbsp;<a href="{{  route('login', ['locale' => app()->getLocale()])}}">{{ translating('log-in-now') }}</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
