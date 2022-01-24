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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Receiver ID</th>
                                <th>Message</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $key => $item)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $item->sender->first_name }} {{ $item->sender->last_name }}</td>
                                <td>{{ $item->sender->email}}</td>
                                <td>{{ $item->receiver->id}}</td>
                                <td> 
                                    @if($item->seen_status == 1)
                                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#showMessage{{ $item->id }}">See More</button> 
                                    @else
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#showMessage{{ $item->id }}">See More</button> 
                                    @endif
                                </td>
                                <td>{{ $item->created_at }}</td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="showMessage{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="showMessageLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="showMessageLabel{{ $item->id }}">Email from <a href="mailto: {{ $item->sender->email }}">{{ $item->sender->email }}</a></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Message Content --> {!! nl2br(e($item->message->message)) !!} <!-- End Message Content -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        @if($item->readed == 1)
                                            <a href="{{ route($route.'-admin-update',['locale' => app()->getLocale(),'id' => $item->id, 'currency' => 'amd']) }}" class="btn  btn-danger">Make Unreaded</a>
                                        @else
                                            <a href="{{ route($route.'-admin-update',['locale' => app()->getLocale(),'id' => $item->id, 'currency' => 'amd']) }}" class="btn  btn-primary">Make Readed</a>
                                        @endif
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection