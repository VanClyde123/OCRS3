@extends('layouts.app')

@section('content')

<div class="content-wrappers">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <h3>Instructors</h3>
              <!-- Search form -->
            <form action="{{ route('secretary.searchInstructors') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control"  placeholder="Search by Last Name, First Name or Middle Name">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                             <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($instructors as $instructor)
                                        <tr>
                                        <td>{{ $instructor->name }}</td>
                                        <td>{{ $instructor->middle_name }}</td>
                                        <td>{{ $instructor->last_name }}</td>
                                        <td>  <a href="{{ route('secretary.teacher_list.subjects', ['instructorId' => $instructor->id]) }}"class="btn btn-info">View Current Subjects</a> <a href="{{ route('secretary.teacher_list.past_subjects', ['instructorId' => $instructor->id]) }}" class="btn btn-info">View Past Semester Subjects</a>
                                        </td>

                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

