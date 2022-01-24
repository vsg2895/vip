<!-- Options Table -->
{{--@dd(isset($post->options));--}}
@if(isset($post->options) && count($post->options) > 0)
    {{--@if((isset($post->brand_spare) && $post->brand_spare != null) || (isset($post->model_spare) && $post->model_spare != null))--}}
    <div class="table-responsive detail-large-version">
        <table class="table rounded detail-table table-bordered mt-2">
            <thead class="detail-table-thead">
            <tr>
                <th class="w-100 text-center" scope="col" colspan="4">{{ translating('main-informations') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($post->options as $option)
                {{--                @dump($option->brand_spare);--}}
                @if(!is_null($option->brand_spare))
                    <tr>
                        <td>{{ translating('spare-maknish') }}</td>
                        <td class="font-weight-bold success-td"><i
                                class="text-success fa fa-check"></i>{{ $option->get_brand['title_'.app()->getLocale()] }}
                        </td>
                    </tr>
                @endif
                @if(!is_null($option->model_spare))
                    <tr>
                        <td>{{ translating('model-work') }}</td>
                        <td class="font-weight-bold success-td"><i
                                class="mr-10 text-success fa fa-check"></i>{{ $option->get_model['title_'.app()->getLocale()] }}
                        </td>
                    </tr>
                @endif
                @if(!is_null($option->min_year_spare) || !is_null($option->max_year_spare))
                    <tr>
                        <td>{{ translating('spare-year') }}</td>
                        @if($option->max_year_spare == null && $option->min_year_spare != null)
                            {{ $option->min_year_spare }}
                        @endif
                        @if($option->min_year_spare == null && $option->max_year_spare != null)
                            {{ $option->max_year_spare }}
                        @endif
                        <td class="font-weight-bold success-td"><i
                                class="mr-10 text-success fa fa-check"></i>
                            {{ $option->min_year_spare }} - {{ $option->max_year_spare }}
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>



    <div class="table-responsive detail-mob-version">
        <table class="table rounded detail-table table-bordered mt-2">
            <thead class="detail-table-thead">
            <tr>
                <th class="w-100 text-center" scope="col" colspan="4">{{ translating('main-informations') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($post->options as $option)
                @if(!is_null($option->brand_spare))
                    <tr>
                        <td>{{ translating('spare-maknish') }}</td>
                        <td class="font-weight-bold success-td"><i
                                class="text-success fa fa-check"></i>{{ $option->get_brand['title_'.app()->getLocale()] }}
                        </td>
                    </tr>
                @endif
                @if(!is_null($option->model_spare))
                    <tr>
                        <td>{{ translating('model-work') }}</td>
                        <td class="font-weight-bold success-td"><i
                                class="mr-10 text-success fa fa-check"></i>{{ $option->get_model['title_'.app()->getLocale()] }}
                        </td>
                    </tr>
                @endif
                @if(!is_null($option->min_year_spare) || !is_null($option->max_year_spare))
                    <tr>
                        <td>{{ translating('spare-year') }}</td>
                        @if($option->max_year_spare == null && $option->min_year_spare != null)
                            {{ $option->min_year_spare }}
                        @endif
                        @if($option->min_year_spare == null && $option->max_year_spare != null)
                            {{ $option->max_year_spare }}
                        @endif
                        <td class="font-weight-bold success-td"><i
                                class="mr-10 text-success fa fa-check"></i>
                            {{ $option->min_year_spare }} - {{ $option->max_year_spare }}
                        </td>
                    </tr>
                @endif
            @endforeach
            {{--            @dd($post->original)--}}
            {{--            @if(!is_null($post->original))--}}
            {{--                <tr>--}}
            {{--                    --}}{{--                    @dd($post->original)--}}
            {{--                    <td>{{ translating('post_spare_quality') }}</td>--}}
            {{--                    <td class="font-weight-bold success-td"><i--}}
            {{--                            class="mr-10 text-success fa fa-check"></i>--}}
            {{--                        @if($post->original == 0)--}}
            {{--                            {{translating('spare-original')}}--}}
            {{--                        @else--}}
            {{--                            {{translating('spare-successor')}}--}}
            {{--                        @endif--}}
            {{--                    </td>--}}
            {{--                </tr>--}}
            {{--            @endif--}}
            {{--            @if(!is_null($post->new))--}}
            {{--                <tr>--}}
            {{--                    <td>{{ translating('post_spare_quality') }}</td>--}}
            {{--                    <td class="font-weight-bold success-td"><i--}}
            {{--                            class="mr-10 text-success fa fa-check"></i>--}}
            {{--                        @if($post->new == 0)--}}
            {{--                            {{ translating('filter-elec-new') }}--}}
            {{--                        @else--}}
            {{--                            {{translating('filter-elec-old')}}--}}
            {{--                        @endif--}}
            {{--                    </td>--}}
            {{--                </tr>--}}
            {{--            @endif--}}
            </tbody>
        </table>
    </div>
    {{--@endif--}}
@endif
