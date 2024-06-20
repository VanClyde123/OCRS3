@extends('layouts.app')
   
@section('content')

    @php
        $header_title = "Imported Data";
    @endphp
    @push('scripts')
    <script>
            $(document).ready(function () {
            
            $('form').submit(function (e) {
                const selectedClassType = $('#subjectType').val();

                if (!selectedClassType) {
                
                    e.preventDefault();
                    alert('Select a class type.');
                } else {
                    $('#subjectTypeHidden').val(selectedClassType);
                }
            });
        });
    </script>
    @endpush
    <style>
            h2 {
                margin-bottom: 10px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
                font-size: 15px; 
            }

            th, td {
                border: 1px solid #ddd;
                padding: 6px; 
                text-align: left;
            }

            th {
                background-color: #f2f2f2;
            }
    </style>

    <div class="content-wrappers">
        <section class="content-header">
            <h2 class="mb-5"></h2>
        </section>
     <div class="alert {{ $message === 'The subject from the imported class list is present in the current course' ? 'alert-info' : 'alert-danger' }}">{{ $message }}</div>
        @include('messages')
        <section class="content">
            <div class="card">
                <div class="card-header">
                    Class List Data
                </div>
                <div class="card-body">
                    <div class="class-info">
                        <table class="class-info-table">
                            <tr>
                                <th>Term: </th>
                                <td>{{ $term }}</td>
                                <th>Days:</th>
                                <td>{{ $days }}</td>
                            </tr>
                            <tr>
                                <th>Section:</th>
                                <td>{{ $section }}</td>
                                <th>Time:</th>
                                <td>{{ $time }}</td>
                            </tr>
                            <tr>
                                <th>Subject Code:</th>
                                <td>{{ $subjectCode }}</td>
                                <th>Room:</th>
                                <td>{{ $room }}</td>
                            </tr>
                            <tr>
                                <th>Subject Description:</th>
                                <td colspan="3">{{ $subjectDescription }}</td>
                            </tr>
                        </table>


                    @php
                        $maleCount = 0;
                        $femaleCount = 0;
                        foreach ($maleStudentValues as $male_student) {
                            $maleCount++;
                        }
                        foreach ($femaleStudentValues as $female_student) {
                            $femaleCount++;
                        }
                    @endphp

                  
                    <p><b>Total Students:</b> {{ $maleCount + $femaleCount }} </br>
                    <b>Male:</b> {{ $maleCount }}
                    <b>Female:</b> {{ $femaleCount }}</p>

                    </div>
                   <div class="table-responsive">
                        <div class="student-lists">
                            <div class="male-students">
                                <p><b>Male Students:</b></p>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ID Number</th>
                                            <th>Name</th>
                                            <th>Middle Initial</th>
                                            <th>Last Name</th>
                                            <th>Course</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $maleCount = 1 @endphp 
                                        @foreach ($maleStudentValues as $male_student)
                                            <tr>
                                                <td>{{ $maleCount++ }}</td> 
                                                <td>{{ $male_student['id_number'] }}</td>
                                                <td>{{ $male_student['name'] }}</td>
                                                <td>{{ $male_student['middle_name'] }}</td>
                                                <td>{{ $male_student['last_name'] }}</td>
                                                <td>{{ $male_student['course'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="female-students">
                                <p><b>Female Students:</b></p>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ID Number</th>
                                            <th>Name</th>
                                            <th>Middle Initial</th>
                                            <th>Last Name</th>
                                            <th>Course</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $femaleCount = 1 @endphp 
                                        @foreach ($femaleStudentValues as $female_student)
                                            <tr>
                                                <td>{{ $femaleCount++ }}</td> 
                                                <td>{{ $female_student['id_number'] }}</td>
                                                <td>{{ $female_student['name'] }}</td>
                                                <td>{{ $female_student['middle_name'] }}</td>
                                                <td>{{ $female_student['last_name'] }}</td>
                                                <td>{{ $female_student['course'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="form-row mb-2">
                        <div class="col-md-2">
                            <div class="subject-type-select">
                                <label for="subjectType">Class Type:</label>
                                <select class="form-control" name="subject_type" id="subjectType" required>
                                    <option value="" disabled selected>--- Select Class Type ---</option>
                                    @foreach($subjectType as $type)
                                        <option value="{{ $type }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('save-data') }}" method="POST">
                        @csrf
                        <input type="hidden" name="section" value="{{ json_encode($section) }}">
                        <input type="hidden" name="subject_code" value="{{ json_encode($subjectCode) }}">
                        <input type="hidden" name="description" value="{{ json_encode($subjectDescription) }}">
                        <input type="hidden" name="term" value="{{ json_encode($term) }}">
                        <input type="hidden" name="days" value="{{ json_encode($days) }}">
                        <input type="hidden" name="time" value="{{ json_encode($time) }}">
                        <input type="hidden" name="room" value="{{ json_encode($room) }}">
                        <input type="hidden" name="subject_type" id="subjectTypeHidden">
                        <input type="hidden" name="male_student_values" value="{{ json_encode($maleStudentValues) }}">
                        <input type="hidden" name="female_student_values" value="{{ json_encode($femaleStudentValues) }}">
                        <button type="submit" class="btn btn-primary mt-3">Save</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection