<!-- Options Table -->
@if(isset($post->option) && count($post->option) > 0)
    <div class="table-responsive detail-large-version">
        <table class="table rounded detail-table table-bordered mt-2">
            <thead class="detail-table-thead">
            <tr>
                <th class="w-100 text-center" scope="col" colspan="4">{{ translating('main-informations') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($post->option as $opt_key => $option)
                @if ($opt_key % 2 == 0)

                    <tr>
                        <td>{{ $option->{'key_'.app()->getLocale()} }}</td>
                        <!-- Check input type -->
                    @if($option->value == 1) <!-- Checkbox -->
                        <td class="font-weight-bold"><i class="text-success fa fa-check"></i></td>
                    @elseif(strlen($option->value) == 7 && explode('#', $option->value)[0] == '') <!-- Color -->
                        <td>
                            <span class="pl-3 pr-3 pt-2 pb-2 rounded"
                                  style="background-color: {{ $option->value }}"></span>
                        </td>
                    @else <!-- Other Inputs -->
                        <td class="font-weight-bold">{{ $option->value }} @if(isset($option->option['unit']) && $option->option['unit'] != NULL) {{ $option->option['unit']['title_'.app()->getLocale()] }} @endif</td>
                        @endif
                        @else
                            <td>{{ $option->{'key_'.app()->getLocale()} }}</td>
                            <!-- Check input type -->
                            @if($option->value == 1) <!-- Checkbox -->
                            <td class="font-weight-bold"><i class="text-success fa fa-check"></i></td>
                            @elseif(strlen($option->value) == 7 && explode('#', $option->value)[0] == '') <!-- Color -->
                            <td>
                                <span class="pl-3 pr-3 pt-2 pb-2 rounded"
                                      style="background-color: {{ $option->value }}"></span>
                            </td>
                            @else <!-- Other Inputs -->
                            <td class="font-weight-bold">{{ $option->value }} @if(isset($option->option['unit']) && $option->option['unit'] != NULL) {{ $option->option['unit']['title_'.app()->getLocale()] }} @endif</td>
                            @endif
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
            {{--            @dd($post->option)--}}
            @foreach($post->option as $opt_key => $option)
                {{--                    @if ($opt_key % 2 == 0)--}}

                <tr>
                    <td>{{ $option->{'key_'.app()->getLocale()} }}</td>
                    <!-- Check input type -->
                @if($option->value == 1) <!-- Checkbox -->
                    <td class="font-weight-bold"><i class="text-success fa fa-check"></i></td>
                @elseif(strlen($option->value) == 7 && explode('#', $option->value)[0] == '') <!-- Color -->
                    <td>
                        <span class="pl-3 pr-3 pt-2 pb-2 rounded" style="background-color: {{ $option->value }}"></span>
                    </td>
                @else <!-- Other Inputs -->
                    <td class="font-weight-bold">{{ $option->value }} @if(isset($option->option['unit']) && $option->option['unit'] != NULL) {{ $option->option['unit']['title_'.app()->getLocale()] }} @endif</td>
                    @endif
                    {{--                    @else--}}
                    {{--                        <td>{{ $option->{'key_'.app()->getLocale()} }}</td>--}}
                    {{--                        <!-- Check input type -->--}}
                    {{--                        @if($option->value == 1) <!-- Checkbox -->--}}
                    {{--                            <td class="font-weight-bold"><i class="text-success fa fa-check"></i></td>--}}
                    {{--                        @elseif(strlen($option->value) == 7 && explode('#', $option->value)[0] == '') <!-- Color -->--}}
                    {{--                            <td>--}}
                    {{--                                <span class="pl-3 pr-3 pt-2 pb-2 rounded" style="background-color: {{ $option->value }}"></span>--}}
                    {{--                            </td>--}}
                    {{--                        @else <!-- Other Inputs -->--}}
                    {{--                            <td class="font-weight-bold">{{ $option->value }} @if(isset($option->option['unit']) && $option->option['unit'] != NULL) {{ $option->option['unit']['title_'.app()->getLocale()] }} @endif</td>--}}
                    {{--                        @endif--}}
                </tr>
                {{--                    @endif--}}
            @endforeach
            </tbody>
        </table>
    </div>
@endif
