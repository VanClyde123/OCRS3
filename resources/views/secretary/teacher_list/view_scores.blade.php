@extends('layouts.app')  <!-- Assuming you have a master layout, modify accordingly -->

@section('content')
    <div class="content-wrappers">
        <section class="content-header">
            <div class="container-fluid">
                <div >
                    <h1>Scores and Grades for {{ $student->last_name }}, {{ $student->name }} {{ $student->middle_name }} </h1>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div >
                    @include('messages')  <!-- Include any flash messages or notifications here -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Assessment Scores</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Grading Period</th>
                                            <th>Assessment Type</th>
                                            <th>Description</th>
                                            <th>Points</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $grades = $grades->groupBy('assessment.grading_period');
                                        @endphp

                                        @foreach($grades as $gradingPeriod => $periodGrades)
                                        <h3>{{ $gradingPeriod }}</h3>

                                        @foreach($periodGrades as $grade)
                                            <tr>      <td>{{ $grade->assessment->grading_period }}</td>

                                            <td>{{ $grade->assessment->type }}</td>
                                            <td>{{ $grade->assessment->description }}</td>
                                            <td>{{ $grade->points }} / {{ $grade->assessment->max_points }}</td>
                                            </tr>
                                        @endforeach

                                        @endforeach
                                        @foreach($studentGrades as $score)
                                            @if ($score->fg_grade !== null || $score->midterms_grade !== null || $score->finals_grade !== null)
                                                <tr>
                                                    <td>
                                                        @if ($score->fg_grade !== null)
                                                            <strong>First Grading Grade:</strong> {{ $score->fg_grade }}<br>
                                                        @endif

                                                        @if ($score->midterms_grade !== null)
                                                            <strong>Midterm Grade:</strong> {{ $score->midterms_grade }}<br>
                                                        @endif

                                                        @if ($score->finals_grade !== null)
                                                            <strong>Finals Grade:</strong> {{ $score->finals_grade }}
                                                        @endif
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection