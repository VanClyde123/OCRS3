@extends('layouts.app')

@section('content')
    <div class="content-wrappers">
        <section class="content-header">
            <h2>Student List</h2>
        </section>

        <section class="content">
            @include('messages')
            <div class="card">
                <div class="card-body ">
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
                                            @if (empty($subjects))
                                                <p>Cannot view Previous/Current Enrolled Subjects.<br>There is no active current semester set. <br>Please contact the Admin or Secretary.</p>
                                            @else
                                                <a href="{{ route('admin.viewEnrolledSubjects', ['studentId' => $student->id]) }}" class="btn btn-info">View Enrolled Subjects</a> <br><br> <a href="{{ route('admin.viewPastEnrolledSubjects', ['studentId' => $student->id]) }}" class="btn btn-info">View Past Semester Subjects</a>
                                            @endif
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