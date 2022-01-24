@extends('admin.layouts.app')

@section('content')
<!-- begin row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="datatable-wrapper table-responsive">
                    <div class="export-buttons m-b-20">
                        <a href="#" id="exportCSV" class="btn btn-sm btn-primary float-right ml-2"><i class="ti ti-download"></i> Export To CSV</a>
                        <a href="#" id="exportExcel" class="btn btn-sm btn-primary float-right"><i class="ti ti-download"></i> Export To Excel</a>
                        <p class="clear"></p>
                    </div>
                    <table id="datatable" class="display compact table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Icon</th>
                                <th>URL</th>
                                <th>Created date</th>
                                <th>Updated date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($items as $key => $item)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $item->icon }}</td>
                                <td>{{ $item->url }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
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
                                                <a class="btn btn-sm btn-primary" href="{{ route($route.'-admin-destroy', ['locale' => app()->getlocale(), 'id' => $item->id]) }}">Yes</a>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Delete -->
                                    <a class="btn btn-sm btn-primary" href="{{ route($route.'-admin-show', ['locale' => app()->getlocale(), 'id' => $item->id]) }}"><i class="ti ti-pencil-alt"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->

<!-- Add new Modal -->
<div class="modal fade" id="addNewItem" tabindex="-1" role="dialog" aria-labelledby="addNewItemLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addNewItemLabel">Add new item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- Contnet -->
            
            <div class="form-group">
                <label>URL</label>
                <input type="text" form="add-new-item" class="form-control mb-2" name="url" max="255" min="2" placeholder="URL" required>
            </div>
            <div class="form-group">
                <label>Position ID</label>
                <input type="number" form="add-new-item" class="form-control mb-2" name="position_id" max="255" min="1" placeholder="Position ID" required>
            </div>
            <div class="form-group">
                <label>Icon</label>
                <select form="add-new-item" class="form-control mb-2" name="icon" required>
                    <option value="facebook-f">Facebook Circle</option>
                    <option value="facebook-square">Facebook Square</option>
                    <option value="facebook">Facebook</option>
                    <option value="facebook-messenger">Messenger</option>
                    <option value="youtube">Youtube</option>
                    <option value="youtube-square">Youtube Square</option>
                    <option value="instagram">Instagram</option>
                    <option value="instagram-square">Instagram Square</option>
                    <option value="twitter">Twitter</option>
                    <option value="twitter-square">Twitter Square</option>
                    <option value="telegram">Telegram</option>
                    <option value="telegram-plane">Telegram Plane</option>
                    <option value="viber">Viber</option>
                    <option value="whatsapp">Whatsapp</option>
                    <option value="whatsapp-square">Whatsapp Square</option>
                    <option value="pinterest">Pinterest</option>
                    <option value="google">Google</option>
                    <option value="google-drive">Google Drive</option>
                    <option value="google-play">Google Play</option>
                    <option value="google-plus">Google Plus</option>
                    <option value="linkedin-in">Linkedin</option>
                    <option value="odnoklassniki">Odnoklassniki</option>
                    <option value="odnoklassniki-square">Odnoklassniki Square</option>
                    <option value="reddite">Reddit</option>
                    <option value="reddite-alien">Reddit Alien</option>
                    <option value="reddit-square">Reddit Square</option>
                    <option value="slack">Slack</option>
                    <option value="snapchat">Snapchat</option>
                    <option value="snapchat-ghost">Snapchat Ghost</option>
                    <option value="snapchat-square">Snapchat Square</option>
                    <option value="snapchat-square">Snapchat Square</option>
                    <option value="tiktok">Tiktok</option>
                    <option value="tripadvisor">Tripadvisor</option>
                    <option value="tumblr">Tumblr</option>
                    <option value="tumblr-square">Tumblr Square</option>
                    <option value="vimeo">Vimeo</option>
                    <option value="vimeo-square">Vimeo Square</option>
                    <option value="vimeo-v">Vimeo V</option>
                    <option value="yandex">Yandex</option>
                    <option value="yahoo">Yahoo</option>
                    <option value="behance">behance</option>
                    <option value="behance-square">Behance Square</option>
                </select>
            </div>
           
        
            <!-- End Contnet -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <form id="add-new-item" action="{{route($route.'-admin-store',['locale' => app()->getLocale()])}}" method="post" enctype="multipart/form-data">
                @csrf
                <button type="submit" form="add-new-item" class="btn btn-primary">Save</button>
            </form>
        </div>
        </div>
    </div>
</div>
<!-- End Modal -->
@endsection