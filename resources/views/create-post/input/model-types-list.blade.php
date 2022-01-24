@if(isset($cur_spare_types) && $cur_spare_types != null)

{{--    @dump(\Request::session()->get('add_post_spare_model'))--}}
    @foreach($cur_spare_types as $key => $type)

        <li><span class="ml-3 font-weight-bold">{{ $key }}</span></li>
{{--                    @dump($type )--}}
        @foreach($type as $elem)

            <li>
                <label>
                    <input type="checkbox" name="spare_store_model[]" class="spare_part_model_checks" form="addPostSpareForm"
                           data-brand="{{ $key }}"
                           data-name="{{ $elem["title_".app()->getLocale()] }}"
                           @if(\Request::session()->has('add_post_spare_model') && \Request::session()->get('add_post_spare_model') != NULL)
                           @foreach(\Request::session()->get('add_post_spare_model') as $sel_models)
{{--                               @dd(\Request::session()->get('add_post_spare_model'))--}}
                           @foreach($sel_models as $el)

                           @if($el == $elem['id'] )

                           checked

                           @endif
                           @endforeach

                           @endforeach
                           @endif
                           data-default-title="{{ translating('model-work') }}"
                           data-action="{{ route('get.brand.model',app()->getLocale()) }}"
                           value="{{ $elem['id'] }}"> {{ $elem['title_'.app()->getLocale()] }}
                </label>
            </li>
        @endforeach
        {{--                                <option value="{{ $model->id }}"--}}
        {{--                                        @if(\Request::session()->has('add_post_spare_brand') && \Request::session()->get('add_post_spare_brand') == $model->id) selected @endif>{{ $model['title_'.app()->getLocale()] }}</option>--}}
        <!-- Options -->
    @endforeach


    {{--    @foreach($cur_spare_types as $type)--}}

    {{--        <option value="{{ $type->id }}"--}}
    {{--                @if(\Request::session()->has('add_post_spare_model') && \Request::session()->get('add_post_spare_model') == $type->id) selected @endif>{{ $type['title_'.app()->getLocale()] }}</option>--}}

    {{--    @endforeach--}}
@endif
