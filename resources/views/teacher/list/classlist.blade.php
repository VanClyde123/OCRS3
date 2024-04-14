@extends('layouts.app')

@section('content')
    <div class="content-wrappers">
        <section class="content-header">
            <h2>Subject List</h2>
            <a href="{{ url('teacher/list/past_classlist')}}" class="btn btn-info">Past Subjects</a>
        </section>
        <section class="content">
            @include('messages')
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body ">
                    <div>
                        <form action="{{ route('teacher.searchSubjects') }}" method="GET" class="mb-2">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search by Subject Code, Description, Section, Days, Time, or Room">
                                <div class="input-group-append">
                                    <button class="btn btn-info" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        @if (empty($subjects))
                            <p>Subjects will not show since there is no active semester set. Please contact the Admin or Secretary.</p>
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
                                            <td>
                                                <form action="{{ route('teacher.update.subject.type', ['subject' => $subject]) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="subject_type" class="form-control" disabled >
                                                        @foreach ($subjectTypes as $type)
                                                            <option value="{{ $type }}" {{ $subject->subject_type === $type ? 'selected' : '' }}>{{ $type }}</option>
                                                        @endforeach
                                                    </select>

                                                    {{-- 
                                                    <button type="submit" class="btn btn-primary mt-1">Update</button>
                                                    --}}

                                                </form>
                                            </td>
                                            <td><a href="{{ route('teacher.list.studentlist', ['subject' => $subject]) }}" class="btn btn-info mt-2">View Students</a></td>
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