@extends('layouts.app')

@section('content')
@php
        $header_title = "Current Semester";
    @endphp
    @push('scripts')
        <script>
            $(document).ready(function () {
                
                $('#semester_id').change(function () {
                    $('#currentSemesterForm').submit();
                });
            });
        </script>
    @endpush

    <div class="content-wrappers">
        <section class="content-header" style="text-align: right;">
                <h2></h2>
                <a href="{{ url('secretary/set_semester/view_semesters')}}" class="btn btn-primary">Modify Semesters</a>
        </section>
    
        @include('messages')
        <section class="content">
            <div class="card ">
                <form method="post" action="{{ route('semesters.setupCurrent1') }}">
                    @csrf
                   <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="semester_name">Term:</label>
                            <select class="form-control" id="semester_name" name="semester_name" required>
                                <option value="" disabled>--- Select Term ---</option>
                                <option value="First Semester" {{ isset($currentSemester) && $currentSemester->semester_name == 'First Semester' ? 'selected' : '' }}>First Semester</option>
                                <option value="Second Semester" {{ isset($currentSemester) && $currentSemester->semester_name == 'Second Semester' ? 'selected' : '' }}>Second Semester</option>
                                <option value="Short Term" {{ isset($currentSemester) && $currentSemester->semester_name == 'Short Term' ? 'selected' : '' }}>Short Term</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="school_year">School Year:</label>
                            <select class="form-control" id="school_year" name="school_year" required>
                                <option value="" disabled>--- Select School Year ---</option>
                                @if(isset($schoolYears))
                                    @foreach($schoolYears as $year)
                                        <option value="{{ $year }}" {{ isset($currentSemester) && $currentSemester->school_year == $year ? 'selected' : '' }}>{{ $year }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Set as Current</button>
                    </div>
                </form>
            </div>
        </section>
    </div>


       <script>
        const baseURL = "{{ url('/') }}";
       document.getElementById('semester_name').addEventListener('change', function () {
        var term = this.value;
        var schoolYearDropdown = document.getElementById('school_year');


        schoolYearDropdown.innerHTML = '<option value="" disabled selected>--- Select School Year ---</option>';

     
        fetch(`${baseURL}/admin/getSchoolYears/${term}`)
            .then(response => response.json())
            .then(data => {
                console.log(data); 
                data.schoolYears.forEach(year => {
                    var option = document.createElement('option');
                    option.value = year;
                    option.textContent = year;
                    if(year == '{{ isset($currentSemester) ? $currentSemester->school_year : '' }}') {
                        option.selected = true;
                    }
                    schoolYearDropdown.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching school years:', error));
    });

   
    if (document.getElementById('semester_name').value !== "") {
        document.getElementById('semester_name').dispatchEvent(new Event('change'));
    }
</script>
@endsection

