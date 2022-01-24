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
                                <th>Type</th>
                                <th>Created date</th>
                                <th>Updated date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($items as $key => $item)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $item->type }}</td>
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addNewItemLabel">Add new item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- Contnet -->
            
            <!-- Name -->
            <div class="form-group">
                <label>Name</label>
                <input type="text" form="add-new-item" class="form-control mb-2" name="name_en" max="255" min="1" placeholder="English">
                <input type="text" form="add-new-item" class="form-control mb-2" name="name_ru" max="255" min="1" placeholder="Русский">
                <input type="text" form="add-new-item" class="form-control mb-2" name="name_hy" max="255" min="1" placeholder="Հայերեն" required>
            </div>   
            
            <!-- Description -->
            <div class="form-group">
                <label>Description</label>
                <textarea rows="3" form="add-new-item" class="form-control mb-2" name="description_en" min="1" placeholder="English"></textarea>
                <textarea rows="3" form="add-new-item" class="form-control mb-2" name="description_ry" min="1" placeholder="Русский"></textarea>
                <textarea rows="3" form="add-new-item" class="form-control mb-2" name="description_hy" min="1" placeholder="Հայերեն" required></textarea>
            </div>

            <!-- Position ID -->
            <div class="form-group">
                <label>Position ID</label>
                <input type="number" form="add-new-item" class="form-control mb-2" name="position_id" required>
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