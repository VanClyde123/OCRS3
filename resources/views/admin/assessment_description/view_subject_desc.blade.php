@extends('layouts.app')

@section('content')
@php
        $header_title = "Course List";
    @endphp
    <div class="content-wrappers">
        <section class="content-header"  style="text-align: right;">
           
            <a href="{{ route('subject_descriptions.create') }}" class="btn btn-success">Add Subject</a>
        </section>
        @include('messages')
      <section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Subject List</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @php
                    $level = [
                        1 => '1st Year',
                        2 => '2nd Year',
                        3 => '3rd Year',
                        4 => '4th Year',
                    ];
                @endphp
                @foreach ($level as $year => $yearName)
                    <h4>{{ $yearName }} Subjects</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10%">ID</th>
                                <th style="width: 20%">Subject Code</th>
                                <th style="width: 30%">Subject Name</th>
                                <th style="width: 40%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subjectDescriptions->where('year_level', $year) as $subjectDescription)
                                <tr>
                                    <td>{{ $subjectDescription->id }}</td>
                                    <td>{{ $subjectDescription->subject_code }}</td>
                                    <td>{{ $subjectDescription->subject_name }}</td>
                                    <td>
                                      <div class="btn-group" role="group">
                                          <a href="{{ route('sections.index', $subjectDescription->id) }}" class="btn btn-success mr-2">Sections</a>
                                        <a href="{{ route('assessment_descriptions.view', $subjectDescription->id) }}" class="btn btn-info mr-2">Assessments Descriptions</a>
                                        <a href="{{ route('subject_descriptions.edit', $subjectDescription->id) }}" class="btn btn-primary mr-2">Edit</a>
                                        <form action="{{ route('subject_descriptions.destroy', $subjectDescription->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endforeach
            </div>
        </div>
    </div>
</section>

    </div>
@endsection