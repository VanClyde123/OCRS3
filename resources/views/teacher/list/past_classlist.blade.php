@extends('layouts.app')

@section('content')
    <div class="content-wrappers">
        <section class="content-header" style="text-align: right;">
            <h2></h2>
            <input action="action" onclick="window.history.go(-1); return false;" type="submit" class="btn btn-info" value="Back to Subject List" /> 
        </section>
        @include('messages')
       <section class="content">
            <div class="card">
                <div class="card-header">
                    Past Subject List
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="form-inline mb-2" style="justify-content: flex-start;">
                            <form action="{{ route('teacher.searchPastSubjects') }}" method="GET" class="mb-2 mr-2 form-inline">
                                <div class="form-group mr-2">
                                    <input type="text" class="form-control" id="search" name="search" placeholder="Search by Subject Code, Description, Section, Days, Time, or Room" size="50">
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
                        
                        @if (empty($subjects))
                            <p>Past subjects will not show since there is no active current semester set. Please contact the Admin or Secretary.</p>
                        @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Subject Code</th>
                                        <th>Subject Description</th>
                                        <th>Section</th>
                                        <th>Days</th>
                                        <th>Time</th>
                                        <th>Room</th>
                                        <th>Term</th>
                                        <th>Class Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="subject-table-body">
                                    @foreach ($subjects as $subject)
                                        <tr>
                                            <td>{{ $subject->subject_code }}</td>
                                            <td>{{ $subject->description }}</td>
                                            <td>{{ $subject->section }}</td>
                                            <td>{{ $subject->importedClasses->first()->days }}</td>
                                            <td>{{ $subject->importedClasses->first()->time }}</td>
                                            <td>{{ $subject->importedClasses->first()->room }}</td>
                                            <td>{{ $subject->term }}</td>
                                            <td>
                                                <form action="{{ route('teacher.update.subject.type', ['subject' => $subject]) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="subject_type" class="form-control" disabled>
                                                        @foreach ($subjectTypes as $type)
                                                            <option value="{{ $type }}" {{ $subject->subject_type === $type ? 'selected' : '' }}>
                                                                {{ $type }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="{{ route('teacher.list.studentlist', ['subject' => $subject]) }}" class="btn btn-info mt-2">View Students</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>

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
@endsection