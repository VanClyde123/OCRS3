@extends('layouts.app')

@section('content')

    <div class="content-wrappers">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <h3>Subjects Taught by {{ $instructor->name }} {{ $instructor->middle_name }} {{ $instructor->last_name }}</h3>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Subject Name</th>
                                        <th>Subject Code</th>
                                        <th>Section</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subjects as $subject)
                                        <tr>
                                        <td>{{ $subject->subject->description }}</td>
                                        <td>{{ $subject->subject->subject_code }}</td>
                                         <td>{{ $subject->subject->section }}</td>
                                        <td>  <a href="{{ route('secretary.teacher_list.enrolled_students', ['subject' => $subject->subject->id]) }}"class="btn btn-info">View Enrolled Students</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

 