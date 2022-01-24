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
                    
                    <!-- Description -->
                    <div class="form-group">
                        <label>Description</label>
                        <textarea rows="5" class="form-control mb-2" name="description_en" max="255" min="1" placeholder="English" required>{{ $item->description_en }}</textarea>
                        <textarea rows="5" class="form-control mb-2" name="description_ru" max="255" min="1" placeholder="Русский" required>{{ $item->description_ru }}</textarea>
                        <textarea rows="5" class="form-control mb-2" name="description_fr" max="255" min="1" placeholder="France" required>{{ $item->description_fr }}</textarea>
                    </div>

                    <!-- Card Number -->
                    <div class="form-group">
                        <label>Card Number</label>
                        <input type="text" class="form-control mb-2" name="card_number" max="255" min="1" placeholder="Card Number" value="{{ $item->card_number }}" required>
                    </div> 

                    <!-- Recipient -->
                    <div class="form-group">
                        <label>Recipient</label>
                        <input type="text" class="form-control mb-2" name="recipient" max="255" min="1" placeholder="Recipient" value="{{ $item->recipient }}" required>
                    </div> 

                    <!-- Image -->
                    <div class="form-group">
                        <label class="w-100 d-block">Image</label>
                        <img src="{{ $image_path }}/card-data/{{ $item->img }}" style="max-width: 100%;" class="rounded responsive" alt="Image">
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