@extends('layouts.app')

@section('content')
@php
        $header_title = "Description List";
    @endphp
    <div class="content-wrappers">
        <!-- Content Header (Page header) -->
        <section class="content-header">
           
            <div  style="text-align: left;">
                 <input type="button" onclick="window.location.href='{{ url('secretary/subject_descriptions') }}';" class="btn btn-info" value="Back" />
                <a href="{{ route('assessment-descriptions.create1', ['subjectDescId' => $subjectDescId]) }}" class="btn btn-success">Create New Description</a>
            </div>
        </section>
        @include('messages')
      <section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Assessment Descriptions for {{ $subjectDescription->subject_code }} | {{ $subjectDescription->subject_name }}</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @php
                    $groupedAssessmentDescriptions = $assessmentDescriptions->groupBy('grading_period');
                    $sortOrder = [
                        'First Grading', 
                        'Midterm',
                        'Finals'
                    ];   
                @endphp
                @foreach($sortOrder as $gradingPeriod)
                    @if($groupedAssessmentDescriptions->has($gradingPeriod))
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th colspan="3" style="text-align: center; font-size: 18px;">{{ $gradingPeriod }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($groupedAssessmentDescriptions[$gradingPeriod]->groupBy('type') as $type => $descriptions)
                                    <tr>
                                        <th colspan="3">{{ $type }}</th>
                                    </tr>
                                    @foreach($descriptions as $description)
                                        <tr>
                                            <td style="width: 50%">{{ $description->description }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                        <a href="{{ route('assessment-descriptions.edit1', $description->id) }}" class="btn btn-primary mr-2">Edit</a>
                                        <form action="{{ route('assessment-descriptions.destroy1', $description->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this description?')">Delete</button>
                                        </form>
                                   </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                @endforeach
                 @if($assessmentDescriptions->isEmpty())
                    <p>No assessment descriptions for this subject.</p>
                @endif
            </div>
        </div>
    </div>
</section>
    </div>
@endsection