{{--@include('components.home.slider')--}}
@if((\Request::segment(2) == 'filter' || \Request::segment(2) == 'category') && in_array($category->id,$transport_sub_cat_ids))
    <!-- Auto-Brands Slider -->
    @include('components.home.auto-brands')
@endif

{{--<div class="app-container">--}}
    <!-- Subcategories Slider -->
    @if(\Request::segment(2) == 'filter' || \Request::segment(2) == 'category' || \Request::segment(2) == 'filter-spare')
        <div class="app-container my-2" id="topCatSection" style="overflow: hidden;">
            @include('items.list.filter.main.sub-categories')
        </div>
    @else
        @if(isset($category->has_subcategory) && $category->has_subcategory == '1' && count(getCategoryChildren($category->id)) > 0)
            <div class="app-container my-2" id="topCatSection" style="overflow: hidden;">
                @include('items.list.filter.main.sub-categories')
            </div>
        @endif
    @endif
{{--</div>--}}
<div class="app-container">
{{--@include('components.home.slider')--}}
{{--    @dump('index-only')--}}
<!-- Show filters button -->
<!-- <button type="button" data-close="<i class='fa fa-filter'></i> {{ translating('close-filters') }}" data-show="<i class='fa fa-filter'></i> {{ translating('show-filters') }}" class="w-100 show-filters btn btn-dark"><i class="fa fa-filter"></i> {{ translating('show-filters') }}</button> -->
    <!-- <div class="row no-gutters filters-bar"> -->
@include('items.list.filter.index')
<!-- </div> -->
</div>

<div class="my-3 bg-white second-app-container">
    <div class="row justify-content-center">
        <!-- Left Sidebar -->

        <!-- Content -->
        <div class="my-3 rounded big-load-data-content col-lg-12 order-1 order-lg-2">
            <!-- Check data -->
        @if(isset($top_posts))
            <!-- Top Posts -->
            {{--                <div class="col-lg-1"></div>--}}
            {{--                    <div class="col-lg-10">--}}
            @include('items.list.content.top')
            {{--                    </div>--}}
            {{--                    <div class="col-lg-1"></div>--}}

        @endif

        <!-- Check data -->
        @if(isset($posts))
            <!-- Posts -->
                @include('items.list.content.posts')
            @endif
        </div>

    </div>
</div>
<script>

    // You can change global variables here:
    var autoRotate = true; // auto rotate or not
    var rotateSpeed = -60; // unit: seconds/360 degrees

    // Responsive
    if (window.innerWidth > 992) {
        var radius = 380;
        var imgWidth = 320;
        var imgHeight = 180;
    } else if (window.innerWidth < 992 && window.innerWidth >= 768) {
        var radius = 310;
        var imgWidth = 240;
        var imgHeight = 120;
    } else if (window.innerWidth < 768 && window.innerWidth > 576) {
        var radius = 280;
        var imgWidth = 220;
        var imgHeight = 100;
    } else if (window.innerWidth < 576 && window.innerWidth > 480) {
        var radius = 250;
        var imgWidth = 200;
        var imgHeight = 70;
    } else {
        var radius = 150;
        var imgWidth = 180;
        var imgHeight = 50;
    }


    // ===================== start =======================
    // animation start after 1000 miliseconds
    setTimeout(init, 1000);

    var odrag = document.getElementById('drag-container');
    var ospin = document.getElementById('spin-container');
    var aImg = ospin.getElementsByClassName('cont');
    var aEle = [...aImg];

    // Size of images
    ospin.style.width = imgWidth + "px";
    ospin.style.height = imgHeight + "px";

    // Size of ground - depend on radius
    var ground = document.getElementById('ground');
    ground.style.width = radius * 3 + "px";
    ground.style.height = radius * 3 + "px";

    function init(delayTime) {
        for (var i = 0; i < aEle.length; i++) {
            aEle[i].style.transform = "rotateY(" + (i * (360 / aEle.length)) + "deg) translateZ(" + radius + "px)";
            aEle[i].style.transition = "transform 1s";
            aEle[i].style.transitionDelay = delayTime || (aEle.length - i) / 4 + "s";
        }
    }

    function applyTranform(obj) {
        // Constrain the angle of camera (between 0 and 180)
        if (tY > 180) tY = 180;
        if (tY < 0) tY = 0;

        // Apply the angle
        obj.style.transform = "rotateX(" + (-tY) + "deg) rotateY(" + (tX) + "deg)";
    }

    function playSpin(yes) {
        ospin.style.animationPlayState = (yes ? 'running' : 'paused');
    }

    var sX, sY, nX, nY, desX = 0,
        desY = 0,
        tX = 0,
        tY = 10;

    // auto spin
    if (autoRotate) {
        var animationName = (rotateSpeed > 0 ? 'spin' : 'spinRevert');
        ospin.style.animation = `${animationName} ${Math.abs(rotateSpeed)}s infinite linear`;
    }

    // setup events
    document.onpointerdown = function (e) {
        if (e.target.id != 'homeSlider' && e.target.id != 'ground') {
            return;
        }
        clearInterval(odrag.timer);
        e = e || window.event;
        var sX = e.clientX,
            sY = e.clientY;
        this.onpointermove = function (e) {
            e = e || window.event;
            var nX = e.clientX,
                desX = nX - sX;
            tX += desX * 0.1;
            applyTranform(odrag);
            sX = nX;
        };

        this.onpointerup = function (e) {
            odrag.timer = setInterval(function () {
                desX *= 0.95;
                desY *= 0.95;
                tX += desX * 0.1;
                tY += desY * 0.1;
                applyTranform(odrag);
                playSpin(false);
                if (Math.abs(desX) < 0.5 && Math.abs(desY) < 0.5) {
                    clearInterval(odrag.timer);
                    playSpin(true);
                }
            }, 17);
            this.onpointermove = this.onpointerup = null;
        };
        return false;
    }


</script>
