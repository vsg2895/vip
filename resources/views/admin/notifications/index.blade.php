@extends('admin.layouts.app')

@section('content')
<!-- begin row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="datatable-wrapper table-responsive">
                    <table id="datatable" class="display compact table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Message</th>
                                <th>Wished Post</th>
                                <th>Wished User</th>
                                <th>Wished Search</th>
                                <th>New Review</th>
                                <th>Remembers</th>
                                <th>Updates</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $key => $item)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $item->user->first_name }} {{ $item->user->last_name }}</td>
                                <td>{{ $item->new_messages}}</td>
                                <td>{{ $item->wished_posts}}</td>
                                <!--td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#showMessage{{ $item->id }}">See More</button> </td-->
                                <td>{{ $item->wished_users }}</td>
                                <td>{{ $item->wished_searchs }}</td>
                                <td>{{ $item->new_reviews}}</td>
                                <td>{{ $item->remembers}}</td>
                                <td>{{ $item->website_updates}}</td>
                                <td>
                                    <!-- Delete -->
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#openDeleteModal{{ $item->id }}"><i class="ti ti-close"></i></button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="openDeleteModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="openDeleteModal{{ $item->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="openDeleteModal{{ $item->id }}Label">Are You Sure ?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">No</button>
                                                <a class="btn btn-sm btn-primary" href="{{ route($route.'-admin-destroy', ['locale' => app()->getlocale(),'id' => $item->id]) }}">Yes</a>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Delete -->
                                    <a class="btn btn-sm btn-primary" href="{{ route($route.'-admin-show', ['locale' => app()->getlocale(),'id' => $item->id]) }}"><i class="ti ti-pencil-alt"></i></a>
                                </td>
                            </tr>
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection