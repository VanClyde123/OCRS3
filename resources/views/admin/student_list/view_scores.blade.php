@extends('layouts.app')

@section('content')
@php
    $header_title = "Student Record";
@endphp

<section class="content-header" style="text-align: right;">
    <input onclick="window.history.go(-1); return false;" type="submit" class="btn btn-info" value="Back" />
</section>

<section class="content">
    @include('messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Score Records for {{ $student->last_name }}, {{ $student->name }} {{ $student->middle_name }} in {{ $subject->description }}
            </h3>
        </div>

        <div class="card-body">
            @if ($grades->isNotEmpty())
                @foreach ($grades->groupBy('assessment.grading_period') as $gradingPeriod => $gradesByGradingPeriod)
                    <div class="text-center mt-4 mb-2">
                        <h4 class="bg-primary text-white py-2 rounded">{{ $gradingPeriod }}</h4>
                    </div>

                    @php $hasScores = false; @endphp

                    @foreach ($gradesByGradingPeriod->groupBy('assessment.type') as $assessmentType => $gradesByAssessmentType)
                        @if ($gradesByAssessmentType->isNotEmpty())
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
                                    @foreach ($gradesByAssessmentType as $grade)
                                        <tr>
                                            <td>{{ $grade->assessment->description }}</td>
                                            <td>{{ $grade->assessment->activity_date ?? $grade->assessment->manual_activity_date }}</td>
                                            <td>{{ $grade->points }}/{{ number_format($grade->assessment->max_points, $grade->assessment->max_points == intval($grade->assessment->max_points) ? 0 : 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    @endforeach

                    @php
                        $gradeText = 'N/A';
                        foreach ($studentGrades as $score) {
                            if ($gradingPeriod === "First Grading" && $score->fg_grade !== null) {
                                $gradeText = $score->fg_grade;
                                break;
                            } elseif ($gradingPeriod === "Midterm" && $score->midterms_grade !== null) {
                                $gradeText = $score->midterms_grade;
                                break;
                            } elseif ($gradingPeriod === "Finals" && $score->finals_grade !== null) {
                                $gradeText = $score->finals_status === 'DEFAULT' ? $score->finals_grade : $score->finals_status;
                                break;
                            }
                        }
                    @endphp

                    @if ($hasScores)
                        <div class="text-center mb-4">
                            <strong>Grade: {{ $gradeText }}</strong>
                        </div>
                    @else
                        <p class="text-muted">No scores available for this grading period.</p>
                    @endif
                @endforeach
            @else
                <p>No activity or scores recorded yet.</p>
            @endif
        </div>
    </div>
</section>
@endsection
