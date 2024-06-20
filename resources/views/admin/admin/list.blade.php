@extends('layouts.app')
   

@section('content')
    <div class="content-wrappers">
        <section class="content-header">
          
            <div style="text-align: right;">
                <a href="{{ url('admin/admin/add')}}" class="btn  btn-success">Add User</a>
                <a href="{{ url('admin/student_list/view_students')}}" class="btn  btn-success">Student List</a>
                
                {{-- 
                <input action="action" onclick="window.history.go(-1); return false;" type="submit" class="btn btn-info" value="Back" /> 
                --}}
            </div>
        </section>
        @include('messages')
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">User List</h3>
                </div>
                <div class="card-body">
                    <div>
                        <form action="{{ url('admin/admin/list') }}" method="GET" class="mb-2">
                            <div class="input-group mb-2">
                                <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-info">Search</button>
                                </div>
                            </div>
                            <select onchange="this.form.submit()"class="form-control" name="role" id="roleSelect" style="width:20%"  placeholder="--Select Role--">
                                <option value="" disabled selected>--Select Role--</option>
                                <option value="">Show All</option>
                                <option value="1" {{ request('role') == 1 ? 'selected' : '' }}>Admin</option>
                                <option value="2" {{ request('role') == 2 ? 'selected' : '' }}>Instructor</option>
                                <option value="4" {{ request('role') == 4 ? 'selected' : '' }}>Secretary</option>
                            </select>
                        </form>
                    </div>
                    <div class="table-responsive">
                        @php
                            $sortOrder = [
                                'Admin', 
                                'Secretary',
                                'Instructor'
                            ];
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
                                @foreach($getData->sortBy('role') as $value)
                                <tr>
                                    <td width="15%">{{ $value->id_number }}</td>
                                    <td width="15%">{{ $value->name }}</td>
                                    <td width="15%">{{ $value->middle_name }}</td>
                                    <td width="15%">{{ $value->last_name }}</td>
                                    <td width="15%">
                                            {{ $roles[$value->role] }}
                                            @if ($value->secondary_role)
                                                / {{ $roles[$value->secondary_role] }}
                                            @endif
                                        </td>
                                    <td width="15%">
                                        <a href="{{ url('admin/admin/confirm-password/'.$value->id) }}" class="btn btn-primary">Edit</a>
                                        @if($value->role != 1)
                                            <a href="{{ url('admin/admin/delete/'.$value->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to remove this user?')">Delete</a>
                                        @else
                                            <button disabled class="btn btn-danger">
                                                Delete
                                            </button>
                                        @endif
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

    <script>
        const select = document.getElementById('roleSelect');
        select.addEventListener('change', () => {
        select.form.submit(); 
        });
    </script>
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