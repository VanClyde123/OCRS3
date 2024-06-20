@extends('layouts.app')

@section('content')
@php
        $header_title = "Assign Instructor";
    @endphp
    <div class="content-wrappers">
   
        <section class="content-header">
            <h2 ><br></h2>
           
        </section>
        <section class="content">
            <div class="card ">
                <form method="post" action="{{ route('secretary.changeInstructor1', ['importedClassId' => $importedClass->id]) }}">
                    {{ csrf_field() }}
                     <div class="card-header">
                        <h3 class="card-title">Assign Another Instructor</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="newInstructor">Assign New Instructor:</label>
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
         <input type="button" onclick="window.location.href='{{ url('secretary/subject_list/view_subjects') }}';" class="btn btn-info" value="Back" />

    </div>
@endsection

 