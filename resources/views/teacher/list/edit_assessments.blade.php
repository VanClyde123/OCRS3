@extends('layouts.app')

@section('content')
   

    <div class="content-wrappers">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
            <div class="card">
                
            <div class="table-responsive">
                <div class="card-body container">
                    <h1>Assessments for {{ $subject->description }} </h1>
                    @include('messages')
                        
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
                            @foreach($assessments as $assessment)
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
</div>
</section>

<div class="container mt-3">
    <a href="{{ route('teacher.list.studentlist', ['subject' => $subject->id]) }}" class="btn btn-primary">Back</a>
</div>

</div>
@endsection

