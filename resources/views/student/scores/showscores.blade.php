@extends('layouts.app')

@section('content')
@php
    $header_title = "Records";
@endphp

<section class="content-header" style="text-align: right;">
    <input onclick="window.history.go(-1); return false;" type="submit" class="btn btn-info" value="Back to Course List" />
</section>

<section class="content">
    @include('messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Score Records For {{ $subjectDetails->subject_code }} - {{ $subjectDetails->description }} </h3>
            <a href="{{ route('student.records.pdf', ['enrolledStudentId' => $enrolledStudentId]) }}" 
               class="btn btn-sm btn-success float-right"
               target="_blank">
              Download Records
            </a>
        </div>

        <div class="card-body">
            @if ($scores->isNotEmpty())
                @foreach ($gradingPeriods as $gradingPeriod)
                    <div class="text-center mt-4 mb-2">
                        <h4 class="bg-primary text-white py-2 rounded">{{ $gradingPeriod }}</h4>
                    </div>

                    @php $hasScores = false; @endphp

                    @foreach ($assessmentTypes as $assessmentType)
                        @php
                            $groupedScores = $scores->filter(function ($score) use ($gradingPeriod, $assessmentType) {
                                return $score->assessment_id &&
                                    $score->points !== null &&
                                    $score->assessment->published &&
                                    $score->assessment->grading_period === $gradingPeriod &&
                                    $score->assessment->type === $assessmentType;
                            });
                        @endphp

                        @if ($groupedScores->isNotEmpty())
                            @php $hasScores = true; @endphp

                            <h5 class="mt-3 mb-2 text-left text-secondary font-weight-bold border-bottom border-secondary">
                                {{ $assessmentType }}
                            </h5>

                            <table class="table table-bordered table-sm mb-3">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Assessment Description</th>
                                        <th>Assessment Date</th>
                                        <th>Score</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($groupedScores as $score)
                                        <tr>
                                            <td>{{ $score->assessment->description }}</td>
                                            <td>{{ $score->assessment->activity_date ?? $score->assessment->manual_activity_date }}</td>
                                            <td>{{ $score->points }}/{{ number_format($score->assessment->max_points, $score->assessment->max_points == intval($score->assessment->max_points) ? 0 : 2) }}</td>
                                           
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    @endforeach

                    @if ($hasScores)
                        <div class="text-center mb-4">
                            <strong>Grade:
                                @php
                                    $grade = 'N/A';
                                    foreach ($scores as $score) {
                                        if ($gradingPeriod === "First Grading" && $score->fg_grade !== null && $score->published) {
                                            $grade = $score->fg_grade;
                                            break;
                                        } elseif ($gradingPeriod === "Midterm" && $score->midterms_grade !== null && $score->published_midterms) {
                                            $grade = $score->midterms_grade;
                                            break;
                                        } elseif ($gradingPeriod === "Finals" && $score->finals_grade !== null && $score->published_finals) {
                                            $grade = $score->finals_status === 'DEFAULT' ? $score->finals_grade : $score->finals_status;
                                            break;
                                        }
                                    }
                                @endphp
                                {{ $grade }}
                            </strong>
                        </div>
                    @else
                        <p class="text-muted">No scores available for this grading period.</p>
                    @endif
                @endforeach
            @else
                <p>No activity or scores recorded for you yet.</p>
            @endif
        </div>
    </div>
</section>
@endsection
