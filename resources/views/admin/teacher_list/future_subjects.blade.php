@extends('layouts.app')

@section('content')
@php
        $header_title = "Next Semester Subjects";
    @endphp
<div class="container">
     <section class="content-header">
     <br>
     <br>
      </section>
        @include('messages')
    <div class="card">
        <div class="card-header">
          Next Semester Subjects for {{ $instructor->name }} {{ $instructor->middle_name }} {{ $instructor->last_name }}
          <a href="{{ route('admin.teacher_list.assign_subject', ['instructorId' => $instructor->id]) }}" class="btn btn-primary float-right">Assign New Subject</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Subject Code</th>
                            <th>Description</th>
                            <th>Section</th>
                            <th>Term</th>
                            <th>Subject Type</th>
                            <th>Days</th>
                            <th>Time</th>
                            <th>Room</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($futureSubjects as $subject)
                            <tr>
                                <td>{{ $subject->subject->subject_code }}</td>
                                <td>{{ $subject->subject->description }}</td>
                                <td>{{ $subject->subject->section }}</td>
                                <td>{{ $subject->subject->term }}</td>
                                <td>{{ $subject->subject->subject_type }}</td>
                                <td>{{ $subject->days }}</td>
                                <td>{{ $subject->time }}</td>
                                <td>{{ $subject->room }}</td>
                                <td>
                                    <a href="{{ route('admin.teacher_list.edit_subject', ['instructorId' => $instructor->id, 'subjectId' => $subject->subject->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
     <input type="button" onclick="window.location.href='{{ url('admin/teacher_list/instructor_list') }}';" class="btn btn-info" value="Back" />    
</div>
@endsection