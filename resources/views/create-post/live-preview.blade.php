@extends('layouts.app')

@section('content')
{{--    @dump(\Request::session()->get('add_post_spare_store_type'))--}}
    <div class="load-content">
        <div class="auth-container @if(Route::currentRouteName() == 'create-post-level-3' || Route::currentRouteName() == 'create-post-level-3-spare')  preview-auth-container @endif">
            <div class="container">
                <div class="row bg-white shadow-sm">
                    @if(\Request::session()->has('image_exists_error') && \Request::session()->get('image_exists_error') != NULL)
                        <div class="alert alert-danger alert-dismissible fade w-100 text-center d-block show"
                             role="alert">
                            <strong><i class="fa fa-images"></i> {{ translating('image-already-exists-error') }}
                            </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true"><i class="fa fa-times"></i></span></button>
                        </div>

                        @php \Request::session()->forget('image_exists_error'); @endphp
                    @endif

                <!-- Left Content -->
                    <div class="mt-3 mt-md-0 mb-md-0 p-5-responsive bg-white mb-5 col-lg-8 left-section">
                        @include('create-post.left-preview')
                    </div>

                    <!-- Right Sidebar -->
                    <div class="mt-3 mt-md-0 p-3 bg-white col-lg-3 offset-lg-1">
                        @include('create-post.right-preview')
                    </div>

                    <!-- Bootom Row -->
{{--                    @dd(\Request::session()->has('add_post_spare_store_type'))--}}
                    <div class="pb-3 bg-white col-12">
                        <a href="javascript:void(0)" class="d-block float-right h5 btn btn-danger ml-5"
                           data-toggle="modal" data-target="#exampleModalCancelProcessCenter"><i
                                class="fa fa-times"></i> {{ translating('cancel') }}</a>
                        @if(\Request::session()->has('add_post_spare_store_type'))
                            <a href="{{ route('sel-spare-store',app()->getLocale()) }}"
                               class="d-block float-right btn btn-main text-light h5" style="color: #0B3363"><i
                                    class="fa fa-edit"></i> {{ translating('edit') }}</a>
                        @else
                            <a href="{{ route('create-post-level-2', ['locale' => app()->getLocale(), 'category_id' => $post->category_id]) }}"
                               class="d-block float-right btn btn-main text-light h5" style="color: #0B3363"><i
                                    class="fa fa-edit"></i> {{ translating('edit') }}</a>
                        @endif
                        <p class="clearfix"></p>
                        <a data-change-url="/{{ app()->getLocale() }}/create-post/level4/{{ $post->id }}"
                           href="{{ route('create-post-level-4', ['locale' => app()->getLocale(), 'id' => $post->id]) }}"
                           id="confirmPostCreatingProcess"
                           class="btn btn-main float-right d-block text-light btn-lg">{{ translating('create-post-confirm') }}</a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCancelProcessCenter" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCancelProcessCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold"
                            id="exampleModalCancelProcessLongTitle">{{ translating('cancel-create-post-process') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <svg id="close" xmlns="http://www.w3.org/2000/svg" width="31.808" height="31.807"
                                 viewBox="0 0 31.808 31.807">
                                <g id="Group_1179" data-name="Group 1179">
                                    <g id="Group_1178" data-name="Group 1178">
                                        <path id="Path_480" data-name="Path 480"
                                              d="M30.482,14.578A1.326,1.326,0,0,0,29.157,15.9a13.253,13.253,0,1,1-3.849-9.338A1.325,1.325,0,1,0,27.189,4.7,15.9,15.9,0,1,0,31.808,15.9,1.326,1.326,0,0,0,30.482,14.578Z"
                                              fill="#747474"/>
                                    </g>
                                </g>
                                <g id="Group_1457" data-name="Group 1457">
                                    <g id="Group_1181" data-name="Group 1181" transform="translate(10.603 10.604)">
                                        <g id="Group_1180" data-name="Group 1180">
                                            <path id="Path_481" data-name="Path 481"
                                                  d="M135.177,133.3l3.039-3.039a1.325,1.325,0,0,0-1.874-1.874l-3.039,3.039-3.039-3.039a1.325,1.325,0,0,0-1.874,1.874l3.039,3.039-3.039,3.039a1.325,1.325,0,1,0,1.874,1.874l3.039-3.039,3.039,3.039a1.325,1.325,0,0,0,1.874-1.874Z"
                                                  transform="translate(-128.002 -128.002)" fill="#747474"/>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body w-100 text-center">
                        <p>{!! translating('post-level3-cancel-procee-description') !!}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ translating('close') }}</button>
{{--                        @dd($post)--}}
                        <a href="{{ route('add-post-destroy', ['locale' => app()->getLocale(), 'id' => $post->id]) }}"
                           class="btn btn-danger">{{ translating('yes-i-accept') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
