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
                    <div class="row my-3">
                        <iframe id="rate-widget" scrolling="no" frameborder="no" src="http://rate.am/informer/rate/iframe/Default.aspx?uid=UI-50107398&width=215&height=132&cb=0&bgcolor=FFFFFF&lang=am" width="215px" height="135px" ></iframe>
                    </div>
                    <table id="datatable" class="display compact table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>AMD</th>
                                <th>USD</th>
                                <th>RUB</th>
                                <th>EUR</th>
                                <th>Updated date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input form="updateForm" type="text" class="form-control" name="amd" placeholder="AMD" value="{{ $item->amd }}">
                                </td>
                                <td>
                                    <input form="updateForm" type="text" class="form-control" name="usd" placeholder="USD" value="{{ $item->usd }}">
                                </td>
                                <td>
                                    <input form="updateForm" type="text" class="form-control" name="rub" placeholder="RUB" value="{{ $item->rub }}">
                                </td>
                                <td>
                                    <input disabled type="text" class="form-control" placeholder="EUR" value="{{ $item->eur }}">
                                </td>
                                <td>{{ $item->updated_at }}</td>
                                <td>
                                    <form id="updateForm" action="{{ route('currency-api-admin-update', ['locale' => app()->getLocale(), 'id' => $item->id]) }}" method="post">
                                        @csrf
                                        <button type="submit" form="updateForm" class="btn btn-sm btn-primary"><i class="ti ti-pencil-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection