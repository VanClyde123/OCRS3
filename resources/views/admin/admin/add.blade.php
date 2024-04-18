@extends('layouts.app')
   
@section('content')
   <div class="content-wrappers">
        <section class="content-header">
            <h2>Add User</h2>
            <input action="action" onclick="window.history.go(-1); return false;" type="submit" class="btn btn-info" value="Back" />
        </section>

        <section class="content">
            <div class="card">
                <form method="post" action="">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" required placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label>Middle Name</label>
                            <input type="text" class="form-control" name="middle_name" placeholder="Middle Name">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <label>ID Number</label>
                            <input type="number" class="form-control" name="id_number" required placeholder="ID Number">
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" name="role" required> 
                            <option value="" disabled selected>--- Select Role ---</option>
                            <option value="1">Admin</option>
                            <option value="4">Secretary</option>
                            <option value="2">Instructor</option>
                            <option value="3">Student</option>
                            </select>
                        </div>
                      <div class="form-group">
                        <label>Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" id="password" required 
                                placeholder="Password" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" 
                                title="Password must contain at least 8 characters, including at least one letter and one number.">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fa fa-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </section>
  </div>

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


@endsection