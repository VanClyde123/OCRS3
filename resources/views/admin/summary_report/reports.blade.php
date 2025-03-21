@extends('layouts.app')

@section('content')

<div class="container-fluid mt-4">
    <br>
    <br>
    <br>
    <div class="card shadow-lg p-4">
        <h2 class="text-center mb-4">Summary Report</h2>
        <form id="reportForm" action="{{ route('generate.report') }}" method="POST">
            @csrf

            <div class="row">
               
                <div class="col-md-6 form-group">
                    <label for="school_year" class="font-weight-bold">School Year:</label>
                    <select id="school_year" name="school_year" class="form-control">
                        <option value="">---Select School Year---</option>
                        @foreach($schoolYears as $year)
                            <option value="{{ $year->school_year }}">{{ $year->school_year }}</option>
                        @endforeach
                    </select>
                </div>

                
                <div class="col-md-6 form-group">
                    <label for="term" class="font-weight-bold">Term:</label>
                    <select id="term" name="term" class="form-control" disabled>
                        <option value="">---Select Term---</option>
                    </select>
                </div>

                
                <div class="col-md-6 form-group">
                    <label for="instructor" class="font-weight-bold">Instructor:</label>
                    <select id="instructor" name="instructor" class="form-control" disabled>
                        <option value="">---Select Instructor---</option>
                    </select>
                </div>

                
                <div class="col-md-6 form-group">
                    <label for="subject" class="font-weight-bold">Subject:</label>
                    <select id="subject" name="subject" class="form-control" disabled>
                        <option value="">---Select Subject---</option>
                    </select>
                </div>

               
                <div class="col-md-6 form-group">
                    <label for="section" class="font-weight-bold">Section:</label>
                    <select id="section" name="section" class="form-control" disabled>
                        <option value="">---Select Section---</option>
                    </select>
                </div>

                
                <div class="col-md-6 form-group">
                    <label for="program" class="font-weight-bold">Program:</label>
                    <select id="program" name="program" class="form-control">
                        <option value="">---Select Program---</option>
                        <option value="BSCS">BSCS</option>
                        <option value="BSIT">BSIT</option>
                        <option value="BSCPE">BSCPE</option>
                    </select>
                </div>
            </div>

           
            <div class="text-center mt-4">
               <!-- <button type="button" id="generateReport" class="btn btn-primary mr-2">
                    Test Generate Report
                </button>-->

                <a href="#" id="exportReport" class="btn btn-success mr-2">
                     Generate as Excel
                </a>

                <button type="button" id="export-pdf" target="_blank" class="btn btn-danger">
                     Generate as PDF
                </button>
            </div>

        </form>
    </div>
</div>
<script>
  document.getElementById('export-pdf').addEventListener('click', function() {
    let filters = {
        school_year: document.getElementById('school_year').value,
        term: document.getElementById('term').value,
        instructor: document.getElementById('instructor').value,
        subject: document.getElementById('subject').value,
        section: document.getElementById('section').value,
        program: document.getElementById('program').value
    };

    let queryString = new URLSearchParams(filters).toString();
    let url = "{{ route('summary.report.pdf') }}?" + queryString;
    
    window.open(url, '_blank');
});
</script>

    <script>
    document.getElementById('exportReport').addEventListener('click', function(event) {
        event.preventDefault();

        let form = document.getElementById('reportForm');
        let formData = new FormData(form);
        let params = new URLSearchParams(formData).toString();

        let exportUrl = "{{ route('summary.export') }}?" + params;
        window.location.href = exportUrl;
    });
    </script>
<script>
    document.getElementById('generateReport').addEventListener('click', function() {
        document.getElementById('reportForm').submit(); 
    });
</script>
<script>
$(document).ready(function() {

    
    $("#program").prop("disabled", true);
    
    $("#school_year").change(function() {
        let schoolYear = $(this).val();
        if (schoolYear) {
            $.ajax({
                url: "{{ route('admin.getTerms') }}",
                type: "GET",
                data: { school_year: schoolYear },
                success: function(response) {
                    $("#term").html('<option value="">Select Term</option>');
                    if (response.length > 0) {
                        response.forEach(term => {
                            $("#term").append(`<option value="${term.semester_name}">${term.semester_name}</option>`);
                        });
                        $("#term").prop("disabled", false);
                    } else {
                        $("#term").prop("disabled", true);
                    }
                    $("#instructor").html('<option value="">Select Instructor</option>').prop("disabled", true);
                }
            });
        } else {
            $("#term, #instructor").html('<option value="">Select</option>').prop("disabled", true);
        }
    });

    
     $("#term").change(function() {
        let schoolYear = $("#school_year").val();
        let term = $(this).val();

        if (schoolYear && term) {
            $.ajax({
                url: "{{ route('admin.summary_report.getInstructors') }}",
                type: "GET",
                data: { school_year: schoolYear, term: term },
                success: function(response) {
                    let instructorDropdown = $("#instructor");
                    instructorDropdown.empty().append('<option value="">Select Instructor</option>');

                    if (response.length > 0) {
                        response.forEach(instructor => {
                            let fullName = `${instructor.last_name}, ${instructor.name} ${instructor.middle_name ? instructor.middle_name : ''}`;
                            instructorDropdown.append(`<option value="${instructor.id}">${fullName}</option>`);
                        });

                        instructorDropdown.prop("disabled", false);
                    } else {
                        instructorDropdown.prop("disabled", true);
                    }
                }
            });
        } else {
            $("#instructor").prop("disabled", true);
        }
    });

  $("#instructor").change(function() {
        let schoolYear = $("#school_year").val();
        let term = $("#term").val();
        let instructorId = $(this).val();

        if (schoolYear && term && instructorId) {
            $.ajax({
                url: "{{ route('admin.summary_report.getSubjects') }}",
                type: "GET",
                data: { school_year: schoolYear, term: term, instructor: instructorId },
                success: function(response) {
                    let subjectDropdown = $("#subject");
                    subjectDropdown.empty().append('<option value="">Select Subject</option>');

                    if (response.length > 0) {
                        response.forEach(subject => {
                            subjectDropdown.append(`<option value="${subject.id}">${subject.name}</option>`);
                        });
                        subjectDropdown.prop("disabled", false);
                    } else {
                        subjectDropdown.prop("disabled", true);
                    }

                    
                    $("#section").empty().append('<option value="">Select Section</option>').prop("disabled", true);
                },
                error: function(xhr) {
                    console.log("Error fetching subjects:", xhr.responseText);
                }
            });
        }
    });

     $("#subject").change(function() {
        let subjectId = $(this).val();

        if (subjectId) {
            $.ajax({
                url: "{{ route('admin.summary_report.getSections') }}",
                type: "GET",
                data: { subject: subjectId },
                success: function(response) {
                    let sectionDropdown = $("#section");
                    sectionDropdown.empty().append('<option value="">Select Section</option>');

                    if (response.length > 0) {
                        response.forEach(section => {
                            sectionDropdown.append(`<option value="${section.name}">${section.name}</option>`);
                        });
                        sectionDropdown.prop("disabled", false);
                    } else {
                        sectionDropdown.prop("disabled", true);
                    }

                  
                    $("#program").prop("disabled", true);
                },
                error: function(xhr) {
                    console.log("Error fetching sections:", xhr.responseText);
                }
            });
        } else {
            $("#section").empty().append('<option value="">Select Section</option>').prop("disabled", true);
             $("#program").prop("disabled", true); 
        }
    });

      
    $("#section").change(function() {
        if ($(this).val()) {
            $("#program").prop("disabled", false);
        } else {
            $("#program").prop("disabled", true);
        }
    });

    
    function fetchFilteredReport() {
        $.ajax({
            url: "{{ route('admin.summary_report.filter') }}",
            type: "GET",
            data: {
                school_year: $("#school_year").val(),
                term: $("#term").val(),
                instructor: $("#instructor").val(),
                subject: $("#subject").val(),
                section: $("#section").val(),
                program: $("#program").val()
            },
            success: function(response) {
                $("#reportResults").html("");
                if (response.length > 0) {
                    let headers = ["Total Enrolled"];
                    let tableHtml = "<table border='1'><thead><tr>";

                    if (!$("#term").val()) headers.unshift("Term");
                    if (!$("#instructor").val()) headers.unshift("Instructor");
                    if (!$("#subject").val()) headers.unshift("Subject");
                    if (!$("#section").val()) headers.unshift("Section");
                    if (!$("#program").val()) headers.unshift("Program");

                    headers.forEach(header => {
                        tableHtml += `<th>${header}</th>`;
                    });

                    tableHtml += "</tr></thead><tbody>";

                    response.forEach(row => {
                        tableHtml += "<tr>";
                        if (!$("#term").val()) tableHtml += `<td>${row.term}</td>`;
                        if (!$("#instructor").val()) tableHtml += `<td>${row.instructor}</td>`;
                        if (!$("#subject").val()) tableHtml += `<td>${row.subject}</td>`;
                        if (!$("#section").val()) tableHtml += `<td>${row.section}</td>`;
                        if (!$("#program").val()) tableHtml += `<td>${row.program}</td>`;
                        tableHtml += `<td>${row.total_enrolled}</td></tr>`;
                    });

                    tableHtml += "</tbody></table>";
                    $("#reportResults").html(tableHtml);
                } else {
                    $("#reportResults").html("<p>No data found.</p>");
                }
            }
        });
    }

    
    $(".filter-dropdown").change(fetchFilteredReport);
});
</script>
@endsection
