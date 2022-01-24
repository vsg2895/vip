<!-- Level 2 Content -->
<div class="container level2-container">

    <div class="row mb-3">
        <!-- Check error -->
        @if($errors->any())
            @foreach($errors->default->messages() as $msg_array)
                @foreach($msg_array as $msg)
                    <div class="alert_msg ml-2 font-weight-bold alert-danger d-flex align-items-center" role="alert">
                        <i class="fas fa-exclamation-circle"></i>
                        <div class="pl-2 pr-2">
                            {{ $msg }}
                        </div>
                    </div>
                @endforeach
            @endforeach
        @endif

        @foreach(array_keys(Session::all()) as $key)
            @if(strpos($key, 'error_') !== false && $key != 'error_identity')
                <div class="alert_msg ml-2 {{ $key }} font-weight-bold alert-danger d-flex align-items-center"
                     role="alert">
                    <i class="fas fa-exclamation-circle"></i>
                    <div class="pl-2 pr-2">

                        {{ Session::get($key) }}

                    </div>
                </div>
                {{ Session::forget($key) }}
            @else
                @if($key == 'error_identity')
                    @foreach(Session::get($key)[0] as $s_error)
                        <div class="alert_msg ml-2 {{ $key }} font-weight-bold alert-danger d-flex align-items-center"
                             role="alert">
                            <i class="fas fa-exclamation-circle"></i>
                            <div class="pl-2 pr-2">

                                {{ $s_error }}

                            </div>
                        </div>
                    @endforeach
                    {{ Session::forget($key) }}
                @endif

            @endif
        @endforeach
    </div>
    <div class="row mb-3">
        <!-- Author type -->
        <div class="col-lg-8">
            <!-- Input Content -->
            <div class="form-group mb-0">
                <div class="form-row">
                    <label class="w-100 hovered">
                        <!-- Radio -->
                        <input type="radio" form="addPostForm" class="input-default float-left mr-2" name="auth_type"
                               required value="0"
                               @if(\Request::session()->has('add_post_auth_type') && \Request::session()->get('add_post_auth_type') == '0')
                               checked
                               @else
                               @if(\Request::session()->has('add_post_auth_type') && \Request::session()->get('add_post_auth_type') != '1')
                               checked
                               @endif

                               @if(!\Request::session()->has('add_post_auth_type'))
                               checked
                            @endif
                            @endif>

                        <!-- Title -->
                        <span class="float-left h5">{{ translating('owner') }}</span>

                        <!-- Clear floats -->
                        <p class="clearfix"></p>

                        <p class="w-100 hovered h6">{!! translating('create-post-owner-description') !!}</p>
                    </label>
                </div>
            </div>

            <!-- Input Content -->
            <div class="form-group mb-0">
                <div class="form-row">
                    <label class="w-100 hovered">
                        <!-- Radio -->
                        <input type="radio" form="addPostForm" class="input-default float-left mr-2" name="auth_type"
                               required value="1"
                               @if(\Request::session()->has('add_post_auth_type') && \Request::session()->get('add_post_auth_type') == '1')
                               checked
                               @else
                               @if(\Request::session()->has('add_post_auth_type') && \Request::session()->get('add_post_auth_type') != '0')
                               checked
                            @endif
                            @endif>

                        <!-- Title -->
                        <span
                            class="float-left h5">@if(!in_array(\Request::session()->get('create-post-category-id'),$real_estate_sub_cat_ids) && !in_array(\Request::session()->get('create-post-category-id'),$transport_sub_cat_ids) && \Request::session()->get('post_has_service') === 0) {{ translating('filtr_magazin_electronics') }} @else {{ translating('agancy') }} @endif</span>

                        <!-- Clear floats -->
                        <p class="clearfix"></p>
                        @if(!in_array(\Request::session()->get('create-post-category-id'),$real_estate_sub_cat_ids) && !in_array(\Request::session()->get('create-post-category-id'),$transport_sub_cat_ids) && \Request::session()->get('post_has_service') === 0)
                            <p class="w-100 hovered h6">{!! translating('create-post-agancy-description') !!}</p>
                        @else
                            <p class="w-100 hovered h6">{!! translating('create-post-magazin-description') !!}</p>
                        @endif
                    </label>
                </div>
            </div>

            <!-- Check error -->
        @if($errors->has('auth_type'))
            <!-- Error Response -->
                <div class="alert alert-danger w-100 alert-dismissible fade show" role="alert">
                    <!-- Text -->
                    <span>{{ translating('add-post-error-author-type') }}</span>

                    <!-- Button -->
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <!-- Close -->
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        @endif

        <!-- Check error -->
        @if(\Request::session()->has('auth_type'))
            <!-- Error Response -->
                <div class="alert alert-danger w-100 alert-dismissible fade show" role="alert">
                    <!-- Text -->
                    <span>{{ translating('add-post-error-author-type') }}</span>

                    <!-- Button -->
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <!-- Close -->
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Forget session -->
                @php \Request::session()->forget('auth_type'); @endphp
            @endif
        </div>
    {{--    @dd(\Request::session()->all())--}}
    @if(\Request::session()->get('post_has_service') === 0)
        <!-- Post Type -->
            <div class="col-lg-4">
                <!-- Author type -->
                <div class="col-xl-8 col-lg-8 col-md-8 col-8 p-0">
                    <!-- Input Content -->
                    <div class="form-group mb-0">
                        <div class="form-row">
                            <label class="w-100">
                                <!-- Radio -->
                                <input type="radio" form="addPostForm" checked class="input-default float-left mr-2"
                                       name="post_type" required value="0"
                                       @if(\Request::session()->has('add_post_auth_type') && \Request::session()->get('add_post_auth_type') == '0')
                                       checked
                                       @else
                                       @if(\Request::session()->has('add_post_auth_type') && \Request::session()->get('add_post_auth_type') != '1' && \Request::session()->get('add_post_post_type') != '2')
                                       checked
                                    @endif
                                    @endif>

                                <!-- Title -->
                                <span class="float-left h5">{{ translating('suggesting') }}</span>

                                <!-- Clear floats -->
                                <p class="clearfix"></p>
                            </label>
                        </div>
                    </div>

                    <!-- Input Content -->
                    <div class="form-group mb-0">
                        <div class="form-row">
                            <label class="w-100">
                                <!-- Radio -->
                                <input type="radio" form="addPostForm" class="input-default float-left mr-2"
                                       name="post_type" required value="1"
                                       @if(\Request::session()->has('add_post_post_type') && \Request::session()->get('add_post_post_type') == '1') checked @endif>

                                <!-- Title -->
                                <span class="float-left h5">{{ translating('changing') }}</span>

                                <!-- Clear floats -->
                                <p class="clearfix"></p>
                            </label>
                        </div>
                    </div>

                    <!-- Input Content -->
                    <div class="form-group mb-0">
                        <div class="form-row">
                            <label class="w-100">
                                <!-- Radio -->
                                <input type="radio" form="addPostForm" class="input-default float-left mr-2"
                                       name="post_type" required value="2"
                                       @if(\Request::session()->has('add_post_post_type') && \Request::session()->get('add_post_post_type') == '2') checked @endif>

                                <!-- Title -->
                                <span class="float-left h5">{{ translating('hiring') }}</span>

                                <!-- Clear floats -->
                                <p class="clearfix"></p>
                            </label>
                        </div>
                    </div>
                </div>
                <!-- Check error -->
            @if($errors->has('post_type'))
                <!-- Error Response -->
                    <div class="alert alert-danger w-100 alert-dismissible fade show" role="alert">
                        <!-- Text -->
                        <span>{{ translating('add-post-error-post-type') }}</span>

                        <!-- Button -->
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <!-- Close -->
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
            @endif

            <!-- Check error -->
            @if(\Request::session()->has('post_type'))
                <!-- Error Response -->
                    <div class="alert alert-danger w-100 alert-dismissible fade show" role="alert">
                        <!-- Text -->
                        <span>{{ translating('add-post-error-post-type') }}</span>

                        <!-- Button -->
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <!-- Close -->
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- Forget session -->
                    @php \Request::session()->forget('post_type'); @endphp
                @endif
            </div>
        @endif
    </div>

    <!-- Break -->
    <hr level-2_hr>
    {{--@dd(Auth::user()->location_id)--}}
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <label class="w-100 d-block font-weight-bold">{{ translating('select-your-location') }}</label>
            <!-- Location row -->
            <select name="location_id" form="addPostForm"
                    class="locations w-100 input-default p-2 mt-1 mb-3 mt-md-1 mb-md-1" required>

            @if(isset($locations) && count($locations) > 0)
                <!-- Loop from locations -->
                @foreach($locations as $location)
                    <!-- Check location data -->
                        @if(\Request::session()->get('post_has_service') === 1 && \Request::session()->get('add_post_location_id') == null)
                            @if($location->title_hy == 'Հասցե' && $location->parent_id == 0)
                                <optgroup label="{{ $location->{'title_'.app()->getLocale()} }}">
                                    @foreach($locations as $child_loc)
                                        @if($location->id == $child_loc->parent_id)
                                            <option value="{{ $child_loc->id }}"
                                                    @if(Auth::user()->location_id == null) selected @endif>
                                                {{ $child_loc->{'title_'.app()->getLocale()} }}
                                            </option>
                                        @endif
                                    @endforeach
                                </optgroup>
                            @endif
                        @endif
                    <!-- Check heading -->
                        @if($location->parent_id == 0)
                            @if($location->title_hy != 'Հասցե')
                            <!-- Heading -->
                                <optgroup label="{{ $location->{'title_'.app()->getLocale()} }}">
                                    <!-- Loop from subitems -->
                                @foreach($locations as $parent_location)
                                    <!-- Check heading -->
                                    @if($location->id == $parent_location->parent_id)
                                        <!-- Subitems -->
                                            <option value="{{ $parent_location->id }}"
                                                    @if(\Request::session()->has('add_post_location_id') && \Request::session()->get('add_post_location_id') == $parent_location->id) selected
                                                    @elseif(isset(Auth::user()->location_id) && Auth::user()->location_id == $parent_location->id) selected @endif>{{ $parent_location->{'title_'.app()->getLocale()} }}</option>
                                        @endif
                                    @endforeach
                                </optgroup>
                            @endif
                        @endif
                    @endforeach
                @endif
            </select>
        </div>
        {{--        @dd()--}}
        {{--        @dump(\Request::session()->get('add_post_elec_type'))--}}
        @if(!in_array(\Request::session()->get('create-post-category-id'),$real_estate_sub_cat_ids) && !in_array(\Request::session()->get('create-post-category-id'),$transport_sub_cat_ids) && \Request::session()->get('post_has_service') === 0)
            <div class="col-lg-4 col-md-6">
                {{--                @dd(\Request::session()->get('filter_post_elec_type'))--}}
                <label class="w-100 d-block font-weight-bold">{{ translating('post_electro_state') }}</label>
                <select name="electro_type" form="addPostForm"
                        class="w-100 input-default p-2 mt-1 mb-3 mt-md-1 mb-md-1">
                {{-- adds controllers category and filtr functions new session filter_post_estate_type--}}
                <!-- Default value -->

                    <option value="default"
                            @if(\Request::session()->has('add_post_elec_type') && \Request::session()->get('add_post_elec_type') == 'default') selected @endif>{{ translating('post_estate_type') }}</option>
                    <!-- Other Values -->
                    <option value="0"
                            @if(\Request::session()->has('add_post_elec_type') && \Request::session()->get('add_post_elec_type') == '0')  selected @endif>{{ translating('filter-elec-new') }}</option>
                    <option value="1"
                            @if(\Request::session()->has('add_post_elec_type') && \Request::session()->get('add_post_elec_type') == '1')  selected @endif>{{ translating('filter-elec-old') }}</option>
                </select>
            </div>
        @endif

        @if(in_array(\Request::session()->get('create-post-category-id'),$real_estate_sub_cat_ids))
            <div class="col-lg-4 col-md-6">
                <label class="w-100 d-block font-weight-bold">{{ translating('post_estate_type') }}</label>
                <select name="estate_type" form="addPostForm" class="w-100 input-default p-2 mt-1 mb-3 mt-md-1 mb-md-1">
                {{-- adds controllers category and filtr functions new session filter_post_estate_type--}}
                <!-- Default value -->
                    <option value="default"
                            @if(\Request::session()->has('add_post_estate_type') && \Request::session()->get('add_post_estate_type') == 'default') selected @endif>{{ translating('post_estate_type') }}</option>
                    <!-- Other Values -->
                    <option value="0"
                            @if(\Request::session()->has('add_post_estate_type') && \Request::session()->get('add_post_estate_type') == '0')  selected @endif>{{ translating('filter_estate_rent') }}</option>
                    <option value="1"
                            @if(\Request::session()->has('add_post_estate_type') && \Request::session()->get('add_post_estate_type') == '1')  selected @endif>{{ translating('filter_daily_rent') }}</option>
                    <option value="2"
                            @if(\Request::session()->has('add_post_estate_type') && \Request::session()->get('add_post_estate_type') == '2')  selected @endif>{{ translating('filter_estate_sale') }}</option>
                    <option value="3"
                            @if(\Request::session()->has('add_post_estate_type') && \Request::session()->get('add_post_estate_type') == '3')  selected @endif>{{ translating('filter_estate_change') }}</option>
                </select>
            </div>
        @endif
    </div>


    <!-- Check error -->
@if($errors->has('location_id'))
    <!-- Error Response -->
        <div class="alert alert-danger w-100 alert-dismissible fade show" role="alert">
            <!-- Text -->
            <span>{{ translating('add-post-error-location') }}</span>

            <!-- Button -->
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <!-- Close -->
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
@endif

<!-- Check error -->
@if(\Request::session()->has('error_location_id'))
    <!-- Error Response -->
        <div class="alert alert-danger w-100 alert-dismissible fade show" role="alert">
            <!-- Text -->
            <span>{{ translating('add-post-error-location') }}</span>

            <!-- Button -->
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <!-- Close -->
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!-- Forget session -->
    @php \Request::session()->forget('error_location_id'); @endphp
@endif

<!-- Check error -->
@if(\Request::session()->has('error_electro_type'))
    <!-- Error Response -->
        <div class="alert alert-danger w-100 alert-dismissible fade show" role="alert">
            <!-- Text -->
            <span>{{ translating('add-post-error-location') }}</span>

            <!-- Button -->
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <!-- Close -->
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!-- Forget session -->
    @php \Request::session()->forget('error_electro_type'); @endphp
@endif
<!-- Check error -->
@if(\Request::session()->has('error_estate_type'))
    <!-- Error Response -->
        <div class="alert alert-danger w-100 alert-dismissible fade show" role="alert">
            <!-- Text -->
            <span>{{ translating('add-post-error-location') }}</span>

            <!-- Button -->
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <!-- Close -->
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!-- Forget session -->
    @php \Request::session()->forget('error_estate_type'); @endphp
@endif
<!-- Break -->
    <hr>

    <!-- Main Form Section -->
    <div class="row no-gutters my-4">
        <!-- Left Aside -->
        <div class="col-lg-6 border-right-secondary">
            <!-- Get category special fields -->
            @include('create-post.input.index')
        </div>

        <!-- Right Aside -->
        <div class="col-lg-6 pl-35-responsive right-add-fields-page">
            <!-- Input Container -->
            <div class="form-group">
                <div class="row no-gutters">
                    <div class="col-lg-3">
                        <!-- Title -->
                        <label class="font-weight-bold input-create-label float-left">{{ translating('title') }}</label>
                    </div>

                    <div class="col-lg-9">
                        <!-- Input -->
                        <input type="text" form="addPostForm" class="input-default p-2 float-right w-100" required
                               min="1" max="255" name="title"
                               placeholder="{{ translating('create-post-title-placeholder') }}"
                               value="@if(\Request::session()->has('add_post_title') && \Request::session()->get('add_post_title') != NULL) {{ \Request::session()->get('add_post_title') }} @endif">

                        <!-- Check error -->
                    @if(\Request::session()->has('error_title'))
                        <!-- Error Response -->
                            <strong class="text-danger"><i
                                    class="fa fa-exclamation-triangle"></i> {{ translating('add-post-error-title') }}
                            </strong>

                            <!-- Forget session -->
                            @php \Request::session()->forget('error_title'); @endphp
                        @endif
                    </div>

                    <!-- Clear floats -->
                    <p class="clearfix"></p>
                </div>
            </div>

            <!-- Input Container -->
            <div class="form-group">
                <div class="row no-gutters">
                    <div class="col-lg-3">
                        <!-- Description -->
                        <label
                            class="font-weight-bold input-create-label float-left">{{ translating('description') }}</label>
                    </div>

                    <div class="col-lg-9">
                        <!-- Input -->
                        @if(\Request::session()->has('add_post_description') && \Request::session()->get('add_post_description') != NULL)
                            <textarea required rows="10" form="addPostForm" class="input-default p-2 float-right w-100"
                                      name="description" required
                                      placeholder="{{ translating('create-post-description-placeholder') }}">{{\Request::session()->get('add_post_description')}}</textarea>
                        @else
                            <textarea required rows="10" form="addPostForm" class="input-default p-2 float-right w-100"
                                      name="description" required
                                      placeholder="{{ translating('create-post-description-placeholder') }}"></textarea>
                        @endif

                    </div>

                    <!-- Clear floats -->
                    <p class="clearfix"></p>
                </div>
            </div>

            <!-- Input Container -->
            <div class="row no-gutters justify-content-center">
                <div class="col-lg-3">
                    <!-- Image -->
                    <label class="font-weight-bold input-create-label float-left">{{ translating('images') }}</label>
                </div>

                <!-- Check images data -->
            {{--            @dd($cover_image)--}}
            @if(isset($cover_image) && $cover_image != NULL)
                <!-- Cover image -->
                    <div class="col-lg-9 bg-white border border-light p-2 rounded">
                        <!-- Tools -->

                        <label class="image-upload-item image position-relative"
                               style="background-image: url({{ Storage::disk('s3')->temporaryUrl($cover_image->img,'+2 minutes') }}) !important"><input
                                type="file" name="uploadImage1" value="{{ $cover_image->img }}" form="addPostForm"
                                class="uploadFile d-none"></label>
                        <input type="hidden" form="addPostForm" value="{{ $cover_image->img }}" name="deleteImage1">
                        <!-- Check gallery images data   -->

                    @if(isset($gallery_images) && count($gallery_images) > 0)
                        <!-- Loop from images -->
                        @foreach($gallery_images as $key => $gallery_image)
                            <!-- Gallery image item -->
                                <label class="image-upload-item image position-relative img_isset"
                                       style="background-image: url({{ Storage::disk('s3')->temporaryUrl($gallery_image->img,'+2 minutes') }}) !important"><input
                                        type="file" value="{{ $gallery_image->img }}" name="uploadImage{{ $key + 2 }}"
                                        form="addPostForm"
                                        class="uploadFile d-none"><i class="fa fa-times axios del"
                                                                     action="{{ route('add-post-destroy-image', ['locale' => app()->getLocale(), 'id' => $gallery_image->id]) }}"
                                                                     data-delS3="{{ $gallery_image->img }}"
                                                                     title="{{ translating('delete') }}"></i></label>

                                <input type="hidden" form="addPostForm" value="{{ $gallery_image->img }}"
                                       name="deleteImage{{ $key + 2 }}">
                        @endforeach
                    @endif

                    <!-- Plus Button -->
                        <div class="image-upload-item plus h4 imgAdd text-dark"><i class="fa fa-plus"></i></div>
                        <!-- Clear floats -->
                        <p class="clearfix in-img-clearfix"></p>
                    </div>
            @else
                <!-- Default not image yet version -->
                    <div class="col-lg-9 bg-white border border-light p-2 rounded">
                        <!-- Tools -->
                        <label class="image-upload-item image no-download position-relative no-img"><input type="file"
                                                                                                           name="uploadImage1"
                                                                                                           form="addPostForm"
                                                                                                           class="uploadFile d-none"></label>
                        <!-- Plus Button -->

                        <div class="image-upload-item plus h4 imgAdd text-dark"><i class="fa fa-plus"></i></div>
                        <!-- Clear floats -->
                        <p class="clearfix in-img-clearfix"></p>
                    </div>
                @endif
                <div class="row error_duration d-none">

                    <span id="duration_error" class="text-danger"></span>
                </div>
                <div class="row videos_row">

                    <div class="col-lg-3">
                        <label
                            class="font-weight-bold mt-3 input-create-label float-left">{{ translating('videos') }}</label>

                    </div>

                    <div class="col-lg-9 col-12 mt-3 bg-white border border-light p-2 rounded video-container">

                        @if(isset($custom_video) && $custom_video != NULL && $custom_video->video_url != NULL)
                            @if(\Request::session()->has('add_post_video_duration') && \Request::session()->get('add_post_video_duration') != "" && !is_null(\Request::session()->get('add_post_video_duration')))
                                <input type="hidden" value="{{ \Request::session()->get('add_post_video_duration') }}"
                                       id="custom_video_duration">
                            @endif
                            @if(\Request::session()->has('add_post_video_price') && \Request::session()->get('add_post_video_price') != "" && !is_null(\Request::session()->get('add_post_video_price')))
                                <input type="hidden" value="{{ \Request::session()->get('add_post_video_price') }}"
                                       id="custom_video_price">
                            @endif
                            <video controls class="myvideo_preview added_page_video" id="video_start"
                                   style="height:100%"
                                   data-delete="{{ route('del.video',app()->getLocale()) }}"
                                   data-failed="{{ asset('assets/videos/video-failed.png') }}"
                                   data-url="{{ $custom_video->video_url }}"
                                   data-public="{{ $custom_video->video_process }}">
                                <source src="{{ $custom_video->video_url }}"
                                        id="video_here">
                            </video>
                            <div class="d-flex justify-content-between video_icons_container">
                                <i class="fas fa-file-video upload_custom_video"></i>
                                <i class="fas fa-minus-circle clear_custom_video"></i>

                            </div>
                        @else
                            @if($user_has_post)
                                <div class="row justify-content-around align-items-center h-100
                                           @if(isset($parent_cat) && in_array(2,$parent_cat))
                                           flex-wrap  @endif "
                                     id="parent_variants">
                                    @if(isset($parent_cat) && in_array(2,$parent_cat))

                                        @foreach($video_variants as $key => $value)
                                            <div
                                                class="col-5 variant_video d-flex flex-column justify-content-around"
                                                data-duration="{{ $value->duration }}"
                                                data-price="{{ $value->price }}"
                                                title="Վճարումը կկատարվի ձեր կողմից հայտարարության վերջնական հաստատման ժամանակ">
                                                Մինչև {{ $value->duration }}
                                                վայրկյան <br>
                                                {{ $value->price }} դրամ
                                            </div>

                                        @endforeach
                                    @else
                                        @foreach($video_variants as $key => $value)
                                            @if($key != count($video_variants) - 1)
                                                <div
                                                    class="col-3 variant_video d-flex flex-column justify-content-around"
                                                    data-duration="{{ $value->duration }}"
                                                    data-price="{{ $value->price }}"
                                                    title="Վճարումը կկատարվի ձեր կողմից հայտարարության վերջնական հաստատման ժամանակ">
                                                    Մինչև {{ $value->duration }}
                                                    վայրկյան <br>
                                                    {{ $value->price }} դրամ
                                                </div>
                                            @endif
                                        @endforeach

                                    @endif
                                </div>
                                <img src="{{ asset('assets/videos/video_thumb.png') }}"
                                     class="myvideo_empty_img d-none"/>
                                <video controls id="video_start"
                                       data-delete="{{ route('del.video',app()->getLocale()) }}"
                                       data-failed="{{ asset('assets/videos/video-failed.png') }}"
                                       class="myvideo_empty d-none">
                                </video>
                            @else
                                <img src="{{ asset('assets/videos/video_thumb.png') }}"
                                     class="myvideo_empty_img"/>
                                <video controls id="video_start"
                                       data-delete="{{ route('del.video',app()->getLocale()) }}"
                                       data-failed="{{ asset('assets/videos/video-failed.png') }}"
                                       class="myvideo_empty d-none">
                                </video>
                            @endif


                        @endif
                        {{--                            name="custom_video"--}}
                        <input type="file" id="custom-video" form="addPostForm" class="d-none"
                               accept="video/*">
                    </div>

                    <div
                        class="col-lg-9 col-12 bg-white border border-light p-2 rounded youtube-links video-container-2">
                        @if(\Request::session()->has('external_urls') && count(\Request::session()->get('external_urls')[0]) > 0)

                            {{--                            @dd(\Request::session()->get('external_urls'))--}}
                            @foreach(\Request::session()->get('external_urls')[0] as $links)

                                <input name="external_url[]" type="text" form="addPostForm"
                                       class="form-control external_url"
                                       aria-describedby="url"
                                       value="{{ $links }}"
                                       autocomplete="off" autofocus placeholder="Youtube-ի հղում">
                                {{--                                @dump($links)--}}

                            @endforeach
                        @else
                            <input name="external_url[]" type="text" form="addPostForm"
                                   class="form-control external_url @error('url')  is-invalid @enderror"
                                   aria-describedby="url"
                                   autocomplete="off" autofocus placeholder="Youtube-ի հղում">

                        @endif

                        <button type="button" class="btn btn-primary btn-sm add_link_btn"><i class="fas fa-plus"></i>
                        </button>

                    </div>

                </div>

                <form id="addPostForm" action="{{ route('add-post-store', ['locale' => app()->getLocale()]) }}"
                      method="post" class="w-100" enctype="multipart/form-data">
                @csrf
                <!-- Category Id -->
                    <input type="text" form="addPostForm" class="d-none input-default p-2 w-100"
                           value="@if(\Request::session()->get('post_has_service') == 1) {{ \Request::session()->get('create-post-category-id') }} @else {{ \Request::segment(4) }} @endif"
                           name="category_id">

                    <!-- Submit -->
                    <button type="submit" form="addPostForm"
                            class="mt-2 btn btn-main add_post_button text-light float-right btn-lg">
                        <i class="loading-icon fa-lg fas fa-spinner d-none fa-spin hide"></i>
                        {{ translating('live-demo') }}</button>
                </form>
                <!-- Check error -->
                @if(\Request::session()->has('error_image'))
                <!-- Error Response -->
                    <strong class="text-danger"><i
                            class="fa fa-exclamation-triangle"></i> {{ translating('add-post-error-image') }}</strong>

                    <!-- Forget session -->
                    @php \Request::session()->forget('error_image'); @endphp
                @endif
            </div>
        </div>

        <!-- Check images count data -->
        {{--        @dump(count($gallery_images))--}}
        @if(isset($cover_image))
            @if(isset($gallery_images) && count($gallery_images))
                <input type="text" class="d-none" name="imagesCount"
                       value="{{ intval(count($gallery_images)) + intval(1) }}" form="addPostForm">
            @else
                <input type="text" class="d-none" name="imagesCount" value="1" form="addPostForm">
            @endif
        @else
            <input type="text" class="d-none" name="imagesCount" value="0" form="addPostForm">
        @endif

    </div>
</div>
