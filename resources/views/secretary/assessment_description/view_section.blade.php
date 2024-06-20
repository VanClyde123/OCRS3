@extends('layouts.app')

@section('content')
@php
        $header_title = "Section List";
    @endphp
   <div class="container">
        <section class="content-header">
            <h2></h2>
          

        </section>
         @include('messages')
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title">Sections for {{ $subjectDescription->subject_name }}</h3>
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addSectionModal">Add Section</button>
            </div>
            <div class="card-body">
                @if($sections->isEmpty())
                    <p>No sections available.</p>
                @else
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Section Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sections as $section)
                                <tr>
                                    <td>{{ $section->id }}</td>
                                    <td>{{ $section->section_name }}</td>
                                    <td>
                                        
                                        <form action="{{ route('sections.destroy1', $section->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this section?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
         <input type="button" onclick="window.location.href='{{ url('secretary/subject_descriptions') }}';" class="btn btn-info" value="Back" />
    </div>

    <!-- add section modal -->
    <div class="modal fade" id="addSectionModal" tabindex="-1" role="dialog" aria-labelledby="addSectionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSectionModalLabel">Add Section</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addSectionForm" action="{{ route('sections.store1') }}" method="POST">
                    @csrf


                <input type="hidden" name="subject_description_id" value="{{ $subjectDescription->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="sectionName">Section Name</label>
                            <input type="text" class="form-control" id="sectionName" name="section_name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    $('#addSectionForm').submit(function(e) {
        e.preventDefault();
          var subjectDescriptionId = {{ $subjectDescription->id }};
        var sectionName = $('#sectionName').val();
      

        $.ajax({
            type: 'POST',
            url: '{{ route("sections.store") }}',
            data: {
                subject_description_id: subjectDescriptionId
                section_name: sectionName,
               
            },
            success: function(data) {
                console.log('section saved:', data);
                
            },
            error: function(xhr, status, error) {
                console.error('error:', error);
            }
        });
    });
</script>

@endsection
