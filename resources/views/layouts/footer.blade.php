<footer class="bg-white shadow-sm">
    <div class="row">
        <div class="col-lg-2 col-sm-4 col-12">
            <!-- Logo -->
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}">
                <svg class="d-block float-sm-left mx-sm-auto mx-auto mb-3" xmlns="http://www.w3.org/2000/svg" width="137" height="35" viewBox="0 0 137 35">
                    <g id="Group_1456" data-name="Group 1456" transform="translate(-99 -4841)">
                        <g id="Group_572" data-name="Group 572" transform="translate(-1 4809.019)">
                        <text id="Yerevan.v_p" data-name="Yerevan.vip" transform="translate(100 59.982)" font-size="26" font-family="SegoeUI, Segoe UI"><tspan x="0" y="0" xml:space="preserve">Yerevan.vip</tspan></text>
                        <g id="Group_453" data-name="Group 453" transform="translate(-3)">
                            <g id="Group_405" data-name="Group 405" transform="matrix(0.914, 0.407, -0.407, 0.914, 209.024, 31.334)">
                            <g id="Group_404" data-name="Group 404" transform="translate(0 4.255) rotate(-21)">
                                <g id="Group_403" data-name="Group 403" transform="translate(0 0)">
                                <path id="Path_221" data-name="Path 221" d="M10.779,1.49A1.094,1.094,0,0,0,9.716,2.843L7.564,3.65,6.489,2.038a1.094,1.094,0,1,0-1.1,0L4.31,3.65,2.157,2.843a1.095,1.095,0,1,0-.7.774l1.9,3.162V7.8a.349.349,0,0,0,.349.349h4.47A.349.349,0,0,0,8.521,7.8V6.779l1.9-3.162a1.094,1.094,0,1,0,.361-2.127ZM1.094,2.98a.4.4,0,1,1,.4-.4A.4.4,0,0,1,1.094,2.98ZM5.937.7a.4.4,0,1,1-.4.4A.4.4,0,0,1,5.937.7ZM7.823,7.45H4.051V7.031H7.823Zm.152-1.118H3.9l-1.619-2.7L4.324,4.4a.349.349,0,0,0,.413-.133l1.2-1.8,1.2,1.8A.353.353,0,0,0,7.55,4.4l2.043-.766ZM10.779,2.98a.4.4,0,1,1,.4-.4A.4.4,0,0,1,10.779,2.98Z"/>
                                </g>
                            </g>
                            </g>
                            <line id="Line_6" data-name="Line 6" y2="14.687" transform="translate(213.009 46.157)" fill="none" stroke="#000" stroke-width="3"/>
                        </g>
                        </g>
                    </g>
                </svg>
            </a>
        </div>

{{--        <div class="col-lg-2 col-sm-4 col-12">--}}
{{--            <ul class="text-center text-sm-left">--}}
{{--                <li class="mb-3">--}}
{{--                    <a class="text-dark w-100 h5" href="#">asasasa</a>--}}
{{--                </li>--}}
{{--                <li class="mb-3">--}}
{{--                    <a class="text-dark w-100 h5" href="#">asasasa</a>--}}
{{--                </li>--}}
{{--                <li class="mb-3">--}}
{{--                    <a class="text-dark w-100 h5" href="#">asasasa</a>--}}
{{--                </li>--}}
{{--                <li class="mb-3">--}}
{{--                    <a class="text-dark w-100 h5" href="#">asasasa</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--        <div class="col-lg-2 col-sm-4 col-12">--}}
{{--            <ul class="text-center text-sm-left">--}}
{{--                <li class="mb-3">--}}
{{--                    <a class="text-dark w-100 h5" href="#">asasasa</a>--}}
{{--                </li>--}}
{{--                <li class="mb-3">--}}
{{--                    <a class="text-dark w-100 h5" href="#">asasasa</a>--}}
{{--                </li>--}}
{{--                <li class="mb-3">--}}
{{--                    <a class="text-dark w-100 h5" href="#">asasasa</a>--}}
{{--                </li>--}}
{{--                <li class="mb-3">--}}
{{--                    <a class="text-dark w-100 h5" href="#">asasasa</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--        <div class="col-lg-2 col-sm-4 col-12">--}}
{{--            <ul class="text-center text-sm-left">--}}
{{--                <li class="mb-3">--}}
{{--                    <a class="text-dark w-100 h5" href="#">asasasa</a>--}}
{{--                </li>--}}
{{--                <li class="mb-3">--}}
{{--                    <a class="text-dark w-100 h5" href="#">asasasa</a>--}}
{{--                </li>--}}
{{--                <li class="mb-3">--}}
{{--                    <a class="text-dark w-100 h5" href="#">asasasa</a>--}}
{{--                </li>--}}
{{--                <li class="mb-3">--}}
{{--                    <a class="text-dark w-100 h5" href="#">asasasa</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}
        <div class="col-lg-2 col-sm-4 col-12">
            <ul class="text-center text-sm-left">
                <li class="mb-3">
                    <a class="text-dark w-100 h5" href="{{ route('reference', ['locale' => app()->getLocale()]) }}">{{ translating('reference') }}</a>
                </li>
                <li class="mb-3">
                    <a class="text-dark w-100 h5" href="{{ route('terms-and-conditions', ['locale' => app()->getLocale()]) }}">{{ translating('terms-and-conditions') }}</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-2 col-sm-4 col-12">
            @if(isset($social_accounts) && count($social_accounts) > 0)
                <div class="row ml-auto justify-content-center">
                    @foreach($social_accounts as $social_account)
                        <a href="{{ $social_account->url }}" rel="nofollow" target="_blank" class="btn ml-2 mr-2 mb-2 btn-sm btn-dark">
                            <i class="fab fa-{{ $social_account->icon }}"></i>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <hr>
    <div class="row no-gutters justify-content-center text-left text-dark">
        &copy;&nbsp;2020-{{ Date('Y') }}&nbsp;|&nbsp;Yerevan.vip
    </div>
</footer>
