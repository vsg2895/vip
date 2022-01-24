@extends('admin.layouts.app')

@section('content')
<!-- begin row -->
<div class="row">
    <div class="col-md-12">
        <div class="card card-statistics">
            <div class="card-header">
                <div class="card-heading">
                    <h4 class="card-title">{{ $item->selector }}</h4>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route($route.'-admin-update', ['locale' => app()->getLocale(), 'currency' => 'amd','id' => $item->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Selector</label>
                        <input type="text" class="form-control mb-2" name="selector" max="255" min="1" placeholder="Selector" value="{{ $item->selector }}" required>
                    </div>
                    <div class="form-group">
                        <label>Translation</label>
                        <textarea rows="5" class="form-control mb-2" name="translations" max="99999" min="1" placeholder="Translation" required>{{ $item->translations }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Localization</label>
                        <select class="form-control mb-2" name="locale" required>
                            <option value="en" @if( $item->locale == 'en' ) selected @endif>English</option>
                            <option value="ru" @if( $item->locale == 'ru' ) selected @endif>Русский</option>
                            <option value="hy" @if( $item->locale == 'hy' ) selected @endif>Armenian</option>
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