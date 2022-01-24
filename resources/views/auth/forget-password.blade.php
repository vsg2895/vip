@extends('layouts.app')

@section('content')
<div class="auth-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 p-60 bg-white rounded">
                <!-- Title -->
                <h1>{{ translating('forget-password-title') }}</h1>

                <!-- Response -->
                @if(\Request::session()->has('error') && \Request::session()->get('error') != NULL)
                    <span class="alert alert-danger text-center d-block w-100 mb-3" role="alert">
                        <strong><i class="fa fa-times"></i> {{ translating('your-data-is-not-found-try-again') }}</strong>
                    </span>                 

                    <!-- Forget this session -->
                    @php \Request::session()->forget('error'); @endphp
                @endif

                <!-- Response -->
                @if(\Request::session()->has('email') && \Request::session()->get('email') != NULL && \Request::session()->has('phone') && \Request::session()->get('phone') != NULL)
                    <span class="alert alert-success text-center d-block w-100 mb-3" role="alert">
                        <strong><i class="fa fa-check"></i> {{ translating('your-data-sen-to-your-email-address') }}</strong>
                    </span>                 
                @endif
                
                <!-- Descriptoin -->
                <p>{!! translating('forget-password-description') !!}</p>
                
                <!-- Email -->
                <div class="form-group mt-5">
                    <label class="w-100 d-block @error('email') is-invalid @enderror">{{ translating('email') }}</label>
                    <input value="{{ old('email') }}" form="forgetPasswordForm" type="email" class="input-default w-100 p-2 no-rounded" required min="1" max="255" placeholder="{{ translating('placeholder-email') }}" name='email'>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ translating('forget-password-email-error') }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Phone Number -->
                <div class="form-group mt-5">
                    <label class="w-100 d-block font-weight-bold @error('phone') is-invalid @enderror">{{ translating('phone-number') }}</label>
                    <div class="row no-gutters">
                        <div class="col-md-2 col-sm-3 col-3">
                            @if(isset($countries) && count($countries) > 0)
                                <select style="-webkit-appearance: none;" form="forgetPasswordForm" name="country_id" class="w-100 no-rounded input-default p-2" required>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" @if($country->code == '374' && $country->id == 121) selected @endif>{{ '+ '.$country->code.' '.$country->{'title_'.app()->getLocale()} }}</option>
                                    @endforeach
                                </select>
                            @else
                                <select style="-webkit-appearance: none;" form="forgetPasswordForm" name="country_id" class="w-100 no-rounded input-default p-2" required>
                                    <option value="121">{{ '+ '.'374'.' '.translating('armenia') }}</option>
                                </select>
                            @endif
                        </div>
                        <div class="col-md-10 col-sm-9 col-9">
                            <input value="{{ old('phone') }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" form="forgetPasswordForm" type="text" class="input-default w-100 p-2 no-rounded" required min="1" max="255" placeholder="{{ translating('placeholder-phone-number') }}" name='phone'>
                        </div>
                    </div>

                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ translating('forget-password-phone-number-error') }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Form -->
                <form id="forgetPasswordForm" action="{{ route('forget-password-send', ['locale' => app()->getLocale()]) }}" method="post">
                    @csrf
                    <!-- Button -->
                    <button class="btn btn-main w-100 text-light mt-5 btn-lg" type="submit" form="forgetPasswordForm">{{ translating('send') }}</button>
                </form>

                <!-- Has'nt account ?> -->
                <p class="h5 mt-5 w-100 text-center">{{ translating('not-account-yet-?') }}&nbsp;<a href="{{  route('register', ['locale' => app()->getLocale()])}}">{{ translating('create-account') }}</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
