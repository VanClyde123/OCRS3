@extends('layouts.app')

@section('content')
    <div class="content-wrappers">
        <section class="content-header">
            <h2>Assessments for {{ $subject->description }} </h2>
        </section>
        <div>
            <a href="{{ route('teacher.list.studentlist', ['subject' => $subject->id]) }}" class="btn btn-info">Back</a>
            <br><br>
        </div>
        @include('messages')
        <section class="content">
            <div class="card">
                <div class="table-responsive">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Grading Period</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Max Points</th>
                                    <th>Activity Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assessments->sortBy('grading_period') as $assessment)
                                    <tr>
                                        <td>{{ $assessment->grading_period }}</td>
                                        <td>{{ $assessment->type }}</td>
                                        <td>{{ $assessment->description }}</td>
                                        <td>{{ number_format($assessment->max_points, 0) }}</td>
                                        <td>{{ $assessment->activity_date }}</td>
                                        <td>
                                        <a href="{{ route('instructor.editSingleAssessment', ['assessmentId' => $assessment->id]) }}"  class="btn btn-primary">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>



    </div>
@endsection

