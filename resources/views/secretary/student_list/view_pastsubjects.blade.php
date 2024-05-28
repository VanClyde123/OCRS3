@extends('layouts.app')

@section('content')
    <div class="content-wrappers">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h2>Past Semester Subjects</h2>
            <input action="action" onclick="window.history.go(-1); return false;" type="submit" class="btn btn-info" value="Back" />
        </section>
        <section class="content">
            @include('messages')
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">{{ $student->last_name }}, {{ $student->name }} {{ $student->middle_name }}</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div>
                            <form action="{{ route('secretary.viewPastEnrolledSubjects1', ['studentId' => $student->id]) }}" method="GET" class=" mb-2 form-inline">
                                <div class="form-group">
                                    <label for="search">Subject:</label>
                                    <input type="text" class="form-control" id="search" name="search" placeholder="Search by Subject Code, Description, or Section" size="40">
                                </div>
                                <div class="form-group mx-sm-3">
                                    <label for="term">Term:</label>
                                    <input type="text" class="form-control" id="term" name="term" placeholder="Search by Semester or School Year" size="40">
                                </div>
                                <button type="submit" class="btn btn-info">Search</button>
                            </form>
                        </div>
                        @if (empty($pastEnrolledSubjects ))
                            <p>Subjects will not show since there is no active semester set. Please set a semester</p>
                        @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Subject Code</th>
                                        <th>Description</th>
                                        <th>Section</th>
                                        <th>Term</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pastEnrolledSubjects as $subject)
                                        <tr>
                                            <td>{{ $subject->subject_code }}</td>
                                            <td>{{ $subject->description }}</td>
                                            <td>{{ $subject->section }}</td>
                                            <td>{{ $subject->term }}</td>
                                            <td><a href="{{ route('secretary.viewGrades1', ['studentId' => $student->id, 'subjectId' => $subject->id]) }}" class="btn btn-info">View Scores and Grades</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection