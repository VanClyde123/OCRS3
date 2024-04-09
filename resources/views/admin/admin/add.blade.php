@extends('layouts.app')
   
@section('content')
   <div class="content-wrappers">
        <section class="content-header">
            <h2>Add User</h2>
        </section>

        <section class="content">
            <div class="card card-primary">
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
                            <input type="password" class="form-control" name="password" required placeholder="Password"
                            pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
                            title="Password must contain at least 8 characters, including atleast one letter and one number.">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Add User</button>
                    </div>
                </form>
            </div>
        </section>
    </div>

@endsection