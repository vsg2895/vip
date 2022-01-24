@extends('admin.layouts.app')

@section('content')
<!-- begin row -->
<div class="row">
    <div class="col-md-12">
        <div class="card card-statistics">
            <div class="card-header">
                <div class="card-heading">
                    <h4 class="card-title">Images</h4>
                </div>
            </div>
            <div class="card-body">
                <!-- Gallery -->
                <div class="form-group pt-20">
                    @if(isset($items) && count($items) > 0) 
                        <div class="row">
                            @foreach($items as $image)
                                <div class="col-lg-4 col-md-6 col-12 mb-4">
                                    <img src="{{ asset($image_path.'/albums/'.$image->img) }}" class="w-100 responsive rounded" alt="Image">
                                    <div class="row no-gutters">
                                        <form class="col-12" id="image-change-{{ $image->id }}" enctype="multipart/form-data" action="{{ route('albums-admin-update', ['locale' => app()->getLocale(), 'currency' => 'amd', 'id' => $image->id]) }}" method="post">
                                            @csrf
                                            <input type="file" form="image-change-{{ $image->id }}" required name="img" class="form-control">
                                            <button type="submit" class="btn-primary btn mr-2 float-left d-inline p-1 mt-1"><span><i class="fa fa-edit"></i> {{ translating('update') }}</span></button>
                                            <a href="{{ route('albums-admin-destroy', ['locale' => app()->getLocale(), 'currency' => 'amd' ,'id' => $image->id]) }}" class="btn mt-1 p-1 btn-danger mr-2 float-left"><span><i class="fa fa-trash"></i> {{ translating('delete') }}</span></a>
                                            <p style="clear: both;"></p>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
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
            <!-- Gallery -->
            <div class="form-group">
                <label>Gallery</label>
                <input type="file" form="add-new-item" multiple class="form-control mb-2" name="gallery[]">
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