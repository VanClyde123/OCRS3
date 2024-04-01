@extends('layouts.app')

@section('content')
    <div class="content-wrappers">
        <section class="content-header">
            <div class="container-fluid">
                <div >
                    <div >
                    
                    </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div> 
                    @include('messages')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Enrolled Students List</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    @foreach (['Male', 'Female'] as $gender)
                                        <thead>
                                            <tr>
                                                <th colspan="3">{{ $gender }}</th>
                                            </tr>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Course</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($sortedStudents[$gender]))
                                                @foreach ($sortedStudents[$gender] as $student)
                                                    <tr>
                                                        <td>{{ $student->student->id_number }}</td>
                                                        <td>{{ $student->student->last_name }}, {{ $student->student->name }} {{ $student->student->middle_name }}</td>
                                                        <td>{{ $student->student->course }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container mt-3">
                    <a href="{{ route('teacher.list.studentlist', ['subject' => $subject->id]) }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </section>
    </div>
@endsection

   