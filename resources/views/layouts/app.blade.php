<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ !empty($header_title) ? $header_title : '' }}</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ url('public/plugins/fontawesome-free/css/all.min.css')}}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet" href="{{ url('public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ url('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
        <!-- JQVMap -->
        <link rel="stylesheet" href="{{ url('public/plugins/jqvmap/jqvmap.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ url('public/dist/css/adminlte.min.css')}}">
        <!-- overlayScrollbars --> 
        <link rel="stylesheet" href="{{ url('public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ url('public/plugins/daterangepicker/daterangepicker.css')}}">
        <!-- summernote -->
        <link rel="stylesheet" href="{{ url('public/plugins/summernote/summernote-bs4.min.css')}}">

        {{--TEST--}}
        <style>
            body{
                background-color:lightgrey;
            }
            hr{
                border: 2px solid darkslategrey;
            }
            .sidebars {
                height: 100%;
                width:  0;
                position: fixed;
                top: 0;  
                left: 0;
                z-index: 998;  
                background-color: rgb(26, 41, 41);
                overflow-x: hidden;
                transition: 0.5s;
                padding-top: 30px;
                box-sizing: border-box;
                .closebtn {
                    position: absolute;
                    top: 0;
                    right: 25px;  
                    font-size: 36px;
                    margin-left: 50px; 
                    background-color: rgb(16, 37, 37);
                    color:darkgrey;
                    &:hover{
                        color:yellow;
                    }
                }
            }
            .openbtn {
                font-size: 20px;
                cursor: pointer;  
                background-color: darkslategrey;
                color: white;
                padding: 10px 15px;
                border: none;
                &:hover {
                    color:yellow;
                    background-color: black; 
                }
            }
            #main {
                transition: margin-left .5s;
            }
            @media screen and (max-height: 450px) {
                .sidebar {padding-top: 15px;}
                .sidebar a {font-size: 18px;}
            }
            .content-wrappers{
                padding-left: 20px;
                padding-right: 20px;
            }
            .header-expanded #mySidebar {
                width: 200px; 
            }
            .butt{
                padding: 16px; 
                position:fixed; 
                z-index: 999;  
                top: 0; 
                left: 0;
                &:hover{
                    opacity:0.3;
                }
            }
        </style>
        @yield('style')


        

        <!--<script src="{{ url('public/plugins/jquery/jquery.min.js')}}"></script>-->
        <script src="{{ url('public/plugins/jquery/jquery-3.6.0.min.js')}}"></script>
        <script src="{{ url('public/plugins/jquery/jquery-3.6.0.js')}}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ url('public/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>$.widget.bridge('uibutton', $.ui.button)</script>
        <!-- Bootstrap 4  <script src="{{ url('public/plugins/bootstrap/js/bootstrap5.3.0.bundle.min.js')}}"></script>-->
        <script src="{{ url('public/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- ChartJS -->
        <script src="{{ url('public/plugins/chart.js/Chart.min.js')}}"></script>
        <!-- Sparkline -->
        <script src="{{ url('public/plugins/sparklines/sparkline.js')}}"></script>
        <!-- JQVMap -->
        <script src="{{ url('public/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
        <script src="{{ url('public/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{ url('public/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
        <!-- daterangepicker -->
        <script src="{{ url('public/plugins/moment/moment.min.js')}}"></script>
        <script src="{{ url('public/plugins/daterangepicker/daterangepicker.js')}}"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="{{ url('public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
        <!-- Summernote -->
        <script src="{{ url('public/plugins/summernote/summernote-bs4.min.js')}}"></script>
        <!-- overlayScrollbars -->
        <script src="{{ url('public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{ url('public/dist/js/adminlte.js')}}"></script>
        <!-- AdminLTE or demo purposes -->
        <script src="{{ url('public/dist/js/pages/dashboard.js')}}"></script>
        @stack('scripts')
        @yield('script')

        <title>
            hello
        </title>
    </head>
    <body >
        <div>
            @include('layouts.header') 
            <div id="main">
                
                @yield('content')
                <br><br><br><br>
                @include('layouts.footer')
            </div>
        </div>
    </body>
</html>
