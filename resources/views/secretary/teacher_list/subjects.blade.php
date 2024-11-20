@extends('layouts.app')

@section('content')
@php
        $header_title = "Subject List";
    @endphp
    <div class="content-wrappers">
        <section class="content-header">
        <h2><br></h2>
      
    </section>
     @include('messages')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Subjects Taught by {{ $instructor->name }} {{ $instructor->middle_name }} {{ $instructor->last_name }}</h3>
            </div>
                <div class="card-body">
                    <div>
                        <form action="{{ route('secretary.searchInstructorSubjects', ['instructorId' => $instructor->id]) }}" method="GET" class="mb-2">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search by Subject Name, Code, or Section">
                                <div class="input-group-append">
                                    <button class="btn btn-info" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        @if (empty($subjects))
                                <p>Subjects will not show since there is no active semester set. Please set a semester</p>
                            @else
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                     <th>Subject Code</th>
                                    <th>Description</th>
                                   
                                    <th>Section</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subjects as $subject)
                                    <tr>
                                        <td>{{ $subject->subject->subject_code }}</td>
                                    <td>{{ $subject->subject->description }}</td>
                                    
                                        <td>{{ $subject->subject->section }}</td>
                                    <td>  <a href="{{ route('secretary.teacher_list.enrolled_students', ['subject' => $subject->subject->id]) }}"class="btn btn-info">View Enrolled Students</a>
                                        <form action="{{ route('secretary.subject.delete', ['subjectId' => $subject->subject->id]) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to remove this subject and all its enrolled students from this instructor?')">Remove</button>
                                        </form></td>
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

 