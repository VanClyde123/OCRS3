@extends('layouts.app')

@section('content')
    <div class="content-wrappers">
        <section class="content-header">
            <h2>Past Subject List</h2>
            <input action="action" onclick="window.history.go(-1); return false;" type="submit" class="btn btn-info" value="Back" /> 
        </section>
        @include('messages')
        <section class="content">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <div>
                        <form action="{{ route('teacher.searchPastSubjects') }}" method="GET" class="form-inline mb-2">
                            <div class="form-group">
                                <label for="search">Search:</label>
                                <input type="text" class="form-control" id="search" name="search" placeholder="Search by Subject Code, Description, Section, Days, Time, or Room" size="60">
                            </div>
                            <div class="form-group mx-sm-3">
                                <label for="term">Term:</label>
                                <input type="text" class="form-control" id="term" name="term" placeholder="Search by Semester or School Year" size="40">
                            </div>
                            <button type="submit" class="btn btn-info">Search</button>
                        </form>
                    </div>
                    <div class="table-responsive">
                        @if (empty($subjects))
                            <p>Past subjects will not show since there is no active current semester set. Please contact the Admin or Secretary.</p>
                        @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Subject Code</th>
                                        <th>Subject Description</th>
                                        <th>Section</th>
                                        <th>Days</th>
                                        <th>Time</th>
                                        <th>Room</th>
                                        <th>Term</th>
                                        <th>Class Type</th> 
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subjects as $subject)
                                        <tr>
                                            <td>{{ $subject->subject_code }}</td>
                                            <td>{{ $subject->description }}</td>
                                            <td>{{ $subject->section }}</td>
                                            <td>{{ $subject->importedClasses->first()->days }}</td>
                                            <td>{{ $subject->importedClasses->first()->time }}</td>
                                            <td>{{ $subject->importedClasses->first()->room }}</td>
                                            <td>{{ $subject->term }}</td>
                                            <td>
                                                <form action="{{ route('teacher.update.subject.type', ['subject' => $subject]) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="subject_type" class="form-control" disabled>
                                                        @foreach ($subjectTypes as $type)
                                                            <option value="{{ $type }}" {{ $subject->subject_type === $type ? 'selected' : '' }}>
                                                                {{ $type }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="{{ route('teacher.list.studentlist', ['subject' => $subject]) }}" class="btn btn-info mt-2">View Students</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection