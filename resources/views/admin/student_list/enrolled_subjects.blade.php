@extends('layouts.app')

@section('content')
    <div class="content-wrappers">
        <!-- Content Header (Page header) -->
        <section class="content-header">

        </section>

        <section class="content">
            @include('messages')
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Enrolled Subjects of {{ $student->last_name }}, {{ $student->name }} {{ $student->middle_name }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body ">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Subject Code</th>
                                    <th>Description</th>
                                    <th>Section</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($enrolledSubjects as $subject)
                                    <tr>
                                        <td>{{ $subject->subject_code }}</td>
                                        <td>{{ $subject->description }}</td>
                                        <td>{{ $subject->section }}</td>
                                        <td>
                                        <a href="{{ route('admin.viewGrades', ['studentId' => $student->id, 'subjectId' => $subject->id]) }}" class="btn btn-primary">View Scores and Grades</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </section>
    </div>
@endsection