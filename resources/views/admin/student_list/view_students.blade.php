@extends('layouts.app')


@section('content')
@php
        $header_title = "Student List";
    @endphp
<title>Student List</title>
    <div class="content-wrappers">
        <section class="content-header" style="text-align: right;">
           
           <input type="button" onclick="window.location.href='{{ url('admin/admin/list') }}';" class="btn btn-info" value="Back to User List" />
        </section>
        <section class="content">
            @include('messages')
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Students List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div>
                            <form action="{{ route('admin.searchStudents') }}" method="GET" class="mb-2">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search by ID Number, Last Name, First Name or Middle Name">
                                    <div class="input-group-append">
                                        <button class="btn btn-info" type="submit">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID Number</th>
                                    <th>Last Name</th>
                                    <th>Name</th>
                                    <th>Middle Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td>{{ $student->id_number }}</td>
                                        <td>{{ $student->last_name }}</td>  
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->middle_name }}</td>
                                        <td>
                                            <a href="{{ route('admin.viewEnrolledSubjects', ['studentId' => $student->id]) }}" class="btn btn-info">View Enrolled Subjects</a>
                                            <br><br>
                                            <a href="{{ route('admin.viewPastEnrolledSubjects', ['studentId' => $student->id]) }}" class="btn btn-info">View Past Semester Subjects</a>
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