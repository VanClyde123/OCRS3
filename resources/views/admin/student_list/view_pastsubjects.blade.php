@extends('layouts.app')

@section('content')
    <div class="content-wrappers">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h3>Past Semester Subjects of {{ $student->last_name }}, {{ $student->name }} {{ $student->middle_name }}</h3>
            <form action="{{ route('admin.viewPastEnrolledSubjects', ['studentId' => $student->id]) }}" method="GET" class="form-inline">
                <div class="form-group">
                    <label for="search">Search:</label>
                    <input type="text" class="form-control" id="search" name="search" placeholder="Search by Subject Code, Description, or Section" size="40">
                </div>
                <div class="form-group mx-sm-3">
                    <label for="term">Term:</label>
                    <input type="text" class="form-control" id="term" name="term" placeholder="Search by Semester or School Year" size="40">
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div>
                    @include('messages')
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive">
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
                                                <td><a href="{{ route('admin.viewGrades', ['studentId' => $student->id, 'subjectId' => $subject->id]) }}" class="btn btn-primary">View Scores and Grades</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection