@extends('layouts.app')

@section('content')
@php
        $header_title = "Semester List";
    @endphp
    <div class="content-wrappers">
        <!-- Content Header (Page header) -->
        <section class="content-header"  style="text-align: right;">
            <h2></h2>
            

            <a href="{{ route('semesters.create1') }}" class="btn btn-success">Add Semester</a>
        </section>
        <section class="content">
            <div class="card">
                @include('messages')
                  <div class="card-header">
                    <h3 class="card-title">Semester List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Semester</th>
                                    <th>School Year</th>
                                     <th>Active Semester</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semesters as $semester)
                                    <tr>
                                        <td>{{ $semester->id }}</td>
                                        <td>{{ $semester->semester_name }}</td>
                                        <td>{{ $semester->school_year }}</td>
                                        <td>{{ $semester->is_current ? 'Active' : '' }}</td>
                                        <td>
                                        <a href="{{ route('semesters.edit1', $semester->id) }}" class="btn btn-primary">Edit</a>
                                        <form action="{{ route('semesters.destroy1', $semester->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')" {{ $semester->is_current ? 'disabled' : '' }}>Delete</button>
                                         </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <input type="button" onclick="window.location.href='{{ url('secretary/set_semester/set_current') }}';" class="btn btn-info" value="Back" />
    </div>
@endsection

