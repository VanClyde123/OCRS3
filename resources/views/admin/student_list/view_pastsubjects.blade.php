@extends('layouts.app')

@section('content')
@php
        $header_title = "Past Semester Subjects";
    @endphp
    <div class="content-wrappers">
       
        <section class="content-header" style="text-align: right;">
            <h2></h2>
            <input action="action" onclick="window.history.go(-1); return false;" type="submit" class="btn btn-info" value="Back to Student List" />
        </section>
        <section class="content">
            @include('messages')
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Past Semester Subjects of {{ $student->last_name }}, {{ $student->name }} {{ $student->middle_name }}</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                         <div class="form-inline" style="justify-content: flex-start;">
                            <form action="{{ route('admin.viewPastEnrolledSubjects', ['studentId' => $student->id]) }}" method="GET" class="mb-2 mr-2 form-inline">
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

                            <!-- School Year Dropdown -->
                            <div class="form-group">
                                <label for="school-year" class="mr-2">School Year:</label>
                                <select id="school-year" class="form-control" style="width: 180px;">
                                    <option value="" disabled selected>--Select--</option>
                                    <option value="">All</option>
                                </select>
                            </div>
                        </div>
                        @if (empty($pastEnrolledSubjects))
                            <p>Subjects will not show since there is no active semester set. Please set a semester.</p>
                        @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Subject Code</th>
                                        <th>Description</th>
                                        <th>Section</th>
                                        <th>Term</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="subject-table-body">
                                    @foreach($pastEnrolledSubjects as $subject)
                                        <tr>
                                            <td>{{ $subject->subject_code }}</td>
                                            <td>{{ $subject->description }}</td>
                                            <td>{{ $subject->section }}</td>
                                            <td>{{ $subject->term }}</td>
                                            <td>
                                                <a href="{{ route('admin.viewGrades', ['studentId' => $student->id, 'subjectId' => $subject->id]) }}" class="btn btn-info">
                                                    View Scores and Grades
                                                </a>
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