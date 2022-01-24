@extends('admin.layouts.app')

@section('content')
<!-- begin row -->
<div class="row">
    <div class="col-md-12">
        <div class="card card-statistics">
            <div class="card-header">
                <div class="card-heading">
                    <h4 class="card-title text-lowercase">{{ $item->url }}</h4>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route($route.'-admin-update', ['locale' => app()->getLocale(), 'id' => $item->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- URL -->
                    <div class="form-group">
                        <label>URL</label>
                        <input type="text" class="form-control mb-2" name="url" max="255" min="1" placeholder="English" value="{{ $item->url }}" required>
                    </div> 

                    <!-- Type -->
                    <div class="form-group">
                        <label>Type</label>
                        <select class="form-control mb-2" name="type" max="255" min="1" required>
                            <option value="detail" @if($item->type == 'detail') selected @endif>Detail</option>
                            <option value="list_haedaer" @if($item->type == 'list_haedaer') selected @endif>List Header</option>
                            <option value="list_sidebar" @if($item->type == 'list_sidebar') selected @endif>List Sidebar</option>
                        </select>
                    </div> 

                    <!-- Position ID -->
                    <div class="form-group">
                        <label>Position ID</label>
                        <input type="number" class="form-control mb-2" name="position_id" max="255" min="1" placeholder="Position ID" value="{{ $item->position_id }}" required>
                    </div>

                    <!-- Image -->
                    <div class="form-group">
                        <label class="w-100 d-block">Image</label>
                        <img src="{{ $image_path }}/ads/{{ $item->img }}" style="max-width: 100%;" class="rounded responsive" alt="Image">
                        <input type="file" class="form-control mb-2" name="img">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection