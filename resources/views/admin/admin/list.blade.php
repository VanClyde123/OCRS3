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
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    @foreach($getData as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->middle_name }}</td>
                                        <td>{{ $value->last_name }}</td>
                                        <td>
                                            <a href="{{ url('admin/admin/confirm-password/'.$value->id) }}" class="btn btn-primary">Edit</a>
                                            <a href="{{ url('admin/admin/delete/'.$value->id) }}" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
