@extends('layouts.app')

@section('content')
@php
        $header_title = "Past Semester Subjects";
    @endphp
    <div class="content-wrappers">
        <!-- Content Header (Page header) -->
       <section class="content-header">
            <h2><br></h2>
           
        </section>
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Past Subjects Taught by {{ $instructor->name }} {{ $instructor->middle_name }} {{ $instructor->last_name }}</h3>
                </div>
                <div class="card-body">
                    <div>
                        <form action="{{ route('secretary.searchPastInstructorSubjects', ['instructorId' => $instructor->id]) }}" method="GET" class="mb-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="search" class="form-control" placeholder="Search by Subject Code, Description, or Section">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="term" class="form-control"  placeholder="Search by Semester or School Year">
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-info" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                            @if (empty($pastSubjects))
                                <p>Subjects will not show since there is no active semester set. Please set a semester</p>
                            @else
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Subject Name</th>
                                    <th>Subject Code</th>
                                    <th>Section</th>
                                        <th>Term</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pastSubjects as $subject)
                                    <tr>
                                    <td>{{ $subject->subject->description }}</td>
                                    <td>{{ $subject->subject->subject_code }}</td>
                                        <td>{{ $subject->subject->section }}</td>
                                        <td>{{ $subject->subject->term }}</td>
                                    <td>  <a href="{{ route('secretary.teacher_list.enrolled_students', ['subject' => $subject->subject->id]) }}"class="btn btn-info">View Enrolled Students</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif

                    </div>
                </div>
            </div>
        </section>
        <input type="button" onclick="window.location.href='{{ url('secretary/teacher_list/instructor_list') }}';" class="btn btn-info" value="Back" />
    </div>
@endsection

 