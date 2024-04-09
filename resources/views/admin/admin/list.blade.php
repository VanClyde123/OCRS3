@extends('layouts.app')
   
@section('content')
    <div class="content-wrappers">
        <section class="content-header">
                <h2>List</h2>
                <div style="text-align: left;">
                    <a href="{{ url('admin/admin/add')}}" class="btn  btn-success">Add User</a>
                    <a href="{{ url('admin/student_list/view_students')}}" class="btn  btn-info">Student List</a>
                </div>
        </section>
        <section class="content">
            @include('messages')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">User List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <th>ID #</th>
                                <th>Name</th>
                                <th>Last Name</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                @foreach($getData->sortBy('id')->groupBy('role') as $role => $groupedData)
                                    @foreach($groupedData as $value)
                                        <tr>
                                            <td>{{ $value->id_number }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->last_name }}</td>
                                            <td>
                                                @switch($value->role)
                                                    @case(1)
                                                        Admin
                                                        @break
                                                    @case(2)
                                                        Teacher 
                                                        @break
                                                    @case(3)
                                                        Student
                                                        @break
                                                    @case(4)  
                                                        Secretary
                                                        @break
                                                @endswitch
                                            </td> 
                                            <td>
                                                <a href="{{ url('admin/admin/confirm-password/'.$value->id) }}" class="btn btn-primary">Edit</a>
                                                <a href="{{ url('admin/admin/delete/'.$value->id) }}" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
