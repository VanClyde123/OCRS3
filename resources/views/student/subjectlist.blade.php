@extends('layouts.app')

@section('content')
    <div class="content-wrappers">
        <section class="content-header">
            <h2>Enrolled Subjects</h2>
            <a href="{{ url('student/past_subjectlist/{studentId}')}}" class="btn btn-info">Past Subjects</a>
        </section>

        @include('messages')
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Enrolled Subjects</h3>
                </div>
                @if (empty($enrolledStudentSubjects))
                    <p>Subjects will not show since there is no active current semester set. Please contact the Admin or Secretary.</p>
                @else
                @if ($enrolledStudentSubjects->count() > 0)
                    <div class="card-body ">
                        <div>
                            <form action="{{ route('student.searchEnrolledSubjects') }}" method="GET" class="mb-2">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search by Subject Code, Description, Instructor, Days, Time, or Room">
                                    <div class="input-group-append">
                                        <button class="btn btn-info" type="submit">Search</button>
                                    </div>
                                </div>
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
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                               <tbody>
                                @foreach ($enrolledStudentSubjects as $enrolledSubject)
                                    @php
                                        $latestPublishedAssessment = $enrolledSubject->importedclasses->subject->latestPublishedAssessment();
                                        $hasNewPublishedScores = $latestPublishedAssessment && !$student->viewedAssessments->contains($latestPublishedAssessment);
                                    @endphp
                                    <tr>
                                        <td>
                                            @if ($hasNewPublishedScores)
                                                <i class="fas fa-bell text-warning" id="bell_{{ $enrolledSubject->importedclasses->subject->id }}"></i>
                                            @endif
                                            {{ $enrolledSubject->importedclasses->subject->subject_code }}
                                            
                                        </td>
                                        <td>{{ $enrolledSubject->importedclasses->subject->description }}</td>
                                        <td>{{ $enrolledSubject->importedclasses->instructor->name }} {{ $enrolledSubject->importedclasses->instructor->last_name }}</td>
                                        <td>{{ $enrolledSubject->importedclasses->days }}</td>
                                        <td>{{ $enrolledSubject->importedclasses->time }}</td>
                                        <td>{{ $enrolledSubject->importedclasses->room }}</td>
                                        <td>
                                            <a href="{{ route('student.scores.showscores', ['enrolledStudentId' => $enrolledSubject->id]) }}" class="btn btn-info view-scores-btn" data-assessment-id="{{ $latestPublishedAssessment ? $latestPublishedAssessment->id : '' }}">View Scores</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <p>Currently not enrolled in any subjects.</p>
                @endif
                    @endif
            </div>
        </section>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const viewScoresButtons = document.querySelectorAll('.view-scores-btn');
        viewScoresButtons.forEach(button => {
            button.addEventListener('click', function() {
               
                const bellId = button.dataset.bellId;
                const bellIcon = document.getElementById(`bell_${bellId}`);
                if (bellIcon) {
                    bellIcon.style.display = 'none'; 
                }
            });
        });
    });
</script>
@endsection