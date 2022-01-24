@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-statistics">
            <div class="card-body">
                <!-- URL -->
                <div class="form-group">
                    <label>URL*</label>
                    <input type="text" form="add-new-item" class="form-control mb-2" name="url" max="255" min="1" placeholder="Ex. new-product-name">
                </div> 

                <!-- Title -->
                <div class="form-group">
                    <label>Title*</label>
                    <input type="text" form="add-new-item" class="form-control mb-2" name="title_en" max="255" min="1" placeholder="English">
                    <input type="text" form="add-new-item" class="form-control mb-2" name="title_ru" max="255" min="1" placeholder="Русский">
                    <input type="text" form="add-new-item" class="form-control mb-2" name="title_hy" max="255" min="1" placeholder="Հայերեն" required>
                </div> 

                <!-- In Stock -->
                <div class="form-group">
                    <label>In Stock*</label>
                    <input type="number" form="add-new-item" class="form-control mb-2" max="9999999" value="1" name="in_stock" min="1" placeholder="In Stock" required>
                </div>

                <!-- Unit Type -->
                <div class="form-group">
                    <label>Unit Type*</label>
                    <input type="text" form="add-new-item" class="form-control mb-2" max="255" name="unit_en" min="1" placeholder="English">
                    <input type="text" form="add-new-item" class="form-control mb-2" max="255" name="unit_ru" min="1" placeholder="Русский">
                    <input type="text" form="add-new-item" class="form-control mb-2" max="255" name="unit_hy" min="1" placeholder="Հայերեն" required>
                </div>

                <!-- Price -->
                <div class="form-group">
                    <label>Price*</label>
                    <input type="number" form="add-new-item" class="form-control mb-2" max="9999999" name="main_price" min="1" placeholder="Main Price" required>
                    <input type="number" form="add-new-item" class="form-control mb-2" max="9999999" name="sale_price" min="1" placeholder="Sale Price">
                    <input type="text" form="add-new-item" class="form-control mb-2" max="255" name="badge_text" min="1" placeholder="Badge Text">
                </div> 

                <!-- Category -->
                <div class="form-group">
                    <label>Primary Category *</label>
                    <select form="add-new-item" class="form-control mb-2" name="category_id" required>
                        @foreach($menu_items as $menu_item)  
                            <option value="{{ $menu_item->id }}">{{ $menu_item->title_hy }}</option>
                        @endforeach
                    </select>
                </div> 

                <!-- Image -->
                <div class="form-group">
                    <label>Image*</label>
                    <input type="file" form="add-new-item" class="form-control mb-2" name="img" required>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label>Description*</label>
                    <textarea data-description="true" rows="3" form="add-new-item" class="form-control mb-2" name="description_en" min="1" placeholder="English"></textarea>
                    <textarea data-description="true" rows="3" form="add-new-item" class="form-control mb-2" name="description_ru" min="1" placeholder="Русский"></textarea>
                    <textarea data-description="true" rows="3" form="add-new-item" class="form-control mb-2" name="description_hy" min="1" placeholder="Հայերեն" required></textarea>
                </div>

                <!-- Gallery -->
                <div class="form-group">
                    <label>Gallery</label>
                    <input type="file" form="add-new-item" class="form-control mb-2" multiple name="gallery[]">
                </div>

                <!-- Embed -->
                <div class="form-group">
                    <label>Embed</label>
                    <textarea rows="7" form="add-new-item" class="form-control mb-2" name="embed" placeholder="Embed Code"></textarea>
                </div>
                <!-- End Contnet -->

                <!-- Countdown -->
                <div class="form-group">
                    <label>Countdown</label>
                    <input type="text" form="add-new-item" class="form-control mb-2" name="countdown_value" min="1" placeholder="Ex. 2021/06/30">
                </div>

                <!-- Add To Special Offers List -->
                <div class="form-group">
                    <label>Add To Special Offers List</label>
                    <select form="add-new-item" class="form-control mb-2" name="special" required>
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div> 

                <!-- Add To New Products List -->
                <div class="form-group">
                    <label>Add To New Products List</label>
                    <select form="add-new-item" class="form-control mb-2" name="new" required>
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div> 

                <!-- Active -->
                <div class="form-group">
                    <label>Active*</label>
                    <select form="add-new-item" class="form-control mb-2" name="active" required>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div> 

                <!-- Position ID -->
                <div class="form-group">
                    <label>Position ID*</label>
                    <input type="number" form="add-new-item" class="form-control mb-2" name="position_id" required value="1" min="1" placeholder="Position ID">
                </div> 

                <div class="form-group">
                    <form id="add-new-item" class="w-100 d-block" action="{{route($route.'-admin-store',['locale' => app()->getLocale(), 'currency' => 'amd'])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <button type="submit" form="add-new-item" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection