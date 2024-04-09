 @extends('layouts.app')
   
@section('content')
    <div class="content-wrappers">
        <section class="content-header">
            <div class="container-fluid">
                <a href="{{ url('student/past_subjectlist/{studentId}')}}" class="btn btn-primary">Past Subjects</a>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div> 
                    @include('messages')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Enrolled Subjects</h3>
                        </div>
                        @if ($enrolledStudentSubjects->count() > 0)
                            <div class="card-body ">
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
                                                <th>Action</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($enrolledStudentSubjects as $enrolledSubject)
                                                <tr>
                                                    <td>{{ $enrolledSubject->importedclasses->subject->subject_code }}</td>
                                                    <td>{{ $enrolledSubject->importedclasses->subject->description }}</td>
                                                    <td>{{ $enrolledSubject->importedclasses->instructor->name }} {{ $enrolledSubject->importedclasses->instructor->last_name }}</td>
                                                    <td>{{ $enrolledSubject->importedclasses->days }}</td>
                                                    <td>{{ $enrolledSubject->importedclasses->time }}</td>
                                                    <td>{{ $enrolledSubject->importedclasses->room }}</td>
                                                    <td><a href="{{ route('student.scores.showscores', ['enrolledStudentId' => $enrolledSubject->id]) }}" class="btn btn-primary">View Scores</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @else
                            <p>currently not enrolled in any subjects.</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

 