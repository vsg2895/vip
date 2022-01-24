@extends('admin.layouts.app')

@section('content')
<!-- begin row -->
<div class="row">
    <div class="col-md-12">
        <div class="card card-statistics">
            <div class="card-header">
                <div class="card-heading">
                    <h4 class="card-title text-capitalize">{{ $item->name }} #{{ $item->id }}</h4>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route($route.'-admin-update', ['locale' => app()->getLocale(), 'currency' => 'amd', 'id' => $item->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <img src="{{ $image_path }}/users/{{ $item->img }}" class="responsive rounded" alt="{{ $item->first_name }}">

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
                        <label>Confirm</label>
                        <input type="number" class="form-control mb-2" name="confirm" min="0" max="1" placeholder="Confirm" value="{{ $item->confirm }}" required>
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control mb-2" name="phone" min="1" max="255" placeholder="Phone" value="{{ $item->phone }}" required>
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control mb-2" name="role" value="{{ $item->role }}" required>
                            <option value="user" @if($item->role == 'user') selected @endif>User</option>
                            <option value="editor"@if($item->role == 'editor') selected @endif>Editor</option>
                            <option value="admin" @if($item->role == 'admin') selected @endif>Admin</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>

        <div class="card card-statistics">
            <div class="card-header">
                <div class="card-heading">
                    <h4 class="card-title text-capitalize">Password Settings</h4>
                </div>
            </div>
            <div class="card-body">
                @if($item->type != 'user_by_facebook')
                    <form action="{{ route($route.'-admin-update-password', ['locale' => app()->getLocale(), 'currency' => 'amd', 'id' => $item->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control mb-2" name="password" max="255" min="1" placeholder="Password" required>
                        </div>

                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control mb-2" name="password_confirm" max="255" min="1" placeholder="Confirm Password" required>
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                @else
                    <p class="text-danger">You can update only "Site Users" Password. User "{{ $item->name }}" is Facebook User :)</p>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection