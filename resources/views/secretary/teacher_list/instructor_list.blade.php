@extends('layouts.app')

@section('content')
    <div class="content-wrappers">
        <section class="content-header">
            <h3>Instructors</h3>
        </section>
        <section class="content">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($instructors as $instructor)
                                        <tr>
                                        <td>{{ $instructor->name }} {{ $instructor->middle_name }} {{ $instructor->last_name }}</td>
                                        
                                        <td>  <a href="{{ route('secretary.teacher_list.subjects', ['instructorId' => $instructor->id]) }}"class="btn btn-info">View Current Subjects</a>
                                             <a href="{{ route('secretary.teacher_list.past_subjects', ['instructorId' => $instructor->id]) }}" class="btn btn-info">View Past Semester Subjects</a>
                                        </td>

                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

