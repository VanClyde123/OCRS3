@extends('layouts.app')
   
@section('content')
   <div class="content-wrappers">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2>Edit User</h2>
        <input action="action" onclick="window.history.go(-1); return false;" type="submit" class="btn btn-info" value="Back" />
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card ">
            <!-- form start -->
            <form method="post" action="">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="{{ $getData->name }}" required placeholder="Name">
                </div>
                <div class="form-group">
                <label>Middle Name</label>
                <input type="text" class="form-control" name="middle_name" value="{{ $getData->middle_name }}" placeholder="Middle Name">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control" name="last_name" value="{{ $getData->last_name }}" placeholder="Last Name">
            </div>
                <div class="form-group">
                <label>ID Number</label>
                <input type="number" class="form-control" name="id_number" value="{{ $getData->id_number }}" required>
                </div>
                <div class="form-group">
                    <label>Role</label>
                   
                    <select class="form-control" name="role">
                        <option value="1" {{ $getData->role == 1 ? 'selected' : '' }}>Admin</option>
                        <option value="4" {{ $getData->role == 4 ? 'selected' : '' }}>Secretary</option>
                        <option value="2" {{ $getData->role == 2 ? 'selected' : '' }}>Instructor</option>
                        <option value="3" {{ $getData->role == 3 ? 'selected' : '' }}>Student</option>
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
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
            </form>
        </div>
    </section>
    <!-- /.content -->
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