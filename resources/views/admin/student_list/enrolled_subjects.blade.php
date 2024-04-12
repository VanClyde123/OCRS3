@extends('layouts.app')

@section('content')
    <div class="content-wrappers">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        </section>

        <section class="content">
            <div class="container-fluid">
                <div> 
                    @include('messages')
                      <!-- Search form -->
                            <form action="{{ route('admin.searchEnrolledSubjects', ['studentId' => $student->id]) }}" method="GET" class="mb-3">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search by Subject Code, Description, or Section">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" type="submit">Search</button>
                                    </div>
                                </div>
                            </form>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Enrolled Subjects of {{ $student->last_name }}, {{ $student->name }} {{ $student->middle_name }}</h3>
                        </div>
                   
                        <div class="card-body p-0">
                          
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
                                                    <a href="{{ route('admin.viewGrades', ['studentId' => $student->id, 'subjectId' => $subject->id]) }}" class="btn btn-primary">View Scores and Grades</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                 @endif
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection