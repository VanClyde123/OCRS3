@extends('layouts.app')

@section('content')
@php
    $header_title = "Student Records";
@endphp

<div class="content-wrappers">
    <section class="content-header" style="text-align: right;">
        <input action="action" onclick="window.history.go(-1); return false;" type="submit" class="btn btn-info" value="Back" />
    </section>

    <section class="content">
        @include('messages')

        <h3 class="mb-3">
            Records of {{ $student->last_name }}, {{ $student->name }} {{ $student->middle_name }} in {{ $subject->description }}
        </h3>

        @forelse($grades->groupBy('assessment.grading_period') as $gradingPeriod => $gradesByGradingPeriod)
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <strong>{{ $gradingPeriod }}</strong>
                </div>
                <div class="card-body">
                    @foreach($gradesByGradingPeriod->groupBy('assessment.type') as $assessmentType => $gradesByAssessmentType)
                        <h5 class="mt-3">{{ $assessmentType }}</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Date Taken</th>
                                    <th>Points</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($gradesByAssessmentType as $grade)
                                    <tr>
                                        <td>{{ $grade->assessment->description }}</td>
                                        <td>{{ $grade->assessment->activity_date ?? $grade->assessment->manual_activity_date }}</td>
                                        <td>{{ $grade->points }} / {{ number_format($grade->assessment->max_points, $grade->assessment->max_points == intval($grade->assessment->max_points) ? 0 : 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach

                    @foreach($studentGrades as $score)
                        @if ($score->fg_grade !== null || $score->midterms_grade !== null || $score->finals_grade !== null)
                            <div class="mt-3">
                                @if ($gradingPeriod == "First Grading" && $score->fg_grade !== null )
                                    <strong>First Grading Grade:</strong> {{ $score->fg_grade }}
                                @endif

                                @if ($gradingPeriod == "Midterm" && $score->midterms_grade !== null )
                                    <strong>Midterm Grade:</strong> {{ $score->midterms_grade }}
                                @endif

                                @if ($gradingPeriod == "Finals" &&  $score->finals_grade !== null )
                                    <strong>Finals Grade:</strong> {{ $score->finals_grade }}
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @empty
            <div class="card">
                <div class="card-body">
                    <p>No activity recorded yet.</p>
                </div>
            </div>
        @endforelse
    </section>
</div>
@endsection
