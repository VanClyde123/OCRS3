<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summary Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header-table { width: 100%; border: none; margin-bottom: 15px; }
        .header-table td { border: none; padding: 3px; }
        .filters-table {
        width: auto; 
        border-collapse: collapse;
        margin-bottom: 15px;
    }

        .filters-table td {
            padding: 5px 10px;
            border: none;
        }

                .filters-table td.label {
                    font-weight: bold;
                    white-space: nowrap;
                    text-align: left;
                }

                    .filters-table td.value {
                        text-align: left;
                    }
    </style>
</head>
<body>
    <h2>Summary Report</h2>
    <table class="filters-table">
        @if($school_year) <tr><td class="label">School Year:</td><td class="value">{{ $school_year }}</td></tr> @endif
        @if($term) <tr><td class="label">Term:</td><td class="value">{{ $term }}</td></tr> @endif
        @if($instructor) <tr><td class="label">Instructor:</td><td class="value">{{ $instructor }}</td></tr> @endif
        @if($subject) <tr><td class="label">Subject:</td><td class="value">{{ $subject }}</td></tr> @endif
        @if($section) <tr><td class="label">Section:</td><td class="value">{{ $section }}</td></tr> @endif
        @if($program) <tr><td class="label">Program:</td><td class="value">{{ $program }}</td></tr> @endif
    </table>


   <table>
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
</body>
</html>
