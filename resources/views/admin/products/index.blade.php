@extends('admin.layouts.app')

@section('content')
<!-- begin row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="datatable-wrapper table-responsive">
                    <div class="export-buttons m-b-20">
                        <a href="#" id="exportCSV" class="btn btn-sm btn-primary float-right ml-2"><i class="ti ti-download"></i> Export To CSV</a>
                        <a href="#" id="exportExcel" class="btn btn-sm btn-primary float-right"><i class="ti ti-download"></i> Export To Excel</a>
                        <p class="clear"></p>
                    </div>
                    <table id="datatable" class="display compact table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Created date</th>
                                <th>Updated date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($items as $key => $item)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $item->title_en }}</td>
                                <td>{{ $item->prices['price'] }} {{ translating('amd') }}</td>
                                <td>{{ $item->categories['title_en'] }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>
                                    <!-- Delete -->
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#openDeleteModal{{ $item->id }}"><i class="ti ti-close"></i></button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="openDeleteModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="openDeleteModal{{ $item->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="openDeleteModal{{ $item->id }}Label">Are You Sure ?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">No</button>
                                                <a class="btn btn-sm btn-primary" href="{{ route($route.'-admin-destroy', ['locale' => app()->getlocale(), 'currency' => 'amd', 'id' => $item->id]) }}">Yes</a>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Delete -->
                                    <a class="btn btn-sm btn-primary" href="{{ route($route.'-admin-show', ['locale' => app()->getlocale(), 'currency' => 'amd', 'id' => $item->id]) }}"><i class="ti ti-pencil-alt"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->

<!-- Add new Modal -->
<div class="modal fade" id="addNewItem" tabindex="-1" role="dialog" aria-labelledby="addNewItemLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addNewItemLabel">Add new item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- Contnet -->
            
            <!-- Title -->
            <div class="form-group">
                <label>Title*</label>
                <input type="text" form="add-new-item" class="form-control mb-2" name="title_en" max="255" min="1" placeholder="English">
                <input type="text" form="add-new-item" class="form-control mb-2" name="title_ru" max="255" min="1" placeholder="Русский">
                <input type="text" form="add-new-item" class="form-control mb-2" name="title_hy" max="255" min="1" placeholder="Հայերեն" required>
            </div> 

            <!-- Price -->
            <div class="form-group">
                <label>Price*</label>
                <input type="number" form="add-new-item" class="form-control mb-2" max="9999999" value="1" name="price" min="1" placeholder="Price" required>
            </div> 

            <!-- Category -->
            <div class="form-group">
                <label>Category*</label>
                <select form="add-new-item" class="form-control mb-2" name="category_id" required>
                    @foreach($menu_items as $menu_item)  
                        <option value="{{ $menu_item->id }}">{{ $menu_item->title_hy }}</option>
                    @endforeach
                </select>
            </div> 

            <!-- Description -->
            <div class="form-group">
                <label>Description*</label>
                <textarea data-description="true" rows="3" form="add-new-item" class="form-control mb-2" name="description_en" min="1" placeholder="English"></textarea>
                <textarea data-description="true" rows="3" form="add-new-item" class="form-control mb-2" name="description_ru" min="1" placeholder="Русский"></textarea>
                <textarea data-description="true" rows="3" form="add-new-item" class="form-control mb-2" name="description_hy" min="1" placeholder="Հայերեն" required></textarea>
            </div>

            <!-- Location -->
            <div class="form-group">
                <label>Location*</label>
                <textarea rows="3" form="add-new-item" class="form-control mb-2" name="location_en" min="1" placeholder="English"></textarea>
                <textarea rows="3" form="add-new-item" class="form-control mb-2" name="location_ru" min="1" placeholder="Русский"></textarea>
                <textarea rows="3" form="add-new-item" class="form-control mb-2" name="location_hy" min="1" placeholder="Հայերեն" required></textarea>
            </div>

            <!-- Top -->
            <div class="form-group">
                <label>Top</label>
                <select form="add-new-item" class="form-control mb-2" name="top" required>
                   <option value="0">No</option>
                   <option value="1">Yes</option>
                </select>
            </div> 

            <!-- Image -->
            <div class="form-group">
                <label>Image*</label>
                <input type="file" form="add-new-item" class="form-control mb-2" name="img" required>
            </div>

            <!-- Gallery -->
            <div class="form-group">
                <label>Gallery</label>
                <input type="file" form="add-new-item" class="form-control mb-2" multiple name="gallery[]">
            </div>

            <!-- PDF -->
            <div class="form-group">
                <label>PDF</label>
                <input type="file" form="add-new-item" class="form-control mb-2" name="pdf">
                <input type="number" form="add-new-item" class="form-control mb-2" name="page" placeholder="PDF Page" value="1">
            </div>

            <!-- Embed -->
            <div class="form-group">
                <label>Embed</label>
                <textarea rows="7" form="add-new-item" class="form-control mb-2" name="embed" placeholder="Embed Code"></textarea>
            </div>
            <!-- End Contnet -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <form id="add-new-item" action="{{route($route.'-admin-store',['locale' => app()->getLocale(), 'currency' => 'amd'])}}" method="post" enctype="multipart/form-data">
                @csrf
                <button type="submit" form="add-new-item" class="btn btn-primary">Save</button>
            </form>
        </div>
        </div>
    </div>
</div>
<!-- End Modal -->
@endsection