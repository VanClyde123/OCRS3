@extends('layouts.app')

@section('content')

@php
        $header_title = "Subject List";
    @endphp
   <div class="content-wrappers">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h2 class="mb-5"></h2>
        </section>

        @include('messages')
        <section class="content">
            <div class="card">
                 <div class="card-header">
                    <h3 class="card-title">Subjects in the Current Semester</h3>
                </div>
                <div class="card-body ">
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
                                        <td>@if ($importedClass->instructor && ($importedClass->instructor->role == 2 || $importedClass->instructor->secondary_role == 2))
                                                    {{ $importedClass->instructor->name }} {{ $importedClass->instructor->middle_name }} {{ $importedClass->instructor->last_name }}
                                                @else
                                                   No Assigned
                                                @endif</td>
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
        </section>
    </div>
@endsection