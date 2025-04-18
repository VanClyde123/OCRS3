@extends('layouts.app')

@section('content')
@php
        $header_title = "Instructor List";
    @endphp
    <div class="content-wrappers">
        <section class="content-header">
            <h2><br></h2>
        </section>
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Instructor List</h3>
                    <div style="text-align: right;">
                          <a href="{{ url('admin/summary_report/reports') }}" class="btn btn-primary">Summary Report</a>
                        <a href="{{ route('grade-ceiling.edit') }}" class="btn  btn-success">Grade Ceiling Settings</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.searchInstructors') }}" method="GET" class="mb-2">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search by Last Name, First Name or Middle Name">
                            <div class="input-group-append">
                                <button class="btn btn-info" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
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
                                @foreach($instructors->sortBy('name') as $instructor)
                                    <tr>
                                    <td>{{ $instructor->name }}</td>
                                    <td>{{ $instructor->middle_name }}</td>
                                    <td>{{ $instructor->last_name }}</td>
                                    <td>  
                                        <a href="{{ route('admin.teacher_list.subjects', ['instructorId' => $instructor->id]) }}"class="btn btn-info">View Current Subjects</a> <a href="{{ route('admin.teacher_list.past_subjects', ['instructorId' => $instructor->id]) }}" class="btn btn-info">View Past Semester Subjects</a>
                                       <a href="{{ route('admin.teacher_list.future_subjects', ['instructorId' => $instructor->id]) }}" class="btn btn-info">Set Next Semester Subjects</a>
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

