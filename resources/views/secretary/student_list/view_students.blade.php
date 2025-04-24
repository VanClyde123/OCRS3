@extends('layouts.app')

@section('content')

@php
        $header_title = "Student List";
    @endphp
    <div class="content-wrappers">
        <section class="content-header">
            
          <h2><br></h2>
            
        </section>

        @include('messages')
        <section class="content">
            <div class="card">
                 <div class="card-header" style="font-size: 1.75rem">
                    Student List
                </div>
                <div class="card-body ">
                    <div>
                           <div id="reset-message" class="mb-2" style="display: none;">
                                <a href="{{ url('secretary/student_list/view_students')}}" class="btn btn-warning btn-sm">Click here to reset</a>
                            </div>
                        <form action="{{ route('secretary.searchStudents1') }}" method="GET" class="mb-2">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search by ID Number, Last Name, First Name or Middle Name">
                                <div class="input-group-append">
                                    <button class="btn btn-info" type="submit">Search</button>
                                </div>
                            </div>
                        </form>

                        <div class="alphabet-filter mt-3">
                            <a href="#" class="btn btn-outline-info mr-2 alphabet-link" data-letter="All" style="font-size: 12px; padding: 5px 7px;">All</a>
                            @foreach(range('A', 'Z') as $letter)
                                <a href="#" class="btn btn-outline-info mr-2 alphabet-link" data-letter="{{ $letter }}" style="font-size: 12px; padding: 5px 9.5px;">{{ $letter }}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID Number</th>
                                    <th>Last Name</th>
                                    <th>Name</th>
                                    <th>Middle Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td>{{ $student->id_number }}</td>
                                        <td>{{ $student->last_name }}</td>  
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->middle_name }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('admin.viewEnrolledSubjects', ['studentId' => $student->id]) }}" class="btn btn-info">View Enrolled Subjects</a>
                                                <a href="{{ route('admin.viewPastEnrolledSubjects', ['studentId' => $student->id]) }}" class="btn btn-info">View Past Semester Subjects</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <style>
        .alphabet-link {
            font-size: 14px; 
            padding: 5px 10px; 
        }

          .btn-group {
            display: flex; 
            gap: 5px; 
        }
    </style>

    <script>
       $(document).ready(function() {
        if ("{{ request()->search }}") {
            $('#reset-message').show();
            $('.alphabet-filter').hide();
        }
        $('.alphabet-link').on('click', function(e) {
            e.preventDefault();
            const selectedLetter = $(this).data('letter').toUpperCase();

            $('tbody tr').each(function() {
                const lastName = $(this).find('td:nth-child(2)').text().trim();
                if (selectedLetter === 'ALL' || lastName.startsWith(selectedLetter)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
 </script>
@endsection