@extends('layouts.app')

@section('content')
@php
        $header_title = "Enrolled Students";
    @endphp
    <div class="content-wrappers">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h2>Enrolled Students for {{ $subject->description }} ({{ $subject->subject_code }})</h2>
            <input action="action" onclick="window.history.go(-1); return false;" type="submit" class="btn btn-info" value="Back" />
        </section>
        <section class="content">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>ID Number</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sortedStudents = $enrolledStudents->groupBy('student.gender');
                                @endphp
                                @foreach ($sortedStudents as $gender => $students)
                                    <tr>
                                        <td colspan="3" class="gender-header">{{ $gender }}</td>
                                    </tr>
                                    @foreach ($students as $enrolledStudent)
                                        <tr>
                                            <td>{{ $enrolledStudent->student->last_name }}, {{ $enrolledStudent->student->name }} {{ $enrolledStudent->student->middle_name }}</td>
                                            <td>{{ $enrolledStudent->student->id_number }}</td>
                                            <td>
                                                <a href="{{ route('view.student.points', ['studentId' => $enrolledStudent->student->id, 'subjectId' => $subject->id]) }}" class="btn btn-info">View Scores</a>
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

