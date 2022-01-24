<div class="app-main" id="main">
    <!-- begin container-fluid -->
    <div class="container-fluid">
        <!-- begin row -->
        <div class="row">
            <div class="col-md-12 m-b-30">
                <!-- begin page title -->
                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                    <h1>{{ $page_name }}</h1>
                    <div class="ml-auto d-flex align-items-center">
                        <nav>
                            <ol class="breadcrumb p-0 m-b-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home-admin-index', ['locale' =>app()->getLocale()]) }}"><i class="ti ti-home"></i></a>
                                </li>
                                @if (\Route::has(\Request::segment(3).'-admin-index'))
                                    <li class="breadcrumb-item active text-primary" aria-current="page">
                                        <a href="{{ route(\Request::segment(3).'-admin-index', ['locale' =>app()->getLocale()]) }}">{{ $page_name }}</a>
                                    </li>
                                @endif
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- end page title -->
            </div>
        </div>
        <!-- end row -->
        
        <!-- Notification -->
        <div class="row">
            <div class="col-md-12">
                @if(session()->has('added'))
                    <div class="alert border-0 alert-primary bg-gradient m-b-30 alert-dismissible fade show border-radius-none" role="alert">
                        Item Added successfully   
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="ti ti-close"></i>
                        </button>
                    </div>
                @endif  
                @if(session()->has('updated'))
                    <div class="alert border-0 alert-warning bg-gradient m-b-30 alert-dismissible fade show border-radius-none" role="alert">
                        Item Updated successfully
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="ti ti-close"></i>
                        </button>
                    </div>
                @endif    
                @if(session()->has('deleted'))
                    <div class="alert border-0 alert-danger bg-gradient m-b-30 alert-dismissible fade show border-radius-none" role="alert">
                        Item Deleted successfully   
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="ti ti-close"></i>
                        </button>
                    </div>
                @endif  
                @if(session()->has('error'))
                    <div class="alert border-0 alert-danger bg-gradient m-b-30 alert-dismissible fade show border-radius-none" role="alert">
                        Somthing Went Wrong
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="ti ti-close"></i>
                        </button>
                    </div>
                @endif    
                @if(session()->has('send'))
                    <div class="alert border-0 alert-info bg-gradient m-b-30 alert-dismissible fade show border-radius-none" role="alert">
                        Message sended successfuly :)
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="ti ti-close"></i>
                        </button>
                    </div>
                @endif    
                @if(isset($add) && $add == true)
                <!-- Add new modal button -->
                <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#addNewItem">Add new item</button>
                @endif
                @if(isset($activate_button) && $activate_button == true)
                    <!-- Activate button -->
                    <a href="{{ route($route.'-admin-activate',['locale' => app()->getLocale()]) }}" class="btn btn-primary mb-4">Activate / Deactivate Section</a>
                @endif
                @if(isset($add_from_new_page) && $add_from_new_page == true)
                <!-- Add new create item url -->
                <a href="{{ route($route.'-admin-create',['locale' => app()->getLocale()]) }}" class="btn btn-primary mb-4">Add new item</a>
                @endif
            </div>
        </div>
        <!-- End Notification -->