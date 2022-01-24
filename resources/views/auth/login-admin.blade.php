@extends('layouts.app')

@section('content')
<div class="auth-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 p-60 bg-white rounded">
                <!-- Image -->
                <a href="{{ route('home', ['locale' => app()->getLocale()]) }}">
                    <svg class="d-block mx-auto" xmlns="http://www.w3.org/2000/svg" width="174" height="44" viewBox="0 0 174 44">
                        <g id="Group_406" data-name="Group 406" transform="translate(-100 -31)">
                            <text id="Yerevan.v_p" data-name="Yerevan.v  p" transform="translate(100 67)" font-size="33" font-family="SegoeUI, Segoe UI"><tspan x="0" y="0" xml:space="preserve">Yerevan.v  p</tspan></text>
                            <g id="Group_405" data-name="Group 405" transform="matrix(0.914, 0.407, -0.407, 0.914, 2081.03, 1354.72)">
                            <g id="Group_404" data-name="Group 404" transform="translate(-2225.966 -452.347) rotate(-21)">
                                <g id="Group_403" data-name="Group 403" transform="translate(0 0)">
                                <path id="Path_221" data-name="Path 221" d="M13.211,1.826a1.341,1.341,0,0,0-1.3,1.658L9.27,4.473,7.953,2.5A1.341,1.341,0,1,0,6.6,2.5L5.282,4.473,2.644,3.484a1.342,1.342,0,1,0-.86.949L4.109,8.308V9.559a.428.428,0,0,0,.428.428h5.478a.428.428,0,0,0,.428-.428V8.308l2.325-3.875a1.341,1.341,0,1,0,.443-2.607ZM1.341,3.652a.485.485,0,1,1,.485-.485A.486.486,0,0,1,1.341,3.652ZM7.276.856a.485.485,0,1,1-.485.485A.486.486,0,0,1,7.276.856ZM9.587,9.131H4.965V8.617H9.587Zm.186-1.37H4.779L2.8,4.455l2.5.939a.428.428,0,0,0,.506-.163l1.47-2.205,1.47,2.205a.432.432,0,0,0,.506.163l2.5-.939Zm3.438-4.109a.485.485,0,1,1,.485-.485A.486.486,0,0,1,13.211,3.652Z"/>
                                </g>
                            </g>
                            </g>
                            <line id="Line_6" data-name="Line 6" y2="18" transform="translate(238.5 49.5)" fill="none" stroke="#000" stroke-width="3"/>
                        </g>
                    </svg>
                </a>

                <!-- Email -->
                <div class="form-group mt-5">
                    <label class="w-100 d-block font-weight-bold @error('email') is-invalid @enderror">{{ translating('email') }}</label>
                    <input form="adminLogInForm" type="email" class="input-default w-100 p-2 no-rounded" required min="1" max="255" placeholder="{{ translating('placeholder-email') }}" name='email'>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ translating('login-email-or-password-error') }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group mt-5 password-row">
                    <label class="w-100 d-block font-weight-bold @error('password') is-invalid @enderror">
                        <span class="text-left">{{ translating('password') }}</span>
                    </label>
                    
                    <input form="adminLogInForm" id="password" type="password" class="input-default w-100 p-2 no-rounded" required min="1" max="255" placeholder="{{ translating('placeholder-password') }}" name='password'>
                
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ translating('login-password-error') }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Form -->
                <form id="adminLogInForm" action="{{ route('login', ['locale' => app()->getLocale()]) }}" method="post">
                    @csrf
                    <!-- Button -->
                    <button class="btn btn-black w-100 text-light mt-5 btn-lg" type="submit" form="adminLogInForm">{{ translating('log-in') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
