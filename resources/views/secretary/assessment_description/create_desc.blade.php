@extends('layouts.app')

@section('content')

<div class="content-wrappers">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2>Create Assessment Description</h2>
        <div >
    </section>
    <section class="content">
        <div class="card p-3">
            <form action="{{ route('assessment-descriptions.store1') }}" method="POST">
                @csrf
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
    </section>
</div>

@endsection