@extends('layouts.app')

@section('content')
@php
        $header_title = "Past Semester Subjects";
    @endphp
    <div class="content-wrappers">
        <section class="content-header">
            <h2>Previously Enrolled Subjects</h2>
            <input action="action" onclick="window.history.go(-1); return false;" type="submit" class="btn btn-info" value="Back" />
        </section>
        @include('messages')
        <section class="content">
            <div class="card">
                @if (empty($pastStudentSubjects))
                    <p>Subjects will not show since there is no active current semester set. Please contact the Admin or Secretary.</p>
                @else
                @if ($pastStudentSubjects->count() > 0)
                    <div class="card-body">
                        <div>
                            
                            <form action="{{ route('student.searchPastSubjects') }}" method="GET" class="form-inline">
                                <div class="form-group">
                                <label for="search">Search:</label>
                                <input type="text" class="form-control" id="search" name="search" placeholder="Search by Subject Code, Description, Section, Instructor Name, Days, Time, or Room" size="70">
                            </div>
                            <div class="form-group mx-sm-3">
                                <label for="term">Term:</label>
                                <input type="text" class="form-control" id="term" name="term" placeholder="Search by Semester or School Year" size="40">
                            </div>
                            <button type="submit" class="btn btn-info">Search</button>
                        </form>
                        </div>
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
                    @endif
            </div>
        </section>
    </div>
@endsection
