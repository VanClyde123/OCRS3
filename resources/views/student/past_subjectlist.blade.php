@extends('layouts.app')

@section('content')
@php
        $header_title = "Past Semester Subjects";
    @endphp
    <div class="content-wrappers">
        <section class="content-header" style="text-align: right;">
            <h2></h2>
            <input action="action" onclick="window.history.go(-1); return false;" type="submit" class="btn btn-info" value="Back" />
        </section>
        @include('messages')
       <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Past Subjects</h3>
            </div>
            @if (empty($pastStudentSubjects))
                <p>Subjects will not show since there is no active current semester set. Please contact the Admin or Secretary.</p>
            @else
            @if ($pastStudentSubjects->count() > 0)
                <div class="card-body">
                    <div class="form-inline mb-2" style="justify-content: flex-start;">
                        <form action="{{ route('student.searchPastSubjects') }}" method="GET" class="mb-2 mr-2 form-inline">
                            <div class="form-group mr-2">
                                <input type="text" class="form-control" id="search" name="search" placeholder="Search by Subject Code, Description, Section, Instructor Name, Days, Time, or Room" size="50">
                            </div>
                            <button type="submit" class="btn btn-info mr-2">Search</button>
                        </form>

                        <div class="form-group mr-2">
                            <label for="semester" class="mr-2">Semester:</label>
                            <select id="semester" class="form-control" style="width: 170px;">
                                <option value="" disabled selected>--Select--</option>
                                <option value="">All</option>
                                <option value="First Semester">First Semester</option>
                                <option value="Second Semester">Second Semester</option>
                                <option value="Short Term">Short Term</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="school-year" class="mr-2">School Year:</label>
                            <select id="school-year" class="form-control" style="width: 180px;">
                                <option value="" disabled selected>--Select--</option>
                                <option value="">All</option>
                            </select>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Subject Code</th>
                                    <th>Subject Description</th>
                                    <th>Instructor</th>
                                    <th>Days</th>
                                    <th>Time</th>
                                    <th>Room</th>
                                    <th>Term</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="subject-table-body">
                                @foreach ($pastStudentSubjects as $enrolledSubject)
                                    <tr>
                                        <td>{{ $enrolledSubject->importedclasses->subject->subject_code }}</td>
                                        <td>{{ $enrolledSubject->importedclasses->subject->description }}</td>
                                        <td>{{ $enrolledSubject->importedclasses->instructor->name }} {{ $enrolledSubject->importedclasses->instructor->last_name }}</td>
                                        <td>{{ $enrolledSubject->importedclasses->days }}</td>
                                        <td>{{ $enrolledSubject->importedclasses->time }}</td>
                                        <td>{{ $enrolledSubject->importedclasses->room }}</td>
                                        <td>{{ $enrolledSubject->importedclasses->subject->term }}</td>
                                        <td>
                                            <a class="btn btn-info" href="{{ route('student.scores.showscores', ['enrolledStudentId' => $enrolledSubject->id]) }}">View Scores</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <p>No available past semester subjects.</p>
            @endif
            @endif
        </div>
    </section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const semesterDropdown = document.getElementById('semester');
    const schoolYearDropdown = document.getElementById('school-year');
    const tableBody = document.getElementById('subject-table-body');

    function generateSchoolYearOptions() {
        const currentYear = new Date().getFullYear();
        const startYear = 2020;

        while (schoolYearDropdown.options.length > 2) {
            schoolYearDropdown.remove(2);
        }

        for (let year = startYear; year <= currentYear; year++) {
            const option = document.createElement('option');
            option.value = `${year} - ${year + 1}`;
            option.textContent = `${year} - ${year + 1}`;
            schoolYearDropdown.appendChild(option);
        }

        schoolYearDropdown.selectedIndex = 0;
    }

    function filterSubjects() {
        const selectedSemester = semesterDropdown.value;
        const selectedSchoolYear = schoolYearDropdown.value;

        const rows = tableBody.querySelectorAll('tr');
        rows.forEach(row => {
            const term = row.cells[6].innerText.trim();
            const [semester, year] = term.split(', ');

            const matchSemester = !selectedSemester || semester === selectedSemester;
            const matchYear = !selectedSchoolYear || year.trim() === selectedSchoolYear.trim();

            if (matchSemester && matchYear) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    generateSchoolYearOptions();
    semesterDropdown.addEventListener('change', filterSubjects);
    schoolYearDropdown.addEventListener('change', filterSubjects);
});
</script>
    </div>
@endsection
