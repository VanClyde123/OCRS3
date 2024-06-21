@extends('layouts.app')

@section('content')
@php
        $header_title = "Student Records";
    @endphp
    <div class="content-wrappers">
        <section class="content-header" style="text-align: right;">
            <h2></h2>
            <input action="action" onclick="window.history.go(-1); return false;" type="submit" class="btn btn-info" value="Back" /> 
        
        </section>

        <section class="content">
            @include('messages')
            <div class="accordion" id="accordionExample">
                @foreach($grades->groupBy('assessment.grading_period') as $gradingPeriod => $gradesByGradingPeriod)
                    <div class="card">
                        <div class="card-header" id="heading{{ $loop->index }}">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ $loop->index }}" aria-expanded="true" aria-controls="collapse{{ $loop->index }}">
                                    {{ $gradingPeriod }}
                                </button>
                            </h2>
                        </div>

                        <div id="collapse{{ $loop->index }}" class="collapse" aria-labelledby="heading{{ $loop->index }}" data-parent="#accordionExample">
                            <div class="card-header">
                                <h3 class="card-title">Records of {{ $student->last_name }}, {{ $student->name }} {{ $student->middle_name }} in {{ $subject->description }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="accordion" id="assessmentAccordion{{ $loop->index }}">
                                    @foreach($gradesByGradingPeriod->groupBy('assessment.type') as $assessmentType => $gradesByAssessmentType)
                                        <div class="card">
                                            <div class="card-header" id="assessmentHeading{{ $loop->parent->index }}{{ $loop->index }}">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" data-toggle="collapse" data-target="#assessmentCollapse{{ $loop->parent->index }}{{ $loop->index }}" aria-expanded="true" aria-controls="assessmentCollapse{{ $loop->parent->index }}{{ $loop->index }}">
                                                        {{ $assessmentType }}
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="assessmentCollapse{{ $loop->parent->index }}{{ $loop->index }}" class="collapse" aria-labelledby="assessmentHeading{{ $loop->parent->index }}{{ $loop->index }}" data-parent="#assessmentAccordion{{ $loop->parent->index }}">
                                                <div class="card-body">
                                                    <table class="table table-striped">
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
                                                                <td>{{ $grade->assessment->activity_date }}</td>
                                                                <td>{{ $grade->points }} / {{ number_format($grade->assessment->max_points, $grade->assessment->max_points == intval($grade->assessment->max_points) ? 0 : 2) }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @foreach($studentGrades as $score)
                                        @if ($score->fg_grade !== null || $score->midterms_grade !== null || $score->finals_grade !== null)
                                            <tr>
                                                <td>
                                                        @if ($gradingPeriod == "First Grading" && $score->fg_grade !== null )
                                                        <strong>First Grading Grade:</strong> {{ $score->fg_grade }}<br>
                                                        @endif

                                                        @if ($gradingPeriod == "Midterm" && $score->midterms_grade !== null )
                                                            <strong>Midterm Grade:</strong> {{ $score->midterms_grade }}<br>
                                                        @endif

                                                        @if ($gradingPeriod == "Finals" &&  $score->finals_grade !== null )
                                                            <strong>Finals Grade:</strong> {{ $score->finals_grade }}
                                                        @endif
                                                </td>
                                                <td></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                  @if(!$grades->groupBy('assessment.grading_period')->isNotEmpty())
                    <div class="card">
                        <div class="card-body">
                            <p>No activity recorded yet.</p>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection