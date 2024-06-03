@extends('layouts.app')

@section('content')
<div class="container">
     <section class="content-header">
       <input type="button" onclick="window.location.href='{{ route('secretary.teacher_list.future_subjects1', ['instructorId' => $instructor->id]) }}';" class="btn btn-info" value="Back" />

      </section>

    <div class="card">
        <div class="card-header">
            Assign Subjects to {{ $instructor->name }} {{ $instructor->middle_name }} {{ $instructor->last_name }}
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('secretary.teacher_list.store_subject1') }}">
                @csrf
                <input type="hidden" name="instructor_id" value="{{ $instructor->id }}">

                <div class="form-group">
                    <label for="year_level">Year Level</label>
                    <select class="form-control" id="year_level" name="year_level" required>
                        <option value="" disabled selected>--- Select Year Level ---</option>
                        @foreach(range(1, 5) as $yearLevel)
                            <option value="{{ $yearLevel }}">Year Level {{ $yearLevel }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="subject_code">Subject Code</label>
                    <select class="form-control" id="subject_code" required>
                        <option value="" disabled selected>--- Select Subject Code ---</option>
                        @foreach($subjectDescriptions as $subjectDescription)
                            <option value="{{ $subjectDescription->id }}" data-year-level="{{ $subjectDescription->year_level }}" data-description="{{ $subjectDescription->subject_name }}" data-code="{{ $subjectDescription->subject_code }}">
                                {{ $subjectDescription->subject_code }}
                            </option>
                        @endforeach
                    </select>
                    <input type="hidden" id="subject_code_hidden" name="subject_code">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" readonly>
                </div>
                <div class="form-group">
                    <label for="section">Section</label>
                    <select class="form-control" id="section" required>
                        <option value="" disabled selected>--- Select Section ---</option>
                    </select>
                    <input type="hidden" id="section_hidden" name="section">
                </div>
                <div class="form-group">
                    <label for="term">Term</label>
                    <input type="text" class="form-control" id="term" name="term" required readonly>
                </div>
                 <div class="form-group">
                    <label for="subject_type">Subject Type</label>
                    <select class="form-control" id="subject_type" name="subject_type" required>
                        <option value="" disabled selected>--- Select Subject Type ---</option>
                        <option value="Lec">Lec</option>
                        <option value="Lab">Lab</option>
                        @foreach($subjectTypes as $subjectType)
                            <option value="{{ $subjectType->subject_type }}">{{ $subjectType->subject_type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="days">Days</label>
                    <input type="text" class="form-control" id="days" name="days" required>
                </div>
                <div class="form-group">
                    <label for="time">Time</label>
                    <input type="text" class="form-control" id="time" name="time" required>
                </div>
                <div class="form-group">
                    <label for="room">Room</label>
                    <input type="text" class="form-control" id="room" name="room" required>
                </div>

                <button type="submit" class="btn btn-primary">Assign Subject</button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const yearLevelSelect = document.getElementById('year_level');
    const subjectCodeSelect = document.getElementById('subject_code');
    const descriptionInput = document.getElementById('description');
    const sectionSelect = document.getElementById('section');
    const subjectCodeHidden = document.getElementById('subject_code_hidden');
    const sectionHidden = document.getElementById('section_hidden');
    const termInput = document.getElementById('term');

    const currentSemester = @json($currentSemester);

    function filterSubjectCodes() {
        const selectedYearLevel = yearLevelSelect.value;
        for (const option of subjectCodeSelect.options) {
            if (option.value) {
                option.style.display = option.getAttribute('data-year-level') == selectedYearLevel ? '' : 'none';
            }
        }
        subjectCodeSelect.value = '';
        descriptionInput.value = '';
        sectionSelect.innerHTML = '<option value="" disabled selected>--- Select Section ---</option>';
    }

    function fetchSections(subjectDescriptionId) {
        if (!subjectDescriptionId) {
            sectionSelect.innerHTML = '<option value="" disabled selected>--- Select Section ---</option>';
            return;
        }

        const url = `/ocrs/secretary/get-sections/${subjectDescriptionId}`;

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Sections:', data);
                sectionSelect.innerHTML = '';

                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.disabled = true;
                defaultOption.selected = true;
                defaultOption.textContent = '--- Select Section ---';
                sectionSelect.appendChild(defaultOption);

                data.forEach(section => {
                    const option = document.createElement('option');
                    option.value = section.section_name;
                    option.textContent = section.section_name;
                    sectionSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching sections:', error);
                sectionSelect.innerHTML = '<option value="" disabled selected>Error fetching sections</option>';
            });
    }

    function setNextTerm() {
        const currentTerm = currentSemester.semester_name;
        const currentYear = currentSemester.school_year;

        let nextTerm = '';
        let nextYear = currentYear;

        switch (currentTerm) {
            case 'First Semester':
                nextTerm = 'Second Semester';
                break;
            case 'Second Semester':
                nextTerm = 'Short Term';
                break;
            case 'Short Term':
                nextTerm = 'First Semester';
                const years = currentYear.split(' - ');
                const startYear = parseInt(years[0], 10) + 1;
                const endYear = parseInt(years[1], 10) + 1;
                nextYear = `${startYear} - ${endYear}`;
                break;
            default:
                console.error('Unknown term:', currentTerm);
        }

        termInput.value = `${nextTerm}, ${nextYear}`;
    }

    yearLevelSelect.addEventListener('change', filterSubjectCodes);

    subjectCodeSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const description = selectedOption.getAttribute('data-description');
        const subjectCode = selectedOption.getAttribute('data-code');
        descriptionInput.value = description;
        subjectCodeHidden.value = subjectCode;

        const subjectDescriptionId = selectedOption.value;
        fetchSections(subjectDescriptionId);
    });

    sectionSelect.addEventListener('change', function() {
        sectionHidden.value = this.options[this.selectedIndex].text;
    });

    setNextTerm();
});
</script>
@endsection
