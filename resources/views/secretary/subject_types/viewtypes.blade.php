@extends('layouts.app')

@section('content')
    <div class="content-wrappers">
        <section class="content-header">
            <div class="container-fluid">
                <div >
                    <div  style="text-align: right;">
                        <a href="{{ route('subject_types.create1') }}" class="btn btn-success">Add Class Type</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div > 
                @include('messages')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Subject Type List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Class Type</th>
                                            <th>Lec Percentage</th>
                                            <th>Lab Percentage</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subjectTypes as $subjectType)
                                            <tr>
                                                <td>{{ $subjectType->id }}</td>
                                                <td>{{ $subjectType->subject_type }}</td>
                                                <td>{{ $subjectType->lec_percentage }}</td>
                                                <td>{{ $subjectType->lab_percentage }}</td>
                                                <td>
                                                    <a href="{{ route('subject_types.edit1', $subjectType->id) }}" class="btn btn-primary">Edit</a>
                                                    <form action="{{ route('subject_types.destroy1', $subjectType->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this subject type?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection