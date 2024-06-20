@extends('layouts.app')

@section('content')
    @php
        $header_title = "Remove Students";
    @endphp
    <div class="content-wrappers">
        <section class="content-header" style="text-align: right;">
            <h2></h2>
            <input action="action" onclick="window.history.go(-1); return false;" type="submit" class="btn btn-info" value="Back" />
        </section>
        <section class="content">
            @include('messages')
            <div class="card">
                 <div class="card-header">
                    <h3 class="card-title">Enrolled Students List</h3>
                </div>
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
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($sortedStudents[$gender]))
                                        @foreach ($sortedStudents[$gender] as $student)
                                            <tr>
                                                <td>{{ $student->student->id_number }}</td>
                                                <td>{{ $student->student->last_name }}, {{ $student->student->name }} {{ $student->student->middle_name }}</td>
                                                <td>{{ $student->student->course }}</td>
                                                <td><a class="btn btn-danger" href="{{ route('remove.student', ['enrolledStudentId' => $student->id]) }}" onclick="return confirm('Are you sure you want to remove this student?')">Remove</a></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

   