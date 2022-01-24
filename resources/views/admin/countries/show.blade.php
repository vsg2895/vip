@extends('admin.layouts.app')

@section('content')
<!-- begin row -->
<div class="row">
    <div class="col-md-12">
        <div class="card card-statistics">
            <div class="card-header">
                <div class="card-heading">
                    <h4 class="card-title">{{ $item->name_hy }}</h4>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route($route.'-admin-update', ['locale' => app()->getLocale(), 'id' => $item->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Name -->
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control mb-2" name="name_en" max="255" min="1" placeholder="English" value="{{ $item->name_en }}" required>
                        <input type="text" class="form-control mb-2" name="name_ru" max="255" min="1" placeholder="Русский" value="{{ $item->name_ru }}" required>
                        <input type="text" class="form-control mb-2" name="name_hy" max="255" min="1" placeholder="Armenian" value="{{ $item->name_hy }}" required>
                    </div> 

                    <!-- Code -->
                    <div class="form-group">
                        <label>Code</label>
                        <input type="text" class="form-control mb-2" name="code" max="255" min="1" placeholder="Code" value="{{ $item->code }}" required>
                    </div> 

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection