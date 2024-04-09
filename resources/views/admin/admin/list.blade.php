@extends('layouts.app')
   
@section('content')
    <div class="content-wrappers">
        <section class="content-header">
            <h2>List</h2>
            <div style="text-align: left;">
                <a href="{{ url('admin/admin/add')}}" class="btn  btn-success">Add User</a>
                <a href="{{ url('admin/student_list/view_students')}}" class="btn  btn-success">Student List</a>
            </div>
        </section>
        <section class="content">
            @include('messages')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">User List</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                <!-- Search form -->
                    <form action="{{ url('admin/admin/list') }}" method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>
                    </div>
                    <div class="table-responsive">
                       @php
                            $roles = [
                                    1 => 'Admin',
                                    2 => 'Instructor',
                                    3 => 'Student',
                                    4 => 'Secretary',
                                ];
                            @endphp
                        <table class="table table-striped">
                            <thead>
                                <th>#</th>
                                <th>Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </thead>
                            <tbody id="userList">
                                @foreach($getData as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->middle_name }}</td>
                                    <td>{{ $value->last_name }}</td>
                                    <td>{{ $roles[$value->role] }}</td>
                                    <td>
                                        <a href="{{ url('admin/admin/confirm-password/'.$value->id) }}" class="btn btn-primary">Edit</a>
                                        <a href="{{ url('admin/admin/delete/'.$value->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to remove this user?')">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination links -->
                    {{ $getData->links() }}
                </div>
            </div>
        </section>
    </div>

    
@endsection

<!-----------------

<script>
     document.getElementById('searchInput').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#userList tr');

            rows.forEach(row => {
                const name = row.cells[1].innerText.toLowerCase();
                const middleName = row.cells[2].innerText.toLowerCase();
                const lastName = row.cells[3].innerText.toLowerCase();
                const role = row.cells[4].innerText.toLowerCase();

                if (name.includes(searchValue) || middleName.includes(searchValue) || lastName.includes(searchValue) || role.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>

------------------->