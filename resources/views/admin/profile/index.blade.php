@extends('admin.layouts.app')

@section('content')
<div class="row account-contant">
    <div class="col-12">
        <div class="card card-statistics">
            <div class="card-body p-0">
                <div class="row no-gutters">
                    <div class="col-xl-3 pb-xl-0 pb-5 border-right">
                        <div class="page-account-profil pt-5">
                            <div class="profile-img text-center rounded-circle">
                                <div class="pt-5">
                                    <div class="bg-img m-auto">
                                        <img src="/admin-assets/img/admin/default.png" class="img-fluid" alt="{{ Auth::user()->name }}">
                                    </div>
                                    <div class="profile pt-4">
                                        <h4 class="mb-1">{{ Auth::user()->name.' '.Auth::user()->surname }}</h4>
                                        <p>Administrator</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 col-12 border-t border-right">
                        <div class="page-account-form">
                            <div class="form-titel border-bottom p-3">
                                <h5 class="mb-0 py-2">Edit Your Personal Settings</h5>
                            </div>
                            <div class="p-4">
                                <form id="update-profile-form" action="{{ route('profile-admin-update', ['locale' => app()->getLocale(), 'currency' => 'amd']) }}" method="post">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="name1">First Name</label>
                                            <input type="text" class="form-control" required min="1" max="255" form="update-profile-form" name="first_name" id="name1" value="{{ Auth::user()->first_name }}">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="name2">Last Name</label>
                                            <input type="text" class="form-control" required min="1" max="255" form="update-profile-form" name="last_name" id="name2" value="{{ Auth::user()->last_name }}">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="email1">Email</label>
                                            <input type="email" class="form-control" required min="1" max="255" form="update-profile-form" name="email" id="email1" value="{{ Auth::user()->email }}">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary" form="update-profile-form">Update Information</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection