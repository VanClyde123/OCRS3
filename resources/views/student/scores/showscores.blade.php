@extends('layouts.app')

@section('content')
@php
        $header_title = "Records";
    @endphp
    @push('scripts')
        <script>
            $(document).ready(function () {
                $('.collapse').on('shown.bs.collapse', function () {
                    var activeCollapseId = $(this).attr('id');
                    $('#accordion button[data-target="#' + activeCollapseId + '"]').addClass('active');
                });

                $('.collapse').on('hidden.bs.collapse', function () {
                    var activeCollapseId = $(this).attr('id');
                    $('#accordion button[data-target="#' + activeCollapseId + '"]').removeClass('active');
                });

               
                $('.assessmentCollapse').on('shown.bs.collapse', function () {
                    var activeAssessmentCollapseId = $(this).attr('id');
                    $('#assessmentAccordion button[data-target="#' + activeAssessmentCollapseId + '"]').addClass('active');
                });

                $('.assessmentCollapse').on('hidden.bs.collapse', function () {
                    var activeAssessmentCollapseId = $(this).attr('id');
                    $('#assessmentAccordion button[data-target="#' + activeAssessmentCollapseId + '"]').removeClass('active');
                });
            });
        </script>
    @endpush
    <div class="content-wrappers">
        <section class="content-header" style="text-align: right;">
            <h2></h2>
            <input action="action" onclick="window.history.go(-1); return false;" type="submit" class="btn btn-info" value="Back to Subject List" />
        </section>
        <section class="content">
            @include('messages')
            <div class="card">
                 <div class="card-header">
                    <h3 class="card-title">Records</h3>
                </div>
                <div class="card-body">
                  
                    @if ($scores->isNotEmpty())
                        <div class="card-body ">
                            <div id="accordion">
                                @foreach($gradingPeriods as $gradingPeriod)
                                    <div class="card">
                                        <div class="card-header" id="heading{{ $loop->index }}">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $loop->index }}" aria-expanded="true" aria-controls="collapse{{ $loop->index }}">
                                                    <span class="font-size-lg font-weight-bold text-center">{{ $gradingPeriod }}</span>
                                                </button>
                                            </h5>
                                        </div>
                                        
                                        <div id="collapse{{ $loop->index }}" class="collapse" aria-labelledby="heading{{ $loop->index }}" data-parent="#accordion">
                                            <div class="card-body">
                                                <div id="assessmentAccordion{{ $loop->index }}">
                                                    @foreach($assessmentTypes as $assessmentType)
                                                          @if (
                                                                ($subjectType == 'Lec' && !in_array($assessmentType, ['Lab Activity', 'Lab Exam'])) ||
                                                                ($subjectType == 'Lab' && !in_array($assessmentType, ['Quiz', 'OtherActivity', 'Exam'])) ||
                                                                (str_starts_with($subjectType, 'LecLab'))
                                                            )
                                                        <div class="card">
                                                            <div class="card-header" id="assessmentHeading{{ $loop->parent->index }}{{ $loop->index }}">
                                                                <h5 class="mb-0">
                                                                    <button class="btn btn-link" data-toggle="collapse" data-target="#assessmentCollapse{{ $loop->parent->index }}{{ $loop->index }}" aria-expanded="true" aria-controls="assessmentCollapse{{ $loop->parent->index }}{{ $loop->index }}">
                                                                        <span class="font-size-lg font-weight-bold text-center">{{ $assessmentType }}</span>
                                                                    </button>
                                                                </h5>
                                                            </div>
                                                            <div id="assessmentCollapse{{ $loop->parent->index }}{{ $loop->index }}" class="collapse" aria-labelledby="assessmentHeading{{ $loop->parent->index }}{{ $loop->index }}" data-parent="#assessmentAccordion{{ $loop->parent->index }}">
                                                                <div class="card-body">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Assessment Description</th>
                                                                                <th>Date Taken</th>
                                                                                <th>Points</th>
                                                                                <th>Release Date</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach($scores as $score)
                                                                                @if ($score->assessment_id && $score->points !== null && $score->assessment->published && $score->assessment->grading_period === $gradingPeriod && $score->assessment->type === $assessmentType)
                                                                                    <tr>
                                                                                        <td>{{ $score->assessment->description }}</td>
                                                                                        <td>{{ $score->assessment->activity_date }}</td>
                                                                                        <td>{{ $score->points }}/{{ number_format($score->assessment->max_points, $score->assessment->max_points == intval($score->assessment->max_points) ? 0 : 2) }}</td>
                                                                                        <td>{{ $score->assessment->published_at ?? 'N/A' }}</td> 
                                                                                    </tr>
                                                                                @endif
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @endforeach

                                                    @foreach($scores as $score)
                                                    @if ($score->fg_grade !== null || $score->midterms_grade !== null || $score->finals_grade !== null)
                                                        <tr>
                                                            <td style="text-align: center;">
                                                                @if ($gradingPeriod == "First Grading" && $score->fg_grade !== null && $score->published)
                                                                    <strong style="display: block; text-align: center;">First Grading Grade: {{ $score->fg_grade }}</strong><br>
                                                                @endif

                                                                @if ($gradingPeriod == "Midterm" && $score->midterms_grade !== null && $score->published_midterms)
                                                                    <strong style="display: block; text-align: center;">Midterm Grade: {{ $score->midterms_grade }}</strong><br>
                                                                @endif

                                                                @if ($gradingPeriod == "Finals" && $score->finals_grade !== null && $score->published_finals)
                                                                    @if ($score->finals_status === 'DEFAULT')
                                                                        <strong style="display: block; text-align: center;">Final Grade: {{ $score->finals_grade }}</strong> 
                                                                    @else
                                                                        <strong style="display: block; text-align: center;">Final Grade: {{ $score->finals_status }}</strong> 
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            <td style="text-align: center;"></td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <p>No activity/ No scores recorded for you yet</p>
                    @endif
                </div>
            </div>
        </section>
    </div>

@endsection
