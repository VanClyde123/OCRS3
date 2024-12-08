<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Recover Password</title>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session('status') }}
            </div>
        @endif
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ url('public/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="{{ url('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ url('public/dist/css/adminlte.min.css')}}">
    </head>
    
<style>
    .btnaa {
      background-color: green;
      border: none;
      color: white;
      padding: 12px 30px;
      cursor: pointer;
      font-size: 15px;
      size: 15px;
    }
    
    /* Darker background on mouse-over */
    .btnaa:hover {
      background-color: RoyalBlue;
    }
</style>
    <body class="hold-transition login-page">

        <div class="login-box">
            <div class="login-logo">
                <a href="">Recover Password</a>
            </div>
                <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                <!--from views/messages.blade.php -->
                    @include('messages')
                    <form action="{{route('password.request')}}" method="post">
                        {{ csrf_field() }}
                        <label for="email">Email</label>
                        <div class="input-group mb-2">

                            <input type="email" class="form-control" required name="email" placeholder="Email" value="{{old('email')}}">
                        </div>

                        <div >
                            <button type="submit" class="btn btn-primary btn-block" >Send Request</button>
                        </div>
                        <div>
                            <a href="{{ route('auth.login') }}">Back to Login</a>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            togglePasswordVisibility(passwordInput, togglePassword);
        });

        function togglePasswordVisibility(inputElement, toggleButton) {
            const type = inputElement.getAttribute('type') === 'password' ? 'text' : 'password';
            inputElement.setAttribute('type', type);
            toggleButton.querySelector('i').classList.toggle('fa-eye-slash');
            toggleButton.querySelector('i').classList.toggle('fa-eye');
        }
    });
</script>
