<!-- Navigation -->
@include('account.settings.navigation')

<!-- Alert -->
@error('email')
    <span class="alert alert-danger text-center d-block w-100 mb-3" role="alert">
        <strong><i class="fa fa-times"></i> {{ translating('reset-email-error') }}</strong>
    </span>  
@enderror

<!-- Response -->
@if(\Request::session()->has('error') && \Request::session()->get('error') != NULL)
    <span class="alert alert-danger text-center d-block w-100 mb-3" role="alert">
        <strong><i class="fa fa-times"></i> {{ translating('passwords-are-not-similiar-or-ol-password-is-wrong-try-again') }}</strong>
    </span>                 

    <!-- Forget this session -->
    @php \Request::session()->forget('error'); @endphp
@endif

<!-- Reset Password -->
<div class="row no-gutters w-100 rounded shadow-md mt-3 mb-5 align-items-center">
    <!-- Information -->
    <div class="col-md-8">
        <!-- Title -->
        <h4>{{ translating('reset-password-title') }}</h4>

        <!-- Description -->
        <p class="h6 mt-3">{{ translating('reset-password-description') }}</p>
    </div>

    <!-- Button -->
    <div class="col-md-4">
        <button data-toggle="modal" data-target="#exampleResetPasswordModalCenter" class="btn btn-main text-light btn-lg float-right pl-4 pr-4">{{ translating('reset') }}</button>
    </div>
</div>

<!-- Reset Password Modal -->
<div class="modal fade" id="exampleResetPasswordModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleResetPasswordModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleResetPasswordModalLongTitle">{{ translating('reset-password-modal-title') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <svg id="close" xmlns="http://www.w3.org/2000/svg" width="31.808" height="31.807" viewBox="0 0 31.808 31.807">
                <g id="Group_1179" data-name="Group 1179">
                    <g id="Group_1178" data-name="Group 1178">
                    <path id="Path_480" data-name="Path 480" d="M30.482,14.578A1.326,1.326,0,0,0,29.157,15.9a13.253,13.253,0,1,1-3.849-9.338A1.325,1.325,0,1,0,27.189,4.7,15.9,15.9,0,1,0,31.808,15.9,1.326,1.326,0,0,0,30.482,14.578Z" fill="#747474"/>
                    </g>
                </g>
                <g id="Group_1181" data-name="Group 1181" transform="translate(10.603 10.603)">
                    <g id="Group_1180" data-name="Group 1180">
                    <path id="Path_481" data-name="Path 481" d="M135.177,133.3l3.039-3.039a1.325,1.325,0,0,0-1.874-1.874l-3.039,3.039-3.039-3.039a1.325,1.325,0,0,0-1.874,1.874l3.039,3.039-3.039,3.039a1.325,1.325,0,1,0,1.874,1.874l3.039-3.039,3.039,3.039a1.325,1.325,0,0,0,1.874-1.874Z" transform="translate(-128.002 -128.002)" fill="#747474"/>
                    </g>
                </g>
            </svg>
        </button>
      </div>
      <!-- Content -->
      <div class="modal-body">
            <!-- Description -->
            <div class="w-100 mb-5">
                {{ translating('reset-password-modal-descriptipon') }}
            </div>  
      
        <!-- Current Password -->
        <div class="form-group mt-4 password-row change">
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

            <input form="changePasswordForm" data-type="password" type="password" class="input-default w-100 p-2 no-rounded" required min="1" max="255" placeholder="{{ translating('placeholder-password') }}" name='old_password'>
        
            @error('old_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ translating('account-old-password-error') }}</strong>
                </span>
            @enderror
        </div>

        <!-- New Password -->
        <div class="form-group mt-4 password-row change">
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

            <input form="changePasswordForm" data-type="password" type="password" class="input-default w-100 p-2 no-rounded" required minlength="8" max="255" placeholder="{{ translating('placeholder-new-password') }}" name='new_password'>
        
            @error('new_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ translating('account-new-password-error') }}</strong>
                </span>
            @enderror
        </div>

        <!-- Confirm New Password -->
        <div class="form-group mt-4 password-row change">
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

            <input form="changePasswordForm" data-type="password" type="password" class="input-default w-100 p-2 no-rounded" required minlength="8" max="255" placeholder="{{ translating('placeholder-confirm-new-password') }}" name='confirm_new_password'>
        
            @error('confirm_new_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ translating('account-confirm-new-password-error') }}</strong>
                </span>
            @enderror
        </div>
      </div>
      <div class="modal-footer">
          <form id="changePasswordForm" action="{{ route('account-settings-account-change-password', ['locale' => app()->getLocale()]) }}" method="post" class="w-100">  
              @csrf
              <button form="changePasswordForm" type="submit" class="btn btn-main d-block mx-auto text-light btn-lg">{{ translating('save') }}</button>
          </form>
      </div>
    </div>
  </div>
</div>

<!-- Change email -->
<div class="row no-gutters w-100 rounded shadow-md mt-3 mb-5 align-items-center">
    <!-- Information -->
    <div class="col-md-8">
        <!-- Title -->
        <h4>{{ translating('reset-email-title') }}</h4>

        <!-- Description -->
        <p class="h6 mt-3">{{ translating('reset-email-description') }}</p>
    </div>

    <!-- Button -->
    <div class="col-md-4">
        <button data-toggle="modal" data-target="#exampleResetEmailModalCenter" class="btn btn-main text-light btn-lg float-right pl-4 pr-4">{{ translating('reset') }}</button>
    </div>
</div>


<!-- Change Email Modal -->
<div class="modal fade" id="exampleResetEmailModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleResetEmailModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleResetEmailModalLongTitle">{{ translating('reset-email-modal-title') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <svg id="close" xmlns="http://www.w3.org/2000/svg" width="31.808" height="31.807" viewBox="0 0 31.808 31.807">
                <g id="Group_1179" data-name="Group 1179">
                    <g id="Group_1178" data-name="Group 1178">
                    <path id="Path_480" data-name="Path 480" d="M30.482,14.578A1.326,1.326,0,0,0,29.157,15.9a13.253,13.253,0,1,1-3.849-9.338A1.325,1.325,0,1,0,27.189,4.7,15.9,15.9,0,1,0,31.808,15.9,1.326,1.326,0,0,0,30.482,14.578Z" fill="#747474"/>
                    </g>
                </g>
                <g id="Group_1181" data-name="Group 1181" transform="translate(10.603 10.603)">
                    <g id="Group_1180" data-name="Group 1180">
                    <path id="Path_481" data-name="Path 481" d="M135.177,133.3l3.039-3.039a1.325,1.325,0,0,0-1.874-1.874l-3.039,3.039-3.039-3.039a1.325,1.325,0,0,0-1.874,1.874l3.039,3.039-3.039,3.039a1.325,1.325,0,1,0,1.874,1.874l3.039-3.039,3.039,3.039a1.325,1.325,0,0,0,1.874-1.874Z" transform="translate(-128.002 -128.002)" fill="#747474"/>
                    </g>
                </g>
            </svg>
        </button>
      </div>
      <!-- Content -->
      <div class="modal-body">
        <!-- Description -->
        <div class="w-100 mb-3">
            {{ translating('reset-email-modal-descriptipon') }}
        </div>  
      
        <!-- Current Email -->
        <div class="form-group mt-">

            <!-- Input -->
            <input form="changeEmailForm" type="email" class="input-default w-100 p-2 no-rounded" required min="1" max="255" placeholder="{{ translating('placeholder-email') }}" name='email' value="{{ Auth::user()->email }}">
        </div>
      </div>

      <!-- Button -->
      <div class="modal-footer">
          <form id="changeEmailForm" action="{{ route('account-settings-account-change-email', ['locale' => app()->getLocale()]) }}" method="post" class="w-100">  
              @csrf
              <button form="changeEmailForm" type="submit" class="btn btn-main d-block mx-auto text-light btn-lg">{{ translating('save') }}</button>
          </form>
      </div>
    </div>
  </div>
</div>

<!-- Delete account -->
<div class="row no-gutters w-100 rounded shadow-md mt-3 mb-5 align-items-center">
    <!-- Information -->
    <div class="col-md-8">
        <!-- Title -->
        <h4>{{ translating('delete-account-title') }}</h4>

        <!-- Description -->
        <p class="h6 mt-3">{{ translating('delete-account-description') }}</p>
    </div>

    <!-- Button -->
    <div class="col-md-4">
        <button data-toggle="modal" data-target="#exampleDeleteAccountModalCenter" class="btn btn-danger btn-lg float-right pl-4 pr-4">{{ translating('delete') }}</button>
    </div>
</div>

<!-- Change Email Modal -->
<div class="modal fade" id="exampleDeleteAccountModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleDeleteAccountModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleDeleteAccountModalLongTitle">{{ translating('delete-account-modal-title') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <svg id="close" xmlns="http://www.w3.org/2000/svg" width="31.808" height="31.807" viewBox="0 0 31.808 31.807">
                <g id="Group_1179" data-name="Group 1179">
                    <g id="Group_1178" data-name="Group 1178">
                    <path id="Path_480" data-name="Path 480" d="M30.482,14.578A1.326,1.326,0,0,0,29.157,15.9a13.253,13.253,0,1,1-3.849-9.338A1.325,1.325,0,1,0,27.189,4.7,15.9,15.9,0,1,0,31.808,15.9,1.326,1.326,0,0,0,30.482,14.578Z" fill="#747474"/>
                    </g>
                </g>
                <g id="Group_1181" data-name="Group 1181" transform="translate(10.603 10.603)">
                    <g id="Group_1180" data-name="Group 1180">
                    <path id="Path_481" data-name="Path 481" d="M135.177,133.3l3.039-3.039a1.325,1.325,0,0,0-1.874-1.874l-3.039,3.039-3.039-3.039a1.325,1.325,0,0,0-1.874,1.874l3.039,3.039-3.039,3.039a1.325,1.325,0,1,0,1.874,1.874l3.039-3.039,3.039,3.039a1.325,1.325,0,0,0,1.874-1.874Z" transform="translate(-128.002 -128.002)" fill="#747474"/>
                    </g>
                </g>
            </svg>
        </button>
      </div>
      <!-- Content -->
      <div class="modal-body">
        <!-- Description -->
        <div class="w-100 mb-3 text-center">
            {{ translating('delete-account-modal-descriptipon') }}
        </div>  
      </div>

      <!-- Button -->
      <div class="modal-footer">
          <form id="deleteAccountForm" action="{{ route('account-settings-delete-account', ['locale' => app()->getLocale()]) }}" method="post" class="w-100">  
              @csrf
              <button form="deleteAccountForm" type="submit" class="btn btn-danger d-block mx-auto btn-lg">{{ translating('delete') }}</button>
          </form>
      </div>
    </div>
  </div>
</div>