<!-- Navigation -->
@include('account.settings.navigation')

<div class="container-fluid mt-3">
    <!-- Check data -->
    @if(isset($blocked_users) && count($blocked_users) > 0)
        <!-- Loop from items -->
        @foreach($blocked_users as $blocked_user)
            <!-- Check user exists -->
            @if(isset($blocked_user->blocked_user) && $blocked_user->blocked_user != NULL)
                <!-- Card -->
                <div class="row mb-5 item-card-row" data-item-id="{{ $blocked_user->id }}">
                    <!-- Image -->
                    <div class="col-lg-3 col-sm-4">
                        <!-- URL -->
                        <a href="{{ route('users', ['locale' => app()->getLocale(), 'id' => $blocked_user->id]) }}">
                            <!-- Check Image -->
                            @if($blocked_user->role == 'facebook_user' || $blocked_user->role == 'google_user')
                                <!-- Facebook and Google User -->
                                <img src="{{ asset('assets/img/items/placeholder/placeholder.gif') }}" data-src="{{ $blocked_user->blocked_user['img'] }}" class="lazy w-100 responsive" title="{{ $blocked_user->blocked_user['first_name'].' '.$blocked_user->blocked_user['last_name'] }}" alt="{{ $blocked_user->blocked_user['first_name'].' '.$blocked_user->blocked_user['last_name'] }}">
                            @else
                                <!-- Site User -->
                                <img src="{{ asset('assets/img/items/placeholder/placeholder.gif') }}" data-src="{{ asset($assets_path.'/img/users'.'/'.$blocked_user->blocked_user['img']) }}" class="lazy w-100 responsive" title="{{ $blocked_user->blocked_user['first_name'].' '.$blocked_user->blocked_user['last_name'] }}" alt="{{ $blocked_user->blocked_user['first_name'].' '.$blocked_user->blocked_user['last_name'] }}">
                            @endif
                        </a>
                    </div>

                    <!-- Content -->
                    <div class="col-lg-9 col-md-8 mt-0 mt-sm-2 col-sm-12">
                        <!-- Datetime -->
                        <div class="row no-gutters w-100">
                            {{ translating('user-blocked-at').' '.date_default_format($blocked_user->updated_at) }}
                        </div>

                        <!-- Fullname -->
                        <div class="row no-gutters w-100 mt-2 card-title">
                             <!-- URL -->
                            <a href="{{ route('users', ['locale' => app()->getLocale(), 'id' => $blocked_user->id]) }}" class="text-dark">
                                <h3>{{ $blocked_user->blocked_user['first_name'].' '.$blocked_user->blocked_user['last_name'] }}</h3>
                            </a>
                        </div>

                        <!-- Price and Actions -->
                        <div class="row no-gutters w-100 bottom-row">
                            <!-- Delete -->
                            <div class="col-12 float-right">
                                <!-- Delete -->
                                <svg data-toggle="modal" data-target="#deletUserModalCenter" class="action user-delete float-right ml-3" xmlns="http://www.w3.org/2000/svg" width="25.601" height="29.999" viewBox="0 0 25.601 29.999">
                                    <g id="delete" transform="translate(0)">
                                        <path id="Path_491" data-name="Path 491" d="M223.025,154.7a.627.627,0,0,0-.627.627v11.85a.627.627,0,0,0,1.254,0V155.33A.627.627,0,0,0,223.025,154.7Zm0,0" transform="translate(-205.829 -141.776)" fill="#f11"/>
                                        <path id="Path_492" data-name="Path 492" d="M105.025,154.7a.627.627,0,0,0-.627.627v11.85a.627.627,0,0,0,1.254,0V155.33A.627.627,0,0,0,105.025,154.7Zm0,0" transform="translate(-96.62 -141.776)" fill="#f11"/>
                                        <path id="Path_493" data-name="Path 493" d="M2.093,8.93V26.239a3.774,3.774,0,0,0,1.083,2.673A3.725,3.725,0,0,0,5.814,30H19.781a3.724,3.724,0,0,0,2.638-1.085A3.774,3.774,0,0,0,23.5,26.239V8.93a2.69,2.69,0,0,0,2.073-2.941,2.777,2.777,0,0,0-2.8-2.337H19V2.774A2.694,2.694,0,0,0,18.146.8,2.978,2.978,0,0,0,16.075,0H9.52A2.978,2.978,0,0,0,7.448.8,2.694,2.694,0,0,0,6.6,2.774v.878H2.817a2.777,2.777,0,0,0-2.8,2.337A2.69,2.69,0,0,0,2.093,8.93ZM19.781,28.592H5.814A2.273,2.273,0,0,1,3.57,26.239V8.991H22.025V26.239a2.273,2.273,0,0,1-2.244,2.354ZM8.073,2.774A1.32,1.32,0,0,1,8.492,1.8,1.46,1.46,0,0,1,9.52,1.4h6.555A1.46,1.46,0,0,1,17.1,1.8a1.319,1.319,0,0,1,.419.976v.878H8.073ZM2.817,5.057H22.778a1.3,1.3,0,0,1,1.329,1.265,1.3,1.3,0,0,1-1.329,1.265H2.817A1.3,1.3,0,0,1,1.488,6.322,1.3,1.3,0,0,1,2.817,5.057Zm0,0" transform="translate(0.003 0.002)" fill="#f11"/>
                                        <path id="Path_494" data-name="Path 494" d="M164.025,154.7a.627.627,0,0,0-.627.627v11.85a.627.627,0,0,0,1.254,0V155.33A.627.627,0,0,0,164.025,154.7Zm0,0" transform="translate(-151.224 -141.776)" fill="#f11"/>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deletUserModalCenter" tabindex="-1" role="dialog" aria-labelledby="deletUserModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-weight-bold" id="deletPostModalLongTitle">{{ translating('post-delete-are-you-sure-?') }}</h5>
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
                            <div class="modal-body">
                                <!-- Content -->
                                <div class="row">
                                    <!-- Image -->
                                    <div class="col-md-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="d-block mx-auto" width="73.641" height="92.949" viewBox="0 0 73.641 92.949">
                                            <g id="delete" transform="translate(0)">
                                                <path id="Path_491" data-name="Path 491" d="M223.025,154.7a.627.627,0,0,0-.627.627v11.85a.627.627,0,0,0,1.254,0V155.33A.627.627,0,0,0,223.025,154.7Zm0,0" transform="translate(-205.829 -141.776)" fill="#f11"/>
                                                <path id="Path_492" data-name="Path 492" d="M105.025,154.7a.627.627,0,0,0-.627.627v11.85a.627.627,0,0,0,1.254,0V155.33A.627.627,0,0,0,105.025,154.7Zm0,0" transform="translate(-96.62 -141.776)" fill="#f11"/>
                                                <path id="Path_493" data-name="Path 493" d="M2.093,8.93V26.239a3.774,3.774,0,0,0,1.083,2.673A3.725,3.725,0,0,0,5.814,30H19.781a3.724,3.724,0,0,0,2.638-1.085A3.774,3.774,0,0,0,23.5,26.239V8.93a2.69,2.69,0,0,0,2.073-2.941,2.777,2.777,0,0,0-2.8-2.337H19V2.774A2.694,2.694,0,0,0,18.146.8,2.978,2.978,0,0,0,16.075,0H9.52A2.978,2.978,0,0,0,7.448.8,2.694,2.694,0,0,0,6.6,2.774v.878H2.817a2.777,2.777,0,0,0-2.8,2.337A2.69,2.69,0,0,0,2.093,8.93ZM19.781,28.592H5.814A2.273,2.273,0,0,1,3.57,26.239V8.991H22.025V26.239a2.273,2.273,0,0,1-2.244,2.354ZM8.073,2.774A1.32,1.32,0,0,1,8.492,1.8,1.46,1.46,0,0,1,9.52,1.4h6.555A1.46,1.46,0,0,1,17.1,1.8a1.319,1.319,0,0,1,.419.976v.878H8.073ZM2.817,5.057H22.778a1.3,1.3,0,0,1,1.329,1.265,1.3,1.3,0,0,1-1.329,1.265H2.817A1.3,1.3,0,0,1,1.488,6.322,1.3,1.3,0,0,1,2.817,5.057Zm0,0" transform="translate(0.003 0.002)" fill="#f11"/>
                                                <path id="Path_494" data-name="Path 494" d="M164.025,154.7a.627.627,0,0,0-.627.627v11.85a.627.627,0,0,0,1.254,0V155.33A.627.627,0,0,0,164.025,154.7Zm0,0" transform="translate(-151.224 -141.776)" fill="#f11"/>
                                            </g>
                                        </svg>
                                    </div>

                                    <!-- Information -->
                                    <div class="col-md-9 offset-md-1 pr-5">
                                        <!-- Title -->
                                        <h5 class="w-100 font-weight-bold delete-user-modal-title">{{ $blocked_user->title }}</h5>

                                        <!-- Description -->
                                        <p class="w-100 mt-2">{!! translating('post-delete-modal-description') !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <!-- Delete -->
                                <a data-href="{{ route('account-settings-blocked-users-delete', ['locale' => app()->getLocale()]) }}" href="{{ route('account-settings-blocked-users-delete', ['locale' => app()->getLocale()]) }}" class="d-block btn delete-user-action btn-danger">{{ translating('delete-post') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        <!-- Pagination -->
        <div class="row no-gutters w-100 mt-5">
            {{ $blocked_users->links() }}
        </div>
    @endif
</div>
