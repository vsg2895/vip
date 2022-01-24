@extends('admin.layouts.app')

@section('content')
<!-- begin row -->
<div class="row">
    <div class="col-md-12">
        <div class="card card-statistics">
            <div class="card-header">
                <div class="card-heading">
                    <h4 class="card-title">{{ $item->value_fr }}</h4>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route($route.'-admin-update', ['locale' => app()->getLocale(), 'currency' => 'amd', 'id' => $item->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Value</label>
                        <input type="text" class="form-control mb-2" id="value_en" name="value_en" required max="255" min="2" value="{{ $item->value_en }}" placeholder="English">
                        <input type="text" class="form-control mb-2" id="value_ru" name="value_ru" required max="255" min="2" value="{{ $item->value_ru }}" placeholder="Русский">
                        <input type="text" class="form-control mb-2" id="value_fr" name="value_fr" required max="255" min="2" value="{{ $item->value_fr }}" placeholder="Հայերեն">
                    </div>

                     <!-- Type -->
                    <div class="form-group">
                        <label>Type</label>
                        <select class="form-control mb-2" name="type" required>
                            <option value="email" @if($item->type == 'email') selected @endif>Email Address</option>
                            <option value="phone" @if($item->type == 'phone') selected @endif>Phone Number</option>
                            <option value="address" @if($item->type == 'address') selected @endif>Address</option>
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