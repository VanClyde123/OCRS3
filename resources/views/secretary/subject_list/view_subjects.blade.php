@extends('layouts.app')

@section('content')
   <div class="content-wrappers">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h2>Subject List</h2>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div > 
                    @include('messages')
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                 @if (empty($importedClasses ))
                                <p>Subjects will not show since there is no active semester set. Please set a semester</p>

                                  @else
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Subject Code</th>
                                            <th>Description</th>
                                            <th>Section</th>
                                            <th>Semester</th>
                                            <th>Current Instructor</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($importedClasses as $importedClass)
                                            <tr>
                                                <td>{{ $importedClass->subject->subject_code }}</td>
                                                <td>{{ $importedClass->subject->description }}</td>
                                                <td>{{ $importedClass->subject->section}}</td>
                                                <td>{{ $importedClass->subject->term}}</td>
                                                <td>{{ $importedClass->instructor->name }} {{ $importedClass->instructor->middle_name }} {{ $importedClass->instructor->last_name }}</td>
                                                <td>
                                                    <a href="{{ route('secretary.changeInstructorForm1',  ['importedClassId' => $importedClass->id]) }}" class="btn btn-primary">Change Instructor</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                 @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection