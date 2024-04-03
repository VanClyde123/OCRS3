 @extends('layouts.app')
   
@section('content')
  <div class="content-wrappers">
        <section class="content-header">
        <div class="container-fluid">
            <div >
                <h3 >Previously Enrolled Subjects</h3>
            </div>
        </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                @include('messages')
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

 