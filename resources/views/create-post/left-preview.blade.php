<!-- Page Header Section -->
<div class="row no-gutters align-items-center preview_title_row">
    <!-- Title -->
    <div class="col-xl-9 col-lg-10 col-md-10 p-0 mb-2">
        <h1 class="h3 post-title font-weight-bold">
            @if(strlen($post->title) > 40) {{ mb_substr($post->title, 0, 35)."..." }} @else {{ $post->title }} @endif
        </h1>
    </div>


    <!-- Hurry or No -->
    <div
        class="col-xl-3 col-lg-2 col-md-2 p-0 mb-2 align-items-baseline @if(isset($post->hurry) && $post->hurry == 1) justify-content-between @else justify-content-end @endif">
        <!-- Check data    -->
        @if(isset($post->hurry) && $post->hurry == 1)
            <span class="btn btn-danger float-left">{{ translating('hurry') }}</span>
    @endif

    <!-- Post Code -->
        <strong class="text-right float-right h5 font-weight-bold">{{ translating('id').' '.$post->code }}</strong>
    </div>
</div>

@if(isset($post->image) && count($post->image) > 0)
    <!-- Iamges Slider -->
    <div class="detail-sldier mt-2">
        <!-- Large Image -->
        <div class="slider slider-for">
            <!-- Check cover image -->
            @if(isset($post->img) && $post->img != NULL)
                <div>
                    <!-- Image -->
                    <img src="{{ Storage::disk('s3')->temporaryUrl($post->img,'+2 minutes') }}"
                         class="responsive rounded"
                         title="{{ $post->title }}" alt="{{ $post->title }}">
                </div>
            @endif
        <!-- Loop from images -->
            @foreach($post->image as $image)

                <div>
                    <!-- Image -->

                    <img src="{{ Storage::disk('s3')->temporaryUrl($image->img,'+2 minutes') }}"
                         class="responsive rounded"
                         title="{{ $post->title }}" alt="{{ $post->title }}">
                </div>
            @endforeach
        </div>

        <!-- Thumbnails -->
        <div class="slider slider-nav thumbnails">
            <!-- Check cover image -->
            @if(isset($post->img) && $post->img != NULL)
                <div>
                    <!-- Image -->
                    <img src="{{ Storage::disk('s3')->temporaryUrl($post->img,'+2 minutes') }}" class="w-100 responsive rounded"
                         title="{{ $post->title }}" alt="{{ $post->title }}">
                </div>
            @endif

        <!-- Loop from images -->
            @foreach($post->image as $image)
                <div>
                    <!-- Image -->
                    <img src="{{ Storage::disk('s3')->temporaryUrl($image->img,'+2 minutes') }}" class="w-100 responsive rounded"
                         title="{{ $post->title }}" alt="{{ $post->title }}">
                </div>
            @endforeach
        </div>
    </div>
@else
    {{--    @dump($post->img)--}}
    {{--    @dd(Storage::disk('s3')->url($post->img))--}}
    <!-- Check image data -->
    @if(isset($post->img) && $post->img != NULL)
        <!-- Single Image -->
        <div class="w-100 mt-2 single-img">

            <img src="{{ Storage::disk('s3')->temporaryUrl($post->img,'+2 minutes') }}" class="w-100 responsive"
                 title="{{ $post->title }}" alt="{{ $post->title }}">
        </div>
    @endif
@endif

<!-- Description, Price, Location Section -->
<div class="mt-3">
    <div class="row no-gutters mt-2 align-items-center">
    @if(!is_null($post->price))
        <!-- Price -->
            <strong class="font-weight-bold h4">{{ $post->price.' '.$post->currency['simbol'] }}</strong>
    @endif
    <!-- Check Location Data -->
    @if(isset($post->location_id) && $post->location_id != NULL)
        <!-- Location -->
            <div class="@if(is_null($post->price)) responsive @else ml-5-responsive @endif">
                <!-- Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="30" viewBox="0 0 33.484 50.226">
                    <g id="pin_1_" data-name="pin (1)" transform="translate(-85.333)">
                        <g id="Group_83" data-name="Group 83" transform="translate(85.333)">
                            <path id="Path_118" data-name="Path 118"
                                  d="M102.075,0A16.744,16.744,0,0,0,87.343,24.7l13.816,24.988a1.047,1.047,0,0,0,1.831,0l13.821-25A16.745,16.745,0,0,0,102.075,0Zm0,25.113a8.371,8.371,0,1,1,8.371-8.371A8.38,8.38,0,0,1,102.075,25.113Z"
                                  transform="translate(-85.333)" fill="#556080"/>
                        </g>
                    </g>
                </svg>

            @if(isset($post->location['title_'.app()->getLocale()]) && $post->location['title_'.app()->getLocale()] != NULL)
                <!-- Location -->
                    <span style="color: #28446A">
                        {{ $post->location['title_'.app()->getLocale()] }}

                        <!-- Address -->
                            @if(isset($post->address) && $post->address != NULL)
                                <i class="fa fa-angle-right"></i> {{ $post->address }}
                            @endif
                    </span>
                @endif
            </div>
    @endif

    <!-- Description -->
        <div class="row no-gutters d-block my-3 w-100">
            @php echo nl2br(strip_tags($post->description)) @endphp
        </div>
    </div>

    @include('items.detail.left.options')
    @include('items.detail.left.option-spare')
    <div class="row no-gutters preview-video-container my-3 w-100">
        @if($post->links()->exists() && count($post->links) > 0)
            <div class="col-3 d-flex flex-column">

                @foreach($post->links as $links)
                    @php
                        $video_key = YoutubeID($links->link);
                    @endphp
                    <div class="mt-1 video">
                        <img src="http://img.youtube.com/vi/{{ $video_key }}/mqdefault.jpg"
                             class="youtube-video-thumbnail"
                             alt=""/>
                        <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33"
                             data-toggle="modal" data-target="#myModal-video" data-key="{{$video_key}}"
                             class="iframe-a">
                            <g id="Icon_feather-play-circle" data-name="Icon feather-play-circle"
                               transform="translate(1.5 1.5)">
                                <path id="Контур_668" data-name="Контур 668"
                                      d="M33,18A15,15,0,1,1,18,3,15,15,0,0,1,33,18Z" transform="translate(-3 -3)"
                                      fill="none" stroke="#e2e2e2" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="3"/>
                                <path id="Контур_669" data-name="Контур 669" d="M15,12l9,6-9,6Z"
                                      transform="translate(-3 -3)" fill="none" stroke="#e2e2e2" stroke-linecap="round"
                                      stroke-linejoin="round" stroke-width="3"/>
                            </g>
                        </svg>
                        {{--                        <button type="button" data-toggle="modal" data-target="#myModal-video" data-key="{{$video_key}}"--}}
                        {{--                                class="iframe-a"></button>--}}


                    </div>
                @endforeach

            </div>

        @endif
        @if(!is_null($post->video_url))
            <div class="col-8">
                <video controls class="myvideo_preview" style="height:100%">
                    <source src="{{ $post->video_url }}"
                            id="video_here">
                </video>
            </div>

        @endif
    </div>

    {{--    <iframe width="560" height="315" class="d-none" id="youtube-iframe"--}}
    {{--            src="http://www.youtube.com/embed/{{$video_key}}" frameborder="0" allowfullscreen></iframe>--}}

    {{--   Video Modal --}}

</div>
<!-- Modal -->
<div class="modal" id="myModal-video" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog-video" role="document">
        <div class="modal-content">


            <div class="modal-body-video">

                <button type="button" class="close-video" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- 16:9 aspect ratio -->
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="" id="youtube-iframe" frameborder="0"
                            allowfullscreen></iframe>
                </div>


            </div>

        </div>
    </div>
</div>
