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
                    <img src="{{ $image_path }}/spare-parts/{{ $item->img }}" class="responsive rounded" alt="{{ $item->first_name }}">

                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control mb-2" name="first_name" max="255" min="2" placeholder="First Name" value="{{ $item->first_name }}" required>
                    </div>

                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control mb-2" name="last_name" max="255" min="2" placeholder="Last Name" value="{{ $item->last_name }}" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control mb-2" name="email" max="255" min="2" placeholder="Email" value="{{ $item->email }}" required>
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control mb-2" name="phone" min="1" max="255" placeholder="Phone" value="{{ $item->phone }}" required>
                    </div>

                    <div class="form-group">
                        <label>Location</label>
                        <select class="form-control mb-2" name="location_id" value="{{ $item->location_id }}" required>
                            @foreach($locations as $loc)
                                <option value="{{$loc->id}}" @if($item->location_id == $loc->id) selected @endif>{{$loc->title_en}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Model</label>
                        <select class="form-control mb-2" name="model_id" value="{{ $item->model_id }}" required>
                            @foreach($models as $mod)
                                <option value="{{$mod->id}}" @if($item->model_id == $mod->id) selected @endif>{{$mod->title_en}}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection