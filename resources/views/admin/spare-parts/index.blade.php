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
                                <th>Avatar</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Location</th>
                                <th>Model</th>
                                <th>Updated date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($items as $key => $item)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>
                                    <img src="{{ asset('assets/img/spare-parts'.'/'.$item->img) }}" class="w-75 d-block mx-auto rounded" alt="{{ $item->first_name.' '.$item->last_name }}">
                                </td>
                                <td>{{ $item->first_name }}</td>
                                <td>{{ $item->last_name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->location['title_hy'] }}</td>
                                <td>{{ $item->model['title_hy'] }}</td>
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
                                                <a class="btn btn-sm btn-primary" href="{{ route($route.'-admin-destroy', ['locale' => app()->getlocale(),'id' => $item->id]) }}">Yes</a>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Delete -->
                                    <a class="btn btn-sm btn-primary" href="{{ route($route.'-admin-show', ['locale' => app()->getlocale(),'id' => $item->id]) }}"><i class="ti ti-pencil-alt"></i></a>
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
                <label>First Name</label>
                <input type="text" form="add-new-item" class="form-control mb-2" name="first_name" max="255" min="1" placeholder="First Name">
            </div>

            <div class="form-group">
                <label>Last Name</label>
                <input type="text" form="add-new-item" class="form-control mb-2" name="last_name" max="255" min="1" placeholder="Last Name">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="text" form="add-new-item" class="form-control mb-2" name="email" max="255" min="1" placeholder="Email">
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input type="text" form="add-new-item" class="form-control mb-2" name="phone" max="255" min="1" placeholder="Phone">
            </div>

            <!-- Model -->
            <div class="form-group">
                <label>Model</label>
                <select form="add-new-item" class="form-control mb-2" name="model_id" max="255" min="1" required>
                    @foreach($models as $mod)
                        <option value="{{$mod->id}}">{{$mod->title_en}}</option>
                    @endforeach
                </select>
            </div>

            <!-- Location -->
            <div class="form-group">
                <label>Location</label>
                <select form="add-new-item" class="form-control mb-2" name="location_id" max="255" min="1" required>
                    @foreach($locations as $loc)
                        <option value="{{$loc->id}}">{{$loc->title_en}}</option>
                    @endforeach
                </select>
            </div>

            <!-- Image -->
            <div class="form-group">
                <label>Image</label>
                <input type="file" form="add-new-item" class="form-control mb-2" name="img" required>
            </div>

            <!-- End Contnet -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <!--,['locale' => app()->getLocale(), 'currency' => 'amd']-->
            <form id="add-new-item" action="{{route($route.'-admin-store', ['locale' => app()->getLocale()]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <button type="submit" form="add-new-item" class="btn btn-primary">Save</button>
            </form>
        </div>
        </div>
    </div>
</div>
<!-- End Modal -->
@endsection
