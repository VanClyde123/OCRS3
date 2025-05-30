@extends('layouts.app')

@section('content')
@php
        $header_title = "Class Types List";
    @endphp
    <div class="content-wrappers">
        <section class="content-header">
            <h2></h2>
            <div  style="text-align: right;">
                <a href="{{ route('subject_types.create1') }}" class="btn btn-success">Add Class Type</a>
            </div>
        </section>
        @include('messages')
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-size: 1.75rem">Class Type List</h3>
                </div>
                <div class="card-body ">
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
                                @php
                                    $lecPercentage = $subjectType->lec_percentage;
                                    $lecPercentage = 100 * $lecPercentage; 
                                    $labPercentage = $subjectType->lab_percentage;
                                    $labPercentage = 100 * $labPercentage; 
                                    @endphp
                                <tr>
                                <td>{{ $subjectType->id }}</td>
                                <td>{{ $subjectType->subject_type }}</td>
                                <td>{{ $lecPercentage }}%</td> 
                                <td>{{ $labPercentage }}%</td>
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
        </section>
    </div>
@endsection