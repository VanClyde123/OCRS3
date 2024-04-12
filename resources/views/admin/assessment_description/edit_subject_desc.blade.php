@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Subject Description</h1>
        <form action="{{ route('subject_descriptions.update', $subjectDescription->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="subject_code">Subject Code</label>
                <input type="text" class="form-control" id="subject_code" name="subject_code" value="{{ $subjectDescription->subject_code }}">
            </div>
            <div class="form-group">
                <label for="subject_name">Subject Name</label>
                <input type="text" class="form-control" id="subject_name" name="subject_name" value="{{ $subjectDescription->subject_name }}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
