@extends('layouts.app')

@section('content')
@php
        $header_title = "Create Description";
    @endphp
<div class="content-wrappers">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2>Create Assessment Description</h2>
        <input action="action" onclick="window.history.go(-1); return false;" type="submit" class="btn btn-info" value="Back" /> 
    </section>
    <section class="content">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('assessment-descriptions.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="subject_desc_id" value="{{ $subjectDescId }}">
                        <div class="form-group">
                            <label for="type">Grading Period:</label>
                            <select class="form-control" name="grading_period" required>
                                <option value="" disabled selected>--- Select Grading Period ---</option>
                                    <option value="First Grading">First Grading</option>
                                    <option value="Midterm">Midterm</option>
                                    <option value="Finals">Finals</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type">Type:</label>
                            <select class="form-control" name="type" required>
                                <option value="" disabled selected>--- Select Type ---</option>
                                <option value="Quiz">Quiz</option>
                                <option value="OtherActivity">Other Activity</option>
                                <option value="Exam">Exam</option>
                                <option value="Lab Activity">Lab Activity</option>
                                <option value="Lab Exam">Lab Exam</option>
                                <option value="Additional Points Quiz">Additional Points Quiz</option>
                                <option value="Additional Points OT">Additional Points Other Activity</option>
                                <option value="Additional Points Exam">Additional Points Exam</option>
                                <option value="Additional Points Lab">Additional Points Lab</option>
                                <option value="Direct Bonus Grade">Direct Bonus Grade</option>
                            </select>
                        </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" name="description" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Create Description</button>
                </form>
            </div>
        </div>
    </section>
</div>

@endsection