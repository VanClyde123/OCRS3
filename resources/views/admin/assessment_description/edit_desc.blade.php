@extends('layouts.app')

@section('content')
@php
        $header_title = "Edit Description";
    @endphp
<div class="content-wrappers">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2><br></h2>
        
    </section>
    <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Description for {{$assessmentDescription->grading_period}} {{$assessmentDescription->description}}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('assessment-descriptions.update', $assessmentDescription->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="type">Grading Period:</label>
                            <select class="form-control" name="grading_period" required>
                                    <option value="" disabled>Select Grading Period</option>
                                    <option value="First Grading" {{ $assessmentDescription->grading_period === 'First Grading' ? 'selected' : '' }}>First Grading</option>
                                    <option value="Midterm" {{ $assessmentDescription->grading_period === 'Midterm' ? 'selected' : '' }}>Midterm</option>
                                    <option value="Finals" {{ $assessmentDescription->grading_period === 'Finals' ? 'selected' : '' }}>Finals</option>
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="type">Type:</label>
                            <select class="form-control" name="type" required>
                                <option value="" disabled>Select Type</option>
                                <option value="Quiz" {{ $assessmentDescription->type === 'Quiz' ? 'selected' : '' }}>Quiz</option>
                                <option value="OtherActivity" {{ $assessmentDescription->type === 'OtherActivity' ? 'selected' : '' }}>Other Activity</option>
                                <option value="Exam" {{ $assessmentDescription->type === 'Exam' ? 'selected' : '' }}>Exam</option>
                                <option value="Lab Activity" {{ $assessmentDescription->type === 'Lab Activity' ? 'selected' : '' }}>Lab Activity</option>
                                <option value="Lab Exam" {{ $assessmentDescription->type === 'Lab Exam' ? 'selected' : '' }}>Lab Exam</option>
                                <option value="Additional Points Quiz" {{ $assessmentDescription->type === 'Additional Points Quiz' ? 'selected' : '' }}>Additional Points Quiz</option>
                                <option value="Additional Points OT" {{ $assessmentDescription->type === 'Additional Points OT' ? 'selected' : '' }}>Additional Points Other Activity</option>
                                <option value="Additional Points Exam" {{ $assessmentDescription->type === 'Additional Points Exam' ? 'selected' : '' }}>Additional Points Exam</option>
                                <option value="Additional Points Lab" {{ $assessmentDescription->type === 'Additional Points Lab' ? 'selected' : '' }}>Additional Points Lab</option>
                                <option value="Direct Bonus Grade" {{ $assessmentDescription->type === 'Direct Bonus Grade' ? 'selected' : '' }}>Direct Bonus Grade</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <input type="text" name="description" class="form-control" value="{{ $assessmentDescription->description }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Description</button><br><br>
                    </form>
                </div>
            </div>
    </section>
    <input action="action" onclick="window.history.go(-1); return false;" type="submit" class="btn btn-info" value="Back" /> 
</div>

@endsection