@extends('layouts.app')

@section('content')
    <!-- Edit post content -->
    <div class="container level2-container">
        <div class="row mb-3">
            <!-- Check error -->
        @if(\Request::session()->has('error_category_id'))
            <!-- Error Response -->
                <div class="alert alert-danger w-100 alert-dismissible fade show" role="alert">
                    <!-- Text -->
                    <span>{{ translating('add-post-error-category-id') }}</span>

                    <!-- Button -->
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <!-- Close -->
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Forget session -->
            @php \Request::session()->forget('error_category_id'); @endphp
        @endif

        <!-- Author type -->
            <div class="col-lg-8">
                <!-- Input Content -->
                <div class="form-group mb-0">
                    <div class="form-row">
                        <label class="w-100">
                            <!-- Radio -->
                            <input type="radio" form="addPostForm" class="input-default float-left mr-2"
                                   name="auth_type" required value="0"
                                   @if(isset($post->auth_type) && $post->auth_type == '0')  checked @endif>

                            <!-- Title -->
                            <span class="float-left h5">{{ translating('owner') }}</span>

                            <!-- Clear floats -->
                            <p class="clearfix"></p>

                            <p class="w-100 h5">{!! translating('create-post-owner-description') !!}</p>
                        </label>
                    </div>
                </div>

                <!-- Input Content -->
                <div class="form-group mb-0">
                    <div class="form-row">
                        <label class="w-100">
                            <!-- Radio -->
                            <input type="radio" form="addPostForm" class="input-default float-left mr-2"
                                   name="auth_type" required value="1"
                                   @if(isset($post->auth_type) && $post->auth_type == '1') checked @endif>

                            <!-- Title -->
                            <span class="float-left h5">{{ translating('agancy') }}</span>

                            <!-- Clear floats -->
                            <p class="clearfix"></p>

                            <p class="w-100 h5">{!! translating('create-post-agancy-description') !!}</p>
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

            <!-- Post Type -->
            <div class="col-lg-4">
                <!-- Author type -->
                <div class="col-lg-6 p-0">
                    <!-- Input Content -->
                    <div class="form-group mb-0">
                        <div class="form-row">
                            <label class="w-100">
                                <!-- Radio -->
                                <input type="radio" form="addPostForm" checked class="input-default float-left mr-2"
                                       name="post_type" required value="0"
                                       @if(isset($post->post_type) && $post->post_type == '0')  checked @endif>

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
                                       @if(isset($post->post_type) && $post->post_type == '1')  checked @endif>

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
                                       @if(isset($post->post_type) && $post->post_type == '2')  checked @endif>

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
        </div>

        <!-- Break -->
        <hr>

        <div class="row">
            <div class="col-lg-4 col-md-6">
                <label class="w-100 d-block">{{ translating('select-your-location') }}</label>

                <!-- Location row -->
                <select name="location_id" form="addPostForm" class="locations input-default p-2 my-4" required>

                @if(isset($locations) && count($locations) > 0)
                    <!-- Loop from locations -->
                    @foreach($locations as $location)
                        <!-- Check location data -->
                            @if($post->has_services === 1)
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

            @if(!in_array($post->category_id,$real_estate_sub_cat_ids) && !in_array($post->category_id,$transport_sub_cat_ids) && $post->has_services === 0)
                <div class="col-lg-4 col-md-6">
                    {{--                @dd(\Request::session()->get('filter_post_elec_type'))--}}
                    <label class="w-100 d-block">{{ translating('post_electro_state') }}</label>
                    <select name="electro_type" form="addPostForm" class="w-100 input-default p-2 mt-4 mb-4">
                    {{-- adds controllers category and filtr functions new session filter_post_estate_type--}}
                    <!-- Default value -->
                        <option value="default">{{ translating('post_estate_type') }}</option>

                        <!-- Other Values -->
                        <option value="0"
                                @if($post->electro_type === 0)  selected @endif>{{ translating('filter-elec-new') }}</option>
                        <option value="1"
                                @if($post->electro_type === 1)  selected @endif>{{ translating('filter-elec-old') }}</option>
                    </select>
                </div>
            @endif

            @if(in_array($post->category_id,$real_estate_sub_cat_ids))
                <div class="col-lg-4 col-md-6">
                    <label class="w-100 d-block">{{ translating('post_estate_type') }}</label>
                    <select name="estate_type" form="addPostForm" class="w-100 input-default p-2 mt-4 mb-4">
                    {{-- adds controllers category and filtr functions new session filter_post_estate_type--}}
                    <!-- Default value -->
                        <option value="default">{{ translating('post_estate_type') }}</option>

                        <!-- Other Values -->
                        <option value="0"
                                @if($post->post_estate_type == '0')  selected @endif>{{ translating('filter_estate_rent') }}</option>
                        <option value="1"
                                @if($post->post_estate_type == '1')  selected @endif>{{ translating('filter_daily_rent') }}</option>
                        <option value="2"
                                @if($post->post_estate_type == '2')  selected @endif>{{ translating('filter_estate_sale') }}</option>
                        <option value="3"
                                @if($post->post_estate_type == '3')  selected @endif>{{ translating('filter_estate_change') }}</option>
                    </select>
                </div>
            @endif
            {{--        <div class="col-lg-4 col-md-6">--}}
            {{--            <label class="w-100 d-block">{{ translating('post-services-?') }}</label>--}}

            {{--            <!-- Services or no row -->--}}
            {{--            <select name="has_services" form="addPostForm" class="w-100 input-default p-2 mt-4 mb-4" required>--}}
            {{--                <option value="0" @if($post->has_services == 0) selected @endif>{{ translating('no') }}</option>--}}
            {{--                <option value="1" @if($post->has_services == 1) selected @endif>{{ translating('yes') }}</option>--}}
            {{--            </select>--}}
            {{--        </div>--}}
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

    <!-- Break -->
        <hr>

        <!-- Main Form Section -->
        <div class="row no-gutters my-4">
            <!-- Left Aside -->
            <div class="col-lg-6 border-right-secondary">
                <!-- Get category special fields -->
                @include('account.post.input.index')
            </div>

            <!-- Right Aside -->
            <div class="col-lg-6 pl-35-responsive">
                <!-- Input Container -->
                <div class="form-group">
                    <div class="row no-gutters">
                        <div class="col-lg-3">
                            <!-- Title -->
                            <label class="font-weight-bold float-left">{{ translating('title') }}</label>
                        </div>

                        <div class="col-lg-9">
                            <!-- Input -->
                            <input type="text" form="addPostForm" class="input-default p-2 float-right w-100" required
                                   min="1" max="255" name="title"
                                   placeholder="{{ translating('create-post-title-placeholder') }}"
                                   value="@if(isset($post->title)) {{ $post->title }} @endif">

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
                            <label class="font-weight-bold float-left">{{ translating('description') }}</label>
                        </div>

                        <div class="col-lg-9">
                            <!-- Input -->
                            <textarea required rows="10" form="addPostForm" class="input-default p-2 float-right w-100"
                                      name="description"
                                      placeholder="{{ translating('create-post-description-placeholder') }}">@if(isset($post->description)) {!! $post->description !!} @endif</textarea>

                            <!-- Check error -->
                        @if(\Request::session()->has('error_description'))
                            <!-- Error Response -->
                                <strong class="text-danger"><i
                                        class="fa fa-exclamation-triangle"></i> {{ translating('add-post-error-description') }}
                                </strong>

                                <!-- Forget session -->
                            @php \Request::session()->forget('error_description'); @endphp
                        @endif

                        <!-- Check error -->
                        @error('description')
                        <!-- Error Response -->
                            <strong class="text-danger"><i
                                    class="fa fa-exclamation-triangle"></i> {{ translating('add-post-error-description') }}
                            </strong>
                            @enderror
                        </div>

                        <!-- Clear floats -->
                        <p class="clearfix"></p>
                    </div>
                </div>

                <!-- Input Container -->
                <div class="row no-gutters">
                    <div class="col-lg-3">
                        <!-- Image -->
                        <label class="font-weight-bold float-left">{{ translating('images') }}</label>
                    </div>

                    <!-- Check images data -->
                @if(isset($post->img) && $post->img != NULL)
                    <!-- Cover image -->
                        <div class="col-lg-9">
                            <!-- Tools -->
                            <label class="image-upload-item image position-relative"
                                   style="background-image: url({{ asset('assets/img/items'.'/'.$post->img) }}) !important"><input
                                    type="file" name="uploadImage1" form="addPostForm"
                                    class="uploadFile d-none"></label>

                            <!-- Check gallery images data   -->
                        @if(isset($post->image) && count($post->image) > 0)
                            <!-- Loop from images -->
                            @foreach($post->image as $key => $gallery_image)
                                <!-- Gallery image item -->
                                    <label class="image-upload-item image position-relative img_isset"
                                           style="background-image: url({{ asset('assets/img/items'.'/'.$gallery_image->img) }}) !important"><input
                                            type="file" name="uploadImage{{ $key + 2 }}" form="addPostForm"
                                            class="uploadFile d-none"><i class="fa fa-times axios del"
                                                                         action="{{ route('add-post-destroy-image', ['locale' => app()->getLocale(), 'id' => $gallery_image->id]) }}"
                                                                         title="{{ translating('delete') }}"></i></label>
                            @endforeach
                        @endif

                        <!-- Plus Button -->
                            <div class="image-upload-item plus h4 imgAdd text-dark"><i class="fa fa-plus"></i></div>
                            <!-- Clear floats -->
                            <p class="clearfix"></p>
                        </div>
                @else
                    <!-- Default not image yet version -->
                        <div class="col-lg-9">
                            <!-- Tools -->
                            <label class="image-upload-item image position-relative"><input type="file"
                                                                                            name="uploadImage1"
                                                                                            form="addPostForm"
                                                                                            class="uploadFile d-none"></label>
                            <!-- Plus Button -->
                            <div class="image-upload-item plus h4 imgAdd text-dark"><i class="fa fa-plus"></i></div>
                            <!-- Clear floats -->
                            <p class="clearfix"></p>
                        </div>
                @endif

                <!-- Check error -->
                @if(\Request::session()->has('error_image'))
                    <!-- Error Response -->
                        <strong class="text-danger"><i
                                class="fa fa-exclamation-triangle"></i> {{ translating('add-post-error-image') }}
                        </strong>

                        <!-- Forget session -->
                        @php \Request::session()->forget('error_image'); @endphp
                    @endif
                </div>
            </div>

            <!-- Chek images count data -->
            @if(isset($post->img))
                @if(isset($post->image) && count($post->image))
                    <input type="text" class="d-none" name="imagesCount"
                           value="{{ intval(count($post->image)) + intval(1) }}" form="addPostForm">
                @else
                    <input type="text" class="d-none" name="imagesCount" value="1" form="addPostForm">
                @endif
            @else
                <input type="text" class="d-none" name="imagesCount" value="0" form="addPostForm">
        @endif

        <!-- Form -->
            <div class="row no-gutters w-100">
                <form id="addPostForm"
                      action="{{ route('account-posts-update-content', ['locale' => app()->getLocale(), 'id' => $post->id]) }}"
                      method="post" class="w-100" enctype="multipart/form-data">
                @csrf
                <!-- Category Id -->

                    <input type="text" form="addPostForm" class="d-none input-default p-2 w-100"
                           value="{{ \Request::segment(4) }}" name="category_id">

                    <!-- Submit -->
                    <button type="submit" form="addPostForm"
                            class="btn btn-main text-light float-right btn-lg">{{ translating('save-changes-post-edit') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
