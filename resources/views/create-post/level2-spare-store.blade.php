<!-- Level 2 Spare Content -->
<div class="container level2-container">
    {{--        @dd(\Request::session()->get('add_post_spare_store_type'))--}}
    <div class="row mb-3">
        {{--    @dd(Session::get('spare_errors'))--}}
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

            @if(strpos($key, 'error_') !== false)
                <div class="alert_msg ml-2 font-weight-bold alert-danger d-flex align-items-center" role="alert">
                    <i class="fas fa-exclamation-circle"></i>
                    <div class="pl-2 pr-2">

                        {{ Session::get($key) }}

                    </div>
                </div>
                {{ Session::forget($key) }}
            @endif
        @endforeach
    </div>

    <!-- Break -->
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <label class="w-100 d-block font-weight-bold">{{ translating('select-your-location') }}</label>
            <!-- Location row -->
            <select name="spare_store_location_id" form="addPostSpareForm"
                    class="locations w-100 input-default p-2 mt-1 mb-3 mt-md-1 mb-md-1"
                    required>

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
        {{--        @if(\Request::session()->has('add_post_spare_store_type') && \Request::session()->get('add_post_spare_store_type') == 0)--}}

        {{--        @endif--}}

    </div>

    {{--    @dump(\Request::session()->get('add_post_spare_store_type'))--}}
    @if(\Request::session()->has('add_post_spare_year_start'))

        <input type="hidden" id="spare_min_year" value="{{ \Request::session()->get('add_post_spare_year_start') }}">
    @endif
    @if(\Request::session()->has('add_post_spare_year_end'))

        <input type="hidden" id="spare_max_year" value="{{ \Request::session()->get('add_post_spare_year_end') }}">
@endif

<!-- Break -->
    <hr class="level-2_hr">

    <!-- Main Form Section -->
    <div class="row no-gutters my-4 added_fields_page_indexes">
        <!-- Left Aside -->
        <div class="col-lg-6 border-right-secondary">
            <!-- Get category special fields -->
            @include('create-post.input.index-spare-store')
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
                        <input type="text" form="addPostSpareForm" class="input-default p-2 float-right w-100" required
                               min="1" max="255" name="spare_store_title"
                               placeholder="{{ translating('create-post-title-placeholder') }}"
                               value="@if(\Request::session()->has('add_post_title') && \Request::session()->get('add_post_title') != NULL) {{ \Request::session()->get('add_post_title') }} @endif">

                    </div>

                    <!-- Clear floats -->
                    <p class="clearfix"></p>
                </div>
            </div>

        @if(\Request::session()->has('add_post_spare_store_type') && \Request::session()->get('add_post_spare_store_type') == 0)

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
                                <textarea required rows="10" form="addPostSpareForm"
                                          class="input-default p-2 float-right w-100"
                                          name="spare_store_description"
                                          placeholder="{{ translating('create-post-description-placeholder') }}">{{\Request::session()->get('add_post_description')}}</textarea>
                            @else
                                <textarea required rows="10" form="addPostSpareForm"
                                          class="input-default p-2 float-right w-100"
                                          name="spare_store_description"
                                          placeholder="{{ translating('create-post-description-placeholder') }}"></textarea>
                            @endif

                        </div>

                        <!-- Clear floats -->
                        <p class="clearfix"></p>
                    </div>
                </div>

        @endif

        <!-- Input Container -->
            <div class="row no-gutters justify-content-center">
                <div class="col-lg-3">
                    <!-- Image -->
                    <label class="font-weight-bold input-create-label float-left">{{ translating('images') }}</label>
                </div>
            @if(isset($cover_image) && $cover_image != NULL)
                <!-- Cover image -->
                    <div class="col-lg-9 bg-white border border-light p-2 rounded">
                        <!-- Tools -->
                        <label class="image-upload-item image position-relative"
                               style="background-image: url({{ Storage::disk('s3')->temporaryUrl($cover_image->img,'+2 minutes') }}) !important"><input
                                type="file" name="uploadImage1" value="{{ $cover_image->img }}" form="addPostSpareForm"
                                class="uploadFile d-none"></label>
                        <input type="hidden" form="addPostSpareForm" value="{{ $cover_image->img }}"
                               name="deleteImage1">

                    </div>
                @else
                    <div class="col-lg-9 bg-white border border-light p-2 rounded">
                        <!-- Tools -->
                        <label class="image-upload-item image position-relative no-img"><input type="file"
                                                                                               name="uploadImage1"
                                                                                               form="addPostSpareForm"
                                                                                               class="uploadFile d-none"></label>

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
                    <div
                        class="col-lg-9 col-md-6 col-12 mt-3 mt-md-1 bg-white border border-light p-2 rounded video-container">
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
                                <div class="row justify-content-around align-items-center h-100"
                                     id="parent_variants">
                                    @foreach($video_variants as $key => $value)

                                        @if($key != count($video_variants) - 1)

                                            <div class="col-3 variant_video d-flex flex-column justify-content-around"
                                                 data-duration="{{ $value->duration }}"
                                                 data-price="{{ $value->price }}"
                                                 title="Վճարումը կկատարվի ձեր կողմից հայտարարության վերջնական հաստատման ժամանակ">
                                                Մինչև {{ $value->duration }}
                                                վայրկյան <br>
                                                {{ $value->price }} դրամ
                                            </div>

                                        @endif
                                    @endforeach
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
                        <input type="file" id="custom-video" form="addPostSpareForm" class="d-none"
                               accept="video/*">
                    </div>

                    <div
                        class="col-lg-9 col-md-6 col-12 bg-white border border-light p-2 rounded youtube-links video-container-2">
                        @if(\Request::session()->has('external_urls') && count(\Request::session()->get('external_urls')[0]) > 0)

                            @foreach(\Request::session()->get('external_urls')[0] as $links)

                                <input name="external_url[]" type="text" form="addPostSpareForm"
                                       class="form-control external_url"
                                       aria-describedby="url"
                                       value="{{ $links }}"
                                       autocomplete="off" autofocus placeholder="Youtube-ի հղում">
                                {{--                                @dump($links)--}}

                            @endforeach
                        @else

                            <input name="external_url[]" type="text" form="addPostSpareForm"
                                   class="form-control external_url"
                                   aria-describedby="url"
                                   autocomplete="off" autofocus placeholder="Youtube-ի հղում">

                        @endif
                        <button type="button" class="btn btn-primary btn-sm spare_external add_link_btn"><i
                                class="fas fa-plus"></i></button>

                    </div>

                </div>
                <form id="addPostSpareForm"
                      action="{{ route('add-post-store-spare', ['locale' => app()->getLocale()]) }}"
                      method="post" class="w-100" enctype="multipart/form-data">
                @csrf
                <!-- Spare-Store-Type -->
                    <input type="text" form="addPostSpareForm" class="d-none input-default p-2 w-100"
                           value="@if(\Request::session()->has('add_post_spare_store_type')) {{ \Request::session()->get('add_post_spare_store_type') }} @else default @endif"
                           name="spare_store_type">
                    <!-- Category Id -->
                    <input type="text" form="addPostSpareForm" class="d-none input-default p-2 w-100"
                           value="@if(\Request::session()->get('post_has_service') == 1) {{ \Request::session()->get('create-post-category-id') }} @else {{ \Request::segment(4) }} @endif"
                           name="category_id">

                    <!-- Submit -->
                    <button type="submit" form="addPostSpareForm"
                            class="mt-2 btn btn-main text-light add_post_button float-right btn-lg">
                        <i class="loading-icon fa-lg fas fa-spinner d-none fa-spin hide"></i>
                        {{ translating('live-demo') }}</button>
                </form>

            </div>
        </div>
        <!-- Check images count data -->
        @if(isset($cover_image))
            <input type="text" class="d-none" name="imagesCount" value="1" form="addPostSpareForm">
        @else
            <input type="text" class="d-none" name="imagesCount" value="0" form="addPostSpareForm">
        @endif

    </div>
</div>

