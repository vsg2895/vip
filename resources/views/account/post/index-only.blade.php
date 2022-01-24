<div class="create-post-load-content">
    <!-- Content -->
    <div class="categories-content categories-content-edit" action="{{ route('create-post-level-2', ['locale' => app()->getLocale(), 'category_id' => 0]) }}">
        @if(\Request::session()->has('post_canceled') && \Request::session()->get('post_canceled') != NULL)
            <!-- Response -->
            <div class="alert alert-success text-center w-100" role="alert">
                <strong><i class="fa fa-check"></i> {{ translating('post-creating-process-canceled') }}</strong>
            </div>

            <!-- Clear session -->
            @php \Request::session()->forget('post_canceled'); @endphp
        @endif

        <!-- Navigation -->
        <nav>
            <!-- Main Category Type -->
            <ul class="bg-white p-3 float-left shadow-md d-inline-block w-auto">
                <!-- Item -->
                <li>
                    <!-- URL -->
                    <a categoryId="{{ '1' }}" class="text-dark selectcategory" href="#">
                        <!-- Text -->
                        <span class="main-name">
                            {{ translating('buy-and-sell') }}&nbsp;
                        </span>

                        <!-- Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="6.693" height="13.233" viewBox="0 0 6.693 13.233">
                            <g id="left-arrow" transform="translate(76.741 0.533)">
                                <g id="Group_9" data-name="Group 9" transform="translate(-76.741 -0.533)">
                                    <path id="Path_5" data-name="Path 5" d="M126.665,12.351l5.358-5.369a.518.518,0,0,0,0-.731L126.665.882a.517.517,0,1,1,.732-.73l5.357,5.368a1.552,1.552,0,0,1,0,2.193L127.4,13.082a.517.517,0,0,1-.732-.73Z" transform="translate(-126.514 0)"/>
                                    <path id="Path_14" data-name="Path 14" d="M126.665,12.351l5.358-5.369a.518.518,0,0,0,0-.731L126.665.882a.517.517,0,1,1,.732-.73l5.357,5.368a1.552,1.552,0,0,1,0,2.193L127.4,13.082a.517.517,0,0,1-.732-.73Z" transform="translate(-126.514 0)"/>
                                </g>
                            </g>
                        </svg>
                    </a>

                    <!-- Submenu Categories -->
                    <ul>
                        <!-- Item -->
                        <li class="position-relative">
                            <!-- URL -->
                            <a href="#" class="text-dark selectcategory">
                                <!-- Icon -->
                                <img src="{{ asset('assets/img/icons/1.png')  }}" class="d-inline ml-auto" alt="#">

                                <!-- Text -->
                                <span class="main-name">{{ 'Ansharj Guyq' }}</span>

                                <!-- Icon -->
                                <svg class="float-right" xmlns="http://www.w3.org/2000/svg" width="6.693" height="13.233" viewBox="0 0 6.693 13.233">
                                    <g id="left-arrow" transform="translate(76.741 0.533)">
                                        <g id="Group_9" data-name="Group 9" transform="translate(-76.741 -0.533)">
                                            <path id="Path_5" data-name="Path 5" d="M126.665,12.351l5.358-5.369a.518.518,0,0,0,0-.731L126.665.882a.517.517,0,1,1,.732-.73l5.357,5.368a1.552,1.552,0,0,1,0,2.193L127.4,13.082a.517.517,0,0,1-.732-.73Z" transform="translate(-126.514 0)"/>
                                            <path id="Path_14" data-name="Path 14" d="M126.665,12.351l5.358-5.369a.518.518,0,0,0,0-.731L126.665.882a.517.517,0,1,1,.732-.73l5.357,5.368a1.552,1.552,0,0,1,0,2.193L127.4,13.082a.517.517,0,0,1-.732-.73Z" transform="translate(-126.514 0)"/>
                                        </g>
                                    </g>
                                </svg>

                                <p class="clearfix"></p>
                            </a>

                            <!-- Submenu Categories -->
                            <ul>
                                <!-- Item -->
                                <li class="position-relative">
                                    <!-- URL -->
                                    <a href="#" class="text-dark selectcategory">
                                        <!-- Icon -->
                                        <img src="{{ asset('assets/img/icons/1.png')  }}" class="d-inline ml-auto" alt="#">

                                        <!-- Text -->
                                        {{ 'Ansharj Guyq' }}

                                        <!-- Icon -->
                                        <svg class="float-right" xmlns="http://www.w3.org/2000/svg" width="6.693" height="13.233" viewBox="0 0 6.693 13.233">
                                            <g id="left-arrow" transform="translate(76.741 0.533)">
                                                <g id="Group_9" data-name="Group 9" transform="translate(-76.741 -0.533)">
                                                    <path id="Path_5" data-name="Path 5" d="M126.665,12.351l5.358-5.369a.518.518,0,0,0,0-.731L126.665.882a.517.517,0,1,1,.732-.73l5.357,5.368a1.552,1.552,0,0,1,0,2.193L127.4,13.082a.517.517,0,0,1-.732-.73Z" transform="translate(-126.514 0)"/>
                                                    <path id="Path_14" data-name="Path 14" d="M126.665,12.351l5.358-5.369a.518.518,0,0,0,0-.731L126.665.882a.517.517,0,1,1,.732-.73l5.357,5.368a1.552,1.552,0,0,1,0,2.193L127.4,13.082a.517.517,0,0,1-.732-.73Z" transform="translate(-126.514 0)"/>
                                                </g>
                                            </g>
                                        </svg>

                                        <p class="clearfix"></p>
                                    </a>

                                    <!-- Submenu Categories -->
                                    <ul>
                                        <!-- Item -->
                                        <li class="position-relative">
                                            <!-- URL -->
                                            <a href="#" class="text-dark selectcategory">
                                                <!-- Icon -->
                                                <img src="{{ asset('assets/img/icons/1.png')  }}" class="d-inline ml-auto" alt="#">

                                                <!-- Text -->
                                                {{ 'Ansharj Guyq' }}

                                                <!-- Icon -->
                                                <svg class="float-right" xmlns="http://www.w3.org/2000/svg" width="6.693" height="13.233" viewBox="0 0 6.693 13.233">
                                                    <g id="left-arrow" transform="translate(76.741 0.533)">
                                                        <g id="Group_9" data-name="Group 9" transform="translate(-76.741 -0.533)">
                                                            <path id="Path_5" data-name="Path 5" d="M126.665,12.351l5.358-5.369a.518.518,0,0,0,0-.731L126.665.882a.517.517,0,1,1,.732-.73l5.357,5.368a1.552,1.552,0,0,1,0,2.193L127.4,13.082a.517.517,0,0,1-.732-.73Z" transform="translate(-126.514 0)"/>
                                                            <path id="Path_14" data-name="Path 14" d="M126.665,12.351l5.358-5.369a.518.518,0,0,0,0-.731L126.665.882a.517.517,0,1,1,.732-.73l5.357,5.368a1.552,1.552,0,0,1,0,2.193L127.4,13.082a.517.517,0,0,1-.732-.73Z" transform="translate(-126.514 0)"/>
                                                        </g>
                                                    </g>
                                                </svg>

                                                <p class="clearfix"></p>
                                            </a>
                                        </li>

                                        <!-- Item -->
                                        <li class="position-relative">
                                            <!-- URL -->
                                            <a href="#" class="text-dark selectcategory">
                                                <!-- Icon -->
                                                <img src="{{ asset('assets/img/icons/1.png')  }}" class="d-inline ml-auto" alt="#">

                                                <!-- Text -->
                                                {{ 'Ansharj Guyq' }}

                                                <!-- Icon -->
                                                <svg class="float-right" xmlns="http://www.w3.org/2000/svg" width="6.693" height="13.233" viewBox="0 0 6.693 13.233">
                                                    <g id="left-arrow" transform="translate(76.741 0.533)">
                                                        <g id="Group_9" data-name="Group 9" transform="translate(-76.741 -0.533)">
                                                            <path id="Path_5" data-name="Path 5" d="M126.665,12.351l5.358-5.369a.518.518,0,0,0,0-.731L126.665.882a.517.517,0,1,1,.732-.73l5.357,5.368a1.552,1.552,0,0,1,0,2.193L127.4,13.082a.517.517,0,0,1-.732-.73Z" transform="translate(-126.514 0)"/>
                                                            <path id="Path_14" data-name="Path 14" d="M126.665,12.351l5.358-5.369a.518.518,0,0,0,0-.731L126.665.882a.517.517,0,1,1,.732-.73l5.357,5.368a1.552,1.552,0,0,1,0,2.193L127.4,13.082a.517.517,0,0,1-.732-.73Z" transform="translate(-126.514 0)"/>
                                                        </g>
                                                    </g>
                                                </svg>

                                                <p class="clearfix"></p>
                                            </a>
                                        </li>

                                        <!-- Item -->
                                        <li class="position-relative">
                                            <!-- URL -->
                                            <a href="#" class="text-dark selectcategory">
                                                <!-- Icon -->
                                                <img src="{{ asset('assets/img/icons/1.png')  }}" class="d-inline ml-auto" alt="#">

                                                <!-- Text -->
                                                {{ 'Ansharj Guyq' }}

                                                <!-- Icon -->
                                                <svg class="float-right" xmlns="http://www.w3.org/2000/svg" width="6.693" height="13.233" viewBox="0 0 6.693 13.233">
                                                    <g id="left-arrow" transform="translate(76.741 0.533)">
                                                        <g id="Group_9" data-name="Group 9" transform="translate(-76.741 -0.533)">
                                                            <path id="Path_5" data-name="Path 5" d="M126.665,12.351l5.358-5.369a.518.518,0,0,0,0-.731L126.665.882a.517.517,0,1,1,.732-.73l5.357,5.368a1.552,1.552,0,0,1,0,2.193L127.4,13.082a.517.517,0,0,1-.732-.73Z" transform="translate(-126.514 0)"/>
                                                            <path id="Path_14" data-name="Path 14" d="M126.665,12.351l5.358-5.369a.518.518,0,0,0,0-.731L126.665.882a.517.517,0,1,1,.732-.73l5.357,5.368a1.552,1.552,0,0,1,0,2.193L127.4,13.082a.517.517,0,0,1-.732-.73Z" transform="translate(-126.514 0)"/>
                                                        </g>
                                                    </g>
                                                </svg>

                                                <p class="clearfix"></p>
                                            </a>
                                        </li>

                                        <!-- Item -->
                                        <li class="position-relative">
                                            <!-- URL -->
                                            <a href="#" class="text-dark selectcategory">
                                                <!-- Icon -->
                                                <img src="{{ asset('assets/img/icons/1.png')  }}" class="d-inline ml-auto" alt="#">

                                                <!-- Text -->
                                                {{ 'Ansharj Guyq' }}

                                                <!-- Icon -->
                                                <svg class="float-right" xmlns="http://www.w3.org/2000/svg" width="6.693" height="13.233" viewBox="0 0 6.693 13.233">
                                                    <g id="left-arrow" transform="translate(76.741 0.533)">
                                                        <g id="Group_9" data-name="Group 9" transform="translate(-76.741 -0.533)">
                                                            <path id="Path_5" data-name="Path 5" d="M126.665,12.351l5.358-5.369a.518.518,0,0,0,0-.731L126.665.882a.517.517,0,1,1,.732-.73l5.357,5.368a1.552,1.552,0,0,1,0,2.193L127.4,13.082a.517.517,0,0,1-.732-.73Z" transform="translate(-126.514 0)"/>
                                                            <path id="Path_14" data-name="Path 14" d="M126.665,12.351l5.358-5.369a.518.518,0,0,0,0-.731L126.665.882a.517.517,0,1,1,.732-.73l5.357,5.368a1.552,1.552,0,0,1,0,2.193L127.4,13.082a.517.517,0,0,1-.732-.73Z" transform="translate(-126.514 0)"/>
                                                        </g>
                                                    </g>
                                                </svg>

                                                <p class="clearfix"></p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <!-- Item -->
                                <li class="position-relative">
                                    <!-- URL -->
                                    <a href="#" class="text-dark selectcategory">
                                        <!-- Icon -->
                                        <img src="{{ asset('assets/img/icons/1.png')  }}" class="d-inline ml-auto" alt="#">

                                        <!-- Text -->
                                        {{ 'Ansharj Guyq' }}

                                        <!-- Icon -->
                                        <svg class="float-right" xmlns="http://www.w3.org/2000/svg" width="6.693" height="13.233" viewBox="0 0 6.693 13.233">
                                            <g id="left-arrow" transform="translate(76.741 0.533)">
                                                <g id="Group_9" data-name="Group 9" transform="translate(-76.741 -0.533)">
                                                    <path id="Path_5" data-name="Path 5" d="M126.665,12.351l5.358-5.369a.518.518,0,0,0,0-.731L126.665.882a.517.517,0,1,1,.732-.73l5.357,5.368a1.552,1.552,0,0,1,0,2.193L127.4,13.082a.517.517,0,0,1-.732-.73Z" transform="translate(-126.514 0)"/>
                                                    <path id="Path_14" data-name="Path 14" d="M126.665,12.351l5.358-5.369a.518.518,0,0,0,0-.731L126.665.882a.517.517,0,1,1,.732-.73l5.357,5.368a1.552,1.552,0,0,1,0,2.193L127.4,13.082a.517.517,0,0,1-.732-.73Z" transform="translate(-126.514 0)"/>
                                                </g>
                                            </g>
                                        </svg>

                                        <p class="clearfix"></p>
                                    </a>
                                </li>

                                <!-- Item -->
                                <li class="position-relative">
                                    <!-- URL -->
                                    <a href="#" class="text-dark selectcategory">
                                        <!-- Icon -->
                                        <img src="{{ asset($assets_path.'/img/icons/1.png')  }}" class="d-inline ml-auto" alt="#">

                                        <!-- Text -->
                                        {{ 'Ansharj Guyq' }}

                                        <!-- Icon -->
                                        <svg class="float-right" xmlns="http://www.w3.org/2000/svg" width="6.693" height="13.233" viewBox="0 0 6.693 13.233">
                                            <g id="left-arrow" transform="translate(76.741 0.533)">
                                                <g id="Group_9" data-name="Group 9" transform="translate(-76.741 -0.533)">
                                                    <path id="Path_5" data-name="Path 5" d="M126.665,12.351l5.358-5.369a.518.518,0,0,0,0-.731L126.665.882a.517.517,0,1,1,.732-.73l5.357,5.368a1.552,1.552,0,0,1,0,2.193L127.4,13.082a.517.517,0,0,1-.732-.73Z" transform="translate(-126.514 0)"/>
                                                    <path id="Path_14" data-name="Path 14" d="M126.665,12.351l5.358-5.369a.518.518,0,0,0,0-.731L126.665.882a.517.517,0,1,1,.732-.73l5.357,5.368a1.552,1.552,0,0,1,0,2.193L127.4,13.082a.517.517,0,0,1-.732-.73Z" transform="translate(-126.514 0)"/>
                                                </g>
                                            </g>
                                        </svg>

                                        <p class="clearfix"></p>
                                    </a>
                                </li>

                                <!-- Item -->
                                <li class="position-relative">
                                    <!-- URL -->
                                    <a href="#" class="text-dark selectcategory">
                                        <!-- Icon -->
                                        <img src="{{ asset($assets_path.'/img/icons/1.png')  }}" class="d-inline ml-auto" alt="#">

                                        <!-- Text -->
                                        {{ 'Ansharj Guyq' }}

                                        <!-- Icon -->
                                        <svg class="float-right" xmlns="http://www.w3.org/2000/svg" width="6.693" height="13.233" viewBox="0 0 6.693 13.233">
                                            <g id="left-arrow" transform="translate(76.741 0.533)">
                                                <g id="Group_9" data-name="Group 9" transform="translate(-76.741 -0.533)">
                                                    <path id="Path_5" data-name="Path 5" d="M126.665,12.351l5.358-5.369a.518.518,0,0,0,0-.731L126.665.882a.517.517,0,1,1,.732-.73l5.357,5.368a1.552,1.552,0,0,1,0,2.193L127.4,13.082a.517.517,0,0,1-.732-.73Z" transform="translate(-126.514 0)"/>
                                                    <path id="Path_14" data-name="Path 14" d="M126.665,12.351l5.358-5.369a.518.518,0,0,0,0-.731L126.665.882a.517.517,0,1,1,.732-.73l5.357,5.368a1.552,1.552,0,0,1,0,2.193L127.4,13.082a.517.517,0,0,1-.732-.73Z" transform="translate(-126.514 0)"/>
                                                </g>
                                            </g>
                                        </svg>

                                        <p class="clearfix"></p>
                                    </a>
                                </li>
                            </ul>

                        </li>

                        <!-- Item -->
                        <li class="position-relative">
                            <!-- URL -->
                            <a href="#" class="text-dark selectcategory">
                                <!-- Icon -->
                                <img src="{{ asset($assets_path.'/img/icons/1.png')  }}" class="d-inline ml-auto" alt="#">

                                <!-- Text -->
                                <span class="main-name">{{ 'Ansharj Guyq' }}</span>

                                <!-- Icon -->
                                <svg class="float-right" xmlns="http://www.w3.org/2000/svg" width="6.693" height="13.233" viewBox="0 0 6.693 13.233">
                                    <g id="left-arrow" transform="translate(76.741 0.533)">
                                        <g id="Group_9" data-name="Group 9" transform="translate(-76.741 -0.533)">
                                            <path id="Path_5" data-name="Path 5" d="M126.665,12.351l5.358-5.369a.518.518,0,0,0,0-.731L126.665.882a.517.517,0,1,1,.732-.73l5.357,5.368a1.552,1.552,0,0,1,0,2.193L127.4,13.082a.517.517,0,0,1-.732-.73Z" transform="translate(-126.514 0)"/>
                                            <path id="Path_14" data-name="Path 14" d="M126.665,12.351l5.358-5.369a.518.518,0,0,0,0-.731L126.665.882a.517.517,0,1,1,.732-.73l5.357,5.368a1.552,1.552,0,0,1,0,2.193L127.4,13.082a.517.517,0,0,1-.732-.73Z" transform="translate(-126.514 0)"/>
                                        </g>
                                    </g>
                                </svg>

                                <p class="clearfix"></p>
                            </a>
                        </li>

                        <!-- Item -->
                        <li class="position-relative">
                            <!-- URL -->
                            <a href="#" class="text-dark selectcategory">
                                <!-- Icon -->
                                <img src="{{ asset($assets_path.'/img/icons/1.png')  }}" class="d-inline ml-auto" alt="#">

                                <!-- Text -->
                                <span class="main-name">{{ 'Ansharj Guyq' }}</span>

                                <!-- Icon -->
                                <svg class="float-right" xmlns="http://www.w3.org/2000/svg" width="6.693" height="13.233" viewBox="0 0 6.693 13.233">
                                    <g id="left-arrow" transform="translate(76.741 0.533)">
                                        <g id="Group_9" data-name="Group 9" transform="translate(-76.741 -0.533)">
                                            <path id="Path_5" data-name="Path 5" d="M126.665,12.351l5.358-5.369a.518.518,0,0,0,0-.731L126.665.882a.517.517,0,1,1,.732-.73l5.357,5.368a1.552,1.552,0,0,1,0,2.193L127.4,13.082a.517.517,0,0,1-.732-.73Z" transform="translate(-126.514 0)"/>
                                            <path id="Path_14" data-name="Path 14" d="M126.665,12.351l5.358-5.369a.518.518,0,0,0,0-.731L126.665.882a.517.517,0,1,1,.732-.73l5.357,5.368a1.552,1.552,0,0,1,0,2.193L127.4,13.082a.517.517,0,0,1-.732-.73Z" transform="translate(-126.514 0)"/>
                                        </g>
                                    </g>
                                </svg>

                                <p class="clearfix"></p>
                            </a>
                        </li>

                        <!-- Item -->
                        <li class="position-relative">
                            <!-- URL -->
                            <a href="#" class="text-dark selectcategory">
                                <!-- Icon -->
                                <img src="{{ asset($assets_path.'/img/icons/1.png')  }}" class="d-inline ml-auto" alt="#">

                                <!-- Text -->
                                <span class="main-name">{{ 'Ansharj Guyq' }}</span>

                                <!-- Icon -->
                                <svg class="float-right" xmlns="http://www.w3.org/2000/svg" width="6.693" height="13.233" viewBox="0 0 6.693 13.233">
                                    <g id="left-arrow" transform="translate(76.741 0.533)">
                                        <g id="Group_9" data-name="Group 9" transform="translate(-76.741 -0.533)">
                                            <path id="Path_5" data-name="Path 5" d="M126.665,12.351l5.358-5.369a.518.518,0,0,0,0-.731L126.665.882a.517.517,0,1,1,.732-.73l5.357,5.368a1.552,1.552,0,0,1,0,2.193L127.4,13.082a.517.517,0,0,1-.732-.73Z" transform="translate(-126.514 0)"/>
                                            <path id="Path_14" data-name="Path 14" d="M126.665,12.351l5.358-5.369a.518.518,0,0,0,0-.731L126.665.882a.517.517,0,1,1,.732-.73l5.357,5.368a1.552,1.552,0,0,1,0,2.193L127.4,13.082a.517.517,0,0,1-.732-.73Z" transform="translate(-126.514 0)"/>
                                        </g>
                                    </g>
                                </svg>

                                <p class="clearfix"></p>
                            </a>
                        </li>
                    </ul>

                </li>
                <li><a class="text-dark selectcategory" href="#"><span class="main-name">{{ translating('job') }}</span></a></li>
                <li><a class="text-dark selectcategory" href="#"><span class="main-name">{{ translating('service') }}</span></a></li>
            </ul>
        </nav>
    </div>
</div>
