@extends('admin.layouts.app')

@section('content')
<!-- begin row -->
<div class="row">
    <div class="col-md-12">
        <div class="card card-statistics">
            <div class="card-header">
                <div class="card-heading">
                    <h4 class="card-title">{{ $item->title_hy }}</h4>
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
                        <input type="text" class="form-control mb-2" name="title_hy" max="255" min="1" placeholder="France" value="{{ $item->title_hy }}" required>
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control mb-2" name="description_en" min="1" placeholder="English" required>{{ $item->description_en }}</textarea>
                        <textarea class="form-control mb-2" name="description_ru" min="1" placeholder="Русский" required>{{ $item->description_ru }}</textarea>
                        <textarea class="form-control mb-2" name="description_hy" min="1" placeholder="France" required>{{ $item->description_hy }}</textarea>
                    </div>

                    <!-- URL -->
                    <div class="form-group">
                        <label>URL</label>
                        <input type="text" class="form-control mb-2" name="url" max="255" min="1" placeholder="URL" value="{{ $item->url }}" required>
                    </div>

                    <!-- Position ID -->
                    <div class="form-group">
                        <label>Position ID</label>
                        <input type="number" class="form-control mb-2" name="position_id" max="255" min="1" placeholder="Position ID" value="{{ $item->position_id }}" required>
                    </div>

                    <!-- Image -->
                    <div class="form-group">
                        <label class="w-100 d-block">Image</label>
                        <img src="{{ asset('assets/img/slider'.'/'.$item->img) }}" style="max-width: 100%;" class="rounded responsive" alt="Image">
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
