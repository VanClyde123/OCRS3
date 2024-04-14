@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Subject Descriptions</h1>
        <a href="{{ route('subject_descriptions.create1') }}" class="btn btn-primary mb-2">Create New Subject Description</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subjectDescriptions as $subjectDescription)
                    <tr>
                        <td>{{ $subjectDescription->id }}</td>
                        <td>{{ $subjectDescription->subject_code }}</td>
                        <td>{{ $subjectDescription->subject_name }}</td>
                        <td>
                             <a href="{{ route('assessment_descriptions.view1', $subjectDescription->id) }}" class="btn btn-primary">View Assessments Descriptions</a>
                            <a href="{{ route('subject_descriptions.edit1', $subjectDescription->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('subject_descriptions.destroy1', $subjectDescription->id) }}" method="POST" style="display: inline;">
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
@endsection