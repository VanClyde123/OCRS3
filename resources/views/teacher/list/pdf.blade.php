<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Subject Report</title>
    <style>
    body {
    font-family: Arial, sans-serif;
    font-size: 9px;
}

.table {
    table-layout: auto; /* Allow table to size based on content */
    border-collapse: collapse;
    margin: 20px 0;
    page-break-inside: auto;
    width: auto; /* Don't force 100% width */
}

.table th, .table td {
    border: 1px solid #000;
    padding: 1px 3px; /* Tighter spacing */
    text-align: left;
    white-space: nowrap; /* Prevent content from wrapping */
    vertical-align: top; /* Align content to the top */
}

.table th {
    background-color: #f2f2f2;
    font-weight: bold;
}

.table tr {
    page-break-inside: avoid;
    page-break-after: auto;
}

thead {
    display: table-header-group;
}
tfoot {
    display: table-footer-group;
}

.header {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 10px;
}

.legend {
    margin-top: 10px;
    width: auto;
    display: inline-block;
    font-size: 7px;
}

.legend-table {
    border-collapse: collapse;
    table-layout: auto;
    width: auto;
}

.legend-table td {
    border: 1px solid #000;
    padding: 1px 3px;
    white-space: nowrap;
    text-align: left;
}
</style>
</head>
<body>
<div class="header">
    <table style="width: 50%; border: 1px solid #000; border-collapse: collapse; margin-left: 0; font-size: 9px; line-height: 1;">
        
        <tbody>
            <tr>
                <td style="padding: 2px 4px; font-weight: bold; border: 1px solid #000;">Subject Code:</td>
                <td style="padding: 2px 4px; border: 1px solid #000;">{{ $subject->subject_code }}</td>
            </tr>
            <tr>
                <td style="padding: 2px 4px; font-weight: bold; border: 1px solid #000;">Days:</td>
                <td style="padding: 2px 4px; border: 1px solid #000;">{{ $subject->importedClasses->first()->days }}</td>
            </tr>
            <tr>
                <td style="padding: 2px 4px; font-weight: bold; border: 1px solid #000;">Time:</td>
                <td style="padding: 2px 4px; border: 1px solid #000;">{{ $subject->importedClasses->first()->time }}</td>
            </tr>
            <tr>
                <td style="padding: 2px 4px; font-weight: bold; border: 1px solid #000;">Term:</td>
                <td style="padding: 2px 4px; border: 1px solid #000;">{{ $subject->term }}</td>
            </tr>
            <tr>
                <td style="padding: 2px 4px; font-weight: bold; border: 1px solid #000;">Section:</td>
                <td style="padding: 2px 4px; border: 1px solid #000;">{{ $subject->section }}</td>
            </tr>
            <tr>
                <td style="padding: 2px 4px; font-weight: bold; border: 1px solid #000;">Instructor:</td>
                <td style="padding: 2px 4px; border: 1px solid #000;">
                    {{ $subject->importedClasses->first()->instructor->name }} 
                    {{ $subject->importedClasses->first()->instructor->middle_name }} 
                    {{ $subject->importedClasses->first()->instructor->last_name }}
                </td>
            </tr>
            <tr>
                <td style="padding: 2px 4px; font-weight: bold; border: 1px solid #000;">Room:</td>
                <td style="padding: 2px 4px; border: 1px solid #000;">{{ $subject->importedClasses->first()->room }}</td>
            </tr>
        </tbody>
    </table>
</div>


    @foreach ($chunkedAssessmentRows as $index => $chunkedRows)
    @if ($index > 0)
        <div style="page-break-before: always;"></div>
    @endif

    <table class="table">
        <thead>
         
        </thead>
        <tbody>
            @foreach ($chunkedRows as $row)
                <tr>
                    @foreach ($row as $cell)
                        <td>{{ $cell }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
@endforeach
    <!-- Legends -->
<div class="legend">
    <table class="legend-table">
        <tr><td>A</td><td>ABSENT</td></tr>
        <tr><td>E</td><td>EXCUSED</td></tr>
        <tr><td>Q</td><td>Quiz</td></tr>
        <tr><td>OT</td><td>OtherActivity</td></tr>
        <tr><td>E</td><td>Exam</td></tr>
        <tr><td>LA</td><td>Lab Activity</td></tr>
        <tr><td>LE</td><td>Lab Exam</td></tr>
        <tr><td>QB</td><td>Additional Total Quiz</td></tr>
        <tr><td>OTB</td><td>Additional Total OtherActivity</td></tr>
        <tr><td>EB</td><td>Additional Total Exam</td></tr>
        <tr><td>LB</td><td>Additional Total Lab Activity</td></tr>
        <tr><td>+FG</td><td>Direct Bonus to Final Grade</td></tr>
        <tr><td>TM</td><td>Tentative Midterm</td></tr>
        <tr><td>TF</td><td>Tentative Finals</td></tr>
        <tr><td>T</td><td>Total</td></tr>
    </table>
</div>


</body>
</html>
