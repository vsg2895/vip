<!-- Content -->
<!-- Address Fields -->
<div class="row w-100 mt-2 p-0 input-filters">
    <div class="form-group col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
        <div class="row no-gutters">
            <div class="col-lg-3">
                <!-- Title -->
                <label class="font-weight-bold input-create-label float-left">{{ translating('address') }}</label>
            </div>

            <div class="col-lg-8 col-md-12 position-relative">
                <!-- Icon -->
                <svg class="position-absolute address-icon" xmlns="http://www.w3.org/2000/svg" width="21.81"
                     height="20.961" viewBox="0 0 21.81 20.961">
                    <g id="map" transform="translate(-0.001)">
                        <g id="Group_1456" data-name="Group 1456">
                            <g id="Group_616" data-name="Group 616" transform="translate(8.356 3.956)">
                                <g id="Group_615" data-name="Group 615">
                                    <path id="Path_300" data-name="Path 300"
                                          d="M189.634,93.3a2.522,2.522,0,0,0-1.444.451.28.28,0,0,0-.071.388.275.275,0,0,0,.385.072,1.974,1.974,0,0,1,1.13-.353,2.006,2.006,0,1,1-1.772,1.084.28.28,0,0,0-.118-.376.276.276,0,0,0-.373.119,2.592,2.592,0,0,0-.287,1.184,2.55,2.55,0,1,0,2.55-2.569Z"
                                          transform="translate(-187.084 -93.297)" fill="#504b4b"/>
                                </g>
                            </g>
                        </g>
                        <g id="Group_618" data-name="Group 618" transform="translate(0.001)">
                            <g id="Group_617" data-name="Group 617">
                                <path id="Path_301" data-name="Path 301"
                                      d="M21.786,20.534,18.642,13.22a.319.319,0,0,0-.294-.19H15.215a15.514,15.514,0,0,0,1.513-2.374,8.868,8.868,0,0,0,1.058-3.993A6.782,6.782,0,0,0,10.906,0a6.781,6.781,0,0,0-6.88,6.662,8.868,8.868,0,0,0,1.058,3.993A15.506,15.506,0,0,0,6.6,13.03H3.463a.319.319,0,0,0-.294.19L1.027,18.2a.3.3,0,0,0,.172.4.327.327,0,0,0,.122.024.319.319,0,0,0,.294-.19l.306-.711H4.089L2.965,20.344H.8l.326-.758a.3.3,0,0,0-.172-.4.322.322,0,0,0-.416.166L.025,20.534a.3.3,0,0,0,.029.29.321.321,0,0,0,.265.137H21.492a.322.322,0,0,0,.265-.137A.3.3,0,0,0,21.786,20.534ZM4.662,6.662A6.154,6.154,0,0,1,10.906.617a6.154,6.154,0,0,1,6.243,6.045c0,1.4-.5,3.631-2.822,6.478l-.007.008q-.178.218-.37.44a24.069,24.069,0,0,1-3.045,2.937A24.033,24.033,0,0,1,7.869,13.6q-.2-.228-.379-.451l-.006-.007C5.164,10.294,4.662,8.06,4.662,6.662Zm-.987,6.984H5.844l-.791,1.84H2.884Zm1.863,6.7,1.991-4.632L13.2,20.344Zm8.645,0h0L7.608,14.969a.326.326,0,0,0-.28-.064.316.316,0,0,0-.219.181l-2.26,5.258H3.655l1.205-2.8a.3.3,0,0,0-.029-.29.321.321,0,0,0-.265-.137H2.186L2.619,16.1H5.265a.319.319,0,0,0,.294-.19l.974-2.267h.553q.144.174.294.348a23.637,23.637,0,0,0,3.33,3.172.327.327,0,0,0,.39,0c.037-.028.543-.41,1.264-1.063h3.607a.309.309,0,1,0,0-.617H13.021c.442-.43.924-.931,1.41-1.493q.15-.174.294-.348h3.411l.791,1.84H17.246a.309.309,0,1,0,0,.617h1.946l.434,1.009H13.062a.318.318,0,0,0-.3.2.3.3,0,0,0,.09.341l3.2,2.69H14.183Zm2.843,0L13.915,17.73h5.975l1.124,2.614Z"
                                      transform="translate(-0.001)" fill="#504b4b"/>
                            </g>
                        </g>
                    </g>
                </svg>

                <!-- Input -->
                <input type="text" form="addPostSpareForm" class="input-default p-2  pr-5 float-left w-100" min="1"
                       name="spare_store_address"

                       placeholder="{{ translating('create-post-address-placeholder') }}"
                       value="@if(\Request::session()->has('add_post_address') && \Request::session()->get('add_post_address') != NULL) {{ \Request::session()->get('add_post_address') }} @endif">

                <!-- Check error -->
            @if(\Request::session()->has('error_address'))
                <!-- Error Response -->
                    <strong class="text-danger"><i
                            class="fa fa-exclamation-triangle"></i> {{ translating('add-post-error-price') }}
                    </strong>

                    <!-- Forget session -->
                @php \Request::session()->forget('error_address'); @endphp
            @endif

            <!-- Check error -->
            @if(\Request::session()->has('error_address'))
                <!-- Error Response -->
                    <div class="alert alert-danger w-100 alert-dismissible fade show" role="alert">
                        <!-- Text -->
                        <span>{{ translating('add-post-error-address') }}</span>

                        <!-- Button -->
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <!-- Close -->
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- Forget session -->
                    @php \Request::session()->forget('error_address'); @endphp
                @endif
            </div>
        </div>
    </div>

    <!-- Phone Fiеlds -->
    <div class="form-group col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
        <div class="row no-gutters">
            <div class="col-lg-3">
                <!-- Title -->
                <label
                    class="font-weight-bold input-create-label float-left">{{ translating('spare-store-phone') }}</label>
            </div>

            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 position-relative">
                <!-- Input -->
                <input type="text" form="addPostSpareForm"
                       class="input-default p-2 add_spare_phone pr-5 float-left w-100" min="1"
                       name="spare_store_phone"
                       value="@if(\Request::session()->has('add_post_spare_phone') && \Request::session()->get('add_post_spare_phone') != NULL) {{ \Request::session()->get('add_post_spare_phone') }} @endif">

                <!-- Check error -->
            @if(\Request::session()->has('error_spare_phone'))
                <!-- Error Response -->
                    <div class="alert alert-danger w-100 alert-dismissible fade show" role="alert">
                        <!-- Text -->
                        <span>{{ translating('error_spare_phone') }}</span>

                        <!-- Button -->
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <!-- Close -->
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- Forget session -->
                    @php \Request::session()->forget('error_spare_phone'); @endphp
                @endif
            </div>
            <span class="col-lg-12 phone_msg text-danger d-flex justify-content-center"></span>
        </div>
    </div>


@if(\Request::session()->has('add_post_spare_store_type') && \Request::session()->get('add_post_spare_store_type') == 0)

    <!-- Brand Fiеlds -->
        {{--@dd(\Request::session()->get('add_post_spare_store_type'))--}}
        {{--                @dd($spare_models[1]->model_types)--}}
        <div class="form-group col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
            <div class="row no-gutters">
                <div class="col-xl-3 col-lg-3 col-12">
                    <!-- Title -->
                    <label
                        class="font-weight-bold input-create-label float-left">{{ translating('spare-maknish') }}</label>
                </div>
                <div class="col-lg-8 col-md-12">
                    <!-- Input -->
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button"
                                id="dropdownmenubrand" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="true">
                            <span>{{ translating('spare-maknish') }}</span>
                            <i class="fas fa-angle-down"></i>
                            {{--                            <span class="caret"></span>--}}
                        </button>
                        <ul class="dropdown-menu checkbox-menu allow-focus" aria-labelledby="dropdownmenubrand">
                            @foreach($spare_models as $model)
                                <li>
                                    {{--                                    @dd(\Request::session()->get('add_post_spare_brand'))--}}
                                    <label>
                                        <input type="checkbox" name="spare_store_brand[]" form="addPostSpareForm"
                                               data-name="{{ $model['title_'.app()->getLocale()] }}"
                                               @if(\Request::session()->has('add_post_spare_brand') && \Request::session()->get('add_post_spare_brand') != NULL)
                                               @foreach(\Request::session()->get('add_post_spare_brand') as $sel_brand)
                                               {{--                                               @dd($sel_brand[0])--}}
                                               {{--                                               @dd(\Request::session()->get('add_post_spare_brand') )--}}
                                               @foreach($sel_brand as $el)
                                               @if($el == $model->id)

                                               checked

                                               @endif
                                               @endforeach

                                               @endforeach
                                               @endif
                                               data-default-title="{{ translating('model-work') }}"
                                               data-action="{{ route('get.brand.model',app()->getLocale()) }}"
                                               value="{{ $model->id }}"> {{ $model['title_'.app()->getLocale()] }}
                                    </label>
                                </li>
                                {{--                                <option value="{{ $model->id }}"--}}
                                {{--                                        @if(\Request::session()->has('add_post_spare_brand') && \Request::session()->get('add_post_spare_brand') == $model->id) selected @endif>{{ $model['title_'.app()->getLocale()] }}</option>--}}
                            <!-- Options -->
                            @endforeach


                        </ul>
                    </div>
                {{--                    <select name="spare_store_brand" form="addPostSpareForm"--}}
                {{--                            data-default-title="{{ translating('model-work') }}"--}}
                {{--                            data-action="{{ route('get.brand.model',app()->getLocale()) }}"--}}
                {{--                            class="input-default w-100 p-2">--}}
                {{--                        <!-- Default value -->--}}

                {{--                        <option value="default">{{ translating('spare-maknish') }}</option>--}}
                {{--                        @foreach($spare_models as $model)--}}

                {{--                            <option value="{{ $model->id }}"--}}
                {{--                                    @if(\Request::session()->has('add_post_spare_brand') && \Request::session()->get('add_post_spare_brand') == $model->id) selected @endif>{{ $model['title_'.app()->getLocale()] }}</option>--}}
                {{--                            <!-- Options -->--}}
                {{--                        @endforeach--}}
                {{--                    </select>--}}
                <!-- Check error -->

                </div>

            </div>
        </div>

        {{--Model Fields--}}

        <div class="form-group col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">

            <div class="row no-gutters">
                <div class="col-xl-3 col-lg-3 col-12">
                    <!-- Title -->
                    <label
                        class="font-weight-bold input-create-label float-left">{{ translating('model-work') }}</label>
                </div>
                <div class="col-lg-8 col-md-12">
                    <!-- Input -->
                    <!-- Default value -->
                    <!-- Input -->
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button"
                                id="dropdownmenumodel" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="true">
                            <span>{{ translating('model-work') }}</span>
                            <i class="fas fa-angle-down"></i>
                            {{--                            <span class="caret"></span>--}}
                        </button>
                        @if(\Request::session()->has('add_post_spare_model') && \Request::session()->get('add_post_spare_model') != NULL)
                            <input type="hidden" id="session_model_has"
                                   value="{{ json_encode(\Request::session()->get('add_post_spare_model'),TRUE) }}">
                        @endif
                        <ul class="dropdown-menu model_append_ul checkbox-menu allow-focus"
                            aria-labelledby="dropdownmenumodel">

                            @include('create-post.input.model-types-list')

                        </ul>
                    </div>

                {{--                    </select>--}}
                <!-- Check error -->
                </div>

            </div>
        </div>
        <!-- Years Fiеlds -->

        <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 years_container"
             data-titleYear="{{ translating('spare-year') }}" data-titleStart="{{ translating('spare-year-start') }}"
             data-titleEnd="{{ translating('spare-year-end') }}">
            {{--           @dd($all_spare_options)--}}
            @if(isset($all_spare_options) && count($all_spare_options) > 0 && !is_null($all_spare_options))
                {{--@dd($all_spare_options)--}}
                @foreach($all_spare_options as $option)
                    {{--                    @dd($option->get_brand)--}}

                    <div class="row no-gutters spare-price-row justify-content-start"
                         data-brandYear="{{ $option->get_brand['title_'.app()->getLocale()] }}">
                        <div class="col-lg-4 col-12">
                            <label class="font-weight-bold input-create-label spare_years_label float-left">
                                {{ translating('spare-year') }}<br>
                                {{ $option->get_brand['title_'.app()->getLocale()] . "-" . $option->get_model['title_'.app()->getLocale()]}}
                            </label>
                        </div>
                        <div class="col-lg-3 col-xl-3 col-md-5 col-5">

                            <select name="spare_store_year_start-{{$option->model_spare}}"
                                    data-value="{{ $option->min_year_spare }}" form="addPostSpareForm"
                                    class="input-default spare_year_start w-100 p-2">
                                <option value="default">{{ translating('spare-year-start') }}</option>

                            </select>

                        </div>
                        <div class="col-lg-3 col-xl-3 col-md-5 col-5">

                            <select name="spare_store_year_end-{{$option->model_spare}}"
                                    data-value="{{ $option->max_year_spare }}" form="addPostSpareForm"
                                    class="input-default spare_year_end w-100 p-2">

                                <option value="default">{{ translating('spare-year-end') }}</option>
                            </select>

                        </div>


                    </div>


                @endforeach

            @endif
        </div>

        {{--        <!-- Price Fiеlds -->--}}
        {{--        <div class="form-group col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">--}}
        {{--            <div class="row no-gutters">--}}
        {{--                <div class="col-lg-3 col-12">--}}
        {{--                    <!-- Title -->--}}
        {{--                    <label class="font-weight-bold input-create-label float-left">{{ translating('price') }}</label>--}}
        {{--                </div>--}}

        {{--                <div class="col-lg-4 col-md-8 col-sm-4 col-5">--}}
        {{--                    <!-- Input -->--}}
        {{--                    <input type="text"--}}
        {{--                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"--}}
        {{--                           form="addPostSpareForm" class="input-default p-2 float-left w-100" required min="1"--}}
        {{--                           name="spare_store_price"--}}
        {{--                           placeholder="{{ translating('create-post-phone-placeholder') }}"--}}
        {{--                           @if(\Request::session()->has('add_post_price') && \Request::session()->get('add_post_price') != NULL)--}}
        {{--                           value="{{ intval(\Request::session()->get('add_post_price')) }}"--}}
        {{--                           @else--}}
        {{--                           value="0"--}}
        {{--                    @endif">--}}

        {{--                    <!-- Check error -->--}}
        {{--                    @if(\Request::session()->has('error_price'))--}}
        {{--                    <!-- Error Response -->--}}
        {{--                        <strong class="text-danger"><i--}}
        {{--                                class="fa fa-exclamation-triangle"></i> {{ translating('add-post-error-price') }}--}}
        {{--                        </strong>--}}

        {{--                        <!-- Forget session -->--}}
        {{--                        @php \Request::session()->forget('error_price'); @endphp--}}
        {{--                    @endif--}}

        {{--                <!-- Check error -->--}}
        {{--                    @if(\Request::session()->has('error_price'))--}}
        {{--                    <!-- Error Response -->--}}
        {{--                        <div class="alert alert-danger w-100 alert-dismissible fade show" role="alert">--}}
        {{--                            <!-- Text -->--}}
        {{--                            <span>{{ translating('add-post-error-price') }}</span>--}}

        {{--                            <!-- Button -->--}}
        {{--                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
        {{--                                <!-- Close -->--}}
        {{--                                <span aria-hidden="true">&times;</span>--}}
        {{--                            </button>--}}
        {{--                        </div>--}}

        {{--                        <!-- Forget session -->--}}
        {{--                        @php \Request::session()->forget('error_price'); @endphp--}}
        {{--                    @endif--}}
        {{--                </div>--}}

        {{--                <div class="col-lg-4 col-md-8 col-sm-4 col-5 offset-md-1 offset-sm-1 offset-2 offset-lg-1">--}}
        {{--                    <!-- Select -->--}}
        {{--                    --}}{{--                @dd($currencies)--}}
        {{--                    <select form="addPostSpareForm" class="input-default p-2 float-right w-100"--}}
        {{--                            name="spare_store_currency_id">--}}
        {{--                        <!-- Check data -->--}}
        {{--                    @if(isset($currencies) && count($currencies) > 0)--}}
        {{--                        <!-- Loop from currencies -->--}}
        {{--                        @foreach($currencies as $currency_value)--}}
        {{--                            <!-- Option -->--}}
        {{--                                <option value="{{ $currency_value->id }}"--}}
        {{--                                        @if(\Request::session()->has('add_post_currency_id') && \Request::session()->get('add_post_currency_id') != NULL) selected--}}
        {{--                                        @elseif($currency->type == $currency_value->type) selected @endif>{{ $currency_value->{'name_'.app()->getLocale()} }}</option>--}}
        {{--                        @endforeach--}}
        {{--                    @else--}}
        {{--                        <!-- Option -->--}}
        {{--                            <option value="0">{{ translating('amd') }}</option>--}}
        {{--                        @endif--}}
        {{--                    </select>--}}

        {{--                    <!-- Check error -->--}}
        {{--                    @if(\Request::session()->has('error_currency_id'))--}}
        {{--                    <!-- Error Response -->--}}
        {{--                        <strong class="text-danger"><i--}}
        {{--                                class="fa fa-exclamation-triangle"></i> {{ translating('add-post-error-currency') }}--}}
        {{--                        </strong>--}}

        {{--                        <!-- Forget session -->--}}
        {{--                        @php \Request::session()->forget('error_currency_id'); @endphp--}}
        {{--                    @endif--}}

        {{--                <!-- Check error -->--}}
        {{--                    @if(\Request::session()->has('error_currency_id'))--}}
        {{--                    <!-- Error Response -->--}}
        {{--                        <div class="alert alert-danger w-100 alert-dismissible fade show" role="alert">--}}
        {{--                            <!-- Text -->--}}
        {{--                            <span>{{ translating('add-post-error-currency') }}</span>--}}

        {{--                            <!-- Button -->--}}
        {{--                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
        {{--                                <!-- Close -->--}}
        {{--                                <span aria-hidden="true">&times;</span>--}}
        {{--                            </button>--}}
        {{--                        </div>--}}

        {{--                        <!-- Forget session -->--}}
        {{--                        @php \Request::session()->forget('error_currency_id'); @endphp--}}
        {{--                    @endif--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}

    @endif
</div>
