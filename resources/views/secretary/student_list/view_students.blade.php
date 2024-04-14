@extends('layouts.app')

@section('content')
    <div class="content-wrappers">
        <section class="content-header">
            <h2 class="mb-5">Student List</h2>
        </section>

        @include('messages')
        <section class="content">
            <div class="card">
                <div class="card-body ">
                    <div>
                        <form action="{{ route('secretary.searchStudents1') }}" method="GET" class="mb-2">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search by ID Number, Last Name, First Name or Middle Name">
                                <div class="input-group-append">
                                    <button class="btn btn-info" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
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
                                            <a href="{{ route('secretary.viewEnrolledSubjects1', ['studentId' => $student->id]) }}" class="btn btn-info">View Enrolled Subjects</a>
                                            <br><br>
                                            <a href="{{ route('secretary.viewPastEnrolledSubjects1', ['studentId' => $student->id]) }}" class="btn btn-info">View Past Semester Subjects</a>
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