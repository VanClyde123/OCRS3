@extends('layouts.app')

@section('content')
@php
        $header_title = "Assign Instructor";
    @endphp
    <div class="content-wrappers">
   
        <section class="content-header">
                <h2 >Change Instructor</h2>
               <input type="button" onclick="window.location.href='{{ url('admin/subject_list/view_subjects') }}';" class="btn btn-info" value="Back" />

        </section>

        <section class="content">
            <div class="card ">
                <form method="post" action="{{ route('admin.changeInstructor', ['importedClassId' => $importedClass->id]) }}">
                    {{ csrf_field() }}
                    <div class="card-header">
                        <h3 class="card-title">Assign New Instructor</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <select class="form-control" name="newInstructor" required>
                                <option value="" disabled selected>--- Select Instructor ---</option>
                                @foreach($instructors as $instructor)
                                <option value="{{ $instructor->id }}">{{ $instructor->name }} {{ $instructor->middle_name }} {{ $instructor->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Reassign Instructor</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection

 