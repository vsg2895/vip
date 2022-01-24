@extends('admin.layouts.app')

@section('content')
<!-- begin row -->
<div class="row">
    <div class="col-md-12">
        <div class="card card-statistics">
            <div class="card-header">
                <div class="card-heading">
                    <h4 class="card-title">Notification ID: {{ $item->id }}</h4>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route($route.'-admin-update', ['locale' => app()->getLocale(), 'id' => $item->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Name -->
                    <div class="form-group">
                        <label>User ID</label>
                        <input type="text" class="form-control mb-2" max="255" min="1" value="{{ $item->user_id }}" disabled>
                    </div> 

                    <!-- Code -->
                    <div class="form-group">
                        <label>Message</label>
                        <input type="text" class="form-control mb-2" name="new_messages" max="255" min="1" placeholder="New Messages" value="{{ $item->new_messages }}">
                    </div> 

                    <div class="form-group">
                        <label>Wished Post</label>
                        <input type="text" class="form-control mb-2" name="wished_posts" max="255" min="1" placeholder="Wished Post" value="{{ $item->wished_posts }}">
                    </div> 

                    <div class="form-group">
                        <label>Wished User</label>
                        <input type="text" class="form-control mb-2" name="wished_users" max="255" min="1" placeholder="Wished User" value="{{ $item->wished_users }}">
                    </div> 

                    <div class="form-group">
                        <label>Wished Search</label>
                        <input type="text" class="form-control mb-2" name="wished_searchs" max="255" min="1" placeholder="Wished Search" value="{{ $item->wished_searchs }}">
                    </div> 

                    <div class="form-group">
                        <label>New Review</label>
                        <input type="text" class="form-control mb-2" name="new_reviews" max="255" min="1" placeholder="New Review" value="{{ $item->new_reviews }}">
                    </div> 

                    <div class="form-group">
                        <label>Remembers</label>
                        <input type="text" class="form-control mb-2" name="remembers" max="255" min="1" placeholder="Remembers" value="{{ $item->remembers }}">
                    </div> 

                    <div class="form-group">
                        <label>Updates</label>
                        <input type="text" class="form-control mb-2" name="website_updates" max="255" min="1" placeholder="Updates" value="{{ $item->website_updates }}">
                    </div> 

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection