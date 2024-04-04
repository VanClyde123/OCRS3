@extends('layouts.app')
   
@section('content')
    <div class="content-wrappers">
        <section class="content-header">
            <div class="container-fluid">
                <div >
                    <div >
                        <h1>Subject List</h1>
                    </div>
                    <div >
                        <a href="{{ url('teacher/list/past_classlist')}}" class="btn btn-primary">Past Subjects</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div > 
                @include('messages')
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive">
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
                                                <td><form action="{{ route('teacher.update.subject.type', ['subject' => $subject]) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <select name="subject_type" class="form-control">
                                                            @foreach ($subjectTypes as $type)
                                                                <option value="{{ $type }}" {{ $subject->subject_type === $type ? 'selected' : '' }}>{{ $type }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <button type="submit" class="btn btn-primary mt-1">Update</button>
                                                    </form></td>
                                                <td><a href="{{ route('teacher.list.studentlist', ['subject' => $subject]) }}" class="btn btn-primary mt-2">View Students</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
