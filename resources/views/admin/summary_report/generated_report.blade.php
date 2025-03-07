@extends('layouts.app')

@section('content')
<div class="container">

    <style>
         
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid black;
        padding: 5px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }

</style>
    <h2>Summary Report</h2>

    <div class="mb-3">
       
        <ul>
            @if($schoolYear) <li><strong>School Year:</strong> {{ $schoolYear }}</li> @endif
            @if($term) <li><strong>Term:</strong> {{ $term }}</li> @endif
            @if($instructor) <li><strong>Instructor:</strong> {{ $instructor }}</li> @endif
            @if($subject) <li><strong>Subject:</strong> {{ $subject }}</li> @endif
            @if($section) <li><strong>Section:</strong> {{ $section }}</li> @endif
            @if($program) <li><strong>Program:</strong> {{ $program }}</li> @endif 
        </ul>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                @if(!$term) <th>Term</th> @endif
                @if(!$instructor) <th>Instructor</th> @endif
                <th>Subject</th>
                @if($section) <th>Section</th> @endif
                @if($program) <th>Program</th> @endif 
                <th>Total Enrolled</th>
                <th>Passed %</th>
                <th>Failed %</th>
                <th>Dropped %</th>
                <th>INC + NFE %</th>
                <th>Other %</th>
            </tr>
        </thead>
       <tbody>
       @if($program) 
        @foreach($programTotals as $totals)
            <tr>
                @if(!$term) <td colspan="2"></td> @endif
                @if(!$instructor) <td colspan="2"></td> @endif
                <td>{{ $totals['subject'] }}</td> 
                <td>{{ $totals['section'] }}</td> 
                <td>{{ $program }}</td> 
                <td>{{ $totals['total_students'] }}</td>
                <td>{{ $totals['passed_percentage'] }}%</td>
                <td>{{ $totals['failed_percentage'] }}%</td>
                <td>{{ $totals['dropped_percentage'] }}%</td>
                <td>{{ $totals['inc_nfe_percentage'] }}%</td>
                <td>{{ $totals['others_percentage'] }}%</td>
            </tr>
        @endforeach
    @else
        @if($section)
            @foreach($results as $record)
                <tr>
                    @if(!$term) <td>{{ $record->subject->term }}</td> @endif
                    @if(!$instructor) <td>{{ $record->instructor->name }}</td> @endif
                    <td>{{ $record->subject->subject_code }}</td>
                    <td>{{ $record->subject->section }}</td>
                    <td>{{ $record->enrolled_students_count }}</td>
                    <td>{{ $record->passed_percentage }}%</td>
                    <td>{{ $record->failed_percentage }}%</td>
                    <td>{{ $record->dropped_percentage }}%</td>
                    <td>{{ $record->inc_nfe_percentage }}%</td>
                    <td>{{ $record->others_percentage }}%</td>
                </tr>
            @endforeach
        @else
            @foreach($groupedResults as $group)
                <tr>
                    @if(!$term) <td>{{ $group['term'] }}</td> @endif
                    @if(!$instructor) <td>{{ $group['instructor'] }}</td> @endif
                    <td>{{ $group['subject'] }}</td>
                    <td>{{ $group['total_students'] }}</td>
                    <td>{{ $group['passed_percentage'] }}%</td>
                    <td>{{ $group['failed_percentage'] }}%</td>
                    <td>{{ $group['dropped_percentage'] }}%</td>
                    <td>{{ $group['inc_nfe_percentage'] }}%</td>
                    <td>{{ $group['others_percentage'] }}%</td>
                </tr>
            @endforeach
        @endif
    @endif
</tbody>
    </table>
</div>
@endsection