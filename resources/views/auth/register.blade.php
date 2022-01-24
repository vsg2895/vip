@extends('layouts.app')

@section('content')
    <div class="auth-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 p-60 bg-white rounded">
                    <!-- Title -->
                    <h1 class="mb-3">{{ translating('registration') }}</h1>

                    <!-- First Name -->
                    <div class="form-group mt-5">
                        <label
                            class="w-100 d-block font-weight-bold @error('first_name') is-invalid @enderror">{{ translating('first-name') }}</label>
                        <input form="registrationForm" type="text" class="input-default w-100 p-2 no-rounded"
                               value="{{ old('first_name') }}" required min="1" max="255" name='first_name'>

                        {{--                        @error('first_name')--}}
                        {{--                        <span class="invalid-feedback" role="alert">--}}
                        {{--                            <strong>{{ translating('registration-first-name-error') }}</strong>--}}
                        {{--                        </span>--}}
                        {{--                        @enderror--}}

                        @if(isset($errors->default->messages()['first_name']))
                            <span class="invalid-feedback" role="alert">
                           @foreach($errors->default->messages()['first_name'] as $msg)
                                    <strong>
                                    {{ $msg }}
                                </strong>
                                @endforeach
                            </span>
                        @endif
                    </div>

                    <!-- Last Name -->
                    <div class="form-group mt-5">
                        <label
                            class="w-100 d-block font-weight-bold @error('last_name') is-invalid @enderror">{{ translating('last-name') }}</label>
                        <input form="registrationForm" type="text" class="input-default w-100 p-2 no-rounded"
                               value="{{ old('last_name') }}" required min="1" max="255" name='last_name'>

                        {{--                        @error('last_name')--}}
                        {{--                        <span class="invalid-feedback" role="alert">--}}
                        {{--                            <strong>{{ translating('registration-last-name-error') }}</strong>--}}
                        {{--                        </span>--}}
                        {{--                        @enderror--}}
                        @if(isset($errors->default->messages()['last_name']))
                            <span class="invalid-feedback" role="alert">
                          @foreach($errors->default->messages()['last_name'] as $msg)
                                    <strong>
                                    {{ $msg }}
                                </strong>
                                @endforeach
                            </span>
                        @endif
                    </div>

                    <!-- Email -->
                    <div class="form-group mt-5">
                        <label
                            class="w-100 d-block font-weight-bold @error('email') is-invalid @enderror">{{ translating('email') }}</label>
                        <input form="registrationForm" type="email" class="input-default w-100 p-2 no-rounded"
                               value="{{ old('email') }}" required min="1" max="255" name='email'>

                        {{--                        @error('email')--}}
                        @if(isset($errors->default->messages()['email']))
                            <span class="invalid-feedback" role="alert">
                           @foreach($errors->default->messages()['email'] as $msg)
                                    <strong>
                                    {{ $msg }}
                                </strong>
                                @endforeach
{{--                            <strong>{{ translating('registration-email-error') }}</strong>--}}
                        </span>
                        @endif
                    </div>

                    <!-- Phone Number -->
                    <div class="form-group mt-5">
                        <label
                            class="w-100 d-block font-weight-bold @error('phone') is-invalid @enderror">{{ translating('phone-number') }}</label>
                        <div class="row no-gutters">
                            <div class="col-md-2 col-sm-3 col-3">
                                @if(isset($countries) && count($countries) > 0)
                                    <select style="-webkit-appearance: none;" form="registrationForm" name="phone_code"
                                            class="w-100 no-rounded input-default p-2" id="reg_phone_country_code"
                                            required>
                                        @foreach($countries as $country)
                                            <option value="+{{ $country->code }}"
                                                    @if($country->code == '374') selected @endif>{{ '+ '.$country->code.' '.$country->{'title_'.app()->getLocale()} }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select style="-webkit-appearance: none;" form="registrationForm" name="phone_code"
                                            class="w-100 no-rounded input-default p-2" required>
                                        <option value="+374">{{ translating('armenia') }}</option>
                                    </select>
                                @endif
                            </div>
                            <div class="col-md-8 col-sm-9 col-9">
                                <div class="alert alert-danger" id="error" style="display: none;"></div>
                                <div class="alert alert-success" id="successAuth" style="display: none;"></div>

                                <input
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    form="registrationForm" type="text" class="input-default w-100 p-2 no-rounded"
                                    required min="1" max="255" name='phone' id="number"
                                    data-route="{{ route('check.reg.phone',app()->getLocale()) }}">
                                <div class="col-md-10 col-sm-10 col-10">

                                      <div id="recaptcha-container" data-size="small"></div>

                                </div>



                            </div>
                            <div class="col-md-2 col-sm-1 col-1 button-send-col">

                                <button type="button" class="btn btn-primary" onclick="sendOTP();">

                                    <i class="fas fa-share"></i>

                                </button>
                            </div>
                        </div>

                        @if(isset($errors->default->messages()['phone']))
                            <span class="invalid-feedback" role="alert">
                           @foreach($errors->default->messages()['phone'] as $msg)
                                    <strong>
                                    {{ $msg }}
                                </strong>
                                @endforeach
{{--                            <strong>{{ translating('registration-email-error') }}</strong>--}}
                            </span>
                        @endif
                    </div>
                    {{-- Verify code blok--}}

                    <div class="form-group mt-3 justify-content-center d-none" id="visible-verify">

                        <div class="col-md-7 col-sm-7 col-6">
                            <div class="alert alert-success" id="successOtpAuth" style="display: none;"></div>

                            <input
                                type="text" class="input-default w-100 p-2 no-rounded"
                                name='phone-code' id="verification">


                        </div>
                        <div class="col-md-1 col-sm-9 col-9 p-0">

                            <button type="button" onclick="verify()" class="btn btn-primary sub_reg">

                                <i class="fas fa-check-circle"></i>

                            </button>

                        </div>

                    </div>
                    @if(isset($errors->default->messages()['confirm_phone_code']))

                        <span class="invalid-feedback" role="alert">

                            @foreach($errors->default->messages()['confirm_phone_code'] as $msg)
                                <strong>
                                    {{ $msg }}
                                </strong>
                            @endforeach

                            </span>
                    @endif
                <!-- Password -->
                    <div class="form-group mt-5 password-row">
                        <label class="w-100 d-block font-weight-bold is-invalid">
                            <span class="text-left">{{ translating('password') }}</span>
                        </label>
                            @if(isset($errors->default->messages()['password']))
                                <span class="invalid-feedback" role="alert">
                            @foreach($errors->default->messages()['password'] as $msg)
                                        <strong>
                                    {{ $msg }}
                                </strong>
                                    @endforeach
                            </span>
                        @endif
                        <!-- Lock or Unlock icon -->
                            <div class="lock-icons-area">
                                <!-- Lock icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="23.018" height="23.018"
                                     viewBox="0 0 23.018 23.018">
                                    <g id="hide_1_" data-name="hide (1)" transform="translate(0 0)">
                                        <g id="Group_161" data-name="Group 161" transform="translate(0 0)">
                                            <g id="Group_160" data-name="Group 160" transform="translate(0 0)">
                                                <path id="Path_15" data-name="Path 15"
                                                      d="M22.877,21.521,1.5.141a.48.48,0,0,0-.678,0L.14.819a.479.479,0,0,0,0,.678L4.106,5.462a12.324,12.324,0,0,0-4.083,5.9.482.482,0,0,0,0,.293,12.085,12.085,0,0,0,11.486,8.485,11.851,11.851,0,0,0,5.779-1.5l4.233,4.233a.48.48,0,0,0,.678,0l.678-.678A.479.479,0,0,0,22.877,21.521Zm-11.368-3.3A6.7,6.7,0,0,1,6.137,7.494L8.222,9.579a3.757,3.757,0,0,0-.55,1.93,3.841,3.841,0,0,0,3.836,3.836,3.758,3.758,0,0,0,1.93-.55l2.085,2.085A6.7,6.7,0,0,1,11.509,18.223Z"
                                                      transform="translate(0 0)" fill="#a2aebc"/>
                                                <path id="Path_16" data-name="Path 16"
                                                      d="M246.2,171.044a.48.48,0,0,0,.1.525l3.316,3.316a.479.479,0,0,0,.819-.345,3.809,3.809,0,0,0-3.789-3.789A.523.523,0,0,0,246.2,171.044Z"
                                                      transform="translate(-235.1 -163.074)" fill="#a2aebc"/>
                                                <path id="Path_17" data-name="Path 17"
                                                      d="M156.728,66.484a.48.48,0,0,0,.546.094,6.642,6.642,0,0,1,2.888-.661,6.721,6.721,0,0,1,6.713,6.713,6.642,6.642,0,0,1-.661,2.888.48.48,0,0,0,.094.546l1.662,1.662a.479.479,0,0,0,.339.14h0a.482.482,0,0,0,.34-.142,12.5,12.5,0,0,0,3-4.948.482.482,0,0,0,0-.293A12.085,12.085,0,0,0,160.163,64a11.943,11.943,0,0,0-4.2.761.479.479,0,0,0-.171.788Z"
                                                      transform="translate(-148.654 -61.122)" fill="#a2aebc"/>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>

                            <input form="registrationForm" type="password" data-type="password"
                                   class="input-default w-100 p-2 no-rounded" required min="1" max="255"
                                   name='password'>
                    </div>

                    <!-- Password -->
                    <div class="form-group mt-5 password-row">
                        <label class="w-100 d-block font-weight-bold @error('password') is-invalid @enderror">
                            <span class="text-left">{{ translating('repeat-password') }}</span>
                        </label>

                        <!-- Lock or Unlock icon -->
                        <div class="lock-icons-area">
                            <!-- Lock icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="23.018" height="23.018"
                                 viewBox="0 0 23.018 23.018">
                                <g id="hide_1_" data-name="hide (1)" transform="translate(0 0)">
                                    <g id="Group_161" data-name="Group 161" transform="translate(0 0)">
                                        <g id="Group_160" data-name="Group 160" transform="translate(0 0)">
                                            <path id="Path_15" data-name="Path 15"
                                                  d="M22.877,21.521,1.5.141a.48.48,0,0,0-.678,0L.14.819a.479.479,0,0,0,0,.678L4.106,5.462a12.324,12.324,0,0,0-4.083,5.9.482.482,0,0,0,0,.293,12.085,12.085,0,0,0,11.486,8.485,11.851,11.851,0,0,0,5.779-1.5l4.233,4.233a.48.48,0,0,0,.678,0l.678-.678A.479.479,0,0,0,22.877,21.521Zm-11.368-3.3A6.7,6.7,0,0,1,6.137,7.494L8.222,9.579a3.757,3.757,0,0,0-.55,1.93,3.841,3.841,0,0,0,3.836,3.836,3.758,3.758,0,0,0,1.93-.55l2.085,2.085A6.7,6.7,0,0,1,11.509,18.223Z"
                                                  transform="translate(0 0)" fill="#a2aebc"/>
                                            <path id="Path_16" data-name="Path 16"
                                                  d="M246.2,171.044a.48.48,0,0,0,.1.525l3.316,3.316a.479.479,0,0,0,.819-.345,3.809,3.809,0,0,0-3.789-3.789A.523.523,0,0,0,246.2,171.044Z"
                                                  transform="translate(-235.1 -163.074)" fill="#a2aebc"/>
                                            <path id="Path_17" data-name="Path 17"
                                                  d="M156.728,66.484a.48.48,0,0,0,.546.094,6.642,6.642,0,0,1,2.888-.661,6.721,6.721,0,0,1,6.713,6.713,6.642,6.642,0,0,1-.661,2.888.48.48,0,0,0,.094.546l1.662,1.662a.479.479,0,0,0,.339.14h0a.482.482,0,0,0,.34-.142,12.5,12.5,0,0,0,3-4.948.482.482,0,0,0,0-.293A12.085,12.085,0,0,0,160.163,64a11.943,11.943,0,0,0-4.2.761.479.479,0,0,0-.171.788Z"
                                                  transform="translate(-148.654 -61.122)" fill="#a2aebc"/>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>

                        <input data-type="password" form="registrationForm" type="password"
                               class="input-default w-100 p-2 no-rounded" required min="1" max="255"
                               name='password_confirmation'>
                    </div>

                    <!-- Terms and Condtions -->
                    <div class="form-group mt-4">
                        <input style="margin-top: 7px;" form="registrationForm" type="checkbox"
                               class="mr-2 input-default float-left p-2 no-rounded" required name='terms'>
                        <a href="{{ route('terms-and-conditions', ['locale' => app()->getLocale()]) }}"
                           class="d-inline text-dark mb-4 float-left">{{ translating('accept-terms-and-conditions') }}</a>

                        @if(isset($errors->default->messages()['terms']))
                            <span class="invalid-feedback" role="alert">
                            @foreach($errors->default->messages()['terms'] as $msg)
                                    <strong>
                                    {{ $msg }}
                                </strong>
                                @endforeach
                            </span>
                        @endif
                    </div>

                    <!-- Form -->
                    <form id="registrationForm" action="{{ route('register', ['locale' => app()->getLocale()]) }}"
                          method="post">
                        @csrf
{{--                        <input type="hidden" name="confirm_phone_code" value="1"/>--}}
                        {{--                        <div class="form-group {{$errors-> has ('g-recaptcha-response')? 'has-error': ''}}">--}}
                        {{--                            <label class="col-md-4 control-label"> Captcha </label>--}}
                        {{--                            <div class="col-md-6">--}}
                        {{--                                {!! app ('captcha') -> display () !!}--}}

                        {{--                                @if ($errors-> has ('g-recaptcha-response'))--}}
                        {{--                                    <span class="help-block">--}}
                        {{--                            <strong> {{$errors-> first ('g-recaptcha-response')}} </strong>--}}
                        {{--                                    </span>--}}
                        {{--                                @endif--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <button class="btn btn-main w-100 text-light" type="submit"
                                form="registrationForm">{{ translating('registration') }}</button>
                    </form>

                    <!-- Already Has account ?> -->
                    <p class="h5 mt-5 w-100 text-center">{{ translating('already-have-account-?') }}&nbsp;<a
                            href="{{  route('login', ['locale' => app()->getLocale()])}}">{{ translating('log-in-now') }}</a>
                    </p>

                </div>
            </div>
        </div>
    </div>
@endsection
{{--<!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->--}}
{{--<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>--}}


{{--<script>--}}
{{--    var firebaseConfig = {--}}
{{--        apiKey: "AIzaSyB2F0JXi2fG2MW4yQXm-7QIpUirBIKQeQE",--}}
{{--        authDomain: "erevanvip-cf4d7.firebaseapp.com",--}}
{{--        databaseURL: "https://erevanvip-cf4d7.firebaseio.com",--}}
{{--        projectId: "erevanvip-cf4d7",--}}
{{--        storageBucket: "erevanvip-cf4d7.appspot.com",--}}
{{--        messagingSenderId: "1062240295341",--}}
{{--        appId: "1:1062240295341:web:3b513d4f0846329a5b6924"--}}
{{--    };--}}
{{--    firebase.initializeApp(firebaseConfig);--}}
{{--</script>--}}
<script type="text/javascript">
    function get_full_num(country_code, phone_num, full_num) {
        full_num = country_code + phone_num;
        return full_num;

    }

    window.onload = function () {
        render();
    };

    function render() {
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
        recaptchaVerifier.render();
    }

    function sendOTP() {
        var full_number = "";
        var number = $("#number").val();
        var c_code = $('select[name=phone_code] option').filter(':selected').val()
        var full_number_get = get_full_num(c_code, number, full_number);
        if (c_code.length > 0 && c_code.length != null && c_code.length != "undefined" && number.length > 0 && number.length != null && number.length != "undefined") {
            // let dataString = new FormData();
            // // Send data to controller
            // dataString['phone_num'] = number;
            // console.log(dataString);
            axios.post($("#number").data('route'), {
                phone_num: number
            }).then(res => {
                console.log(res.data);
                if (res.data == true) { // Request sned and get success

                    $("#error").text("");
                    $("#error").hide();
                    $("#error").text("Phone Number is exists");
                    $("#error").show();

                } else { // Something wwnt wrong

                    firebase.auth().signInWithPhoneNumber(full_number_get, window.recaptchaVerifier).then(function (confirmationResult) {
                        window.confirmationResult = confirmationResult;
                        coderesult = confirmationResult;
                        console.log(coderesult);
                        console.log("Message sent")
                        $("#successAuth").text("Message sent");
                        $("#successAuth").show();
                        $('#visible-verify').toggleClass('d-none');
                        $('#visible-verify').toggleClass('d-flex');
                    }).catch(function (error) {
                        console.log(error.message)
                        $("#error").text(error.message);
                        $("#error").show();
                    });
                }
            }).catch(res => { // Request error
                // Error Alert
                alert('error')
            });


        } else {
            $("#error").text("");
            $("#error").hide();
            $("#error").text("Not Correctly Country Code Or Phone Number");
            $("#error").show();

        }
        // alert(c_code.length)

    }

    function verify() {
        var code = $("#verification").val();
        coderesult.confirm(code).then(function (result) {
            var user = result.user;
            console.log(user);
            console.log("Code is successful");
            $("#successOtpAuth").text("Code is successful");
            $("#successOtpAuth").show();
            $('#registrationForm').append('<input type="hidden" name="confirm_phone_code" value="1" />')
        }).catch(function (error) {
            console.log(error.message)
            $("#error").text(error.message);
            $("#error").show();
        });
    }
</script>
