@extends('layouts.app')

@section('content')
    <div class="content-wrappers">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h2>Assessment Descriptions</h2>
            @include('messages')
            <div  style="text-align: left;">
                <a href="{{ route('assessment-descriptions.create') }}" class="btn btn-success">Create New Description</a>
            </div>
        </section>
        <section class="content">
            <div class="card p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($descriptions as $description)
                                <tr>
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
                                    <td colspan="3">No assessment descriptions found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection