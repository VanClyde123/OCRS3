@extends('layouts.app')

@section('content')
@php
        $header_title = "Past Semester Subjects";
    @endphp
    <div class="content-wrappers">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h2><br></h2>
           
        </section>
       <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Past Courses Taught by {{ $instructor->name }} {{ $instructor->middle_name }} {{ $instructor->last_name }}</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="form-inline" style="justify-content: flex-start;">
                            <form action="{{ route('admin.searchPastInstructorSubjects', ['instructorId' => $instructor->id]) }}" method="GET" class="mb-2 mr-2 form-inline">
                                <div class="form-group mr-2">
                                    <label for="search" class="mr-2">Subject:</label>
                                    <input type="text" class="form-control" id="search" name="search" placeholder="Search by Subject Code, Description, or Section" size="40">
                                </div>
                                <button type="submit" class="btn btn-info mr-2">Search</button>
                            </form>
                            <div class="form-group mr-2">
                                <label for="semester" class="mr-2">Semester:</label>
                                <select id="semester" class="form-control" style="width: 180px;">
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
                        
                        @if (empty($pastSubjects))
                            <p>Subjects will not show since there is no active semester set. Please set a semester.</p>
                        @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                         <th>Subject Code</th>
                                        <th>Description</th>
                                       
                                        <th>Section</th>
                                        <th>Term</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="subject-table-body">
                                    @foreach($pastSubjects as $subject)
                                        <tr>
                                             <td>{{ $subject->subject->subject_code }}</td>
                                            <td>{{ $subject->subject->description }}</td>
                                           
                                            <td>{{ $subject->subject->section }}</td>
                                            <td>{{ $subject->subject->term }}</td>
                                            <td>
                                                <a href="{{ route('admin.teacher_list.enrolled_students', ['subject' => $subject->subject->id]) }}" class="btn btn-info">View Enrolled Students</a>
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
        <input type="button" onclick="window.location.href='{{ url('admin/teacher_list/instructor_list') }}';" class="btn btn-info" value="Back" />
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
                    const term = row.cells[3].innerText.trim();
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