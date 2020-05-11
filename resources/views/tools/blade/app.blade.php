<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        
        
    
        <title>Shopp App - @yield('title', 'Shoppe') </title>
    
        @yield('css')
        
        
    </head>
    <body class="hold-transition layout-boxed light-skin dark-sidebar sidebar-mini theme-yellow">
    
        <!-- Site wrapper -->
        <div class="wrapper">
            
            @yield('main_header')
        
            @yield('main_sidebar')
        
            <div class="content-wrapper">
                <div class="container-full">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        @yield('navigator')
                       
                    </div>
        
                    <!-- Main content -->
                    <section class="content">
                        @yield('content')
                    </section>
                    <!-- /.content -->
                </div>
            </div>
        
            @yield('main_footer')
            
        </div>
    
    @yield('js')
    <!-- PACE -->
    <script src="{{asset('theme/cryptoadmin/vendor_components/PACE/pace.min.js')}}"></script>

</body>
</html>
