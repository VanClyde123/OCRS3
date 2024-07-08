@extends('layouts.app')

@section('content')
@php
        $header_title = "Add New Semester";
    @endphp
    <div class="content-wrappers">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h2><br></h2>
        </section>
        <section class="content">
            <div class="card ">
                 <div class="card-header">
                    <h3 class="card-title">Create Semester</h3>
                </div>
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
            <input type="button" onclick="window.location.href='{{ url('admin/set_semester/view_semesters') }}';" class="btn btn-info" value="Back" />
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
@endsection