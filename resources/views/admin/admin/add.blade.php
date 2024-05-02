@extends('layouts.app')
   
@section('content')
   <div class="content-wrappers">
        <style>
            small.small-tag {
                font-size: 0.8em; /* Adjust this value to make the tag smaller */
                position: relative;
                top: -10px; /* Adjust this value to elevate the tag from the ground */
            }
        </style>
        <section class="content-header">
            <h2>Add User</h2>
            <input action="action" onclick="window.history.go(-1); return false;" type="submit" class="btn btn-info" value="Back" />
        </section>
        @include('messages')
        <section class="content">
            <div class="card">
                <form method="post" action="">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <small class="small-tag">* Required</small>
                        <div class="form-group">
                            <label>Name *</label>
                            <input type="text" class="form-control" name="name" placeholder="Name" required >
                        </div>
                        <div class="form-group">
                            <label>Middle Name</label>
                            <input type="text" class="form-control" name="middle_name" placeholder="Middle Name">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="lastna"placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <label>ID Number *</label>
                            <input min ="0" type="number" class="form-control" name="id_number" id="id_number" placeholder="ID Number" required >
                        </div>
                        <div class="form-group">
                            <label>Role *</label>
                            <select id="roleSelect" class="form-control" name="role" required> 
                                <option value="" disabled selected>--- Select Role ---</option>
                                <option value="1">Admin</option>
                                <option value="4">Secretary</option>
                                <option value="2">Instructor</option>
                                <option value="3">Student</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Password *</label>
                            <div class="input-group">
                                <select id="passgen" class="form-control" name="passgen" required> 
                                    <option value="0" disabled selected>--- Select Password Generation Method---</option>
                                    <option value="1">Secure Auto Generated Password</option>
                                    <option value="2">Role + ID Number</option>
                                    <option value="3">User Defined</option>
                                </select>
                                <div class="input-group-append">
                                    <button hidden class="btn btn-success" type="button" id="generate" name="generate">
                                        Generate Password
                                    </button>
                                </div>
                            </div><br>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="password" required placeholder="Password" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" title="Password must contain at least 8 characters, including at least one letter and one number." >
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

    @php
        function generateRandomPasswords() {
        return Str::random(12); 
        }

        function addNumberToRandomPassword($password) {
        $number = rand(10, 99); // generate random 2-digit number
        return $password . $number; 
        }
    @endphp
    <script>
        const genbut = document.getElementById('generate'); 
        const idInput = document.getElementById('id_number'); 
        const roleSelect = document.getElementById('roleSelect'); 
        const passwordInput = document.getElementById('password'); 
        const passgenSelect = document.getElementById('passgen'); 
        const test = document.getElementById('lastna');
        let password = '';
        idInput.addEventListener('change', () => {
            password = idrole();
        });
        roleSelect.addEventListener('change', () => {
            password = idrole();
        });
        passgenSelect.addEventListener('change', () => {
            const gen = passgenSelect.value;
            const role = roleSelect.value;
            const id = idInput.value;
            let password = '';
            if(gen === '1') {
                genbut.hidden = false;
                password = generateRandomPassword();
            }else if(gen === '2') {
                password = '';
                password = idrole();
                genbut.hidden = true;
                passwordInput.value = password;
                test.value = password;
            }else if(gen === '3') {
                genbut.hidden = true;
                passwordInput.value = password;
            }
        });
        function idrole(){
            const gen = passgenSelect.value;
            const role = roleSelect.value;
            const id = idInput.value;
            if (gen==='2'){
                if(role === '1') { 
                password = 'Admin' + id;
                } else if(role === '2') {
                    password = 'Instructor' + id; 
                } else if(role === '3') {
                    password = 'Student' + id;
                } else if(role === '4') {
                    password = 'Secretary' + id;
                }
                passwordInput.value = password;
            }
            return password;
        }
        function generateRandomPassword() {
            password = "@php echo addNumberToRandomPassword(generateRandomPasswords()) @endphp";
            passwordInput.value = password;
            return password;
        }
        genbut.addEventListener('click', () => {
            password = "@php echo addNumberToRandomPassword(generateRandomPasswords()) @endphp";
            passwordInput.value = password;
        });
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