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
        @php
        $header_title = "Set Account Password";
    @endphp
<div class="content-wrappers">
    <section class="content-header">
    
    </section>

    @include('messages')
    <section class="content d-flex justify-content-center align-items-center" style="height: 100vh;">


        <div class="card" style="width: 400px; transform: translateY(-20%);">
            <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{route('password.update')}}" method="POST">
                    @csrf
                    
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <div class="input-group">
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Enter New Password</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control" required pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" 
                            title="Password must contain at least 8 characters, including at least one letter and one number.">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="toggleNewPassword">
                                    <i class="fa fa-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm New Password</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                    <i class="fa fa-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Reset Password</button>
                    
                    <div>
                        <a  href="{{ route('auth.login') }}">Back to Login</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    
        const toggleNewPassword = document.getElementById('toggleNewPassword');
        const newPasswordInput = document.getElementById('password');
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPasswordInput = document.getElementById('password_confirmation');

        toggleNewPassword.addEventListener('click', function() {
            togglePasswordVisibility(newPasswordInput, toggleNewPassword);
        });

        toggleConfirmPassword.addEventListener('click', function() {
            togglePasswordVisibility(confirmPasswordInput, toggleConfirmPassword);
        });

        function togglePasswordVisibility(inputElement, toggleButton) {
            const type = inputElement.getAttribute('type') === 'password' ? 'text' : 'password';
            inputElement.setAttribute('type', type);
            toggleButton.querySelector('i').classList.toggle('fa-eye-slash');
            toggleButton.querySelector('i').classList.toggle('fa-eye');
        }
    });
</script>
    </body>
</html>



