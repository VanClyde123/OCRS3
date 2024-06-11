@extends('layouts.app')

@section('content')
@php
        $header_title = "Edit Semester";
    @endphp
    <div class="content-wrappers">
        <section class="content-header">
            <h3>Edit Semester</h3>
            <input type="button" onclick="window.location.href='{{ url('secretary/set_semester/view_semesters') }}';" class="btn btn-info" value="Back" />

        </section>
        <section class="content">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <form method="post" action="{{ route('semesters.update1', $semester->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Semester</label>
                                <input type="text" class="form-control" name="semester_name" value="{{ $semester->semester_name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="school_year">School Year</label>
                                <input type="text" class="form-control" name="school_year" value="{{ $semester->school_year }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection