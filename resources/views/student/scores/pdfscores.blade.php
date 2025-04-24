<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Score Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .subject-details {
            font-weight: bold;
            margin-bottom: 15px;
        }
        .subject-details p {
            margin: 2px 0;
        }
        .period-title {
            font-weight: bold;
            text-align: center;
            margin-bottom: 5px;
        }
        table.outer {
            width: 100%;
            table-layout: fixed;
        }
        table.outer td {
            vertical-align: top;
            padding: 5px;
            width: 33%;
        }
        table.inner {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        table.inner th, table.inner td {
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
        }
        .assessment-type {
            font-weight: bold;
            margin-top: 10px;
        }
        .grade-section {
            font-weight: bold;
            text-align: center;
            margin-top: 10px;
        }
        .no-scores {
            color: #777;
            text-align: center;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Student Records Report</h2>
    </div>

     @if ($subjectDetails)
            <table style="border-collapse: collapse; font-size: 11px; margin-bottom: 20px; margin-left: 0; width: auto;">
                <tr>
                    <td style="border: 1px solid #000; padding: 4px;"><strong>Subject Code:</strong></td>
                    <td style="border: 1px solid #000; padding: 4px;">{{ $subjectDetails->subject_code }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 4px;"><strong>Subject Description:</strong></td>
                    <td style="border: 1px solid #000; padding: 4px;">{{ $subjectDetails->description }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 4px;"><strong>Instructor Name:</strong></td>
                    <td style="border: 1px solid #000; padding: 4px;">{{ $instructorFullName }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 4px;"><strong>Days:</strong></td>
                    <td style="border: 1px solid #000; padding: 4px;">{{ $subjectDetails->days }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 4px;"><strong>Time:</strong></td>
                    <td style="border: 1px solid #000; padding: 4px;">{{ $subjectDetails->time }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 4px;"><strong>Room:</strong></td>
                    <td style="border: 1px solid #000; padding: 4px;">{{ $subjectDetails->room }}</td>
                </tr>
            </table>
        @endif



    @if ($scores->isNotEmpty())
        <table class="outer">
            <tr>
                @foreach ($gradingPeriods as $gradingPeriod)
                    <td>
                        <div class="period-title">{{ $gradingPeriod }}</div>

                        @php $hasScores = false; @endphp

                        @foreach ($assessmentTypes as $assessmentType)
                            @php
                                $groupedScores = $scores->filter(function ($score) use ($gradingPeriod, $assessmentType) {
                                    return $score->assessment_id &&
                                        $score->points !== null &&
                                        $score->assessment->published &&
                                        $score->assessment->grading_period === $gradingPeriod &&
                                        $score->assessment->type === $assessmentType;
                                });
                            @endphp

                            @if ($groupedScores->isNotEmpty())
                                @php $hasScores = true; @endphp

                                <table class="inner">
                                    <thead>
                                        <tr>
                                            <th colspan="3" style="text-align: center;">{{ $assessmentType }}</th>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>Score</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($groupedScores as $score)
                                            <tr>
                                                <td>{{ $score->assessment->description }}</td>
                                                <td>{{ $score->assessment->activity_date ?? $score->assessment->manual_activity_date }}</td>
                                                <td>{{ $score->points }}/{{ number_format($score->assessment->max_points, $score->assessment->max_points == intval($score->assessment->max_points) ? 0 : 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        @endforeach

                        @if ($hasScores)
                            <div class="grade-section">
                                Grade:
                                @php
                                    $grade = 'N/A';
                                    foreach ($scores as $score) {
                                        if ($gradingPeriod === "First Grading" && $score->fg_grade !== null && $score->published) {
                                            $grade = $score->fg_grade;
                                            break;
                                        } elseif ($gradingPeriod === "Midterm" && $score->midterms_grade !== null && $score->published_midterms) {
                                            $grade = $score->midterms_grade;
                                            break;
                                        } elseif ($gradingPeriod === "Finals" && $score->finals_grade !== null && $score->published_finals) {
                                            $grade = $score->finals_status === 'DEFAULT' ? $score->finals_grade : $score->finals_status;
                                            break;
                                        }
                                    }
                                @endphp
                                {{ $grade }}
                            </div>
                        @else
                            <div class="no-scores">No scores available.</div>
                        @endif
                    </td>
                @endforeach
            </tr>
        </table>
    @else
        <p class="no-scores">No activity or scores recorded for you yet.</p>
    @endif
</body>
</html>
