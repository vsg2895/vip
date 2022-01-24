@extends('layouts.app')

@section('content')
<div class="auth-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 p-60 bg-white rounded">
                <!-- Email -->
                <div class="form-group">
                    <!-- Sended message response check -->
                    @if(\Request::session()->has('email-sended') && \Request::session()->get('email-sended') != NULL)
                        <!-- Sended message response check -->
                        <span class="alert alert-success text-center d-block w-100 mb-3" role="alert">
                            <strong><i class="fa fa-check"></i> {{ translating('confirmation-sended-to-your-email-address') }}</strong>
                        </span>                 

                        <!-- Forget this session -->
                        @php \Request::session()->forget('email-sended'); @endphp
                    @endif

                    <!-- Label -->
                    <label class="w-100 d-block">{{ translating('resend-email-again-description') }}</label>

                    <!-- Label -->
                    <label class="w-100 d-block font-weight-bold @error('email') is-invalid @enderror">{{ translating('resend-email-again-?') }}</label>
                    
                    <!-- Input -->
                    <input form="resendEmailForm" type="email" class="input-default w-100 p-2  mt-2 no-rounded" required min="1" max="255" placeholder="{{ translating('placeholder-email') }}" name='email'>

                    <!-- Error message -->
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ translating('resend-email-email-error') }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Form -->
                <form id="resendEmailForm" action="{{ route('resend-email', ['locale' => app()->getLocale()]) }}" method="post">
                    @csrf
                    <!-- Button -->
                    <button class="btn btn-black w-100 text-light mt-2 btn-lg" type="submit" form="resendEmailForm">{{ translating('resend-now') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
