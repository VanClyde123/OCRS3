@extends('layouts.app')

@section('content')
<div class="content-wrappers">
    <section class="content-header">
        <h2>Change Password</h2>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                @include('messages')
                  @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                   @endif

                <form action="{{ route('change-password3') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="old_password">Enter your Old Password</label>
                        <div class="input-group">
                            <input type="password" name="old_password" id="old_password" class="form-control" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="toggleOldPassword">
                                    <i class="fa fa-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <div class="input-group">
                            <input type="password" name="new_password" id="new_password" class="form-control" required pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" 
                            title="Password must contain at least 8 characters, including at least one letter and one number.">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="toggleNewPassword">
                                    <i class="fa fa-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="new_password_confirmation">Confirm New Password</label>
                        <div class="input-group">
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                    <i class="fa fa-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Change Password</button>
                </form>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleOldPassword = document.getElementById('toggleOldPassword');
        const oldPasswordInput = document.getElementById('old_password');
        const toggleNewPassword = document.getElementById('toggleNewPassword');
        const newPasswordInput = document.getElementById('new_password');
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPasswordInput = document.getElementById('new_password_confirmation');

        toggleOldPassword.addEventListener('click', function() {
            togglePasswordVisibility(oldPasswordInput, toggleOldPassword);
        });

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

@endsection
