@extends('layouts.app')
   
@section('content')
@php
        $header_title = "Edit User";
    @endphp
   <div class="content-wrappers">
        <style>
            small.small-tag {
                font-size: 0.8em; 
                position: relative;
                top: -10px; 
            }
        </style>
        <section class="content-header">
           <br>
           
        </section>

        <section class="content">
            <div class="card ">
                <form method="post" action="">
                {{ csrf_field() }}
                 <div class="card-header">
                    <h3 class="card-title">Edit {{ $getData->name }} {{ $getData->middle_name }}. {{ $getData->last_name }} Account Information </h3>
                </div>
                <div class="card-body">
                    <small class="small-tag">* Required</small>
                    <div class="form-group">
                        <label>Name *</label>
                        <input type="text" class="form-control" name="name" value="{{ $getData->name }}" placeholder="Name" required>
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
                        <label>ID Number *</label>
                        <input min="0" class="form-control" name="id_number" @if ($getData->id == '1')  value="{{ $getData->id_number }}" @else type="number" value="{{ $getData->id_number }}" @endif required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Role *</label>
                            <select class="form-control" name="role" id="role">
                                <option value="1" {{ $getData->role == 1 ? 'selected' : '' }}>Admin</option>
                                <option value="4" {{ $getData->role == 4 ? 'selected' : '' }}>Secretary</option>
                                <option value="2" {{ $getData->role == 2 ? 'selected' : '' }}>Instructor</option>
                                <option value="3" {{ $getData->role == 3 ? 'selected' : '' }}>Student</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Activate Secondary Role</label>
                            <select class="form-control" name="secondary_role" id="secondary_role">
                                <option value="" {{ is_null($getData->secondary_role) ? 'selected' : '' }}>Disable</option>
                                <option value="1" {{ $getData->secondary_role == 1 ? 'selected' : '' }}>Admin</option>
                                <option value="2" {{ $getData->secondary_role == 2 ? 'selected' : '' }}>Instructor</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" id="password" 
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
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
                </form>
            </div>

            <input type="button" onclick="window.location.href='{{ url('admin/admin/list') }}';" class="btn btn-info" value="Back" />
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

        document.getElementById('role').addEventListener('change', function () {
        const secondaryRoleSelect = document.getElementById('secondary_role');
        const selectedRole = this.value;

        
        while (secondaryRoleSelect.options.length > 0) {
            secondaryRoleSelect.remove(0);
        }

        
        const noneOption = new Option('Disable', '');
        secondaryRoleSelect.add(noneOption);

       
        if (selectedRole == 1) { 
            const instructorOption = new Option('Instructor', '2');
            secondaryRoleSelect.add(instructorOption);
        } else if (selectedRole == 4) { 
            const adminOption = new Option('Admin', '1');
            secondaryRoleSelect.add(adminOption);
        } else if (selectedRole == 2) {
            const adminOption = new Option('Admin', '1');
            secondaryRoleSelect.add(adminOption);
        } 

        
        secondaryRoleSelect.value = "{{ $getData->secondary_role }}";
    });

    
    document.getElementById('role').dispatchEvent(new Event('change'));
    </script>


  @endsection