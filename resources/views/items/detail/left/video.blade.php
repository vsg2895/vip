<!-- Video Section -->
@if(isset($post->video_url) && $post->video_url != NULL)
   <div class="w-100">
        <!-- Title -->
        <h5 class="my-3" style="color: #28446A">{{ translating('see-video') }}</h5>

        <!-- Video -->

       <div class="row no-gutters my-3 w-100">

           @if($post->links()->exists() && count($post->links) > 0)
               <div class="col-4 d-flex flex-column">

                   @foreach($post->links as $links)
                       @php
                           $video_key = YoutubeID($links->link);
                       @endphp
                       <div class="mt-1 video">
                           <img src="http://img.youtube.com/vi/{{ $video_key }}/mqdefault.jpg"
                                class="youtube-video-thumbnail"
                                alt=""/>
                           <button type="button" data-toggle="modal" data-target="#myModal-video" data-key="{{$video_key}}"
                                   class="iframe-a"></button>


                       </div>
                   @endforeach

               </div>

           @endif
           @if(!is_null($post->video_url))
               <div class="col-8">
                   @php
                       $video_name = explode('/',$post->video_url)
                   @endphp

                   <video controls class="myvideo_preview" style="height:100%">
                       <source src="{{ asset('storage/videos/'.$video_name[2]) }}"
                               {{--                <source src="/get-video/'{{ $post->video_url }}"--}}
                               id="video_here">
                   </video>
               </div>

           @endif
       </div>
   </div>
@endif

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
                    <iframe class="embed-responsive-item" src="" id="youtube-iframe" frameborder="0" allowfullscreen></iframe>
                </div>


            </div>

        </div>
    </div>
</div>
