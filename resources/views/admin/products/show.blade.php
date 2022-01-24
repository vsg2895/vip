@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-statistics">
            <div class="card-body">
                <!-- URL -->
                <div class="form-group">
                    <label>URL*</label>
                    <input type="text" class="form-control mb-2" name="url" max="255" min="1" form="updateForm" value="{{ $item->url }}" placeholder="Ex. new-product-name">
                </div> 

                <!-- Title -->
                <div class="form-group">
                    <label>Title*</label>
                    <input type="text" class="form-control mb-2" name="title_en" max="255" min="1" form="updateForm" value="{{ $item->title_en }}" placeholder="English" required>
                    <input type="text" class="form-control mb-2" name="title_ru" max="255" min="1" form="updateForm" value="{{ $item->title_ru }}" placeholder="Русский" required>
                    <input type="text" class="form-control mb-2" name="title_hy" max="255" min="1" form="updateForm" value="{{ $item->title_hy }}" placeholder="Հայերեն" required>
                </div> 

                <!-- In Stock -->
                <div class="form-group">
                    <label>In Stock*</label>
                    <input type="number" class="form-control mb-2" max="9999999" form="updateForm" value="{{ $item->in_stock['count'] }}" name="in_stock" min="0" placeholder="In Stock" required>
                </div>

                <!-- Unit Type -->
                <div class="form-group">
                    <label>Unit Type*</label>
                    <input type="text" class="form-control mb-2" max="255" form="updateForm" value="{{ $item->unit['unit_en'] }}" name="unit_en" min="1" placeholder="English" required> 
                    <input type="text" class="form-control mb-2" max="255" form="updateForm" value="{{ $item->unit['unit_ru'] }}" name="unit_ru" min="1" placeholder="Русский" required>
                    <input type="text" class="form-control mb-2" max="255" form="updateForm" value="{{ $item->unit['unit_hy'] }}" name="unit_hy" min="1" placeholder="Հայերեն" required>
                </div>

                <!-- Price -->
                <div class="form-group">
                    <label>Price*</label>
                    <input type="number" class="form-control mb-2" max="9999999" form="updateForm" value="{{ $item->prices['main_price'] }}" name="main_price" min="1" placeholder="Main Price" required>
                    <input type="number" class="form-control mb-2" max="9999999" form="updateForm" value="{{ $item->prices['sale_price'] }}" name="sale_price" min="0" placeholder="Sale Price">
                    <input type="text" class="form-control mb-2" max="255" form="updateForm" value="{{ $item->prices['badge_show'] }}" name="badge_text" min="1" placeholder="Badge Text">
                </div> 

                <!-- Category -->
                <div class="form-group">
                    <label>Category*</label>
                    <select class="form-control mb-2" form="updateForm" name="category_id" required>
                        @foreach($menu_items as $menu_item)  
                            <option value="{{ $menu_item->id }}" @if($menu_item->id == $item->category_id) selected @endif>{{ $menu_item->title_hy }}</option>
                        @endforeach
                    </select>
                </div> 

                <!-- Multiple Categories -->
                <div class="form-group">
                    <label>
                        <!-- Add new modal -->
                        <button type="button" class="btn btn-sm btn-primary rounded-circle" data-toggle="modal" data-target="#exampleModalAddNewCategory"><i class="fa fa-plus"></i></button>
                        Muliple Categories
                    </label>
                    <table class="table table-striped table-bordered col-md-6">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Category</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($item->product_categories as $prodt_cat_key => $prod_cat)
                                <tr>
                                    <th scope="row">{{ ++$prodt_cat_key }}</th>
                                    <td>
                                        <select  form="updateCategory{{$prod_cat->id}}" name="category_id" class="form-control">
                                            @foreach($menu_items as $cat)
                                                <option value="{{ $cat->id }}" @if($prod_cat->category_id == $cat->id) selected @endif>{{ $cat->title_en }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <form action="{{ route('products-admin-update-category', ['locale' => app()->getLocale(), 'currency' => 'amd', 'id' => $prod_cat->id]) }}" method="post" id="updateCategory{{$prod_cat->id}}">
                                            @csrf
                                            <button type="submit" form="updateCategory{{$prod_cat->id}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                                        </form>
                                        <a href="{{ route('products-admin-destroy-category', ['locale' => app()->getLocale(), 'currency' => 'amd', 'id' => $prod_cat->id]) }}" class="btn btn-sm btn-danger mt-2"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Image -->
                <div class="form-group">
                    <label class="w-100 d-block">Image*</label>
                    <img src="{{ $image_path }}/product/{{ $item->img }}" class="responsive rounded" alt="Image">
                    <input type="file" class="form-control mb-2" form="updateForm" name="img">
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label>Description*</label>
                    <textarea data-description="true" rows="3" class="form-control mb-2" form="updateForm" name="description_en" min="1" placeholder="English" required>{{ $item->description['description_en'] }}</textarea>
                    <textarea data-description="true" rows="3" class="form-control mb-2" form="updateForm" name="description_ru" min="1" placeholder="Русский" required>{{ $item->description['description_ru'] }}</textarea>
                    <textarea data-description="true" rows="3" class="form-control mb-2" form="updateForm" name="description_hy" min="1" placeholder="Հայերեն" required>{{ $item->description['description_hy'] }}</textarea>
                </div>

                <!-- Options -->
                <div class="form-group">
                    <label>
                        <!-- Add new modal -->
                        <button type="button" class="btn btn-sm btn-primary rounded-circle" data-toggle="modal" data-target="#exampleModalAddNewOption"><i class="fa fa-plus"></i></button>
                        Options 
                    </label>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Option En</th>
                                <th scope="col">Option Ru</th>
                                <th scope="col">Option Hy</th>
                                <th scope="col">Value En</th>
                                <th scope="col">Value Ru</th>
                                <th scope="col">Value Hy</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($item->options as $opt_key => $opt)
                                <tr>
                                    <th scope="row">{{ ++$opt_key }}</th>
                                    <td><input type="text" form="updateOption{{$opt->id}}" name="key_en" class="form-control" value="{{ $opt['key_en'] }}"></td>
                                    <td><input type="text" form="updateOption{{$opt->id}}" name="key_ru" class="form-control" value="{{ $opt['key_ru'] }}"></td>
                                    <td><input type="text" form="updateOption{{$opt->id}}" name="key_hy" class="form-control" value="{{ $opt['key_hy'] }}"></td>
                                    <td><input type="text" form="updateOption{{$opt->id}}" name="value_en" class="form-control" value="{{ $opt['value_en'] }}"></td>
                                    <td><input type="text" form="updateOption{{$opt->id}}" name="value_ru" class="form-control" value="{{ $opt['value_ru'] }}"></td>
                                    <td><input type="text" form="updateOption{{$opt->id}}" name="value_hy" class="form-control" value="{{ $opt['value_hy'] }}"></td>
                                    <td>
                                        <form action="{{ route('products-admin-update-option', ['locale' => app()->getLocale(), 'currency' => 'amd', 'id' => $opt->id]) }}" method="post" id="updateOption{{$opt->id}}">
                                            @csrf
                                            <button type="submit" form="updateOption{{$opt->id}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                                        </form>
                                        <a href="{{ route('products-admin-destroy-option', ['locale' => app()->getLocale(), 'currency' => 'amd', 'id' => $opt->id]) }}" class="btn btn-sm btn-danger mt-2"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Gallery -->
                <div class="form-group">
                    <label class="w-100 d-block">Gallery</label>
                    <div class="row">
                        @if(isset($item->images) && count($item->images) > 0)
                            @foreach($item->images as $image)
                                <div class="col-lg-4 col-md-6 col-12 mb-5">
                                    <img src="{{ $image_path }}/product/{{ $image->img }}" class="d-block w-100 rounded responsive" alt="Image">
                                    <form id="updateGalleryImage{{$image->id}}" action="{{ route('products-admin-update-image', ['locale' => app()->getLocale(), 'currency' => 'amd', 'id' => $image->id]) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input form="updateGalleryImage{{$image->id}}" type="file" class="form-control" name="img" required>
                                    </form>
                                    <div class="row no-gutters mt-2">
                                        <button class="btn btn-sm btn-primary" type="submit" form="updateGalleryImage{{$image->id}}"><i class="fa fa-edit"></i></button>
                                        <a class="btn btn-sm btn-danger ml-2" href="{{ route('products-admin-destroy-image', ['locale' => app()->getLocale(), 'currency' => 'amd', 'id' => $image->id]) }}"><i class="fa fa-trash"></i></a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <label class="w-100 d-block mt-3">Add New Gallery Item</label>
                    <input type="file" class="form-control mb-2" form="updateForm" multiple name="gallery[]">
                </div>

                <!-- Embed -->
                <div class="form-group">
                    <label class="w-100 d-block">Embed</label>
                        @if(isset($item->embeds) && count($item->embeds) > 0)
                            @foreach($item->embeds as $embed)
                                {!! $embed->url !!}
                                <form class="mb-4" id="embedForm{{ $embed->id }}" action="{{ route('products-admin-update-embed', ['locale' => app()->getLocale(), 'currency' => 'amd', 'id' => $embed->id]) }}" method="post">
                                    @csrf
                                    <textarea rows="7" class="form-control mb-2" form="embedForm{{ $embed->id }}" name="url" placeholder="Embed Code">{{ $embed->url }}</textarea>
                                    <div class="row no-gutters mt-2">
                                        <button class="btn btn-sm btn-primary" type="submit" form="embedForm{{ $embed->id }}"><i class="fa fa-edit"></i></button>
                                        <a class="btn btn-sm btn-danger ml-2" href="{{ route('products-admin-destroy-embed', ['locale' => app()->getLocale(), 'currency' => 'amd', 'id' => $embed->id]) }}"><i class="fa fa-trash"></i></a>
                                    </div>
                                </form>
                            @endforeach
                        @endif

                    <label class="w-100 d-block mt-3">Add Embed</label>
                    <textarea rows="7" form="updateForm" class="form-control mb-2" name="embed" placeholder="Embed Code"></textarea>
                </div>
                <!-- End Contnet -->

                <!-- Countdown -->
                <div class="form-group">
                    <label>Countdown</label>
                    @if(isset($item->countdown) && $item->countdown != null)
                        <input type="text" form="updateForm" class="form-control mb-2" name="countdown_value" value="{{ $item->countdown['value'] }}" min="1" placeholder="Ex. 2021/06/30">
                    @else
                        <input type="text" form="updateForm" class="form-control mb-2" name="countdown_value" min="1" placeholder="Ex. 2021/06/30">
                    @endif
                </div>

                <!-- Add To Special Offers List -->
                <div class="form-group">
                    <label>Add To Special Offers List</label>
                    <select form="updateForm" class="form-control mb-2" name="special" required>
                        <option value="0">No</option>
                        <option value="1" @if(isset($item->small_slider) && $item->small_slider != null) selected @endif>Yes</option>
                    </select>
                </div> 

                <!-- Add To New Products List -->
                <div class="form-group">
                    <label>Add To New Products List</label>
                    <select form="updateForm" class="form-control mb-2" name="new" required>
                        <option value="0">No</option>
                        <option value="1" @if(isset($item->new) && $item->new != null) selected @endif>Yes</option>
                    </select>
                </div> 

                <!-- Active -->
                <div class="form-group">
                    <label>Active*</label>
                    <select form="updateForm" class="form-control mb-2" name="active" required>
                        <option value="1" @if($item->active == 1) selected @endif>Yes</option>
                        <option value="0" @if($item->active == 0) selected @endif>No</option>
                    </select>
                </div> 

                <!-- Position ID -->
                <div class="form-group">
                    <label>Position ID*</label>
                    <input type="number" form="updateForm" class="form-control mb-2" name="position_id" required value="{{ $item->position_id }}" min="1" placeholder="Position ID">
                </div> 

                <div class="form-group">
                    <form id="updateForm" class="w-100 d-block" action="{{route($route.'-admin-update',['locale' => app()->getLocale(), 'currency' => 'amd', 'id' => $item->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <button type="submit" form="updateForm" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalAddNewOption" tabindex="-1" role="dialog" aria-labelledby="exampleModalAddNewOptionLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalAddNewOptionLabel">Add new option</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            
            <!-- Option -->
            <div class="form-group">
                <label>Option</label>
                <input type="text" class="form-control mb-2" form="addNewOptionForm" min="1" max="255" name="key_en" placeholder="English"> 
                <input type="text" class="form-control mb-2" form="addNewOptionForm" min="1" max="255" name="key_ru" placeholder="Русский"> 
                <input type="text" class="form-control mb-2" form="addNewOptionForm" required min="1" max="255" name="key_hy" placeholder="Հայերեն"> 
            </div>

            <!-- Value -->
            <div class="form-group">
                <label>Option</label>
                <input type="text" class="form-control mb-2" form="addNewOptionForm" min="1" max="255" name="value_en" placeholder="English"> 
                <input type="text" class="form-control mb-2" form="addNewOptionForm" min="1" max="255" name="value_ru" placeholder="Русский"> 
                <input type="text" class="form-control mb-2" form="addNewOptionForm" required min="1" max="255" name="value_hy" placeholder="Հայերեն"> 
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <form id="addNewOptionForm" action="{{ route('products-admin-store-option', ['locale' => app()->getLocale(), 'currency' => 'amd', 'id' => $item->id]) }}" method="post">
                @csrf
                <button type="submit" form="addNewOptionForm" class="btn btn-primary">Save</button>
            </form>
        </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalAddNewCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalAddNewCategoryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalAddNewCategoryLabel">Add new option</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            
            <!-- Category -->
            <div class="form-group">
                <label>Category</label>
                <select  form="addNewCategoryForm" name="category_id" class="form-control">
                    @foreach($menu_items as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->title_en }}</option>
                    @endforeach
                </select>
            </div>
           
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <form id="addNewCategoryForm" action="{{ route('products-admin-store-category', ['locale' => app()->getLocale(), 'currency' => 'amd', 'id' => $item->id]) }}" method="post">
                @csrf
                <button type="submit" form="addNewCategoryForm" class="btn btn-primary">Save</button>
            </form>
        </div>
        </div>
    </div>
</div>
@endsection