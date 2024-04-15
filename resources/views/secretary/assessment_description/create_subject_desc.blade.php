@extends('layouts.app')

@section('content')
    <div class="content-wrappers">
        <section class="content-header">
            <h2>New Subject Descriptions</h2>
            <input action="action" onclick="window.history.go(-1); return false;" type="submit" class="btn btn-info" value="Back" /> 
        </section>
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Subject Description</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('subject_descriptions.store1') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="subject_code">Subject Code</label>
                            <select class="form-control" id="subject_code" name="subject_code">
                                <option value="" selected disabled>-----Select Subject Code----</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->subject_code }}">{{ $subject->subject_code }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="subject_name">Subject Name</label>
                            <input type="text" class="form-control" id="subject_name" name="subject_name" readonly>
                        </div>
                        
                        <button type="submit" class="btn btn-success">Create</button>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <script>
        // Function to update the subject name based on the selected subject code
        $(document).ready(function() {
            $('#subject_code').change(function() {
                var selectedCode = $(this).val();
                var selectedSubject = {!! json_encode($subjects) !!}.find(subject => subject.subject_code === selectedCode);
                if (selectedSubject) {
                    $('#subject_name').val(selectedSubject.description);
                } else {
                    $('#subject_name').val('');
                }
            });
        });
    </script>
@endsection