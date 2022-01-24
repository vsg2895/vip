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
                                <th>Created date</th>
                                <th>Updated date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($items as $key => $item)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ mb_substr(html_entity_decode(strip_tags($item->description_fr)),0 ,50) }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>
                                    {{-- <!-- Delete -->
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
                                                <a class="btn btn-sm btn-primary" href="{{ route($route.'-admin-destroy', ['locale' => app()->getlocale(), 'id' => $item->id]) }}">Yes</a>
                                            </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <!-- End Delete -->
                                    <a class="btn btn-sm btn-primary" href="{{ route($route.'-admin-show', ['locale' => app()->getlocale(), 'id' => $item->id]) }}"><i class="ti ti-pencil-alt"></i></a>
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
            
            <div class="form-group">
                <label>Title</label>
                <input type="text" form="add-new-item" class="form-control mb-2" name="title_fr" max="255" min="2" placeholder="English" required>
                <input type="text" form="add-new-item" class="form-control mb-2" name="title_ru" max="255" min="2" placeholder="Русский" required>
                <input type="text" form="add-new-item" class="form-control mb-2" name="title_fr" max="255" min="2" placeholder="France" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea rows="6" form="add-new-item" class="form-control mb-2" id="description_en" name="description_en" required max="99999" min="2" placeholder="English"></textarea>
                <textarea rows="6" form="add-new-item" class="form-control mb-2" id="description_ru" name="description_ru" required max="99999" min="2" placeholder="Русский"></textarea>
                <textarea rows="6" form="add-new-item" class="form-control mb-2" id="description_fr" name="description_fr" required max="99999" min="2" placeholder="France"></textarea>
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