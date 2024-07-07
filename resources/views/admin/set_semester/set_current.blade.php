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
    
    @if($semesters->isEmpty())
        @include('messages')
            <div class="content-wrappers">
               
                <section class="content-header">
                    <h2>Create Semester</h2>
                    <input action="action" onclick="window.history.go(-1); return false;" type="submit" class="btn btn-info" value="Back" />
                </section>
                <section class="content">
                    <div class="card ">
                        <div class="card-body">
                            <form method="post" action="{{ route('semesters.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Semester</label>
                                    <select class="form-control" name="semester_name" required>
                                        <option value="" disabled selected>--- Select Semester ---</option>
                                        <option value="First Semester">First Semester</option>
                                        <option value="Second Semester">Second Semester</option>
                                        <option value="Short Term">Short Term</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="school_year">School Year</label>
                                    <div class="d-flex">
                                        <input id="year1" min="2020" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "4" class="form-control" name="school_year1" step="1" placeholder="Starting Year (eg., 2023)" required>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                        <input id="year2" disabled min="2021" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "4" class="form-control" name="school_year2" step="1" placeholder="Ending Year"required>
                                        <input type="text" id="yearRange" name="school_year" hidden> 
                                    </div>
                                </div>
                                <button  type="submit" class="btn btn-primary">Create</button>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        <script>
            const input1 = document.querySelector('input[name="school_year1"]');
            const input2 = document.querySelector('input[name="school_year2"]');
            const yearRange = document.getElementById('yearRange');
    
            function updateInput2() {
                input2.value = parseInt(input1.value) + 1; 
            }
            function updateRange() {
                const year1 = input1.value;
                const year2 = input2.value;
                yearRange.value = `${year1} - ${year2}`;
            }
    
            input1.addEventListener('change', updateInput2);
            input1.addEventListener('change', updateRange);
            updateInput2(); 
            updateRange();
        </script>
    @else
        <div class="content-wrappers">
            <section class="content-header">
              
                <div  style="text-align: right;">
                    <a href="{{ url('admin/set_semester/view_semesters')}}" class="btn btn-success">Modify Semesters</a>
                </div>
            </section>
            @include('messages')
            <section class="content">
        <div class="card">
            <form method="post" action="{{ route('semesters.setupCurrent') }}">
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


    @endif
@endsection

