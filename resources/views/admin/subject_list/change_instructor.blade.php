@extends('layouts.app')

@section('content')
    <div class="content-wrappers">
   
        <section class="content-header">
                <h2 >Change Instructor</h2>

        </section>


        <section class="content">
            <div class="container-fluid">
                <div>
                    <div class="card ">
                        <form method="post" action="{{ route('admin.changeInstructor', ['importedClassId' => $importedClass->id]) }}">
                            {{ csrf_field() }}
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
                </div>
            </div>
        </section>
    </div>
@endsection

 