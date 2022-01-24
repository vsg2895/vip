<!DOCTYPE html>
<html lang="en_EN">
<head>
    <meta charset="utf-8" />
    <title>Yerevan.vip - Admin Dashboard by ArmCoding</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta content="Depannage.fr - Admin Dashboard by ArmCoding" name="description" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- app favicon -->
    <link rel="shortcut icon" href="{{asset('admin-assets/img/favicon.ico') }}">
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <!-- plugin stylesheet -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/vendors.css') }}" />
    <!-- app style -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/style.css') }}" />
</head>
<body>
    <!-- begin app -->
    <div class="app">
        <!-- begin app-wrap -->
        <div class="app-wrap">
            @include('admin.layouts.loader')
            
            @include('admin.layouts.header')

            <!-- begin app-container -->
            <div class="app-container">
                <!-- begin app-nabar -->
                    @include('admin.layouts.sidebar')
                <!-- end app-navbar -->
                
                <!-- begin app-main -->
                    @include('admin.layouts.content-header')
                        @yield('content')
                    @include('admin.layouts.content-footer')
                <!-- end app-main -->
            </div>
            <!-- end app-container -->
            
            @include('admin.layouts.footer')
        </div>
        <!-- end app-wrap -->
    </div>
    <!-- end app -->

    <!-- plugins -->
    <script src="/admin-assets/js/vendors.js"></script>

    <!-- Ck Editor -->
    <script src="/admin-assets/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.config.allowedContent = true;
            $("*[data-description='true']").each(function(){
            CKEDITOR.replace(this);
                    var self = $(this);
            $(this).parents('form').submit(function () {
                self.html(CKEDITOR.instances[self.attr('name')].gletData());
            });
        });
    </script>

    <!-- custom app -->
    <script src="/admin-assets/js/app.js"></script>
</body>
</html>