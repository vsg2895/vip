@extends('admin.layouts.app')

@section('content')
<!-- begin row -->
<div class="row">
    <div class="col-md-12">
        <div class="card card-statistics">
            <div class="card-header">
                <div class="card-heading">
                    <h4 class="card-title">{{ $item->title_en }}</h4>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route($route.'-admin-update', ['locale' => app()->getLocale(), 'id' => $item->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control mb-2" name="title_en" max="255" min="1" placeholder="English" value="{{ $item->title_en }}" required>
                        <input type="text" class="form-control mb-2" name="title_ru" max="255" min="1" placeholder="Русский" value="{{ $item->title_ru }}" required>
                        <input type="text" class="form-control mb-2" name="title_fr" max="255" min="1" placeholder="France" value="{{ $item->title_fr }}" required>
                    </div>

                    <!-- URL -->
                    <div class="form-group">
                        <label>URL</label>
                        <input type="text" class="form-control mb-2" name="url" max="255" min="1" placeholder="URL" value="{{ $item->url }}" required>
                    </div>
                    
                    <!-- Position ID -->
                    <div class="form-group">
                        <label>Position ID</label>
                        <input type="number" class="form-control mb-2" name="position_id" max="255" min="1" value="{{ $item->position_id }}" placeholder="Position ID" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection