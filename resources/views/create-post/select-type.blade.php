@extends('layouts.app')

@section('content')
    {{--    @dd('sjsjs)--}}
    <div class="create-post-load-content min-h-100" id="create-post-page">
        <!-- Content -->
        <div
            class="categories-content categories-content-edit d-flex @if(\Request::session()->has('post_canceled') && \Request::session()->get('post_canceled') != NULL) flex-column @endif align-items-center"
            action="{{ route('create-post',app()->getLocale()) }}">
        @if(\Request::session()->has('post_canceled') && \Request::session()->get('post_canceled') != NULL)
            <!-- Response -->
                <div class="alert alert-success text-center w-100 mt-5" role="alert">
                    <strong><i class="fa fa-check"></i> {{ translating('post-creating-process-canceled') }}</strong>
                </div>

                <!-- Clear session -->
            @php \Request::session()->forget('post_canceled'); @endphp
            {{--            @php \Request::session()->forget('post_has_service'); @endphp--}}
        @endif

        <!-- Navigation -->
            <div class="mt-5 app-container app-container-create">
                <div class="row title-select-type">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-12 title-select-type-col">
                        <h5>{{ translating('creat-post') }}</h5>
                    </div>
                </div>
                <div class="row post-types-row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-9 single_type d-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="31.843" height="40" viewBox="0 0 31.843 40" data-type="0" class="sel_added_type">
                            <g id="XMLID_470_" transform="translate(-27.75)">
                                <path id="XMLID_472_" d="M80,8.792A8.688,8.688,0,1,0,88.687,0,8.75,8.75,0,0,0,80,8.792Z"
                                      transform="translate(-45.015)" fill="#3b99f6"/>
                                <path id="XMLID_473_"
                                      d="M29.827,173.714h27.69a2.089,2.089,0,0,0,2.077-2.1,15.923,15.923,0,1,0-31.843,0A2.089,2.089,0,0,0,29.827,173.714Z"
                                      transform="translate(0 -133.714)" fill="#3b99f6"/>
                            </g>
                        </svg>
                        <a class="sel_added_type" data-type="0">Առք/Վաճառք</a>
                    </div>
                    <div
                        class="col-xl-3 col-lg-3 col-md-3 col-9 mt-lg-0 mt-xl-0 mt-md-0 mt-2 mt-sm-1 ml-md-0 ml-0 ml-xl-3 ml-lg-3 single_type d-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" data-type="1" class="sel_added_type">
                            <path id="Объединение_1" data-name="Объединение 1"
                                  d="M-8493.4,2238.1a4.986,4.986,0,0,0-3.443-4.483,4.986,4.986,0,0,0-5.42,1.6,19.932,19.932,0,0,1-4.761-4.069,5.011,5.011,0,0,0,.736-5.607,5.009,5.009,0,0,0-2.911-2.479,5.037,5.037,0,0,0-2.058-.221,19.814,19.814,0,0,1-.5-6.24,5.012,5.012,0,0,0,4.487-3.451,5,5,0,0,0-1.612-5.432,20.285,20.285,0,0,1,4.064-4.771,4.907,4.907,0,0,0,1.8,1.043,4.993,4.993,0,0,0,3.813-.294,4.989,4.989,0,0,0,2.7-4.978,19.83,19.83,0,0,1,6.244-.5,5.01,5.01,0,0,0,3.449,4.5,5.008,5.008,0,0,0,5.433-1.61,19.785,19.785,0,0,1,4.751,4.066,5.007,5.007,0,0,0-.739,5.617,5.007,5.007,0,0,0,2.911,2.479,5.092,5.092,0,0,0,2.072.214,19.79,19.79,0,0,1,.494,6.241,5.006,5.006,0,0,0-4.5,3.448,5.032,5.032,0,0,0,1.6,5.438,19.933,19.933,0,0,1-4.071,4.758,5.01,5.01,0,0,0-1.795-1.031,4.983,4.983,0,0,0-3.812.3,5.009,5.009,0,0,0-2.7,4.969,19.944,19.944,0,0,1-4.677.558Q-8492.617,2238.161-8493.4,2238.1Zm-6.036-22.426a8.1,8.1,0,0,0,5.2,10.208,8.138,8.138,0,0,0,1.835.371,2.474,2.474,0,0,0-.443-1.376,23.187,23.187,0,0,0-2.855-3.137,4.256,4.256,0,0,1-1.441-5.043l2.823,3.363,2.873.046.142-2.574-2.979-3.551a6.174,6.174,0,0,1,4.991,1.9c1.506,1.8,1.932,4.555.964,6.213a4.286,4.286,0,0,0-1.017,2.87q.047.474.093.925a8.1,8.1,0,0,0,5.228-5.211,8.1,8.1,0,0,0-5.2-10.208,8.106,8.106,0,0,0-2.508-.4A8.106,8.106,0,0,0-8499.438,2215.674Z"
                                  transform="translate(8511.817 -2198.161)" fill="#3b99f6"/>
                        </svg>
                        <a class="sel_added_type" data-type="1">Ծառայություն</a>
                    </div>
                    <div
                        class="col-xl-3 col-lg-3 col-md-3 col-9 mt-lg-0 mt-xl-0 mt-md-0 mt-2 ml-md-0 ml-0 ml-xl-3 ml-lg-3 single_type d-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="40" viewBox="0 0 48 40" data-type="2" class="sel_added_type">
                            <path id="Icon_awesome-store" data-name="Icon awesome-store"
                                  d="M46.914,9.266,41.857,1.172A2.493,2.493,0,0,0,39.745,0H8.26A2.493,2.493,0,0,0,6.148,1.172L1.091,9.266c-2.611,4.18-.3,9.992,4.582,10.656a8.079,8.079,0,0,0,1.068.07,7.687,7.687,0,0,0,5.751-2.586,7.689,7.689,0,0,0,11.5,0,7.689,7.689,0,0,0,11.5,0,7.712,7.712,0,0,0,5.751,2.586,7.992,7.992,0,0,0,1.068-.07C47.21,19.266,49.533,13.453,46.914,9.266ZM41.264,22.5a9.865,9.865,0,0,1-2.3-.3V30H9.04V22.2a10.3,10.3,0,0,1-2.3.3,10.489,10.489,0,0,1-1.4-.094,9.779,9.779,0,0,1-1.278-.281V37.5A2.494,2.494,0,0,0,6.554,40H41.467a2.494,2.494,0,0,0,2.494-2.5V22.125a7.94,7.94,0,0,1-1.278.281A10.811,10.811,0,0,1,41.264,22.5Z"
                                  transform="translate(-0.004)" fill="#3b99f6"/>
                        </svg>
                        <a class="sel_added_type" data-type="2">Պահեստամաս/Խանութ</a>
                    </div>
                </div>
                <div class="mt-3 row w-100">
                    <input type="hidden" name="added_post_type" value="">
                {{--                    <input type="hidden" name="category_id" value="">--}}
                <!-- <button class="selectcategory btn btn-main text-light btn-lg">{{ translating('continue') }}</button> -->
                </div>
            </div>
        </div>
    </div>

@endsection
