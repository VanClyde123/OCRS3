@extends('layouts.app')

@section('content')
@php
        $header_title = "Assessment List";
    @endphp
    <div class="content-wrappers">
        <section class="content-header" style="text-align: right;">
            <h2></h2>
           <input type="button" onclick="window.location.href='{{ route('teacher.list.studentlist', ['subject' => $subject]) }}';" class="btn btn-info" value="Back" />
        </section>
        @include('messages')
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Assessments for {{ $subject->subject_code}}| {{ $subject->description }} | {{ $subject->section }}</h3>
                </div>
                <div class="table-responsive">
                    <div class="card-body">
                        @php
                            $groupedAssessments = $assessments->groupBy('grading_period')->map(function ($group) {
                                return $group->groupBy('type');
                            });
                        @endphp

                        @foreach($groupedAssessments as $gradingPeriod => $types)
                            <h3>{{ $gradingPeriod }}</h3>
                            @foreach($types as $type => $assessments)
                                <h5><b>{{ $type }}</b></h5>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 20%">Description</th>
                                            <th style="width: 10%">Max Points</th>
                                            <th style="width: 20%">Activity Date</th>
                                            <th style="width: 10%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($assessments as $assessment)
                                            <tr>
                                                <td>{{ $assessment->description }}</td>
                                                <td>{{ number_format($assessment->max_points, 0) }}</td>
                                                <td>{{ $assessment->activity_date }}</td>
                                                <td>
                                                    <a href="{{ route('instructor.editSingleAssessment', ['assessmentId' => $assessment->id]) }}" class="btn btn-primary">Edit</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
