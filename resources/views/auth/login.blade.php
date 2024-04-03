<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Log In</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ url('public/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="{{ url('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ url('public/dist/css/adminlte.min.css')}}">
    </head>
    <body class="hold-transition login-page">
        <div class="card" style="align-items: center;">
            <div class="card-header">
                Test Accounts
            </div>
            <div class="card-body" style="align-items: center;">
                <h4 class="card-title">This card is here until after tests</h4>
                <p class="card-text">Admin Account:  admin <br>Secretary Account:  00001000<br>Teacher Account: 10001000<br>Student Account:  20151110<br>Passwords: 12345</p>
            </div>
        </div>

        <div class="login-box">
            <div class="login-logo">
                <a href="">Log In</a>
            </div>
                <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                <!--from views/messages.blade.php -->
                    @include('messages')
                    <form action="{{ url('login') }}" method="post">
                        {{ csrf_field() }}
                        <div class="input-group mb-3">
                        <input type="idnumber" class="form-control" required name="id_number" placeholder="ID Number">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            </div>
                        </div>
                        </div>
                        <div class="input-group mb-3">
                        <input type="password" class="form-control"  required name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        </div>
                        
                        <div class="col-8">
                            <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            </div>
                        </div>

                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block" >Log In</button>
                        </div>
                        <!-- /.col -->
                    </form>
                </div>
            </div>
        </div>

        <script src="{{ url('public/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ url('public/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ url('public/dist/js/adminlte.min.js') }}"></script>
    </body>
</html>

