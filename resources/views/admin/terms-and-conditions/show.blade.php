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
                <form action="{{ route($route.'-admin-update', ['locale' => app()->getLocale(), 'currency' => 'amd','id' => $item->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Title -->
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control mb-2" name="title_en" placeholder="English" value="{{ $item->title_en }}" required>
                        <input type="text" class="form-control mb-2" name="title_ru" placeholder="Russian" value="{{ $item->title_ru }}" required>
                        <input type="text" class="form-control mb-2" name="title_hy" placeholder="Armenian" value="{{ $item->title_hy }}" required>
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label>Description</label>
                        <textarea rows="5" data-description="true" class="form-control mb-2" placeholder="English" name="description_en" required>{{ $item->description_en }}</textarea>
                        <textarea rows="5" data-description="true" class="form-control mb-2" placeholder="Russian" name="description_ru" required>{{ $item->description_ru }}</textarea>
                        <textarea rows="5" data-description="true" class="form-control mb-2" placeholder="Armenian" name="description_hy" required>{{ $item->description_hy }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection