@extends('layouts.app')

@section('content')
    <div class="content-wrappers">
        <!-- Content Header (Page header) -->
        <section class="content-header">
              <h2>Assessment Descriptions for {{ $subjectDescription->subject_code }} {{ $subjectDescription->subject_name }}</h2>
            @include('messages')
            <div  style="text-align: left;">
                <a href="{{ route('assessment-descriptions.create1', ['subjectDescId' => $subjectDescId]) }}" class="btn btn-success">Create New Description</a>
            </div>
        </section>
        <section class="content">
            <div class="card p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Grading Period</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                          <tbody>
                           @forelse($assessmentDescriptions ?? [] as $description)
                            <tr>
                                <td>{{ $description->grading_period }}</td>
                                <td>{{ $description->type }}</td>
                                <td>{{ $description->description }}</td>
                                <td>
                                    <a href="{{ route('assessment-descriptions.edit1', $description->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('assessment-descriptions.destroy1', $description->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this description?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No assessment descriptions for this subject.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection