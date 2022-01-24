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
                                <th>Code</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Hurry</th>
                                <th>Top</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $key => $item)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $item->user->email }}</td>
                                <td>{{ $item->code }}</td>
                                @if (strlen($item->title) > 50)
                                    <td>{{ substr($item->title, 0, 49) }}...</td>
                                @else
                                    <td>{{ $item->title }}</td>
                                @endif
                                
                                <td>{{ $item->category_id }}</td>
                                <td>{{ $item->price }} {{ $item->currency->name_en }}</td>
                                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#showHurry{{ $item->id }}">More</button> </td>
                                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#showTop{{ $item->id }}">More</button> </td>
                                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#showActive{{ $item->id }}">More</button> </td>
                                <!--td>{{ $item->hurry }}</td>
                                <td>{{ $item->top }}</td>
                                <td>{{ $item->active }}</td-->
                                
                                <!--td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#showMessage{{ $item->id }}">See More</button> </td-->
                                
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
                                </td>
                            
                            </tr>
                            <div class="modal fade" id="showHurry{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="showMessageLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="showMessageLabel{{ $item->id }}">Hurry Status of Post # {{ $item->id }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Message Content --> Status: {!! nl2br(e($item->hurry)) !!} <!-- End Message Content -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        @if($item->hurry == 1)
                                            <a href="{{ route($route.'-hurry-admin-update',['locale' => app()->getlocale(),'id' => $item->id]) }}" class="btn  btn-danger">Remove Hurry</a>
                                        @else
                                            <a href="{{ route($route.'-hurry-admin-update',['locale' => app()->getlocale(),'id' => $item->id]) }}" class="btn  btn-primary">Make Hurry</a>
                                        @endif
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="showTop{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="showMessageLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="showMessageLabel{{ $item->id }}">Top Status of Post # {{ $item->id }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Message Content --> Status: {!! nl2br(e($item->top)) !!} <!-- End Message Content -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        @if($item->top == 1)
                                            <a href="{{ route($route.'-top-admin-update',['locale' => app()->getlocale(),'id' => $item->id]) }}" class="btn  btn-danger">Remove Top</a>
                                        @else
                                            <a href="{{ route($route.'-top-admin-update',['locale' => app()->getlocale(),'id' => $item->id]) }}" class="btn  btn-primary">Make Top</a>
                                        @endif
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="showActive{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="showMessageLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="showMessageLabel{{ $item->id }}">Active Status of Post # {{ $item->id }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Message Content --> Status: {!! nl2br(e($item->active)) !!} <!-- End Message Content -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        @if($item->active == 1)
                                            <a href="{{ route($route.'-active-admin-update',['locale' => app()->getLocale(),'id' => $item->id]) }}" class="btn  btn-danger">Make Passive</a>
                                        @elseif($item->active == 0)
                                            <a href="{{ route($route.'-active-admin-update',['locale' => app()->getLocale(),'id' => $item->id]) }}" class="btn  btn-primary">Make Active</a>
                                        @endif
                                    </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection