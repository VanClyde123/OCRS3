@extends('layouts.app')

@section('content')
    <div class="content-wrappers">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h2 >Enrolled Subjects</h2>
            <input action="action" onclick="window.history.go(-1); return false;" type="submit" class="btn btn-info" value="Back" /> 
        </section>

        @include('messages')
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Enrolled Subjects of {{ $student->last_name }}, {{ $student->name }} {{ $student->middle_name }}</h3>
                </div>
                <div class="card-body ">
                    <div>
                        <form action="{{ route('secretary.searchEnrolledSubjects1', ['studentId' => $student->id]) }}" method="GET" class="mb-2">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search by Subject Code, Description, or Section">
                                <div class="input-group-append">
                                    <button class="btn btn-info" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                            @if (empty($enrolledSubjects))
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
                                @foreach($enrolledSubjects as $subject)
                                    <tr>
                                        <td>{{ $subject->subject_code }}</td>
                                        <td>{{ $subject->description }}</td>
                                        <td>{{ $subject->section }}</td>
                                        <td>{{ $subject->term }}</td>
                                        <td>
                                            <a href="{{ route('secretary.viewGrades1', ['studentId' => $student->id, 'subjectId' => $subject->id]) }}" class="btn btn-info">View Scores and Grades</a>
                                        </td>
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