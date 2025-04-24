@extends('layouts.app')

@section('content')
@php
        $header_title = "Instructor List";
    @endphp
<div class="content-wrappers">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2><br></h2>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-size: 1.75rem">List of Instructors</h3>
            </div>
            <div class="card-body">
                <div>
                    <form action="{{ route('secretary.searchInstructors') }}" method="GET" class="mb-2">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"  placeholder="Search by Last Name, First Name or Middle Name">
                            <div class="input-group-append">
                                <button class="btn btn-info" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
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
                                    <td>  <a href="{{ route('secretary.teacher_list.subjects', ['instructorId' => $instructor->id]) }}"class="btn btn-info">View Current Courses</a> <a href="{{ route('secretary.teacher_list.past_subjects', ['instructorId' => $instructor->id]) }}" class="btn btn-info">View Past Semester Courses</a>
                                        <a href="{{ route('secretary.teacher_list.future_subjects1', ['instructorId' => $instructor->id]) }}" class="btn btn-info">Set Next Semester Courses</a>
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

@endsection

