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
                                <th>ID</th>
                                <th>Type</th>
                                <th>Name EN</th>
                                <th>Name RU</th>
                                <th>Name HY</th>
                                <th>Simbol</th>
                                <th>Value (AMD)</th>
                                <th>Updated date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($items as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>
                                        <input form="updateForm{{ $item->id }}" type="text" class="form-control" name="name_en" placeholder="English" value="{{ $item->name_en }}">
                                    </td>
                                    <td>
                                        <input form="updateForm{{ $item->id }}" type="text" class="form-control" name="name_ru" placeholder="Russian" value="{{ $item->name_ru }}">
                                    </td>
                                    <td>
                                        <input form="updateForm{{ $item->id }}" type="text" class="form-control" name="name_hy" placeholder="Armenian" value="{{ $item->name_hy }}">
                                    </td>
                                    <td><input type="text" name="simbol" class="form-control" value="{{ $item->simbol }}" form="updateForm{{ $item->id }}"></td>
                                    <td><input type="text" name="value" class="form-control" value="{{ $item->value }}" form="updateForm{{ $item->id }}"></td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <form id="updateForm{{ $item->id }}" action="{{ route('currencies-admin-update', ['locale' => app()->getLocale(), 'id' => $item->id]) }}" method="post">
                                            @csrf
                                            <button type="submit" form="updateForm{{ $item->id }}" class="btn btn-sm btn-primary" href="{{ route($route.'-admin-show', ['locale' => app()->getlocale(), 'id' => $item->id, 'currency' => 'amd']) }}"><i class="ti ti-pencil-alt"></i></button>
                                        </form>
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
@endsection