<!-- Page Header Section -->
<div class="row no-gutters align-items-baseline">
    <!-- Title -->
    <div class="col-xl-9 col-lg-9 col-md-9 col-9 p-0 mb-2">
        <h1 class="h3 post-title font-weight-bold">
            @if(strlen($post->title) > 40) {{ mb_substr($post->title, 0, 35)."..." }} @else {{ $post->title }} @endif

        </h1>
    </div>


    <!-- Hurry or No -->
    <div class="col-xl-3 col-lg-3 col-md-3 col-3 p-0 mb-2 d-flex align-items-baseline @if(isset($post->hurry) && $post->hurry == 1) justify-content-between detail-header-info @else justify-content-end @endif">
        <!-- Check data -->
        @if(isset($post->hurry) && $post->hurry == 1)
            <span class="btn btn-danger ml-5 float-left hurry-span">{{ translating('hurry') }}</span>
    @endif

    <!-- Post Code -->
        <strong class="text-right float-right h5 code-detail font-weight-bold"><span
                class="font-weight-bold text-danger">{{ translating('id') }}</span> {{ $post->code }}</strong>
    </div>
</div>
