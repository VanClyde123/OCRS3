   
@extends('layouts.app')

@section('content')
    @push('scripts')
        <script>
            $(document).ready(function () {
                let assessmentCounter = 0;
                let savedAssessments = null; 
                let assessments = [];
                let newAssessments = [];
                $('#assessmentModal').on('shown.bs.modal', function () {
                    $('#gradingPeriod, #assessmentType').trigger('change');
                });
                $('#addAssessmentFieldsBtn').click(function () {
                    addAssessmentFields(true);
                });
                
                function fetchAssessments(gradingPeriod, type) {
                    const filteredAssessments = assessments.filter(
                        assessment => assessment.grading_period === gradingPeriod && assessment.type === type
                    );
                    updateAssessmentFields(filteredAssessments);
                }
                function addAssessmentFields(isNew) {
                    const assessmentCount = $('.assessment-container').length + 1;
                    const assessmentField = `
                       <div class="mb-2 assessment-container" data-is-new="${isNew}">
                        <label for="assessmentType${assessmentCount}">Type</label>
                        <select class="form-control" name="type" disabled>
                            <option value="${$('#assessmentType').val()}">${$('#assessmentType').val()}</option>
                        </select>
                        <label for="assessmentDescription${assessmentCount}">Description</label>
                        <select name="description" id="assessmentDescription" class="form-control" required></select>
                        <div id="custom" style="display:none;">
                            <label for="manualDescription${assessmentCount}">Description (Manual)</label>
                            <input type="text" class="form-control" name="manual_description">
                            <small class="text-muted instruction-text">In case the description for the assessment does not exists in the dropdown, use manual input</small><br>
                        </div>
                        <label for="assessmentMaxPoints${assessmentCount}">Max Points</label>
                        <input type="number" class="form-control" min="1" max="100" name="max_points" value="">
                        <small class="text-muted instruction-text">For Additional Points and Bonus Assessment Type, no need to insert max points</small><br>
                        <label for="assessmentActivityDate${assessmentCount}">Activity Date</label>
                        <input type="date" class="form-control" name="activity_date" value="">
                    </div>
                    `;

                    $('#assessmentFieldsContainer').append(assessmentField);

                    
                    const selectedGradingPeriod = $('#gradingPeriod').val();
                    const selectedType = $('#assessmentType').val();
                    const selectedSubjectCode = $('#subject_code').val(); 

                    $.ajax({
                        type: 'GET',
                        url: '{{ route('assessment-descriptions.fetch') }}',
                        data: {
                            grading_period: selectedGradingPeriod,
                            type: selectedType,
                            subject_code: selectedSubjectCode 
                        },
                        success: function (response) {
                            const descriptions = response.descriptions;
                            updateDescriptionDropdown(descriptions, `#assessmentFieldsContainer .assessment-container:last-child select[name="description"]`);
                        },
                        error: function (error) {
                            console.error('Error:', error);
                        },
                    });
                    assessmentCounter++;
                }
                function updateDescriptionDropdown(descriptions, targetSelector) {
                    const $descriptionDropdown = $(targetSelector);
                    $descriptionDropdown.empty();
                    $descriptionDropdown.append($('<option>', {
                        value: '',
                        text: '------Select Description--------',
                        selected: true,
                        disabled: true, 
                    }));
                    $descriptionDropdown.append($('<option>', {
                        value: 'custom', // use a string value 
                        text: 'Custom Description',
                        selected: false,
                        disabled: false, 
                    }));
                    descriptions.forEach(description => {
                        $descriptionDropdown.append($('<option>', {
                            value: description.description,
                            text: description.description,
                        }));
                    });
                    $descriptionDropdown.on('change', function() {
                        if ($(this).val() === 'custom') {
                            $('#custom').show(); 
                        } else {
                            $('#custom').hide();
                        }
                    });
                }

                function resetIsNewFlag() {
                $('.assessment-container').each(function () {
                    $(this).data('isNew', false);
                });
                }

                
                function populateAssessmentFields(assessments) {
            
                    assessments.forEach(function (assessment, index) {
                        const assessmentField = `
                            <div class="mb-3 assessment-container">
                                <label for="assessmentType${index}">Type</label>
                                <select class="form-control" name="type" >
                                    <option value="${assessment.type}">${assessment.type}</option>
                                </select>
                                <label for="assessmentDescription${index}">Description</label>
                                <input type="text" class="form-control" name="description" value="${assessment.description}">
                                <label for="assessmentMaxPoints${index}">Max Points</label>
                                <input type="number" class="form-control assessmentMaxPoints" id="assessmentMaxPoints${index}"  min="1" name="assessment_max_points[]" value="${assessment.maxPoints}">
                                <label for="assessmentActivityDate${index}">Activity Date</label>
                                <input type="date" class="form-control" name="activity_date" value="${assessment.activity_date}">
                    
                            </div>
                        `;
                        $('#assessmentFieldsContainer').append(assessmentField);
                        $(`#assessmentMaxPoints${index}`).val(assessment.maxPoints);
                        $('#assessmentFieldsContainer').append(assessmentField);
                    });
                }
                $('#assessmentModalButton').click(function () {
                    $('#assessmentModal').modal('show');
                    $('#gradingPeriod, #assessmentType').change(function () {
                        const selectedGradingPeriod = $('#gradingPeriod').val();
                        const selectedType = $('#assessmentType').val();


                        $.ajax({
                            type: 'GET',
                            url: '{{ route('assessments.fetch') }}',
                            data: {
                                grading_period: selectedGradingPeriod,
                                type: selectedType,
                                subject_id: $('#subject_id').val(),
                                subject_type: $('#subject_type').val(),

                            },
                            success: function (response) {
                                const assessments = response.assessments;
                                updateAssessmentFields(assessments);
                            },
                            error: function (error) {
                                console.error('Error:', error);
                            },
                        });
                    });
                });
                function updateAssessmentFields(assessments) {
                    const assessmentFields = assessments.map((assessment, index) => {
                        return `
                            <div class="mb-2 assessment-container">
                                <label for="assessmentType${index}">Type</label>
                                <select class="form-control" name="type" disabled>
                                    <option value="${assessment.type}">${assessment.type}</option>
                                </select>
                                <label for="assessmentDescription${index}">Description</label>
                                <input type="text" class="form-control" name="description" value="${assessment.description}" disabled>
                                <label for="assessmentMaxPoints${index}">Max Points</label>
                            <input type="number" class="form-control assessmentMaxPoints" id="assessmentMaxPoints${index}" min="1" name="assessment_max_points[]" value="${assessment.maxPoints}" disabled>
                            <label for="assessmentActivityDate${index}">Activity Date</label>
                                <input type="date" class="form-control" name="activity_date" value="${assessment.activity_date}" disabled>
                    
                            </div>
                        `;
                    });

                
                    $('#assessmentFieldsContainer').empty().append(assessmentFields);
                }
                $('#saveAssessmentsBtn').click(function () {
                
                    const assessments = [];
                    $('.assessment-container').each(function (index) {
                        const isNew = $(this).data('isNew');
                        const gradingPeriod = $('#gradingPeriod').val();
                        const type = $(this).find('.form-control[name="type"]').val();
                        const description = $(this).find('.form-control[name="description"]').val();
                        const manualDescription = $(this).find('.form-control[name="manual_description"]').val(); 
                        const max_points = $(this).find('.form-control[name="max_points"]').val();
                        const activity_date = $(this).find('.form-control[name="activity_date"]').val();

                        assessments.push({ isNew, grading_period: gradingPeriod, type, description, manual_description: manualDescription, max_points, activity_date });
                    });

                    console.log('Assessments to save:', assessments);

                
                    const newAssessmentsToSave = assessments.filter(assessment => assessment.isNew);

                
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('assessments.store') }}',
                        data: {
                            _token: $('input[name="_token"]').val(),
                            assessments: JSON.stringify(assessments),
                            subject_id: $('#subject_id').val(),
                            subject_type: $('#subject_type').val(),
                        },
                        success: function (response) {
                        
                            $('#assessmentModal').modal('hide');
                            window.location.href = window.location.href;
                        },
                        error: function (error) {
                            console.error('Error:', error);
                        },
                    });
                });
            });
        </script>

        <script> 
            $(document).ready(function () {
            console.log('Score Modal script is running.');
            $('.score-button').on('click', function (event) {
                    const enrolledStudentId = $(this).data('enrolled-student-id');
                    const modal = $(`#scoreModal-${enrolledStudentId}`);
                    let isSaving = false; 
                    $('.save-score').on('click', function (event) {
                        event.preventDefault();

                        if (isSaving) {
                            return; 
                        }

                        isSaving = true;

                        //console.log('save button clicked');

                        const assessmentId = modal.find('#assessment').val();
                        const points = modal.find('#points').val();

                    
                        const url = `{{ route('insert.score', '') }}/${enrolledStudentId}`;

                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {
                                _token: '{{ csrf_token() }}',
                                enrolledStudentId: enrolledStudentId,
                                assessmentId: assessmentId,
                                points: points
                            },
                            success: function (response) {
                                console.log('Score saved successfully');
                                modal.modal('hide');
                                isSaving = false; 
                                location.reload(); 
                            },
                            error: function (error) {
                                console.error('Error:', error);
                                isSaving = false; 
                            }
                        });
                    });
                });
            });
        </script>

        <script>
            function deleteStudent(enrolledStudentId) {
                if (confirm('Are you sure you want to delete this student?')) {
                    var form = document.createElement('form');
                    form.action = "{{ url('delete-student') }}" + '/' + enrolledStudentId;
                    form.method = 'post';
                    form.style.display = 'none';

                
                    var csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = "{{ csrf_token() }}";
                    form.appendChild(csrfToken);

            
                    var methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';
                    form.appendChild(methodField);

                    document.body.appendChild(form);
                    form.submit();
                }
            }
        </script>
        
        <script>
            $(document).ready(function () {   
                function updateAssessmentTypeOptions() {
                    var subjectType = $('#subject_type').val();
                    var gradingPeriod = $('#gradingPeriod').val(); 
                    var assessmentTypeDropdown = $('#assessmentType');
                    var options = [];

                    
                    
                    if (subjectType === 'Lec') {
                        options = ['Quiz', 'OtherActivity', 'Exam', 'Additional Points Quiz', 'Additional Points OT', 'Additional Points Exam'];
                        if (gradingPeriod === 'Finals') {
                            options.push('Direct Bonus Grade');
                        }
                    } 
                    
                    else if (subjectType === 'Lab') {
                        options = ['Lab Activity', 'Lab Exam', 'Additional Points Lab'];
                        if (gradingPeriod === 'Finals') {
                            options.push('Direct Bonus Grade');
                        }
                    } 
                    
                    else if (subjectType.startsWith('LecLab')) {
                        options = ['Quiz', 'OtherActivity', 'Exam', 'Lab Activity', 'Lab Exam', 'Additional Points Quiz', 'Additional Points OT', 'Additional Points Exam', 'Additional Points Lab'];
                        if (gradingPeriod === 'Finals') {
                            options.push('Direct Bonus Grade');
                        }
                    } 

                    
                    assessmentTypeDropdown.empty();

                
                    for (var i = 0; i < options.length; i++) {
                        assessmentTypeDropdown.append('<option value="' + options[i] + '">' + options[i] + '</option>');
                    }
                }
                updateAssessmentTypeOptions();
                ///// binds the change event to update options when grading period and subject type option changes
                $('#subject_type').change(updateAssessmentTypeOptions);
                $('#gradingPeriod').change(updateAssessmentTypeOptions);
            });
        </script>

        <script>
            $(document).ready(function () {
                $('.assessment-description').popover({
                    trigger: 'hover',
                    placement: 'top', 
                    container: 'body', 
                    html: true,
                    content: function () {
                        return $(this).data('description');
                    }
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('.btn-publish').forEach(function (btn) {
                    btn.addEventListener('click', function (event) {
                    event.preventDefault();

                    var assessmentId = this.getAttribute('data-assessment-id');
                    var assessmentDescription = findClosestAssessmentDescription(this);

                    if (!assessmentDescription) {
                        console.error('Error: Associated assessment description not found.');
                        return;
                    }

                    console.log('Selected button:', this);
                    console.log('Parent TH:', assessmentDescription.closest('th'));
                    console.log('Associated assessment description:', assessmentDescription);

                    var isPublished = this.getAttribute('data-published') === 'true';

                    var confirmPublish = confirm('Do you want to ' + (isPublished ? 'hide' : 'show') + ' scores for this assessment to the students?');
                    if (confirmPublish) {
                        
                            fetch('{{ route("update.publish.status") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({ assessmentId: assessmentId, isPublished: !isPublished })
                            })
                            .then(response => response.json())
                            .then(data => {
                            
                                console.log('AJAX Response:', data);

                                
                                if (data.success) {
                                    btn.innerText = isPublished ? 'Show Scores' : 'Hide Scores';
                                    btn.setAttribute('data-published', isPublished ? 'false' : 'true');
                                } else {
                                    console.error('Error:', data.message);
                                }
                            })
                            .catch(error => {
                                console.error('AJAX Error:', error);

                                
                                console.log('Assessment ID:', assessmentId);
                                console.log('Is Published:', !isPublished);
                            });
                        }
                    });
                });
                function findClosestAssessmentDescription(element) {
                    var parent = element.closest('.assessment-column');
                    if (parent) {
                        return parent.querySelector('.assessment-description');
                    }
                    return null;
                }
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('.btn-publish-grades').forEach(function (btn) {
                    btn.addEventListener('click', function (event) {
                        event.preventDefault();

                        var gradingPeriod = this.getAttribute('data-grading-period');
                        var subjectId = this.getAttribute('data-subject-id');
                        console.log('Clicked the Publish Grades button for grading period:', gradingPeriod);
                        console.log('Subject ID:', subjectId);

                        var isPublished = this.getAttribute('data-published') === 'true';
                        var confirmMessage = 'Do you want to ' + (isPublished ? 'hide' : 'publish') + ' grades for ' + gradingPeriod + '?';
                        var confirmPublish = confirm(confirmMessage);

                        if (confirmPublish) {
                            fetch('{{ route("update.publish.grades.status") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({
                                    gradingPeriod: gradingPeriod,
                                    isPublished: !isPublished,
                                    subjectId: subjectId
                                })
                            })
                                .then(response => {
                                    console.log('Response status:', response.status);
                                    return response.json();
                                })
                                .then(data => {
                                    console.log('Server response:', data);

                                    btn.innerText = isPublished ? 'Publish Grades' : 'Hide Grades';
                                    btn.setAttribute('data-published', isPublished ? 'false' : 'true');

                                    localStorage.setItem('publishedState_' + gradingPeriod + '_' + subjectId, !isPublished);

                                    console.log('Grades for ' + gradingPeriod + ' ' + (isPublished ? 'hidden' : 'published') + ' successfully.');
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                });
                        }
                    });
                });

                document.querySelectorAll('.btn-publish-grades').forEach(function (btn) {
                    var gradingPeriod = btn.getAttribute('data-grading-period');
                    var subjectId = btn.getAttribute('data-subject-id');
                    var isPublished = localStorage.getItem('publishedState_' + gradingPeriod + '_' + subjectId) === 'true';

                    btn.innerText = isPublished ? 'Hide Grades' : 'Publish Grades';
                    btn.setAttribute('data-published', isPublished ? 'true' : 'false');
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                function updateDisplayedValue(dropdown, actualGrade, selectedStatus) {
                    var displayedValue;
                    switch (selectedStatus) {
                        case 'DEFAULT':
                            displayedValue = actualGrade;
                            break;
                        case 'DRP':
                            displayedValue = 'DRP';
                            break;
                        case 'WITHDRAW':
                            displayedValue = 'Withdraw';
                            break;
                        case 'INC':
                            displayedValue = 'INC';
                            break;
                        case 'NFE':
                            displayedValue = 'NFE';
                            break;
                        default:
                            displayedValue = actualGrade;
                            break;
                    }
                    dropdown.closest('.grade-dropdown').find('.displayed-value').text(displayedValue);
                }

                $('.status-dropdown').change(function() {
                    var gradeId = $(this).data('grade-id');
                    var selectedStatus = $(this).val();
                    var gradeType = $(this).data('grade-type');

                    var dropdown = $(this);

                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                
                    $.ajax({
                        url: '{{ route('update.grade.status') }}',
                        method: 'POST',
                        data: {
                            gradeId: gradeId,
                            status: selectedStatus,
                            gradeType: gradeType,
                            _token: csrfToken
                        },
                        success: function(response) {
                            console.log('Response:', response);
                        
                            updateDisplayedValue(dropdown, response.actualGrade, selectedStatus);
                        },
                        error: function(error) {
                            console.error('error updating grade status:', error);
                        }
                    });
                });

                $('.status-dropdown').each(function() {
                    var dropdown = $(this);
                    var actualGrade = dropdown.closest('.grade-dropdown').find('.displayed-value').text();
                    var selectedStatus = dropdown.val();
                    updateDisplayedValue(dropdown, actualGrade, selectedStatus);
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('.assessment-column input[type="text"]').on('input', function() {
                    var value = $(this).val();
                    var containsLetters = /[a-zA-Z]/.test(value);
                    var containsNumbers = /\d/.test(value);
                    
                    if (containsLetters && containsNumbers) {
                        $(this).val('');    
                        alert('Enter numbers only or letters only.');
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function() {

        
            $('.assessment-description').each(function() {
                var enrolledStudentId = $(this).data('enrolled-student-id');
                var assessmentType = $(this).data('type');
                var gradingPeriod = $(this).data('grading-period');
                updateTotalPoints(enrolledStudentId, assessmentType, gradingPeriod);
            });
            
                $('.score-input').each(function() {
                    var originalValue = $(this).val();
                    $(this).data('original-value', originalValue);
                });

            
                $('.score-input').on('blur', function() {
                    var currentValue = $(this).val();
                    var originalValue = $(this).data('original-value');

                
                    if (currentValue !== originalValue) {
                        console.log('value changed, triggersave');
                        // Update the original value data attribute
                        $(this).data('original-value', currentValue);

                        
                        savePoints($(this));
                    }
                });

                function savePoints(inputElement) {
                    var enrolledStudentId = inputElement.data('enrolled-student-id');
                    var assessmentId = inputElement.data('assessment-id');
                    var assessmentType = inputElement.data('assessment-type');
                    var gradingPeriod = inputElement.data('grading-period');
                    var points = inputElement.val();

                    console.log('Saving points:', {
                        enrolledStudentId: enrolledStudentId,
                        assessmentId: assessmentId,
                        points: points
                    });

                $.ajax({
                    url: '{{ url('insert/score') }}/' + enrolledStudentId,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        points: {
                            [enrolledStudentId]: {
                                [assessmentId]: points
                            }
                        }
                    },
                    success: function(response) {
                        console.log('Points saved successfully');
                    
                        updateTotalPoints(enrolledStudentId, assessmentType, gradingPeriod);

                    
                        fetchGrades(enrolledStudentId);
                    },
                    error: function(xhr) {
                        console.error('Error saving points:', xhr.responseText);
                    }
                });
            }

            function updateTotalPoints(enrolledStudentId, assessmentType, gradingPeriod) {
            
            var totalPoints = 0;

        
            $('input.score-input[data-enrolled-student-id="' + enrolledStudentId + '"][data-assessment-type="' + assessmentType + '"][data-grading-period="' + gradingPeriod + '"]').each(function() {
                var value = $(this).val();
                ///// empty or non-numeric values is zero
                totalPoints += isNaN(parseFloat(value)) ? 0 : parseFloat(value);
            });

            
            $('p.assessment-description[data-enrolled-student-id="' + enrolledStudentId + '"][data-type="' + assessmentType + '"][data-grading-period="' + gradingPeriod + '"]').text(totalPoints);
            }

                function fetchGrades(enrolledStudentId) {
                    var subjectId = {{ $subject->id }};
                    $.ajax({
                        url: '{{ url('fetch/grades') }}/' + subjectId + '/' + enrolledStudentId,
                        method: 'GET',
                        success: function(response) {
                            console.log('Grades fetched successfully', response.grades);

                            /// find the grades with non-null values
                    var grade = response.grades.find(g => g.total_fg_lec !== null || g.lec_fg_grade !== null || g.total_fg_lab !== null || g.lab_fg_grade !== null || g.total_fg_grade !== null || g.fg_grade !== null || g.total_midterms_lec !== null || g.lec_midterms_grade !== null);

                            if (grade) {
                            
                                var total_fg_lec = grade.total_fg_lec !== null ? grade.total_fg_lec : '';
                                var lec_fg_grade = grade.lec_fg_grade !== null ? grade.lec_fg_grade : '';
                                var total_fg_lab = grade.total_fg_lab !== null ? grade.total_fg_lab : '';
                                var lab_fg_grade = grade.lab_fg_grade !== null ? grade.lab_fg_grade : '';
                                var total_fg_grade = grade.total_fg_grade !== null ? grade.total_fg_grade : '';
                                var fg_grade = grade.fg_grade !== null ? grade.fg_grade : '';
                                var total_midterms_lec  = grade.total_midterms_lec !== null ? grade.total_midterms_lec  : '';
                                var lec_midterms_grade  = grade.lec_midterms_grade  !== null ? grade.lec_midterms_grade  : '';
                                var total_midterms_lab = grade.total_midterms_lab !== null ? grade.total_midterms_lab : '';
                                var lab_midterms_grade = grade.lab_midterms_grade !== null ? grade.lab_midterms_grade : '';
                                var total_midterms_grade = grade.total_midterms_grade !== null ? grade.total_midterms_grade : '';
                                var tentative_midterms_grade  = grade.tentative_midterms_grade  !== null ? grade.tentative_midterms_grade  : '';
                                var midterms_grade = grade.midterms_grade !== null ? grade.midterms_grade : '';
                                var total_finals_lec = grade.total_finals_lec !== null ? grade.total_finals_lec : '';
                                var lec_finals_grade = grade.lec_finals_grade !== null ? grade.lec_finals_grade : '';
                                var total_finals_lab  = grade.total_finals_lab  !== null ? grade.total_finals_lab : '';
                                var lab_finals_grade = grade.lab_finals_grade!== null ? grade.lab_finals_grade : '';
                                var total_finals_grade = grade.total_finals_grade  !== null ? grade.total_finals_grade : '';
                                var tentative_finals_grade  = grade.tentative_finals_grade  !== null ? grade.tentative_finals_grade  : '';
                                var finals_grade  = grade.finals_grade !== null ? grade.finals_grade  : '';

                                $('td.grade-column[data-enrolled-student-id="' + enrolledStudentId + '"][data-grade-type="total_fg_lec"]').text(total_fg_lec);
                                $('td.grade-column[data-enrolled-student-id="' + enrolledStudentId + '"][data-grade-type="lec_fg_grade"]').text(lec_fg_grade);
                                $('td.grade-column[data-enrolled-student-id="' + enrolledStudentId + '"][data-grade-type="total_fg_lab"]').text(total_fg_lab);
                                $('td.grade-column[data-enrolled-student-id="' + enrolledStudentId + '"][data-grade-type="lab_fg_grade"]').text(lab_fg_grade);
                                $('td.grade-column[data-enrolled-student-id="' + enrolledStudentId + '"][data-grade-type="total_fg_grade"]').text(total_fg_grade);
                                $('td.grade-column[data-enrolled-student-id="' + enrolledStudentId + '"][data-grade-type="fg_grade"]').text(fg_grade);
                                $('td.grade-column[data-enrolled-student-id="' + enrolledStudentId + '"][data-grade-type="total_midterms_lec"]').text(total_midterms_lec);
                                $('td.grade-column[data-enrolled-student-id="' + enrolledStudentId + '"][data-grade-type="lec_midterms_grade"]').text(lec_midterms_grade);
                                $('td.grade-column[data-enrolled-student-id="' + enrolledStudentId + '"][data-grade-type="total_midterms_lab"]').text(total_midterms_lab);
                                $('td.grade-column[data-enrolled-student-id="' + enrolledStudentId + '"][data-grade-type="lab_midterms_grade"]').text(lab_midterms_grade);
                                $('td.grade-column[data-enrolled-student-id="' + enrolledStudentId + '"][data-grade-type="total_midterms_grade"]').text(total_midterms_grade);
                                $('td.grade-column[data-enrolled-student-id="' + enrolledStudentId + '"][data-grade-type="tentative_midterms_grade"]').text(tentative_midterms_grade);
                                $('td.grade-column[data-enrolled-student-id="' + enrolledStudentId + '"][data-grade-type="midterms_grade"]').text(midterms_grade);
                                $('td.grade-column[data-enrolled-student-id="' + enrolledStudentId + '"][data-grade-type="total_finals_lec"]').text(total_finals_lec);
                                $('td.grade-column[data-enrolled-student-id="' + enrolledStudentId + '"][data-grade-type="lec_finals_grade"]').text(lec_finals_grade);
                                $('td.grade-column[data-enrolled-student-id="' + enrolledStudentId + '"][data-grade-type="total_finals_lab"]').text(total_finals_lab);
                                $('td.grade-column[data-enrolled-student-id="' + enrolledStudentId + '"][data-grade-type="lab_finals_grade"]').text(lab_finals_grade);
                                $('td.grade-column[data-enrolled-student-id="' + enrolledStudentId + '"][data-grade-type="total_finals_grade"]').text(total_finals_grade);
                                $('td.grade-column[data-enrolled-student-id="' + enrolledStudentId + '"][data-grade-type="tentative_finals_grade"]').text(tentative_finals_grade);
                            $('span.displayed-value[data-enrolled-student-id="' + enrolledStudentId + '"][data-grade-type="finals_grade"]').text(finals_grade);

                            } else {
                                console.error('no grades fetched');
                            }
                        },
                        error: function(xhr) {
                            console.error('errorfetching grades:', xhr.responseText);
                        }
                    });
                }
            });
        </script>
    @endpush

    <style>
        .ths, .tds {
            border: 1px solid #ddd;
            padding: 6px; 
            text-align: left;
        }
        .ths{
            background-color: #f2f2f2;
        }
        .tables{
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 15px; 
        }
    </style>
    <div class="content-wrappers">
        <section class="content-header">
            <h2>{{ $subject->subject_code }} - {{ $subject->description }} ClassList</h2>
            <input action="action" onclick="window.history.go(-1); return false;" type="submit" class="btn btn-info" value="Back" /> 
            @php
                $studentCount = count($enrolledStudents);
            @endphp
            <a href="#demo" class="btn btn-info" data-toggle="collapse">Show Class Info</a>
            <div id="demo" class="collapse card" >
                <div class="table-responsive">
                    <div class="card-body">
                        <div class="class-info">
                            <table class="class-info-table tables">
                                <thead>
                                    <tr>
                                        <th class="ths"><strong>Subject:</strong> 
                                            <td class="tds">{{ $subject->subject_code }}</td>
                                        </th>
                                        <th class="ths"><strong>Description:</strong>
                                            <td class="tds">{{ $subject->description }}</td>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="ths"><strong>Section:</strong> 
                                            <td class="tds">{{ $subject->section }}</td>
                                        </th>
                                        <th class="ths"><strong>Time:</strong>
                                            <td class="tds"> {{ $subject->importedClasses->first()->time }}</td>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="ths"><strong>Enrolled Students:</strong> 
                                            <td class="tds">{{ $studentCount }}</td>
                                        </th>
                                        <th class="ths"><strong>Days:</strong> 
                                            <td class="tds">{{ $subject->importedClasses->first()->days }}</td>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="ths"><strong>Term:</strong> 
                                            <td class="tds">{{ $subject->term }}</td>
                                        </th>
                                        <th class="ths"><strong>Calculation Used:</strong> 
                                            <td class="tds">{{ $subject->subject_type }}</td>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('messages')
        <section class="content">
            
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List of Enrolled Students</h3>
                    </div>
                    <div class="table-responsive ">
                        <div class="card-body">
                            <button type="button" class="btn btn-success fixed-column" id="assessmentModalButton" data-toggle="modal" data-target="#assessmentModal" {{ $isPastSubjectList ? 'disabled' : '' }}>Add Assessment</button>
                            <a href="{{ $isPastSubjectList ? 'javascript:void(0);' : route('instructor.editAssessments', ['subjectId' => $subject->id]) }}" class="btn btn-primary {{ $isPastSubjectList ? ' disabled' : '' }}">Edit Assessments</a>

                            <form id="scoreForm" action="{{ route('insert.scores') }}" method="post">
                                @csrf
                                <div class="form-row mb-2">
                                </div>
                                <style>
                                    .table-scroll-container {
                                        overflow-x: auto;
                                        max-width: 100%;
                                    }

                                    .table-container table {
                                        width: auto;
                                    } 
                                
                                    table, th, td {
                                        border: 1px solid #000; 
                                        border-collapse: collapse;
                                    }

                                    .fixed-column {
                                        position: sticky;
                                        left: 0;
                                        z-index: 1;
                                        border: 1px solid #000; 
                                    }

                                    .assessment-column {
                                        text-align: center;
                                        width: 80px;
                                        border: 1px solid #000; 
                                        
                                    }

                                    .assessment-type-header,
                                    .grading-period-header,
                                    .gender-header {
                                        background-color: #f2f2f2;
                                        border: 1px solid #000; 

                                    }

                                    
                                    .table-container thead th {
                                        border-top: 1px solid #000; 
                                        border-bottom: 1px solid #000; 
                                    }

                                    
                                    .table-container tbody tr:first-child td {
                                        border-top: 1px solid #000; 
                                        border-bottom: 1px solid #000; 
                                    }
                                </style>
                                <div class="table-container table-striped" class="table-scroll-container" >
                                    <table class="table ">
                                       <thead>
                                            <tr>
                                                <!-- Fixed columns -->
                                                <th class="fixed-column"></th>
                                                <th class="fixed-column"></th>
                                                <th class="fixed-column"></th>
                                                <th class="fixed-column"></th> 
                                                @php
                                                    $gradingPeriods = $assessments->pluck('grading_period')->unique();
                                                    $assessmentTypes = $assessments->pluck('type')->unique();
                                                @endphp
                                                @foreach ($gradingPeriods as $gradingPeriod)
                                                    @php
                                                        $gradingPeriodAssessmentTypes = $assessments
                                                            ->where('grading_period', $gradingPeriod)
                                                            ->pluck('type')
                                                            ->unique();
                                                        $colspan = $gradingPeriodAssessmentTypes->reduce(function ($carry, $assessmentType) use ($assessments, $gradingPeriod) {
                                                            return $carry + $assessments
                                                                ->where('grading_period', $gradingPeriod)
                                                                ->where('type', $assessmentType)
                                                                ->count() + 1;
                                                        }, 0);
                                                    @endphp
                                                    @if ($gradingPeriod == "First Grading")
                                                        @if (strpos($subject->subject_type, 'LecLab') !== false)
                                                            <th colspan="{{ $colspan + 5 }}" class="text-center grading-period-header">
                                                                {{ $gradingPeriod }}
                                                            </th>
                                                        @else
                                                            <th colspan="{{ $colspan + 2 }}" class="text-center grading-period-header">
                                                                {{ $gradingPeriod }}
                                                            </th>
                                                        @endif
                                                    @else 
                                                          @if (strpos($subject->subject_type, 'LecLab') !== false)
                                                            <th colspan="{{ $colspan + 6 }}" class="text-center grading-period-header">
                                                                {{ $gradingPeriod }}
                                                            </th>
                                                        @else
                                                            <th colspan="{{ $colspan + 3 }}" class="text-center grading-period-header">
                                                                {{ $gradingPeriod }}
                                                            </th>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <!-- Fixed columns -->
                                                <th class="fixed-column"></th> 
                                                <th class="fixed-column"></th> 
                                                <th class="fixed-column"></th> 
                                                <th class="fixed-column"></th> 
                                                @foreach ($gradingPeriods as $gradingPeriod)
                                                    @php
                                                        $gradingPeriodAssessmentTypes = $assessments
                                                            ->where('grading_period', $gradingPeriod)
                                                            ->pluck('type')
                                                            ->unique();
                                                    @endphp
                                               @php
                                                 ////////// variable to track the last type header
                                                    $lastAssessmentType = '';

                                                /////// variable to track if Total Lec/Lec Grade headers is already present
                                                    $showTotalLecHeaders = false; 

                                                ////// checks the last specific assessment type header
                                                    foreach ($gradingPeriodAssessmentTypes as $assessmentType) {
                                                        if (in_array($assessmentType, ['Quiz', 'OtherActivity', 'Exam'])) {
                                                            $lastAssessmentType = $assessmentType;
                                                        }
                                                    }

                                                 ///////// display Total Lec/Lec Grade headers if the last assessment type header is one of the specified types
                                                    if ($lastAssessmentType !== '') {
                                                        $showTotalLecHeaders = true;
                                                    }
                                               @endphp

                                            @foreach ($gradingPeriodAssessmentTypes as $assessmentType)
                                               
                                                <th colspan="{{ $assessments->where('grading_period', $gradingPeriod)->where('type', $assessmentType)->count() }}" class="text-center assessment-type-header">
                                                    {{ $assessmentType }}
                                                </th>

                                                @php
                                                    $headerText = '';
                                                    switch ($assessmentType) {
                                                        case 'Quiz':
                                                            $headerText = 'QT';
                                                            break;
                                                        case 'OtherActivity':
                                                            $headerText = 'OAT';
                                                            break;
                                                        case 'Exam':
                                                            $headerText = 'ET';
                                                            break;
                                                        case 'Lab Activity':
                                                            $headerText = 'LT';
                                                            break;
                                                        case 'Lab Exam':
                                                            $headerText = 'ET';
                                                            break;
                                                        case 'Direct Bonus Grade':
                                                            $headerText = 'FGT';
                                                            break;
                                                       
                                                    }
                                                @endphp


                                                <th class="text-center">{{ $headerText }}</th>

                                                
                                                @if ($assessmentType === $lastAssessmentType && $showTotalLecHeaders)
                                                 
                                                    @if ($gradingPeriod == "First Grading" && strpos($subject->subject_type, 'LecLab') !== false)
                                                        <th class="text-center">Total Lec</th>
                                                        <th class="text-center">Lec Grade</th>
                                                    @endif

                                                     @if ($gradingPeriod == "Midterm" && strpos($subject->subject_type, 'LecLab') !== false)
                                                        <th class="text-center">Total Midterm Lec</th>
                                                        <th class="text-center">Midterm Lec Grade</th>
                                                    @endif

                                                     @if ($gradingPeriod == "Finals" && strpos($subject->subject_type, 'LecLab') !== false)
                                                        <th class="text-center">Total Finals Lec</th>
                                                        <th class="text-center">Finals Lec Grade</th>
                                                    @endif
                                                @endif
                                            @endforeach


                                                    @if (strpos($subject->subject_type, 'LecLab') !== false)
                                                        @if ($gradingPeriod == "First Grading")
                                                            <th class="text-center">Total Lab</th>
                                                            <th class="text-center">Lab Grade</th>
                                                            <th class="text-center">FG Grade</th>
                                                        @endif
                                                        @else
                                                            @if ($gradingPeriod == "First Grading")
                                                                <th class="text-center">Over All Total</th>
                                                                <th class="text-center">FG Grade</th>
                                                            @endif
                                                    @endif 
                                                    @if (strpos($subject->subject_type, 'LecLab') !== false)      
                                                        @if ($gradingPeriod == "Midterm")
                                                            <th class="text-center">Total Midterm Lab</th>
                                                            <th class="text-center">Midterm Lab Grade</th>
                                                            <th class="text-center">Tentative Midterm Grade</th>
                                                            <th class="text-center">Midterm Grade</th>
                                                        @endif
                                                        @else
                                                            @if ($gradingPeriod == "Midterm")
                                                                <th class="text-center">Over All Total</th>
                                                                <th class="text-center">Tentative Midterm Grade</th>
                                                                <th class="text-center">Midterm Grade</th>
                                                             @endif
                                                    @endif
                                                    @if (strpos($subject->subject_type, 'LecLab') !== false)    
                                                        @if ($gradingPeriod == "Finals")
                                                            <th class="text-center">Total Finals Lab</th>
                                                            <th class="text-center">Finals Lab Grade</th>
                                                            <th class="text-center">Tentative Finals Grade</th>
                                                            <th class="text-center">Final Grade</th>
                                                        @endif
                                                        @else
                                                            @if ($gradingPeriod == "Finals")
                                                            <th class="text-center">Over All Total</th>
                                                            <th class="text-center">Tentative Final Grade</th>
                                                            <th class="text-center">Final Grade</th>
                                                        @endif
                                                     @endif
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <th class="fixed-column"></th> 
                                                <th class="fixed-column"></th> 
                                                <th class="fixed-column"></th> 
                                                <th class="fixed-column"></th> 
                                                @foreach ($gradingPeriods as $gradingPeriod)
                                                    @foreach ($assessmentTypes as $assessmentType)
                                                        @php
                                                            $gradingPeriodAssessments = $assessments
                                                                ->where('grading_period', $gradingPeriod)
                                                                ->where('type', $assessmentType)
                                                                ->sortBy(function ($assessment) {
                                                                    $typeOrder = [
                                                                        'Quiz' => 1,
                                                                        'Additional Points Quiz' => 1,
                                                                        'OtherActivity' => 2,
                                                                        'Additional Points OT' => 2,
                                                                        'Exam' => 3,
                                                                        'Additional Points Exam' => 3,
                                                                        'Lab Activity' => 4,
                                                                        'Additional Points Lab' => 4,
                                                                        'Lab Exam' => 5,
                                                                        'Direct Bonus Grade' => 6,
                                                                    ];
                                                                    return [
                                                                        'type_order' => $typeOrder[$assessment->type] ?? 999,
                                                                    'activity_date' => $assessment->activity_date ? $assessment->activity_date : '9999-12-31',
                                                                    ];
                                                                });
                                                            $maxPointsTotal = $gradingPeriodAssessments->sum('max_points');
                                                            $hasAssessments = $gradingPeriodAssessments->isNotEmpty();
                                                        @endphp
                                                        @foreach ($gradingPeriodAssessments as $assessment)
                                                            <th class="assessment-column">
                                                                <p class="assessment-description"
                                                                    data-grading-period="{{ $assessment->grading_period }}"
                                                                    data-type="{{ $assessment->type }}"
                                                                    data-description="{{ $assessment->description }}">
                                                                    {{ $assessment->abbreviation }} <br> {{ number_format($assessment->max_points, $assessment->max_points == intval($assessment->max_points) ? 0 : 2) }}
                                                                </p>
                                                            </th>    
                                                        @endforeach
                                                        @if ($hasAssessments)    
                                                            <td class="assessment-column">
                                                                <p class="assessment-description"
                                                                    data-grading-period="{{ $gradingPeriod }}"
                                                                    data-type="{{ $assessmentType }}"
                                                                    data-description="Total Max Points">
                                                                    {{ $maxPointsTotal }}
                                                                </p>
                                                            </td>
                                                        @endif



                                                      
                                                    @if ($assessmentType === $lastAssessmentType && $showTotalLecHeaders)
                                                       
                                                        @if ($gradingPeriod == "First Grading" && strpos($subject->subject_type, 'LecLab') !== false)
                                                            <th class="text-center"></th>
                                                            <th class="text-center"></th>
                                                        @endif

                                                         @if ($gradingPeriod == "Midterm" && strpos($subject->subject_type, 'LecLab') !== false)
                                                            <th class="text-center"></th>
                                                            <th class="text-center"></th>
                                                        @endif

                                                         @if ($gradingPeriod == "Finals" && strpos($subject->subject_type, 'LecLab') !== false)
                                                            <th class="text-center"></th>
                                                            <th class="text-center"></th>
                                                        @endif
                                                    @endif



                                                    @endforeach
                                                    @if ($gradingPeriod == "First Grading")
                                                        @if (strpos($subject->subject_type, 'LecLab') !== false)
                                                            <th class="text-center"></th>
                                                            <th class="text-center"></th>
                                                            <th class="text-center"></th>
                                                            
                                                        @else
                                                            <th class="text-center"></th>
                                                            <th class="text-center"></th>
                                                        @endif

                                                    @endif
                                                    @if ($gradingPeriod == "Midterm")
                                                        @if (strpos($subject->subject_type, 'LecLab') !== false)
                                                            <th class="text-center"></th>
                                                            <th class="text-center"></th>
                                                            <th class="text-center"></th>
                                                            <th class="text-center"></th>
                                                        @else
                                                            <th class="text-center"></th>
                                                            <th class="text-center"></th>
                                                            <th class="text-center"></th>
                                                        @endif
                                                    @endif
                                                    @if ($gradingPeriod == "Finals")
                                                        @if (strpos($subject->subject_type, 'LecLab') !== false)
                                                            <th class="text-center"></th>
                                                            <th class="text-center"></th>
                                                            <th class="text-center"></th>
                                                            <th class="text-center"></th>
                                                        @else
                                                            <th class="text-center"></th>
                                                            <th class="text-center"></th>
                                                            <th class="text-center"></th>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <th >No.</th> 
                                                <th >ID</th> 
                                                <th >Name</th> 
                                                <th >Course</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $studentNumberMale = 1;
                                                $studentNumberFemale = 1;
                                            @endphp
                                            @foreach ($sortedStudents as $gender => $students)
                                                <tr>
                                                    <td colspan="{{ count($gradingPeriods) + 99 }}" class="gender-header">
                                                        {{ $gender }}
                                                    </td>
                                                </tr>
                                                @foreach ($students as $enrolledStudent)
                                                    <tr>
                                                        <td >{{ $gender == 'Male' ? $studentNumberMale++ : $studentNumberFemale++ }}</td>
                                                        <td >{{ $enrolledStudent->student->id_number }}</td>
                                                        <td class="fixed-column" style="background-color:white; height" >{{ $enrolledStudent->student->last_name }}, {{ $enrolledStudent->student->name }} {{ $enrolledStudent->student->middle_name }}</td>
                                                        <td >{{ $enrolledStudent->student->course }}</td>
                                                        @php
                                                            $totalPointsForAssessmentType = 0;
                                                            $currentColIndex = 1; // Start from the first column
                                                            foreach ($gradingPeriods as $gradingPeriod) {
                                                                foreach ($assessmentTypes as $assessmentType) {
                                                                    $gradingPeriodAssessments = $assessments
                                                                        ->where('grading_period', $gradingPeriod)
                                                                        ->where('type', $assessmentType)
                                                                        ->sortBy(function ($assessment) {
                                                                            $typeOrder = [
                                                                                'Quiz' => 1,
                                                                                'Additional Points Quiz' => 2,
                                                                                'OtherActivity' => 3,
                                                                                'Additional Points OT' => 4,
                                                                                'Exam' => 5,
                                                                                'Additional Points Exam' => 6,
                                                                                'Lab Activity' => 7,
                                                                                'Lab Exam' => 8,
                                                                                'Additional Points Lab' => 9,
                                                                                'Direct Bonus Grade' => 10,
                                                                            ];
                                                                            return [
                                                                                'type_order' => $typeOrder[$assessment->type] ?? 999,
                                                                                'activity_date' => $assessment->activity_date ? $assessment->activity_date : '9999-12-31',
                                                                            ];
                                                                        });
                                                                    foreach ($gradingPeriodAssessments as $assessment) {
                                                                    $textboxName = "points[{$enrolledStudent->id}][{$assessment->id}]";
                                                                    $textboxValue = is_null($enrolledStudent->getScore($assessment->id)) ? '' : $enrolledStudent->getScore($assessment->id);

                                                                    $disabled = $isPastSubjectList ? 'disabled' : ''; /// check if the subject is in the past subject list view

                                                                    echo '<td class="assessment-column">
                                                                        <input type="text" name="' . $textboxName . '" class="form-control score-input" ' . $disabled . '
                                                                           data-grading-period="' . $assessment->grading_period . '"
                                                                            data-enrolled-student-id="' . $enrolledStudent->id . '"
                                                                            data-assessment-id="' . $assessment->id . '"
                                                                            data-assessment-type="' . $assessment->type . '"
                                                                            data-original-value="' . $textboxValue . '"
                                                                            value="' . $textboxValue . '"
                                                                            style="width: 80px; text-align: center;">
                                                                    </td>';
                                                                    $totalPointsForAssessmentType += is_numeric($textboxValue) ? $textboxValue : 0;
                                                                    $currentColIndex++; 
                                                                }
                                                                if ($gradingPeriodAssessments->isNotEmpty()) {
                                                                echo '<td class="assessment-column">
                                                                    <p class="assessment-description" data-type="' . $assessmentType . '" data-description="Total Points" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grading-period="' . $gradingPeriod . '">
                                                                        ' . $totalPointsForAssessmentType . '
                                                                    </p>
                                                                </td>';

                                                                $currentColIndex++; 
                                                            }
                                                            $totalPointsForAssessmentType = 0; // reset the total points for the next assessment type



                                                      /////////////////leclab- total and lec grade////////////////
                                                           if ($assessmentType === $lastAssessmentType && $showTotalLecHeaders){
                                                                if ($gradingPeriod == "First Grading") {
                                                                    if (strpos($subject->subject_type, 'LecLab') !== false) {

                                                                        //// column for fg total lec grade
                                                                        echo '<td class="grade-column" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="total_fg_lec">';
                                                                        foreach ($enrolledStudent->grades as $grade) {
                                                                            if ($grade->total_fg_lec !== null) {
                                                                                echo '<div class="grade-dropdown displayed-value">';
                                                                                echo '<span class="displayed-value">' . $grade->total_fg_lec . '</span>';
                                                                                echo '</div>';
                                                                            }
                                                                        }
                                                                        echo '</td>';

                                                                        // column for fg lec grade
                                                                        echo '<td class="grade-column" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="lec_fg_grade">';
                                                                        foreach ($enrolledStudent->grades as $grade) {
                                                                            if ($grade->lec_fg_grade !== null) {
                                                                                echo '<div class="grade-dropdown displayed-value">';
                                                                                echo '<span class="displayed-value">' . $grade->lec_fg_grade . '</span>';
                                                                                echo '</div>';
                                                                            }
                                                                        }
                                                                        echo '</td>';
                                                                    }
                                                                }

                                                          


                                                               if ($gradingPeriod == "Midterm") {
                                                                    if (strpos($subject->subject_type, 'LecLab') !== false) {

                                                                        /// column for total mid lec grade
                                                                        echo '<td class="grade-column" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="total_midterms_lec">';
                                                                        foreach ($enrolledStudent->grades as $grade) {
                                                                            if ($grade->total_midterms_lec !== null) {
                                                                                echo '<div class="grade-dropdown displayed-value">';
                                                                                echo '<span class="displayed-value">' . $grade->total_midterms_lec . '</span>';
                                                                                echo '</div>';
                                                                            }
                                                                        }
                                                                        echo '</td>';

                                                                          /// column for mid lec grade
                                                                        echo '<td class="grade-column" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="lec_midterms_grade">';
                                                                        foreach ($enrolledStudent->grades as $grade) {
                                                                            if ($grade->lec_midterms_grade !== null) {
                                                                                echo '<div class="grade-dropdown displayed-value">';
                                                                                echo '<span class="displayed-value">' . $grade->lec_midterms_grade . '</span>';
                                                                                echo '</div>';
                                                                            }
                                                                        }
                                                                        echo '</td>';
                                                                    }
                                                                }

                                                                 if ($gradingPeriod == "Finals") {
                                                                    if (strpos($subject->subject_type, 'LecLab') !== false) {
                                                                      
                                                                            //// column for total fn lec grade
                                                                            echo '<td class="grade-column" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="total_finals_lec">';
                                                                            foreach ($enrolledStudent->grades as $grade) {
                                                                                if ($grade->total_finals_lec !== null) {
                                                                                    echo '<div class="grade-dropdown displayed-value">';
                                                                                    echo '<span class="displayed-value">' . $grade->total_finals_lec . '</span>';
                                                                                    echo '</div>';
                                                                                }
                                                                            }
                                                                            echo '</td>';

                                                                            //// column for mid fn grade
                                                                            echo '<td class="grade-column" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="lec_finals_grade">';
                                                                            foreach ($enrolledStudent->grades as $grade) {
                                                                                if ($grade->lec_finals_grade !== null) {
                                                                                    echo '<div class="grade-dropdown displayed-value">';
                                                                                    echo '<span class="displayed-value">' . $grade->lec_finals_grade . '</span>';
                                                                                    echo '</div>';
                                                                                }
                                                                            }
                                                                            echo '</td>';
                                                                        
                                                                    }
                                                                }

                                                         }



                                                            

                                                       ////////////////lec, lab - total/tentative/official grade, leclab - total lab/lab grade/tentative/official grade/////////////
                                                                }
                                                                  if ($gradingPeriod == "First Grading") {
                                                                    if (strpos($subject->subject_type, 'LecLab') !== false) {


                                                                        //// column for fg total lab grade
                                                                        echo '<td class="grade-column" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="total_fg_lab">';
                                                                        foreach ($enrolledStudent->grades as $grade) {
                                                                            if ($grade->total_fg_lab !== null) {
                                                                                echo '<div class="grade-dropdown displayed-value">';
                                                                                echo '<span class="displayed-value">' . $grade->total_fg_lab . '</span>';
                                                                                echo '</div>';
                                                                            }
                                                                        }
                                                                        echo '</td>';

                                                                         //// column for fg lab grade
                                                                        echo '<td class="grade-column" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="lab_fg_grade">';
                                                                        foreach ($enrolledStudent->grades as $grade) {
                                                                            if ($grade->lab_fg_grade !== null) {
                                                                                echo '<div class="grade-dropdown displayed-value">';
                                                                                echo '<span class="displayed-value">' . $grade->lab_fg_grade . '</span>';
                                                                                echo '</div>';
                                                                            }
                                                                        }
                                                                        echo '</td>';

                                                                        //// column for fg grade
                                                                        echo '<td class="grade-column" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="fg_grade">';
                                                                        foreach ($enrolledStudent->grades as $grade) {
                                                                            if ($grade->fg_grade !== null) {
                                                                                echo '<div class="grade-dropdown displayed-value">';
                                                                                echo '<span class="displayed-value">' . number_format($grade->fg_grade, $grade->fg_grade == intval($grade->fg_grade) ? 0 : 2) . '</span>';
                                                                                echo '</div>';
                                                                            }
                                                                        }
                                                                        echo '</td>';

                                                                    } else {
                                                                        ///// columns for Lec type/Lab type total grade and fg grade
                                                                        echo '<td class="grade-column" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="total_fg_grade">';
                                                                        foreach ($enrolledStudent->grades as $grade) {
                                                                            if ($grade->total_fg_grade !== null) {
                                                                                echo '<div class="grade-dropdown displayed-value">';
                                                                                echo '<span class="displayed-value">' . $grade->total_fg_grade . '</span>';
                                                                                echo '</div>';
                                                                            }
                                                                        }
                                                                        echo '</td>';

                                                                        echo '<td class="grade-column" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="fg_grade">';
                                                                        foreach ($enrolledStudent->grades as $grade) {
                                                                            if ($grade->fg_grade !== null) {
                                                                                echo '<div class="grade-dropdown displayed-value">';
                                                                                echo '<span class="displayed-value">' . number_format($grade->fg_grade, $grade->fg_grade == intval($grade->fg_grade) ? 0 : 2) . '</span>';
                                                                                echo '</div>';
                                                                            }
                                                                        }
                                                                        echo '</td>';
                                                                    }
                                                                }
                                                                if ($gradingPeriod == "Midterm") {
                                                                     if (strpos($subject->subject_type, 'LecLab') !== false) {
                                                                       

                                                                        //// column for total md lab grade
                                                                        echo '<td class="grade-column" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="total_midterms_lab">';
                                                                        foreach ($enrolledStudent->grades as $grade) {
                                                                            if ($grade->total_midterms_lab !== null) {
                                                                                echo '<div class="grade-dropdown displayed-value">';
                                                                                echo '<span class="displayed-value">' . $grade->total_midterms_lab . '</span>';
                                                                                echo '</div>';
                                                                            }
                                                                        }
                                                                        echo '</td>';

                                                                        //// column for md lab grade
                                                                        echo '<td class="grade-column" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="lab_midterms_grade">';
                                                                        foreach ($enrolledStudent->grades as $grade) {
                                                                            if ($grade->lab_midterms_grade !== null) {
                                                                                echo '<div class="grade-dropdown displayed-value">';
                                                                                echo '<span class="displayed-value">' . $grade->lab_midterms_grade . '</span>';
                                                                                echo '</div>';
                                                                            }
                                                                        }
                                                                        echo '</td>';

                                                                    //// column for tentative  mid grade
                                                                        echo '<td class="grade-column" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="tentative_midterms_grade">';
                                                                        foreach ($enrolledStudent->grades as $grade) {
                                                                            if ($grade->tentative_midterms_grade !== null) {
                                                                                echo '<div class="grade-dropdown displayed-value">';
                                                                                echo '<span class="displayed-value">' . $grade->tentative_midterms_grade  . '</span>';
                                                                                echo '</div>';
                                                                            }
                                                                        }
                                                                        echo '</td>';


                                                                    echo '<td class="grade-column" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="midterms_grade">';
                                                                    foreach ($enrolledStudent->grades as $grade) {
                                                                        if ($grade->midterms_grade !== null) {
                                                                            echo '<div class="grade-dropdown displayed-value">';
                                                                        echo '<span class="displayed-value">' . number_format($grade->midterms_grade, $grade->midterms_grade == intval($grade->midterms_grade) ? 0 : 2) . '</span>';
                                                                        
                                                                        }
                                                                    }
                                                                    echo '</td>';

                                                                       
                                                                    } else {

                                                                      //// column for total  mid grade
                                                                        echo '<td class="grade-column" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="total_midterms_grade">';
                                                                        foreach ($enrolledStudent->grades as $grade) {
                                                                            if ($grade->total_midterms_grade !== null) {
                                                                                echo '<div class="grade-dropdown displayed-value">';
                                                                                echo '<span class="displayed-value">' . $grade->total_midterms_grade  . '</span>';
                                                                                echo '</div>';
                                                                            }
                                                                        }
                                                                        echo '</td>';

                                                                         //// column for tentative  mid grade
                                                                        echo '<td class="grade-column" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="tentative_midterms_grade">';
                                                                        foreach ($enrolledStudent->grades as $grade) {
                                                                            if ($grade->tentative_midterms_grade !== null) {
                                                                                echo '<div class="grade-dropdown displayed-value">';
                                                                                echo '<span class="displayed-value">' . $grade->tentative_midterms_grade  . '</span>';
                                                                                echo '</div>';
                                                                            }
                                                                        }
                                                                        echo '</td>';


                                                                    echo '<td class="grade-column" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="midterms_grade">';
                                                                    foreach ($enrolledStudent->grades as $grade) {
                                                                        if ($grade->midterms_grade !== null) {
                                                                            echo '<div class="grade-dropdown displayed-value">';
                                                                        echo '<span class="displayed-value">' . number_format($grade->midterms_grade, $grade->midterms_grade == intval($grade->midterms_grade) ? 0 : 2) . '</span>';
                                                                        
                                                                        }
                                                                    }
                                                                    echo '</td>';
                                                                }
                                                            }

                                                                if ($gradingPeriod == "Finals") {
                                                                    if (strpos($subject->subject_type, 'LecLab') !== false) {
                                                                       

                                                                        //// column for total fn lab grade
                                                                        echo '<td class="grade-column" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="total_finals_lab">';
                                                                        foreach ($enrolledStudent->grades as $grade) {
                                                                            if ($grade->total_finals_lab !== null) {
                                                                                echo '<div class="grade-dropdown displayed-value">';
                                                                                echo '<span class="displayed-value">' . $grade->total_finals_lab . '</span>';
                                                                                echo '</div>';
                                                                            }
                                                                        }
                                                                        echo '</td>';

                                                                        //// column for fn lab grade
                                                                        echo '<td class="grade-column" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="lab_finals_grade">';
                                                                        foreach ($enrolledStudent->grades as $grade) {
                                                                            if ($grade->lab_finals_grade !== null) {
                                                                                echo '<div class="grade-dropdown displayed-value">';
                                                                                echo '<span class="displayed-value">' . $grade->lab_finals_grade . '</span>';
                                                                                echo '</div>';
                                                                            }
                                                                        }
                                                                        echo '</td>';

                                                                    //// column for tentative fn grade
                                                                        echo '<td class="grade-column" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="tentative_finals_grade">';
                                                                        foreach ($enrolledStudent->grades as $grade) {
                                                                            if ($grade->tentative_finals_grade !== null) {
                                                                                echo '<div class="grade-dropdown displayed-value">';
                                                                                echo '<span class="displayed-value">' . $grade->tentative_finals_grade  . '</span>';
                                                                                echo '</div>';
                                                                            }
                                                                        }
                                                                        echo '</td>';

                                                                     //// column for  fn grade
                                                                      echo '<td class="grade-column">';
                                                                       foreach ($enrolledStudent->grades as $grade) {
                                                                        echo '<div class="grade-dropdown displayed-value">';
                                                                        if ($grade->finals_grade !== null) {
                                                                            echo '<span class="displayed-value" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="finals_grade">' . number_format($grade->finals_grade, $grade->finals_grade == intval($grade->finals_grade) ? 0 : 2) . '</span>';
                                                                        
                                                                        }

                                                                        if ($grade->finals_grade !== null) {
                                                                        echo '<select class="status-dropdown" data-grade-type="final" data-grade-id="' . $grade->id . '" ' . ($isPastSubjectList ? 'disabled' : '') . '>';
                                                                                echo '<option value="DEFAULT">Grade </option>';
                                                                                echo '<option value="DRP" ' . ($grade->finals_status === 'DRP' ? 'selected' : '') . '>DRP</option>';
                                                                                    echo '<option value="WITHDRAW" ' . ($grade->finals_status === 'WITHDRAW' ? 'selected' : '') . '>Withdraw</option>';
                                                                                    echo '<option value="NFE" ' . ($grade->finals_status === 'NFE' ? 'selected' : '') . '>NFE</option>';
                                                                                    echo '<option value="INC" ' . ($grade->finals_status === 'INC' ? 'selected' : '') . '>INC</option>';
                                                                                    echo '</select>';
                                                                                echo '</div>';
                                                                                echo '<br>';
                                                                            }
                                                                    }
                                                                    echo '</td>';

                                                                       
                                                                    } else {

                                                                      //// column for total fin grade
                                                                        echo '<td class="grade-column" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="total_finals_grade">';
                                                                        foreach ($enrolledStudent->grades as $grade) {
                                                                            if ($grade->total_finals_grade !== null) {
                                                                                echo '<div class="grade-dropdown displayed-value">';
                                                                                echo '<span class="displayed-value">' . $grade->total_finals_grade  . '</span>';
                                                                                echo '</div>';
                                                                            }
                                                                        }
                                                                        echo '</td>';

                                                                         //// column for tentative fin grade
                                                                        echo '<td class="grade-column" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="tentative_finals_grade">';
                                                                        foreach ($enrolledStudent->grades as $grade) {
                                                                            if ($grade->tentative_finals_grade !== null) {
                                                                                echo '<div class="grade-dropdown displayed-value">';
                                                                                echo '<span class="displayed-value">' . $grade->tentative_finals_grade  . '</span>';
                                                                                echo '</div>';
                                                                            }
                                                                        }
                                                                        echo '</td>';


                                                                     echo '<td class="grade-column">';
                                                                       foreach ($enrolledStudent->grades as $grade) {
                                                                        echo '<div class="grade-dropdown displayed-value">';
                                                                        if ($grade->finals_grade !== null) {
                                                                            echo '<span class="displayed-value" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="finals_grade">' . number_format($grade->finals_grade, $grade->finals_grade == intval($grade->finals_grade) ? 0 : 2) . '</span>';
                                                                        
                                                                        }

                                                                        if ($grade->finals_grade !== null) {
                                                                        echo '<select class="status-dropdown" data-grade-type="final" data-grade-id="' . $grade->id . '" ' . ($isPastSubjectList ? 'disabled' : '') . '>';
                                                                                echo '<option value="DEFAULT">Grade </option>';
                                                                                echo '<option value="DRP" ' . ($grade->finals_status === 'DRP' ? 'selected' : '') . '>DRP</option>';
                                                                                    echo '<option value="WITHDRAW" ' . ($grade->finals_status === 'WITHDRAW' ? 'selected' : '') . '>Withdraw</option>';
                                                                                    echo '<option value="NFE" ' . ($grade->finals_status === 'NFE' ? 'selected' : '') . '>NFE</option>';
                                                                                    echo '<option value="INC" ' . ($grade->finals_status === 'INC' ? 'selected' : '') . '>INC</option>';
                                                                                    echo '</select>';
                                                                                echo '</div>';
                                                                                echo '<br>';
                                                                            }
                                                                    }
                                                                    echo '</td>';
                                                                }
                                                              }
                                                            }
                                                        @endphp
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                            <!----for the date appear below---->
                                            <tr>
                                                <th class="fixed-column"></th> 
                                                <th class="fixed-column"></th> 
                                                <th class="fixed-column"></th> 
                                                <th class="fixed-column"></th> 
                                                @php
                                                    $currentColIndex = 1; // Start from the first column
                                                    foreach ($gradingPeriods as $gradingPeriod) {
                                                        foreach ($assessmentTypes as $assessmentType) {
                                                            $gradingPeriodAssessments = $assessments
                                                                ->where('grading_period', $gradingPeriod)
                                                                ->where('type', $assessmentType)
                                                                ->sortBy(function ($assessment) {
                                                                    $typeOrder = [
                                                                        'Quiz' => 1,
                                                                                'Additional Points Quiz' => 2,
                                                                                'OtherActivity' => 3,
                                                                                'Additional Points OT' => 4,
                                                                                'Exam' => 5,
                                                                                'Additional Points Exam' => 6,
                                                                                'Lab Activity' => 7,
                                                                                'Lab Exam' => 8,
                                                                                'Additional Points Lab' => 9,
                                                                                'Direct Bonus Grade' => 10,
                                                                    ];
                                                                    return [
                                                                                        'type_order' => $typeOrder[$assessment->type] ?? 999,
                                                                                    'activity_date' => $assessment->activity_date ? $assessment->activity_date : '9999-12-31',
                                                                                    
                                                                                    ];
                                                                });

                                                            
                                                            foreach ($gradingPeriodAssessments as $assessment) {
                                                                echo '<th class="assessment-column">
                                                                    <p class="assessment-description"
                                                                        data-grading-period="' . $assessment->grading_period . '"
                                                                        data-type="' . $assessment->type . '"
                                                                        data-description="' . $assessment->description . '">
                                                                        ' . ($assessment->activity_date ?? '') . '
                                                                    </p>
                                                                    <button class="btn btn-sm btn-publish publish-button btn-primary" data-assessment-id="' . $assessment->id . '" data-published="' . ($assessment->published ? 'true' : 'false') . '"' . ($isPastSubjectList ? ' disabled' : '') . '>
                                                                            ' . ($assessment->published ? 'Hide Scores' : 'Show Scores') . '
                                                                        </button>

                                                                </th>';

                                                                
                                                                $currentColIndex++; ///// move to the next column
                                                            }
                                                           
                                                        if ($assessmentType === $lastAssessmentType && $showTotalLecHeaders) {
                                                           if ($gradingPeriod == "First Grading" && strpos($subject->subject_type, 'LecLab') !== false) {
                                                           
                                                                echo '<th class="assessment-column"></th>
                                                                      <th class="assessment-column"></th>';
                                                                        $currentColIndex++; ///// move to the next column
                                                                     
                                                                   }

                                                           if ($gradingPeriod == "Midterm" && strpos($subject->subject_type, 'LecLab') !== false) {
                                                           
                                                                echo '<th class="assessment-column"></th>
                                                                      <th class="assessment-column"></th>';
                                                                        $currentColIndex++; ///// move to the next column
                                                                     
                                                                   }

                                                            if ($gradingPeriod == "Finals" && strpos($subject->subject_type, 'LecLab') !== false) {
                                                            
                                                                echo '<th class="assessment-column"></th>
                                                                      <th class="assessment-column"></th>';
                                                                        $currentColIndex++; ///// move to the next column
                                                                     
                                                                   }

                                                            }


                                                            if ($gradingPeriodAssessments->isNotEmpty()) {
                                                                //// Empty th for Total Points
                                                                echo '<th class="assessment-column"></th>';
                                                                $currentColIndex++; 
                                                            }
                                                        }
                                                        $subjectId = $subject->id;
                                                            ///// Empty th for grades column under 
                                                      

                                                   if ($gradingPeriod == "First Grading") {
                                                        if (strpos($subject->subject_type, 'LecLab') !== false) {
                                                            //// for LecLab subject type
                                                            echo '<th class="grade-column"></th>
                                                                  <th class="grade-column"></th>';
                                                        } else {
                                                            //// for Lec and Lab type
                                                            echo '<th class="grade-column"></th>';
                                                        }
                                                    } else {
                                                        //// for Midterms and Finals
                                                       if (strpos($subject->subject_type, 'LecLab') !== false) {
                                                            //// for LecLab subject type
                                                            echo '<th class="grade-column"></th>
                                                                  <th class="grade-column"></th>
                                                                  <th class="grade-column"></th>';
                                                        } else {
                                                            //// for Lec and Lab type
                                                            echo '<th class="grade-column"></th>
                                                                  <th class="grade-column"></th>';
                                                        }
                                                    }

                                                    echo '
                                                    <th class="grade-column">
                                                        <button class="btn btn-sm btn-publish-grades btn-primary' . ($isPastSubjectList ? ' disabled' : '') . '"
                                                            data-grading-period="' . $gradingPeriod . '"
                                                            data-subject-id="' . $subjectId . '"'
                                                            . ($isPastSubjectList ? ' disabled' : '') . '>Grades</button>
                                                    </th>';
                                                        $currentColIndex++;
                                                    }
                                                @endphp
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <a href="{{ route('generateExcelReport', ['subjectId' => $subject->id]) }}" class="btn btn-success" target="_blank">Records Report</a>
                                <a href="{{ route('export.gradeslist', ['subjectId' => $subject->id]) }}" class="btn btn-success" target="_blank">Grades List</a>
                                <a href="{{ route('export.summary', ['subjectId' => $subject->id]) }}" class="btn btn-success" target="_blank"> Summary</a>      
                                <a href="{{ $isPastSubjectList ? 'javascript:void(0);' : route('teacher.list.studentlistremove', ['subjectId' => $subject->id]) }}" class="btn btn-danger{{ $isPastSubjectList ? ' disabled' : '' }}">Remove Students</a>

                               
                            </form>
                        </div>
                    </div>
                </div>
        </section>
    </div>
    <!----modal for setting the assessment--->
    <div class="modal fade" id="assessmentModal" tabindex="-1" role="dialog" aria-labelledby="assessmentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('assessments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="subject_code" id="subject_code" value="{{ $subject->subject_code }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="assessmentModalLabel">Set Assessment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <input type="hidden" name="assessment_id" id="assessment_id">
                    <input type="hidden" name="subject_id" id="subject_id" value="{{ $subject->id }}">
                    <input type="hidden" name="subjectType" id="subject_type" value="{{ $subject->subject_type }}">

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="gradingPeriod">Grading Period:</label>
                            <select class="form-control" id="gradingPeriod" name="grading_period" required>
                                <option value="" disabled selected>--- Select Grading Period---</option>
                                <option value="First Grading">First Grading</option>
                                <option value="Midterm">Midterm</option>
                                <option value="Finals">Finals</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="assessmentType">Assessment Type:</label>
                            <select class="form-control" id="assessmentType" name="type" required>
                             
                            </select>
                        </div>

                        <div id="assessmentFieldsContainer">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="addAssessmentFieldsBtn">+</button>
                        <button type="button" class="btn btn-primary" id="saveAssessmentsBtn">save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- 
        /.content
        /.content-wrappers \
        $('#assessmentModal').on('shown.bs.modal', function () {
            //$('#assessmentFieldsContainer').empty(); // Clear existing fields
            if (savedAssessments === null) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('assessments.fetch') }}',
                    success: function (response) {
                        savedAssessments = response.assessments;
                        populateAssessmentFields(savedAssessments);
                    },
                    error: function (error) {
                        console.error('Error:', error);
                    },
                });
            } else {
                // Data is already fetched, just populate the fields
                populateAssessmentFields(savedAssessments);
            }
        });
    -->
@endsection
<!--
    <div class="form-row mb-2">
        <div class="col-md-2">
            <label for="gradingPeriodDropdown">Grading Period:</label>
            <select id="gradingPeriodDropdown" name="gradingPeriodDropdown" class="form-control">
                <option value="First Grading">First Grading</option>
                <option value="Midterm">Midterm</option>
                <option value="Finals">Finals</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="typeDropdown">Assessment Type:</label>
            <select id="typeDropdown" name="typeDropdown" class="form-control">
                
                <option value="Quiz">Quiz</option>
                <option value="OtherActivity">OtherActivity</option>
                <option value="Project">Project</option>
                <option value="Exam">Exam</option>
                <option value="Lab Activity">Lab Activity</option>
            </select>
        </div>
    </div>
-->
                                