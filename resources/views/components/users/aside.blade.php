<!-- Aside -->
<aside class="col-lg-3 col-md-5 col-sm-8 col-12 bg-white offset-lg-1 user-page-aside">
    <!-- Check image -->
    @if(isset($user->img) && $user->img != NULL) <!-- Has Image -->
        @if($user->role == 'facebook_user' || $user->role == 'google_user') <!-- Fb Or Google User -->
            <img src="{{ asset('assets/img/items/placeholder/placeholder.gif') }}" data-src="{{ $user->img }}" class="lazy rounded-circle responsive" title="{{ $user->first_name.' '.$user->last_name }}" alt="{{ $user->first_name.' '.$user->last_name }}">
        @else  <!-- Site User -->
            <img src="{{ asset('assets/img/items/placeholder/placeholder.gif') }}" data-src="{{ asset($assets_path.'/img/users/'.$user->img) }}" class="lazy rounded-circle responsive" title="{{ $user->first_name.' '.$user->last_name }}" alt="{{ $user->first_name.' '.$user->last_name }}">
        @endif
    @else <!-- Has not Image -->
        <svg title="{{ $user->first_name.' '.$user->last_name }}" xmlns="http://www.w3.org/2000/svg" width="110.522" height="109.459" viewBox="0 0 110.522 109.459">
            <g id="Group_1185" data-name="Group 1185" transform="translate(-239 -222)">
                <ellipse id="Ellipse_13" data-name="Ellipse 13" cx="55.261" cy="54.73" rx="55.261" ry="54.73" transform="translate(239 222)" fill="#eceff1"/>
                <path id="Path_299" data-name="Path 299" d="M145.2,137.562a20.456,20.456,0,0,0-8.487-3.92L121.6,130.611a3.407,3.407,0,0,1-2.728-3.376V123.77a41.392,41.392,0,0,0,2.845-5.07,27.836,27.836,0,0,1,2.425-4.251c3.059-3.073,6.014-6.524,6.93-10.974.854-4.175.014-6.366-.971-8.129,0-4.4-.138-9.913-1.178-13.923-.124-5.429-1.109-8.481-3.589-11.153-1.75-1.895-4.326-2.335-6.4-2.687a11.184,11.184,0,0,1-2.349-.551A24.312,24.312,0,0,0,104.949,64c-9.073.372-20.227,6.145-23.96,16.437-1.157,3.135-1.04,8.281-.944,12.414l-.09,2.487c-.889,1.736-1.764,3.941-.9,8.129.909,4.457,3.865,7.916,6.979,11.03a30.241,30.241,0,0,1,2.418,4.23,42.818,42.818,0,0,0,2.866,5.05v3.465a3.424,3.424,0,0,1-2.742,3.376l-15.122,3.031a20.5,20.5,0,0,0-8.46,3.913,3.452,3.452,0,0,0-.406,5.015,54.847,54.847,0,0,0,81.016,0,3.451,3.451,0,0,0-.406-5.015Z" transform="translate(189.309 170.422)" fill="#1876f2"/>
            </g>
        </svg>
    @endif

    <!-- Fullname -->
    <h2 class="w-100 text-center mt-4 text-dark">{{ $user->first_name.' '. $user->last_name }}</h2>

    <!-- Account created at time -->
    <p class="text-muted h5 w-100 text-center">{{ translating('user-created-at').' '.date_default_format($user->created_at) }}</p>

    <!-- Ratings -->
    <div class="my-3 justify-content-center aside-rate-box row no-gutters">
        <!-- Loop from rating stars -->
        @for($rating = 0; $rating < 5; $rating++)
            <!-- Icon -->
            <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="22.742" height="21.694" viewBox="0 0 22.742 21.694">
                <path id="Path_230" data-name="Path 230" d="M22.709,20.034a.666.666,0,0,0-.538-.453l-7.05-1.024-3.153-6.388a.666.666,0,0,0-1.195,0L7.62,18.556.571,19.58A.666.666,0,0,0,.2,20.717l5.1,4.973L4.1,32.711a.666.666,0,0,0,.967.7L11.371,30.1l6.306,3.315a.666.666,0,0,0,.967-.7l-1.2-7.022,5.1-4.973A.666.666,0,0,0,22.709,20.034Z" transform="translate(0 -11.796)" fill="@if($rating < getUserAvgStars($user->id)) {{ '#FECE1F' }} @else {{ '#D4D3CE' }} @endif"/>
            </svg>
        @endfor
    </div>

    <!-- Write review button -->
    <button class="btn btn-review btn-lg w-100" data-toggle="modal" data-target="#exampleWrireReviewModalCenter">{{ translating('write-review') }}</button>
</aside>

<!-- Write Review Modal -->
<div class="modal fade" id="exampleWrireReviewModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleWrireReviewModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleWrireReviewModalLongTitle">{{ translating('write-review') }}</h5>
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
            <!-- Rating Stars Box -->
            <ul class="ratingW">
                <!-- Loop from stars -->
                @for($rating = 0; $rating < 5; $rating ++)
                    <li class="@if($rating < $user->rate['rate']) on @endif"><a href="javascript:void(0);"><div class="star"></div></a></li>
                @endfor
            </ul>

            <!-- Label -->
            <label class="w-100 d-block text-center h5 mt-2">{{ translating('your-rate') }}</label>
            <input class="d-none" oninput="this.value = this.value.replace(/[^1-5.]/g, '').replace(/(\..*)\./g, '$1');" form="writeReviewForm" name="rate" type="text" min="1" max="5" value="@if(isset($user->rate['rate']) && $user->rate['rate'] != NULL) {{ $user->rate['rate'] }} @else 1 @endif" required>

            <!-- Textarea -->
            <div class="form-group mt-5">
                <textarea placeholder="{{ translating('placeholder-your-opinion') }}" name="description" form="writeReviewForm" required class="form-control border-none border shadow-sm bg-light" rows="4">@if(isset($user->rate['description']) && $user->rate['description'] != NULL) {{ $user->rate['description'] }} @endif</textarea>
            </div>
       </div>
       <div class="modal-footer">
            <!-- Send Review -->
            <form id="writeReviewForm" action="{{ route('user-page-send-review', ['locale' => app()->getLocale(), 'user_id' => $user->id]) }}" method="post" class="w-100">
                @csrf
                <button id="sendForm" form="writeReviewForm" type="submit" class="d-block mx-auto btn btn-main text-light btn-lg">{{ translating('save') }}</button>
            </form>
       </div>
    </div>
  </div>
</div>

