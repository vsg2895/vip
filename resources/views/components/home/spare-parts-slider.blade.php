@if(isset($spares) && count($spares) > 0)
<!-- Contenet -->
<div class="app-container my-2" id="topCatSection" style="overflow: hidden;">
    <div class="row">
        <!-- Title -->
        <h2 class="font-weight-bold mb-5 text-dark text-center h2 w-100">{{ translating('home-section-spare-parts') }}</h2>

        <div class="custom-slider">
            @foreach($spares as $spare)
{{--                @dd($spare->img)--}}
                <!-- Slider Items -->
                <div class="custom-box">
                    <div class="item">
                        <div class="row">
                            <!-- Info -->
                            <div class="col-8">
                                <a class="spare-part-click" data-id="{{$spare->id}}" class="text-dark">
                                    <!-- Title -->
                                    <h5 class="title">{{ mb_substr($spare->{'title_'.app()->getLocale()} ,0 ,20) }}</h5>

                                    <!-- Short Description -->
                                    {{-- <p class="text-muted h6">{{ getPostCountWithCategory($top_category->id).' '.translating('post') }}</p> --}}
                                </a>
                            </div>

                            <!-- Image -->
                            <div class="col-4">
                                <a class="spare-part-click" data-id="{{$spare->id}}" href="#">
                                    <img src="{{ asset($assets_path.'/img/spare-parts/'.$spare->img) }}" class="w-100 responsive" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="container spare-container-initial" id="spare-parts-container" style="">
    <div style="overflow-y:auto;overflow-x:hidden;">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="datatable-wrapper table-responsive">
                            <table id="datatable" class="display compact table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Նկար</th>
                                        <th>Անուն</th>
                                        <th>Վայր</th>
                                        <th>Հեռախոս</th>
                                    </tr>
                                </thead>
                                <tbody id="spare_parts_body">
{{--                                     @foreach($so as $key => $item)--}}
{{--                                        <tr>--}}
{{--                                            <td>--}}
{{--                                                <img src="{{ asset($assets_path.'/img/spare-parts'.'/'.$item->img) }}" style="width:120px;height:auto;" class="d-block mx-auto rounded" alt="">--}}
{{--                                            </td>--}}
{{--                                            <td>{{ $item->first_name }} {{ $item->last_name }}</td>--}}
{{--                                            <td>{{ $item->location->{'title_'.app()->getLocale()} }}</td>--}}
{{--                                            <td><a href="tel:{{$item->phone}}">{{ $item->phone }}</a></td>--}}

{{--                                        </tr>--}}

{{--                                    @endforeach--}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br /><br />

@endif
