@extends('layouts.app')

@section('content')
    <div class="content-wrappers">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h2>{{ $subjectDescription->subject_code }} {{ $subjectDescription->subject_name }}</h2>
            <div style="text-align: left;">
                <input action="action" onclick="window.history.go(-1); return false;" type="submit" class="btn btn-info" value="Back" /> 
                <a href="{{ route('assessment-descriptions.create', ['subjectDescId' => $subjectDescId]) }}" class="btn btn-success">Create New Description</a>
            </div>
        </section>
        @include('messages')
        <section class="content">
            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">Assessment Descriptions</h3>
                </div>
                <div class="card-body">
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
                            @php
                                $sortOrder = [
                                    'First Grading', 
                                    'Midterm',
                                    'Finals'
                                ];   
                            @endphp
                            @forelse($assessmentDescriptions->sortBy(function ($item) use ($sortOrder) { return array_search($item->grading_period, $sortOrder);}) as $description)
                                <tr>
                                    <td>{{ $description->grading_period }}</td>
                                    <td>{{ $description->type }}</td>
                                    <td>{{ $description->description }}</td>
                                    <td>
                                        <a href="{{ route('assessment-descriptions.edit', $description->id) }}" class="btn btn-primary">Edit</a>
                                        <form action="{{ route('assessment-descriptions.destroy', $description->id) }}" method="POST" style="display:inline;">
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
            </div>
        </section>
    </div>
@endsection