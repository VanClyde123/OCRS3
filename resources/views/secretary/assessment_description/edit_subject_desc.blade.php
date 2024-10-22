@extends('layouts.app')

@section('content')
@php
        $header_title = "Edit Subject Description";
    @endphp
    <div class="content-wrappers">
        <section class="content-header">
            <h2><br></h2>
          
 
        </section>
        <section class="content">
            @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
            <div class="card">
                 <div class="card-header">
                    <h3 class="card-title">Edit Subject Description of {{ $subjectDescription->subject_code }} - {{ $subjectDescription->subject_name }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('subject_descriptions.update1', $subjectDescription->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                          <div class="form-group">
                        <label for="year_level">Year Level</label>
                        <select class="form-control" id="year_level" name="year_level" required>
                            <option value="" disabled>--- Select Year Level ---</option>
                            <option value="1" {{ $subjectDescription->year_level == 1 ? 'selected' : '' }}>1st Year</option>
                            <option value="2" {{ $subjectDescription->year_level == 2 ? 'selected' : '' }}>2nd Year</option>
                            <option value="3" {{ $subjectDescription->year_level == 3 ? 'selected' : '' }}>3rd Year</option>
                            <option value="4" {{ $subjectDescription->year_level == 4 ? 'selected' : '' }}>4th Year</option>
                        </select>
                    </div>
                        <div class="form-group">
                            <label for="subject_code">Subject Code</label>
                            <input type="text" class="form-control" id="subject_code" name="subject_code" value="{{ $subjectDescription->subject_code }}">
                        </div>
                        <div class="form-group">
                            <label for="subject_name">Subject Name</label>
                            <input type="text" class="form-control" id="subject_name" name="subject_name" value="{{ $subjectDescription->subject_name }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </section>
          <input type="button" onclick="window.location.href='{{ url('secretary/subject_descriptions') }}';" class="btn btn-info" value="Back" />
    </div>
@endsection
