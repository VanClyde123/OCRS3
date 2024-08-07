@extends('layouts.app')

@section('content')
@php
        $header_title = "Enrolled Student";
    @endphp
    <div class="content-wrappers">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h2><br></h2>
            
        </section>
        <section class="content">
    <div class="card">
        <div class="card-header">
                    <h3 class="card-title">Enrolled Students for {{ $subject->description }} ({{ $subject->subject_code }})</h3>
                </div>
        <div class="card-body">
            <div class="table-responsive">
                @if ($enrolledStudents->isEmpty())
                    <p>There are no enrolled students for this subject. the associated class list for this subject is not imported by the instructor yet.</p>
                @else
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
                                    @if ($enrolledStudent->student)
                                        <tr>
                                            <td>{{ $enrolledStudent->student->last_name }}, {{ $enrolledStudent->student->name }} {{ $enrolledStudent->student->middle_name }}</td>
                                            <td>{{ $enrolledStudent->student->id_number }}</td>
                                            <td>
                                                <a href="{{ route('admin.view.student.points', ['studentId' => $enrolledStudent->student->id, 'subjectId' => $subject->id]) }}" class="btn btn-info">View Scores</a>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="3">Student record not found. The classlist is not imported by the instructor yet</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</section>
<input action="action" onclick="window.history.go(-1); return false;" type="submit" class="btn btn-info" value="Back" />
    </div>
@endsection

