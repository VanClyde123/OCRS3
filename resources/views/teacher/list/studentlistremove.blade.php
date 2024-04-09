@extends('layouts.app')

@section('content')
    <div class="content-wrappers">
        <section class="content-header">

            <h3>Enrolled Students List</h3>
        </section>
        <section class="content">
            @include('messages')
            <div class="card">
                <div class="card-body ">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            @foreach (['Male', 'Female'] as $gender)
                                <thead>
                                    <tr>
                                        <th colspan="3">{{ $gender }}</th>
                                    </tr>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Course</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($sortedStudents[$gender]))
                                        @foreach ($sortedStudents[$gender] as $student)
                                            <tr>
                                                <td>{{ $student->student->id_number }}</td>
                                                <td>{{ $student->student->last_name }}, {{ $student->student->name }} {{ $student->student->middle_name }}</td>
                                                <td>{{ $student->student->course }}</td>
                                                <td><a class="btn btn-primary" href="{{ route('remove.student', ['enrolledStudentId' => $student->id]) }}" onclick="return confirm('Are you sure you want to remove this student?')">Remove</a></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
                <div>
                    <a href="{{ route('teacher.list.studentlist', ['subject' => $subject->id]) }}" class="btn btn-primary">Back</a>
                </div>
        </section>
    </div>
@endsection

   