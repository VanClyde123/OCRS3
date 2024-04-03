@extends('layouts.app')

@section('content')

    <div class="content-wrappers">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h2>Semesters</h2>
            <div  style="text-align: left;">
                <a href="{{ route('semesters.create') }}" class="btn btn-success">Add Semester</a>
            </div>
        </section>
        <section class="content">
            <div class="card">
                @include('messages')
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Semester</th>
                                    <th>School Year</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semesters as $semester)
                                    <tr>
                                        <td>{{ $semester->id }}</td>
                                        <td>{{ $semester->semester_name }}</td>
                                        <td>{{ $semester->school_year }}</td>
                                        <td>
                                            <a href="{{ route('semesters.edit', $semester->id) }}" class="btn btn-primary">Edit</a>
                                            <form action="{{ route('semesters.destroy', $semester->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
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
    </div>
@endsection
