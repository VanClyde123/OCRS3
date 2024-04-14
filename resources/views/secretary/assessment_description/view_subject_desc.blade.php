@extends('layouts.app')

@section('content')
    <div class="content-wrappers">
        <section class="content-header">
            <h2>Subject Descriptions</h2>
            <a href="{{ route('subject_descriptions.create1') }}" class="btn btn-success">Create New Subject Description</a>
        </section>
        @include('messages')
        <section class="content">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
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
                </div>
            </div>
        </section>
    </div>
@endsection