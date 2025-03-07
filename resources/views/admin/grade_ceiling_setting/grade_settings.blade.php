@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <br>
    <br>
    <div class="card shadow-lg">
        <div class="card-header">
            <h4 class="mb-0">Grade Ceiling Settings</h4>
        </div>

        <div class="card-body">
            <div class="alert alert-info">
             This setting determines the grade ceiling for the category in the Summary Report per Class. The categories are:
                <ul class="mb-0">
                    <li>Students with grades of <strong>"Grade and Above"</strong> and above.</li>
                    <li>Students with grades between <strong>"Lower Bound Grade"</strong> and <strong>"Upper Bound Grade"</strong>.</li>
                </ul>
            </div>

            <div class="card-body">
                <form action="{{ route('grade-ceiling.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                   <div class="row">
                    <div class="col-md-4">
                        <label for="grade_above" class="form-label fw-bold">Grade and Above</label>
                        <input type="number" name="grade_above" class="form-control" value="{{ $gradeSetting->grade_above ?? '' }}" required>
                    </div>

                    <div class="col-md-4">
                        <label for="grade_lower" class="form-label fw-bold">Lower Bound Grade</label>
                        <input type="number" name="grade_lower" class="form-control" value="{{ $gradeSetting->grade_lower ?? '' }}" required>
                    </div>

                    <div class="col-md-4">
                        <label for="grade_upper" class="form-label fw-bold">Upper Bound Grade</label>
                        <input type="number" name="grade_upper" class="form-control" value="{{ $gradeSetting->grade_upper ?? '' }}" required>
                    </div>
                </div>
                <br>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-4">Set</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
