@extends('layouts.app')

@section('content')
    <div class="content-wrappers">
        <section class="content-header">
            <div class="container-fluid">
                <h3>Previously Enrolled Subjects</h3>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                @include('messages')
                 <form action="{{ route('student.searchPastSubjects') }}" method="GET" class="form-inline">
                         <div class="form-group">
                            <label for="search">Search:</label>
                            <input type="text" class="form-control" id="search" name="search" placeholder="Search by Subject Code, Description, Section, Instructor Name, Days, Time, or Room" size="70">
                        </div>
                        <div class="form-group mx-sm-3">
                            <label for="term">Term:</label>
                            <input type="text" class="form-control" id="term" name="term" placeholder="Search by Semester or School Year" size="40">
                        </div>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                <div class="card">
                   
                    @if ($pastStudentSubjects->count() > 0)
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Subject Code</th>
                                            <th>Subject Description</th>
                                            <th>Instructor</th>
                                            <th>Days</th>
                                            <th>Time</th>
                                            <th>Room</th>
                                            <th>Term</th>
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pastStudentSubjects as $enrolledSubject)
                                            <tr>
                                                <td>{{ $enrolledSubject->importedclasses->subject->subject_code }}</td>
                                                <td>{{ $enrolledSubject->importedclasses->subject->description }}</td>
                                                <td>{{ $enrolledSubject->importedclasses->instructor->name }} {{ $enrolledSubject->importedclasses->instructor->last_name }}</td>
                                                <td>{{ $enrolledSubject->importedclasses->days }}</td>
                                                <td>{{ $enrolledSubject->importedclasses->time }}</td>
                                                <td>{{ $enrolledSubject->importedclasses->room }}</td>
                                                <td>{{ $enrolledSubject->importedclasses->subject->term }}</td>
                                                <td><a class="btn btn-info" href="{{ route('student.scores.showscores', ['enrolledStudentId' => $enrolledSubject->id]) }}">View Scores</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <p>No available past semester subjects.</p>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection
