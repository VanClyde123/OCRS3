@extends('layouts.app')

@section('content')
@php
    $header_title = "Set Current Semester";

    $currentYear = date('Y');
    $startYear = 2020; 
    $endYear = $currentYear + 1; 
    $schoolYearOptions = collect(range($startYear, $endYear))->map(function($year) {
        return "$year - " . ($year + 1);
    });
@endphp

<div class="content-wrappers">
    <section class="content-header">
        <h1></h1>
        <br>
        <br>
    </section>

    @include('messages')

    <section class="content">
        @if($semesters->isEmpty())
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-size: 1.75rem">No Set Semester</h3>
                </div>
                <div class="card-body">
                    <p class="text-danger">Please select a semester and school year to set the current semester.</p>
                <form method="post" action="{{ route('semesters.setupCurrent1') }}">
                   @csrf
                        <div class="form-group">
                            <label for="semester_name">Semester:</label>
                            <select class="form-control" id="semester_name" name="semester_name" required>
                                <option value="" disabled selected>--- Select Semester ---</option>
                                <option value="First Semester">First Semester</option>
                                <option value="Second Semester">Second Semester</option>
                                <option value="Short Term">Short Term</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="school_year">School Year:</label>
                            <select class="form-control" id="school_year" name="school_year" required>
                                <option value="" disabled selected>--- Select School Year ---</option>
                                @foreach ($schoolYearOptions as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Create and Set Current</button>
                    </form>
                </div>
            </div>
        @else
            <div class="card">
                 <div class="card-header">
                    <h3 class="card-title" style="font-size: 1.75rem">Current Semester</h3>
                </div>
                  <form method="post" action="{{ route('semesters.setupCurrent1') }}">
                     @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="semester_name">Semester:</label>
                                <select class="form-control" id="semester_name" name="semester_name" required>
                                    <option value="" disabled selected>--- Select Semester ---</option>
                                    <option value="First Semester" {{ isset($currentSemester) && $currentSemester->semester_name == 'First Semester' ? 'selected' : '' }}>First Semester</option>
                                    <option value="Second Semester" {{ isset($currentSemester) && $currentSemester->semester_name == 'Second Semester' ? 'selected' : '' }}>Second Semester</option>
                                    <option value="Short Term" {{ isset($currentSemester) && $currentSemester->semester_name == 'Short Term' ? 'selected' : '' }}>Short Term</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="school_year">School Year:</label>
                                <select class="form-control" id="school_year" name="school_year" required>
                                    <option value="" disabled selected>--- Select School Year ---</option>
                                    @if(isset($schoolYears))
                                        @foreach($schoolYears as $year)
                                            <option value="{{ $year }}" {{ isset($currentSemester) && $currentSemester->school_year == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Set as Current</button>
                    </div>
                </form>
            </div>
        @endif
    </section>
</div>

@endsection


