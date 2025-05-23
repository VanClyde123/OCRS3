   
@extends('layouts.app')

@section('content')

    @php
        $header_title = "Student Records";
    @endphp
    
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

                $('#gradingPeriod, #assessmentType').change(function () {
                   
                    const selectedGradingPeriod = $('#gradingPeriod').val();
                    const selectedType = $('#assessmentType').val();

                   
                    $('#assessmentFieldsContainer').empty();

                    fetchAssessments(selectedGradingPeriod, selectedType);
                });

                function fetchAssessments(gradingPeriod, type) {
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('assessments.fetch') }}',
                        data: {
                            grading_period: gradingPeriod,
                            type: type,
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
        <select name="description" id="assessmentDescription${assessmentCount}" class="form-control description-select" required>
            <option value="default">Select description</option>
            <option value="custom">Enter manually</option>
        </select>

        <div id="custom${assessmentCount}" style="display:none;">
            <label for="manualDescription${assessmentCount}">Description (Manual)</label>
            <input type="text" class="form-control" name="manual_description">
            <small class="text-muted instruction-text">In case the description for the assessment does not exist in the dropdown, use manual input</small><br>
        </div>

        <label for="assessmentMaxPoints${assessmentCount}">Max Points</label>
        <input type="number" class="form-control" min="1" max="100" name="max_points" value="">
        <small class="text-muted instruction-text">For Additional Points and Bonus Assessment Type, no need to insert max points</small><br>

        <label for="assessmentActivityDate${assessmentCount}">Activity Date</label>
        <select class="form-control date-choice" id="dateChoice${assessmentCount}">
            <option value="date">Pick a Date</option>
            <option value="text">Enter Date Manually</option>
        </select>
        
        <input type="date" class="form-control date-picker" id="datePicker${assessmentCount}" name="activity_date" value="">
        <input type="text" class="form-control manual-date" id="manualDate${assessmentCount}" name="manual_activity_date" placeholder="Enter date (MM/DD/YYYY)" style="display: none;">
        
        <small class="text-muted instruction-text">For Additional Points and Bonus Assessment Type, no need to insert the date</small><br>
    </div>
`;

//////handles dropdown changes
$(document).on('change', '.description-select', function () {
    let container = $(this).closest('.assessment-container');
    let customInput = container.find(`#custom${assessmentCount}`);
    if ($(this).val() === 'custom') {
        customInput.show();
    } else {
        customInput.hide();
    }
});

$(document).on('change', '.date-choice', function () {
    let container = $(this).closest('.assessment-container');
    let datePicker = container.find('.date-picker');
    let manualDate = container.find('.manual-date');

    if ($(this).val() === 'text') {
        datePicker.val('').hide();
        manualDate.show();
    } else {
        manualDate.val('').hide();
        datePicker.show();
    }
});


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
                        value: 'custom', 
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
                    $descriptionDropdown.off('change').on('change', function() {
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

                       
                        $('#assessmentFieldsContainer').empty();

                        fetchAssessments(selectedGradingPeriod, selectedType);
                    });
                });

            $('#saveAssessmentsBtn').click(function () {
                    const assessments = [];
                    let isValid = true;

                    $('.assessment-container').each(function (index) {
                        const isNew = $(this).data('isNew');
                        const gradingPeriod = $('#gradingPeriod').val();
                        const type = $(this).find('.form-control[name="type"]').val();
                        const description = $(this).find('.form-control[name="description"]').val();
                        const manualDescription = $(this).find('.form-control[name="manual_description"]').val(); 
                        const max_points = $(this).find('.form-control[name="max_points"]').val();
                        const activity_date = $(this).find('.form-control[name="activity_date"]').val();
                         const manual_activity_date = $(this).find('.form-control[name="manual_activity_date"]').val();

                        
                        let selected_activity_date = '';
                        let selected_manual_activity_date = '';

                        
                        if ($(this).find('.date-picker').is(':visible') && activity_date) {
                            selected_activity_date = activity_date;
                            selected_manual_activity_date = null; // Ensure manual date is cleared
                        } else if ($(this).find('.manual-date').is(':visible') && manual_activity_date) {
                            selected_activity_date = null; // Ensure activity_date is cleared
                            selected_manual_activity_date = manual_activity_date;
                        }


                        //////for validation for desc
                        if (!description && !manualDescription) {
                            isValid = false;
                            $(this).find('select[name="description"]').addClass('is-invalid');
                            $(this).find('input[name="manual_description"]').addClass('is-invalid');
                        } else {
                            $(this).find('select[name="description"]').removeClass('is-invalid');
                            $(this).find('input[name="manual_description"]').removeClass('is-invalid');
                        }

                        //////validation based on selected assessment type
                        if (
                            type !== 'Additional Points Quiz' &&
                            type !== 'Additional Points OT' &&
                            type !== 'Additional Points Exam' &&
                            type !== 'Additional Points Lab' &&
                            type !== 'Direct Bonus Grade'
                        ) {
                            if (!max_points || max_points <= 0) {
                                isValid = false;
                                $(this).find('input[name="max_points"]').addClass('is-invalid');
                            } else {
                                $(this).find('input[name="max_points"]').removeClass('is-invalid');
                            }

                          
                            if (!selected_activity_date && !selected_manual_activity_date) {
                                isValid = false;
                                $(this).find('.date-picker, .manual-date').addClass('is-invalid');
                            } else {
                                $(this).find('.date-picker, .manual-date').removeClass('is-invalid');
                            }
                        }

                        assessments.push({ isNew, grading_period: gradingPeriod, type, description, manual_description: manualDescription, max_points, activity_date: selected_activity_date, manual_activity_date: selected_manual_activity_date});
                    });

                    if (!isValid) {
                        alert('Please fill out the required fields.');
                        return; 
                    }

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

                        /////console.log('save button clicked');

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

                    var confirmPublish = confirm('Do you want to ' + (isPublished ? 'hide' : 'publish') + ' scores for this assessment to the students?');
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
                                    btn.innerText = isPublished ? 'Publish Scores' : 'Hide Scores';
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
                    
                    if (selectedStatus === 'DEFAULT') {
                        dropdown.closest('.grade-dropdown').find('.displayed-value').text(actualGrade);
                    } else {
                       
                        dropdown.closest('.grade-dropdown').find('.displayed-value').text(selectedStatus);
                    }
                }
                    $('.status-dropdown').change(function() {
                        var gradeId = $(this).data('grade-id');
                        var gradeType = $(this).data('grade-type');
                        var selectedStatus = $(this).val();
                        var enrolledStudentId = $(this).data('enrolled-student-id');
                        var csrfToken = $('meta[name="csrf-token"]').attr('content');
                        var actualGrade = $(this).closest('.grade-dropdown').find('.displayed-value').data('actual-grade');

                        
                        updateDisplayedValue($(this), actualGrade, selectedStatus);

                       
                        $.ajax({
                            url: '{{ route('update.grade.status') }}',
                            method: 'POST',
                            data: {
                                gradeId: gradeId,
                                status: selectedStatus,
                                gradeType: gradeType, 
                                enrolledStudentId: enrolledStudentId,
                                _token: csrfToken
                            },
                            success: function(response) {
                                console.log('Status updated successfully');
                            },
                            error: function(error) {
                                console.error('Error updating grade status:', error);
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

               
                function initializeAutoZero() {
                    $('.score-input').each(function() {
                        if ($(this).val().trim() === '') {
                            $(this).val('0').data('auto-zero', 'true').addClass('auto-zero');
                        } else {
                            $(this).data('auto-zero', 'false').removeClass('auto-zero');
                        }
                    });
                }

               
                if ((window.location.href.indexOf("studentlist") > -1 && window.location.href.match(/\/\d+$/)) || 
                    document.referrer.indexOf("classlist") > -1 || 
                    document.referrer.indexOf("edit_assessments") > -1) {
                    
                    initializeAutoZero();

                    $('.score-input').each(function() {
                        if ($(this).val().trim() !== "") {
                            savePoints($(this));
                        }
                    });
                }

                
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


                $('.score-input').on('focus', function() {
                    if ($(this).data('auto-zero') === 'true') {
                        $(this).val(''); 
                    }
                });

                
                $('.score-input').on('blur', function() {
                    var currentValue = $(this).val().trim();
                    var originalValue = $(this).data('original-value');
                    var maxPoints = parseFloat($(this).data('max-points'));
                    var studentName = $(this).data('student-name');
                    var assessmentDescription = $(this).data('assessment-description');

                    
                    if (currentValue === '') {
                        $(this).val('0').data('auto-zero', 'true').addClass('auto-zero');
                        currentValue = '0';  
                    } else {
                        $(this).data('auto-zero', 'false').removeClass('auto-zero');
                    }

                    
                    if (currentValue !== originalValue) {
                        $(this).data('original-value', currentValue);

                        if (parseFloat(currentValue) > maxPoints) {
                            showMessage(`Inserted points exceeded the max points of ${assessmentDescription} for ${studentName} -  Considered as Bonus Points.`);
                        } else {
                            hideMessage();
                        }

                        savePoints($(this));
                    }
                });


                function savePoints(inputElement) {
                    var enrolledStudentId = inputElement.data('enrolled-student-id');
                    var assessmentId = inputElement.data('assessment-id');
                    var assessmentType = inputElement.data('assessment-type');
                    var gradingPeriod = inputElement.data('grading-period');
                    var points = inputElement.val();

                    console.log('saving points:', {
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
                        console.log('points saved');
                    
                        updateTotalPoints(enrolledStudentId, assessmentType, gradingPeriod);

                    
                        fetchGrades(enrolledStudentId);
                    },
                    error: function(xhr) {
                        console.error('error save:', xhr.responseText);
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

             function showMessage(message) {
            $('#message-text').text(message);
            $('#message-container').fadeIn();

            /////timer before fading: 1000 = 1 sec
            setTimeout(function() {
                $('#message-container').fadeOut();
            }, 6000);
        }

        function hideMessage() {
            $('#message-container').fadeOut();
        }

                function fetchGrades(enrolledStudentId) {
                    var subjectId = {{ $subject->id }};
                    $.ajax({
                        url: '{{ url('fetch/grades') }}/' + subjectId + '/' + enrolledStudentId,
                        method: 'GET',
                        success: function(response) {
                            console.log('Grades fetched successfully', response.grades);

                            ///// find the grade columns with non-null values
                    var grade = response.grades.find(g => g.total_fg_lec !== null || g.lec_fg_grade !== null || g.total_fg_lab !== null || g.lab_fg_grade !== null || g.total_fg_grade !== null || g.fg_grade !== null || g.total_midterms_lec !== null || g.lec_midterms_grade !== null);

                            if (grade) {
                            
                                var total_fg_lec = grade.total_fg_lec !== null ? Math.round(grade.total_fg_lec) : '';
                                var lec_fg_grade = grade.lec_fg_grade !== null ? grade.lec_fg_grade : '';
                                var total_fg_lab = grade.total_fg_lab !== null ? Math.round(grade.total_fg_lab) : '';
                                var lab_fg_grade = grade.lab_fg_grade !== null ? grade.lab_fg_grade : '';
                                var total_fg_grade = grade.total_fg_grade !== null ? Math.round(grade.total_fg_grade) : '';
                                var fg_grade = grade.fg_grade !== null ? grade.fg_grade : '';
                                var total_midterms_lec  = grade.total_midterms_lec !== null ? Math.round(grade.total_midterms_lec)  : '';
                                var lec_midterms_grade  = grade.lec_midterms_grade  !== null ? grade.lec_midterms_grade  : '';
                                var total_midterms_lab = grade.total_midterms_lab !== null ? Math.round(grade.total_midterms_lab) : '';
                                var lab_midterms_grade = grade.lab_midterms_grade !== null ? grade.lab_midterms_grade : '';
                                var total_midterms_grade = grade.total_midterms_grade !== null ? Math.round(grade.total_midterms_grade) : '';
                                var tentative_midterms_grade  = grade.tentative_midterms_grade  !== null ? grade.tentative_midterms_grade  : '';
                                var midterms_grade = grade.midterms_grade !== null ? grade.midterms_grade : '';
                                var total_finals_lec = grade.total_finals_lec !== null ? Math.round(grade.total_finals_lec) : '';
                                var lec_finals_grade = grade.lec_finals_grade !== null ? grade.lec_finals_grade : '';
                                var total_finals_lab  = grade.total_finals_lab  !== null ? Math.round(grade.total_finals_lab) : '';
                                var lab_finals_grade = grade.lab_finals_grade!== null ? grade.lab_finals_grade : '';
                                var total_finals_grade = grade.total_finals_grade  !== null ? Math.round(grade.total_finals_grade) : '';
                                var tentative_finals_grade  = grade.tentative_finals_grade  !== null ? grade.tentative_finals_grade  : '';
                                var finals_grade  = grade.finals_grade !== null ? grade.finals_grade  : '';
                                var adjusted_finals_grade  = grade.adjusted_finals_grade !== null ? grade.adjusted_finals_grade  : '';

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
                                $('span.displayed-value[data-enrolled-student-id="' + enrolledStudentId + '"][data-grade-type="adjusted_finals_grade"]').text(adjusted_finals_grade);



                                if (finals_grade !== null) {
                                    var finalsGradeSpan = $('span.displayed-value[data-enrolled-student-id="' + enrolledStudentId + '"][data-grade-type="finals_grade"]');
                                    var finalsGradeColumn = finalsGradeSpan.closest('td.grade-column'); 

                                    
                                    if (finals_grade < 75) {
                                        finalsGradeSpan.addClass('text-red').removeClass('text-default');
                                    } else {
                                        finalsGradeSpan.addClass('text-default').removeClass('text-red');
                                    }
                                } 
                                if (adjusted_finals_grade !== null) {
                                  var gradeSelect = $('select.status-dropdown[data-adjusted-finals="true"][data-enrolled-student-id="' + enrolledStudentId + '"]');

                                   var formattedGrade = adjusted_finals_grade;

                                    //// update the "DEFAULT" option text
                                    gradeSelect.find('option[value="DEFAULT"]').text(formattedGrade);

                                    ///// update color based on grade value
                                    if (adjusted_finals_grade < 75) {
                                        gradeSelect.addClass('text-red').removeClass('text-default');
                                    } else {
                                        gradeSelect.addClass('text-default').removeClass('text-red');
                                    }
                                }
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

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const addAssessmentFieldsBtn = document.getElementById('addAssessmentFieldsBtn');
                const saveAssessmentsBtn = document.getElementById('saveAssessmentsBtn');

                addAssessmentFieldsBtn.addEventListener('click', function() {
                    saveAssessmentsBtn.classList.remove('d-none');
                });
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
        <section class="content-header" style="text-align: right;">
            <h2></h2>
            <input type="button" onclick="window.location.href='{{ url('teacher/list/classlist') }}';" class="btn btn-info" value="Back to Course List" />
            @php
                $studentCount = count($enrolledStudents);
            @endphp
            <a href="#demo" class="btn btn-info" data-toggle="collapse">Show Class Info</a>
            <h2></h2>
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
        <div id="message-container" style="display: none; position: fixed; top: 20px; left: 50%; transform: translateX(-50%); background-color: #ffcc00; color: black; padding: 10px; border-radius: 5px; z-index: 1000;">
            <span id="message-text"></span>
        </div>
        <section class="content">
            
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $subject->subject_code }} | {{ $subject->description }} | {{ $subject->section }}</h3>
                    </div>
                    <div class="table-responsive ">
                        <div class="card-body">
                            <button type="button" class="btn btn-success" id="assessmentModalButton" data-toggle="modal" data-target="#assessmentModal" {{ $isPastSubjectList ? 'disabled' : '' }}>Add Assessment</button>
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
                                        font-size: 11px; 
                                        table-layout: fixed; 
                                        border-collapse: collapse; 
                                    }

                                    table, th, td {
                                        border: 1px solid #000;
                                        padding: 4px; 
                                        text-align: center; 
                                    }

                                   .fixed-column {
                                        position: sticky;
                                        left: 0;
                                        z-index: 3;
                                        border: 1px solid #000;
                                        font-size: 0.9em; 
                                        white-space: nowrap; 
                                        overflow: hidden; 
                                        text-overflow: ellipsis; 
                                        text-align: left;
                                        vertical-align: top;
                                        line-height: 1.2; 
                                    }

                                    .fixed-column b {
                                        font-size: 1.1em; 
                                    }
                                    .fixed-row th,
                                    .fixed-row td {
                                        position: sticky;
                                        background-color: #f2f2f2;
                                        z-index: 2;
                                        border: 1px solid #000;
                                        padding: 4px 6px;
                                    }

                                   
                                    .fixed-row.top-header th,
                                    .fixed-row.top-header td {
                                        top: 0;
                                        z-index: 3; 
                                    }

                                   
                                    .fixed-row.bottom-header th,
                                    .fixed-row.bottom-header td {
                                        top: 30px; 
                                        z-index: 2;
                                    }

                                    .assessment-column {
                                        width: 50px; 
                                        vertical-align: middle;
                                        padding: 2px 4px;      
                                        line-height: 1.2;       
                                        background-color: #f2f2f2;      
                                    }

                                    .assessment-column .score-input {
                                        width: calc(100% - 10px); 
                                        height: 3vh;
                                        font-size: 10px; 
                                        font-weight: bold; 
                                        padding: 0px; 
                                        text-align: center; 
                                        box-sizing: border-box; 
                                        border: 1px solid #ccc; 
                                    }

                                    .assessment-column .score-input:focus {
                                        outline: none; 
                                        border-color: #66afe9; 
                                        box-shadow: 0 0 5px #66afe9; 
                                    }

                                    .assessment-type-header,
                                    .grading-period-header,
                                    .gender-header {
                                        background-color: #f2f2f2;
                                        font-weight: bold; 
                                        padding: 6px; 
                                        text-align: left;
                                    }

                                    .table-container thead th {
                                        border: 1px solid #000;
                                        padding: 8px; 
                                    }

                                    .table-container tbody tr:first-child td {
                                        border-top: 1px solid #000;
                                        border-bottom: 1px solid #000;
                                    }

                                    .centered-bold {
                                        text-align: center;
                                        font-weight: bold;
                                    }

                                    .score-input {
                                        width: 60px; 
                                        text-align: center; 
                                    }

                                     .btn-publish {
                                        padding: 4px 8px; 
                                        font-size: 10px; 
                                    }

                                    .btn-publish-grades {
                                        padding: 4px 8px; 
                                        font-size: 10px; 
                                    }

                                    .score-input.auto-zero::placeholder {
                                        color: transparent;
                                    }

                                    .score-input.auto-zero {
                                        color: transparent;
                                    }

                                    .score-input.auto-zero:focus {
                                        color: #000; 
                                    }

                                    .bg-red {
                                        background-color: red;
                                        color: white;
                                    }

                                    .bg-default {
                                        background-color: transparent; 
                                        color: black; 
                                    }

                                    /* grade font color change */
                                    .text-default {
                                        color: inherit;
                                    }

                                    .text-red {
                                        color: red;
                                        font-weight: bold;
                                    }

                                    .table-scroll-container {
                                        border:solid 1px #000;
                                        max-height: 70vh; 
                                        overflow-y:auto;
                                    }

                                     .modal-lg-custom {
                                        max-width: 800px; 
                                    }

                                    .modal-body-scrollable {
                                        max-height: 70vh; 
                                        overflow-y: auto;
                                    }

                                    @media (max-width: 768px) {
                                        .modal-lg-custom {
                                            max-width: 95%;
                                        }
                                    }
                                     .status-dropdown {
                                        padding: 4px 18px 4px 6px;  
                                         padding-bottom: 2px;   
                                        font-size: 10px;
                                        font-weight: bold; 
                                        border: 1px solid #ccc;
                                        border-radius: 6px;
                                        background: #fff url("data:image/svg+xml;utf8,<svg fill='gray' height='16' viewBox='0 0 24 24' width='16' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>") no-repeat right 10px center;
                                        appearance: none;
                                        -webkit-appearance: none;
                                        -moz-appearance: none;
                                        width: 100%;
                                        max-width: 100px;  
                                        min-width: 80px; 
                                        cursor: pointer;
                                    }

                                    .grade-dropdown {
                                        margin: 0; 
                                        padding: 0;
                                        max-width: 180px;
                                    }
                                    th.fixed-column-space {
                                    border: none !important;
                                    background-color: transparent !important;
                                    }
                                    #zoomable-table-wrapper {
    overflow: auto;
    border: 1px solid #ccc;
    width: 100%;
  }

  #zoomable-table {
    transform: scale(1);
    transform-origin: top left;
    transition: transform 0.3s ease;
  }
                                </style>
                                <div style="margin-bottom: 10px;">
                                    <button type ="button"class="btn btn-info" onclick="zoomIn()">Zoom In +</button>
                                    <button type ="button"class="btn btn-info" onclick="zoomOut()">Zoom Out -</button>
                                    <button type ="button"class="btn btn-info" onclick="resetZoom()">Reset Zoom</button>
                                </div>
                                <div class="table-scroll-container" id="zoomable-table-wrapper">
                                    <div class="table-container table-striped " id="zoomable-table">
                                        <div id="zoomable-table-inner">
                                            <table class="table ">
                                                <thead>
                                                    <tr >
                                                        <!-- Fixed columns -->
                                                        <th class="fixed-column-space"></th>
                                                        <th class="fixed-column-space"></th>
                                                        <th class="fixed-column-space"></th>
                                                        <th class="fixed-column-space"></th> 
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
                                                    <tr >
                                                        <!-- Fixed columns -->
                                                        <th class="fixed-column-space"></th> 
                                                        <th class="fixed-column-space"></th> 
                                                        <th class="fixed-column-space"></th> 
                                                        <th class="fixed-column-space"></th> 
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
                                                    
                                                        @if ($assessmentType != 'Direct Bonus Grade')
                                                            <th colspan="{{ $assessments->where('grading_period', $gradingPeriod)->where('type', $assessmentType)->count() }}" class="text-center assessment-type-header ">
                                                                {{ $assessmentType }}
                                                            </th>
                                                        @endif

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
                                                                
                                                            
                                                            }
                                                        @endphp

                                                        @if ($assessmentType != 'Direct Bonus Grade')
                                                        <th class="text-center">{{ $headerText }}</th>
                                                        @endif
                                                        
                                                        @if ($assessmentType === $lastAssessmentType && $showTotalLecHeaders)
                                                        
                                                            @if ($gradingPeriod == "First Grading" && strpos($subject->subject_type, 'LecLab') !== false)
                                                                <th class="text-center">Total</th>
                                                                <th class="text-center">Lec Grade</th>
                                                            @endif

                                                            @if ($gradingPeriod == "Midterm" && strpos($subject->subject_type, 'LecLab') !== false)
                                                                <th class="text-center">Total</th>
                                                                <th class="text-center">Lec Grade</th>
                                                            @endif

                                                            @if ($gradingPeriod == "Finals" && strpos($subject->subject_type, 'LecLab') !== false)
                                                                <th class="text-center">Total</th>
                                                                <th class="text-center">Lec Grade</th>
                                                            @endif
                                                        @endif
                                                    @endforeach


                                                            @if (strpos($subject->subject_type, 'LecLab') !== false)
                                                                @if ($gradingPeriod == "First Grading")
                                                                    <th class="text-center">Total</th>
                                                                    <th class="text-center">Lab Grade</th>
                                                                    <th class="text-center">1st Grading Grade</th>
                                                                @endif
                                                                @else
                                                                    @if ($gradingPeriod == "First Grading")
                                                                        <th class="text-center">Total</th>
                                                                        <th class="text-center">1st Grading Grade</th>
                                                                    @endif
                                                            @endif 
                                                            @if (strpos($subject->subject_type, 'LecLab') !== false)      
                                                                @if ($gradingPeriod == "Midterm")
                                                                    <th class="text-center">Total</th>
                                                                    <th class="text-center">Lab Grade</th>
                                                                    <th class="text-center">TM Grade</th>
                                                                    <th class="text-center">Midterm Grade</th>
                                                                @endif
                                                                @else
                                                                    @if ($gradingPeriod == "Midterm")
                                                                        <th class="text-center">Total</th>
                                                                        <th class="text-center">TM Grade</th>
                                                                        <th class="text-center">Midterm Grade</th>
                                                                    @endif
                                                            @endif
                                                            @if (strpos($subject->subject_type, 'LecLab') !== false)    
                                                                @if ($gradingPeriod == "Finals")
                                                                    <th class="text-center">Total</th>
                                                                    <th class="text-center">Lab Grade</th>
                                                                    <th class="text-center">TF Grade</th>
                                                                    <th class="text-center">Final Grade</th>
                                                                @endif

                                                                
                                                                @if ($gradingPeriod == "Finals" && $assessments->where('grading_period', $gradingPeriod)->where('type', 'Direct Bonus Grade')->count() > 0)
                                                                        <th colspan="{{ $assessments->where('grading_period', $gradingPeriod)->where('type', 'Direct Bonus Grade')->count() }}" class="text-center assessment-type-header">
                                                                            +FG
                                                                        </th>
                                                                @endif
                                                                @if ($gradingPeriod == "Finals")
                                                                    <th class="text-center">Adjusted Final Grade</th>
                                                                @endif
                                                            @else
                                                                @if ($gradingPeriod == "Finals")
                                                                    <th class="text-center">Total</th>
                                                                    <th class="text-center">TF Grade</th>
                                                                    <th class="text-center">Final Grade</th>
                                                                @endif
                                                        
                                                                @if ($gradingPeriod == "Finals" && $assessments->where('grading_period', $gradingPeriod)->where('type', 'Direct Bonus Grade')->count() > 0)
                                                                        <th colspan="{{ $assessments->where('grading_period', $gradingPeriod)->where('type', 'Direct Bonus Grade')->count() }}" class="text-center assessment-type-header">
                                                                            +FG
                                                                        </th>
                                                                @endif

                                                                @if ($gradingPeriod == "Finals")
                                                                    <th class="text-center">Adjusted Final Grade</th>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                    <tr  class="fixed-row top-header">
                                                        <th class="fixed-column-space"></th> 
                                                        <th class="fixed-column-space"></th> 
                                                        <th class="fixed-column-space"></th> 
                                                        <th class="fixed-column-space"></th> 
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
                                                                @if ($assessmentType != 'Direct Bonus Grade')
                                                                    <th class="assessment-column">
                                                                            <span class="assessment-description"
                                                                                data-grading-period="{{ $assessment->grading_period }}"
                                                                                data-type="{{ $assessment->type }}"
                                                                                data-description="{{ $assessment->description }}">
                                                                            {{ $assessment->abbreviation }}
                                                                        </span>
                                                                    </th>
                                                                @endif
                                                            @endforeach
                                                                    @if ($hasAssessments && $assessmentType != 'Direct Bonus Grade')
                                                                    <th class="assessment-column centered-bold">
                                                                        
                                                                    </th>
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
                                                                @if ($assessments->where('grading_period', $gradingPeriod)->where('type', 'Direct Bonus Grade')->count() > 0)
                                                                    <th class="assessment-column">
                                                                        <span class="assessment-description"
                                                                            data-grading-period="{{ $assessment->grading_period }}"
                                                                            data-type="{{ $assessment->type }}"
                                                                            data-description="{{ $assessment->description }}">
                                                                            
                                                                        </span>
                                                                    </th>
                                                                @endif
                                                                    <th class="text-center"></th>
                                                                    
                                                                    
                                                            @else
                                                                    <th class="text-center"></th>
                                                                    <th class="text-center"></th>
                                                                    <th class="text-center"></th>
                                                                @if ($assessments->where('grading_period', $gradingPeriod)->where('type', 'Direct Bonus Grade')->count() > 0)
                                                                    <th class="assessment-column">
                                                                        <span class="assessment-description"
                                                                            data-grading-period="{{ $assessment->grading_period }}"
                                                                            data-type="{{ $assessment->type }}"
                                                                            data-description="{{ $assessment->description }}">
                                                                            
                                                                        </span>
                                                                    </th>
                                                                @endif
                                                                    <th class="text-center"></th>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </tr>


                                                    <tr  class="fixed-row bottom-header">
                                                        <th class="fixed-column-space" ></th> 
                                                        <th class="fixed-column-space" ></th> 
                                                        <th class="fixed-column-space"></th> 
                                                        <th class="fixed-column-space"></th> 
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
                                                                    @if ($assessmentType != 'Direct Bonus Grade')
                                                                        <th class="assessment-column">
                                                                            {{ number_format($assessment->max_points, $assessment->max_points == intval($assessment->max_points) ? 0 : 2) }}
                                                                        </th>
                                                                    @endif
                                                                @endforeach
                                                                @if ($hasAssessments && $assessmentType != 'Direct Bonus Grade')
                                                                        <th class="assessment-column centered-bold">
                                                                            {{ $maxPointsTotal }}
                                                                        </th>
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
                                                                @if ($assessments->where('grading_period', $gradingPeriod)->where('type', 'Direct Bonus Grade')->count() > 0)
                                                                    <th class="assessment-column">
                                                                        <span class="assessment-description"
                                                                            data-grading-period="{{ $assessment->grading_period }}"
                                                                            data-type="{{ $assessment->type }}"
                                                                            data-description="{{ $assessment->description }}">
                                                                            
                                                                        </span>
                                                                    </th>
                                                                @endif
                                                                    <th class="text-center"></th>
                                                                    
                                                                    
                                                            @else
                                                                    <th class="text-center"></th>
                                                                    <th class="text-center"></th>
                                                                    <th class="text-center"></th>
                                                                @if ($assessments->where('grading_period', $gradingPeriod)->where('type', 'Direct Bonus Grade')->count() > 0)
                                                                    <th class="assessment-column">
                                                                        <span class="assessment-description"
                                                                            data-grading-period="{{ $assessment->grading_period }}"
                                                                            data-type="{{ $assessment->type }}"
                                                                            data-description="{{ $assessment->description }}">
                                                                            
                                                                        </span>
                                                                    </th>
                                                                @endif
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
                                                                <td ><b>{{ $enrolledStudent->student->id_number }}</b></td>
                                                                <td class="fixed-column" style="background-color:white; " ><b>{{ $enrolledStudent->student->last_name }}, {{ $enrolledStudent->student->name }} {{ $enrolledStudent->student->middle_name }}</b></td>
                                                                <td ><b>{{ $enrolledStudent->student->course }}</b></td>
                                                                @php
                                                                    $totalPointsForAssessmentType = 0;
                                                                    $currentColIndex = 1; 
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

                                                                            $studentName = $enrolledStudent->student->last_name . ', ' . $enrolledStudent->student->name . ' ' . $enrolledStudent->student->middle_name;
                                                                            $assessmentDescription = $assessment->description;
                                                                        if ($assessment->type != 'Direct Bonus Grade') {
                                                                        echo '<td class="assessment-column">
                                                                                <input type="text" name="' . $textboxName . '" class="form-control score-input" "  font-size: 12px;""' . $disabled . '
                                                                                    data-grading-period="' . $assessment->grading_period . '"
                                                                                    data-enrolled-student-id="' . $enrolledStudent->id . '"
                                                                                    data-assessment-id="' . $assessment->id . '"
                                                                                    data-assessment-type="' . $assessment->type . '"
                                                                                    data-original-value="' . $textboxValue . '"
                                                                                    data-max-points="' . $assessment->max_points . '"
                                                                                    data-student-name="' . $studentName . '"
                                                                                    data-assessment-description="' . $assessmentDescription . '"
                                                                                    data-auto-zero="' . (empty($textboxValue) ? 'true' : 'false') . '"
                                                                                    value="' . $textboxValue . '">
                                                                            </td>';
                                                                        }
                                                                            $totalPointsForAssessmentType += is_numeric($textboxValue) ? $textboxValue : 0;
                                                                            $currentColIndex++; 
                                                                        }
                                                                        if ($gradingPeriodAssessments->isNotEmpty()) {
                                                                        if ($assessment->type != 'Direct Bonus Grade') {
                                                                        echo '<td class="assessment-column centered-bold">
                                                                            <span class="assessment-description" data-type="' . $assessmentType . '" data-description="Total Points" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grading-period="' . $gradingPeriod . '">
                                                                                ' . $totalPointsForAssessmentType . '
                                                                            </span>
                                                                        </td>';
                                                                    }

                                                                        $currentColIndex++; 
                                                                    }
                                                                    $totalPointsForAssessmentType = 0; 



                                                            /////////////////leclab- total and lec grade////////////////
                                                                if ($assessmentType === $lastAssessmentType && $showTotalLecHeaders){
                                                                        if ($gradingPeriod == "First Grading") {
                                                                            if (strpos($subject->subject_type, 'LecLab') !== false) {

                                                                                //// column for fg total lec grade
                                                                                echo '<td class="grade-column centered-bold" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="total_fg_lec">';
                                                                                foreach ($enrolledStudent->grades as $grade) {
                                                                                    if ($grade->total_fg_lec !== null) {

                                                                                        $roundedGrade = round($grade->total_fg_lec);
                                                                                        echo '<div class="grade-dropdown displayed-value">';
                                                                                        echo '<span class="displayed-value">' . $roundedGrade . '</span>';
                                                                                        echo '</div>';
                                                                                    }
                                                                                }
                                                                                echo '</td>';

                                                                                // column for fg lec grade
                                                                                echo '<td class="grade-column centered-bold" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="lec_fg_grade">';
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
                                                                                echo '<td class="grade-column centered-bold" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="total_midterms_lec">';
                                                                                foreach ($enrolledStudent->grades as $grade) {
                                                                                    if ($grade->total_midterms_lec !== null) {

                                                                                        $roundedGrade = round($grade->total_midterms_lec);
                                                                                        echo '<div class="grade-dropdown displayed-value">';
                                                                                        echo '<span class="displayed-value">' . $roundedGrade . '</span>';
                                                                                        echo '</div>';
                                                                                    }
                                                                                }
                                                                                echo '</td>';

                                                                                /// column for mid lec grade
                                                                                echo '<td class="grade-column centered-bold" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="lec_midterms_grade">';
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
                                                                                    echo '<td class="grade-column centered-bold" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="total_finals_lec">';
                                                                                    foreach ($enrolledStudent->grades as $grade) {
                                                                                        if ($grade->total_finals_lec !== null) {

                                                                                            $roundedGrade = round($grade->total_finals_lec);
                                                                                            echo '<div class="grade-dropdown displayed-value">';
                                                                                            echo '<span class="displayed-value">' . $roundedGrade . '</span>';
                                                                                            echo '</div>';
                                                                                        }
                                                                                    }
                                                                                    echo '</td>';

                                                                                    //// column for mid fn grade
                                                                                    echo '<td class="grade-column centered-bold" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="lec_finals_grade">';
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
                                                                                echo '<td class="grade-column centered-bold" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="total_fg_lab">';
                                                                                foreach ($enrolledStudent->grades as $grade) {
                                                                                    if ($grade->total_fg_lab !== null) {

                                                                                        $roundedGrade = round($grade->total_fg_lab);
                                                                                        echo '<div class="grade-dropdown displayed-value">';
                                                                                        echo '<span class="displayed-value">' . $roundedGrade . '</span>';
                                                                                        echo '</div>';
                                                                                    }
                                                                                }
                                                                                echo '</td>';

                                                                                //// column for fg lab grade
                                                                                echo '<td class="grade-column centered-bold" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="lab_fg_grade">';
                                                                                foreach ($enrolledStudent->grades as $grade) {
                                                                                    if ($grade->lab_fg_grade !== null) {
                                                                                        echo '<div class="grade-dropdown displayed-value">';
                                                                                        echo '<span class="displayed-value">' . $grade->lab_fg_grade . '</span>';
                                                                                        echo '</div>';
                                                                                    }
                                                                                }
                                                                                echo '</td>';

                                                                                //// column for fg grade
                                                                                echo '<td class="grade-column centered-bold" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="fg_grade">';
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
                                                                                echo '<td class="grade-column centered-bold" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="total_fg_grade">';
                                                                                foreach ($enrolledStudent->grades as $grade) {
                                                                                    if ($grade->total_fg_grade !== null) {
                                                                                        $roundedGrade = round($grade->total_fg_grade);

                                                                                        echo '<div class="grade-dropdown displayed-value">';
                                                                                        echo '<span class="displayed-value">' . $roundedGrade . '</span>';
                                                                                        echo '</div>';
                                                                                        }
                                                                                }
                                                                                echo '</td>';

                                                                                echo '<td class="grade-column centered-bold" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="fg_grade">';
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
                                                                                echo '<td class="grade-column centered-bold" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="total_midterms_lab">';
                                                                                foreach ($enrolledStudent->grades as $grade) {
                                                                                    if ($grade->total_midterms_lab !== null) {

                                                                                        $roundedGrade = round($grade->total_midterms_lab);
                                                                                        echo '<div class="grade-dropdown displayed-value">';
                                                                                        echo '<span class="displayed-value">' . $roundedGrade . '</span>';
                                                                                        echo '</div>';
                                                                                    }
                                                                                }
                                                                                echo '</td>';

                                                                                //// column for md lab grade 
                                                                                echo '<td class="grade-column centered-bold" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="lab_midterms_grade">';
                                                                                foreach ($enrolledStudent->grades as $grade) {
                                                                                    if ($grade->lab_midterms_grade !== null) {
                                                                                        echo '<div class="grade-dropdown displayed-value">';
                                                                                        echo '<span class="displayed-value">' . $grade->lab_midterms_grade . '</span>';
                                                                                        echo '</div>';
                                                                                    }
                                                                                }
                                                                                echo '</td>';

                                                                            //// column for tentative  mid grade
                                                                                echo '<td class="grade-column centered-bold" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="tentative_midterms_grade">';
                                                                                foreach ($enrolledStudent->grades as $grade) {
                                                                                    if ($grade->tentative_midterms_grade !== null) {
                                                                                        echo '<div class="grade-dropdown displayed-value">';
                                                                                        echo '<span class="displayed-value">' . $grade->tentative_midterms_grade  . '</span>';
                                                                                        echo '</div>';
                                                                                    }
                                                                                }
                                                                                echo '</td>';


                                                                            echo '<td class="grade-column centered-bold" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="midterms_grade">';
                                                                            foreach ($enrolledStudent->grades as $grade) {
                                                                                if ($grade->midterms_grade !== null) {
                                                                                    echo '<div class="grade-dropdown displayed-value">';
                                                                                echo '<span class="displayed-value">' . number_format($grade->midterms_grade, $grade->midterms_grade == intval($grade->midterms_grade) ? 0 : 2) . '</span>';
                                                                                
                                                                                }
                                                                            }
                                                                            echo '</td>';

                                                                            
                                                                            } else {

                                                                            //// column for total  mid grade
                                                                                echo '<td class="grade-column centered-bold" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="total_midterms_grade">';
                                                                                foreach ($enrolledStudent->grades as $grade) {
                                                                                    if ($grade->total_midterms_grade !== null) {
                                                                                        $roundedGrade = round($grade->total_midterms_grade);
                                                                                        echo '<div class="grade-dropdown displayed-value">';
                                                                                        echo '<span class="displayed-value">' . $roundedGrade . '</span>';
                                                                                        echo '</div>';
                                                                                    }
                                                                                }
                                                                                echo '</td>';

                                                                                //// column for tentative  mid grade
                                                                                echo '<td class="grade-column centered-bold" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="tentative_midterms_grade">';
                                                                                foreach ($enrolledStudent->grades as $grade) {
                                                                                    if ($grade->tentative_midterms_grade !== null) {
                                                                                        echo '<div class="grade-dropdown displayed-value">';
                                                                                        echo '<span class="displayed-value">' . $grade->tentative_midterms_grade  . '</span>';
                                                                                        echo '</div>';
                                                                                    }
                                                                                }
                                                                                echo '</td>';


                                                                            echo '<td class="grade-column centered-bold" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="midterms_grade">';
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
                                                                                echo '<td class="grade-column centered-bold" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="total_finals_lab">';
                                                                                foreach ($enrolledStudent->grades as $grade) {
                                                                                    if ($grade->total_finals_lab !== null) {

                                                                                        $roundedGrade = round($grade->total_finals_lab);
                                                                                        echo '<div class="grade-dropdown displayed-value">';
                                                                                        echo '<span class="displayed-value">' . $roundedGrade . '</span>';
                                                                                        echo '</div>';
                                                                                    }
                                                                                }
                                                                                echo '</td>';

                                                                                //// column for fn lab grade
                                                                                echo '<td class="grade-column centered-bold" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="lab_finals_grade">';
                                                                                foreach ($enrolledStudent->grades as $grade) {
                                                                                    if ($grade->lab_finals_grade !== null) {
                                                                                        echo '<div class="grade-dropdown displayed-value">';
                                                                                        echo '<span class="displayed-value">' . $grade->lab_finals_grade . '</span>';
                                                                                        echo '</div>';
                                                                                    }
                                                                                }
                                                                                echo '</td>';

                                                                            //// column for tentative fn grade
                                                                                echo '<td class="grade-column centered-bold" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="tentative_finals_grade">';
                                                                                foreach ($enrolledStudent->grades as $grade) {
                                                                                    if ($grade->tentative_finals_grade !== null) {
                                                                                        echo '<div class="grade-dropdown displayed-value">';
                                                                                        echo '<span class="displayed-value">' . $grade->tentative_finals_grade  . '</span>';
                                                                                        echo '</div>';
                                                                                    }
                                                                                }
                                                                                echo '</td>';


                                                                                //// column for fn grade - actual fn grade -no additions
                                                                                //// column for  fn grade
                                                                            $textClass = 'text-default';

                                                                        
                                                                            foreach ($enrolledStudent->grades as $grade) {
                                                                                if ($grade->finals_grade !== null && $grade->finals_grade < 75) {
                                                                                        $textClass = 'text-red';
                                                                                    break; 
                                                                                }
                                                                            }

                                                                        
                                                                            echo '<td class="grade-column centered-bold">';

                                                                            foreach ($enrolledStudent->grades as $grade) {
                                                                                echo '<div class="grade-dropdown displayed-value">';
                                                                                if ($grade->finals_grade !== null) {
                                                                                
                                                                                        echo '<span class="displayed-value ' . $textClass . '" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="finals_grade">' .
                                                                            number_format($grade->finals_grade, $grade->finals_grade == intval($grade->finals_grade) ? 0 : 2) .
                                                                            '</span>';
                                                                                }
                                                                                }
                                                                                echo '</td>';

                                                                        if ($assessment->type === 'Direct Bonus Grade' && $assessments->where('type', 'Direct Bonus Grade')->count() > 0) {
                                                                                echo '<td class="assessment-column">
                                                                                    <input type="text" name="' . $textboxName . '" class="form-control score-input" ' . $disabled . '
                                                                                    data-grading-period="' . $assessment->grading_period . '"
                                                                                        data-enrolled-student-id="' . $enrolledStudent->id . '"
                                                                                        data-assessment-id="' . $assessment->id . '"
                                                                                        data-assessment-type="' . $assessment->type . '"
                                                                                        data-original-value="' . $textboxValue . '"
                                                                                        data-max-points="' . $assessment->max_points . '"
                                                                                        data-student-name="' . $studentName . '"
                                                                                        data-assessment-description="' . $assessmentDescription . '"
                                                                                        value="' . $textboxValue . '"
                                                                                        style="width: 40px; text-align: center;">
                                                                                </td>';
                                                                            }

                                                                            //// column for  fn grade
                                                                            $textClass = 'text-default';

                                                                        
                                                                            foreach ($enrolledStudent->grades as $grade) {
                                                                                if ($grade->adjusted_finals_grade !== null && $grade->adjusted_finals_grade < 75) {
                                                                                        $textClass = 'text-red';
                                                                                    break; 
                                                                                }
                                                                            }

                                                                        
                                                                            echo '<td class="grade-column centered-bold ">';

                                                                            foreach ($enrolledStudent->grades as $grade) {
                                                                            echo '<div class="grade-dropdown displayed-value">';

                                                                            // Only show if grade is available
                                                                            if ($grade->adjusted_finals_grade !== null) {
                                                                                $formattedGrade = number_format(
                                                                                    $grade->adjusted_finals_grade,
                                                                                    $grade->adjusted_finals_grade == intval($grade->adjusted_finals_grade) ? 0 : 2
                                                                                );

                                                                                echo '<select 
                                                                                    class="status-dropdown ' . $textClass . '" 
                                                                                    data-grade-type="final" 
                                                                                    data-enrolled-student-id="' . $enrolledStudent->id . '" 
                                                                                    data-grade-id="' . $grade->id . '" 
                                                                                    data-adjusted-finals="true" 
                                                                                    ' . ($isPastSubjectList ? 'disabled' : '') . '>';

                                                                                        ///// Grade as the first option
                                                                                    echo '<option value="DEFAULT" ' . ($grade->finals_status === 'DEFAULT' ? 'selected' : '') . '>' . $formattedGrade . '</option>';

                                                                                        foreach ($statuses as $status) {
                                                                                        $selected = $grade->finals_status === $status->name ? 'selected' : '';
                                                                                        echo '<option value="' . $status->name . '" ' . $selected . '>' . $status->name . '</option>';
                                                                                    }


                                                                                echo '</select>';
                                                                            }

                                                                            echo '</div>';
                                                                        }
                                                                            echo '</td>';

                                                                            
                                                                            } else {

                                                                            //// column for total fin grade
                                                                                echo '<td class="grade-column centered-bold" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="total_finals_grade">';
                                                                                foreach ($enrolledStudent->grades as $grade) {
                                                                                    if ($grade->total_finals_grade !== null) {
                                                                                        $roundedGrade = round($grade->total_finals_grade);
                                                                                        echo '<div class="grade-dropdown displayed-value">';
                                                                                        echo '<span class="displayed-value">' . $roundedGrade . '</span>';
                                                                                        echo '</div>';
                                                                                    }
                                                                                }
                                                                                echo '</td>';

                                                                                //// column for tentative fin grade
                                                                                echo '<td class="grade-column centered-bold" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="tentative_finals_grade">';
                                                                                foreach ($enrolledStudent->grades as $grade) {
                                                                                    if ($grade->tentative_finals_grade !== null) {
                                                                                        echo '<div class="grade-dropdown displayed-value">';
                                                                                        echo '<span class="displayed-value">' . $grade->tentative_finals_grade  . '</span>';
                                                                                        echo '</div>';
                                                                                    }
                                                                                }
                                                                                echo '</td>';

                                
                                                                                //// column for fn grade - actual fn grade -no additions
                                                                                //// column for  fn grade
                                                                            $textClass = 'text-default';

                                                                        
                                                                            foreach ($enrolledStudent->grades as $grade) {
                                                                                if ($grade->finals_grade !== null && $grade->finals_grade < 75) {
                                                                                    $textClass = 'text-red';
                                                                                    break; 
                                                                                }
                                                                            }

                                                                        
                                                                            echo '<td class="grade-column centered-bold ">';

                                                                            foreach ($enrolledStudent->grades as $grade) {
                                                                                echo '<div class="grade-dropdown displayed-value">';
                                                                                if ($grade->finals_grade !== null) {
                                                                                
                                                                                        echo '<span class="displayed-value ' . $textClass . '" data-enrolled-student-id="' . $enrolledStudent->id . '" data-grade-type="finals_grade">' .
                                                                                    number_format($grade->finals_grade, $grade->finals_grade == intval($grade->finals_grade) ? 0 : 2) .
                                                                                    '</span>';
                                                                                }
                                                                                }
                                                                                echo '</td>';

                                                                            if ($assessment->type === 'Direct Bonus Grade' && $assessments->where('type', 'Direct Bonus Grade')->count() > 0) {
                                                                            echo '<td class="assessment-column">
                                                                                <input type="text" name="' . $textboxName . '" class="form-control score-input" ' . $disabled . '
                                                                                data-grading-period="' . $assessment->grading_period . '"
                                                                                    data-enrolled-student-id="' . $enrolledStudent->id . '"
                                                                                    data-assessment-id="' . $assessment->id . '"
                                                                                    data-assessment-type="' . $assessment->type . '"
                                                                                    data-original-value="' . $textboxValue . '"
                                                                                    data-max-points="' . $assessment->max_points . '"
                                                                                    data-student-name="' . $studentName . '"
                                                                                    data-assessment-description="' . $assessmentDescription . '"
                                                                                    value="' . $textboxValue . '"
                                                                                    style="width: 40px; text-align: center;">
                                                                            </td>';
                                                                        }


                                                                            //// column for  fn grade
                                                                            $textClass = 'text-default';

                                                                        
                                                                            foreach ($enrolledStudent->grades as $grade) {
                                                                                if ($grade->adjusted_finals_grade !== null && $grade->adjusted_finals_grade < 75) {
                                                                                    $textClass = 'text-red';
                                                                                    break; 
                                                                                }
                                                                            }

                                                                        
                                                                            echo '<td class="grade-column centered-bold ">';

                                                                            foreach ($enrolledStudent->grades as $grade) {
                                                                                echo '<div class="grade-dropdown displayed-value">';

                                                                                ///Only show if grade is available
                                                                                if ($grade->adjusted_finals_grade !== null) {
                                                                                    $formattedGrade = number_format(
                                                                                        $grade->adjusted_finals_grade,
                                                                                        $grade->adjusted_finals_grade == intval($grade->adjusted_finals_grade) ? 0 : 2
                                                                                    );

                                                                                    echo '<select 
                                                                                    class="status-dropdown ' . $textClass . '" 
                                                                                    data-grade-type="final" 
                                                                                    data-enrolled-student-id="' . $enrolledStudent->id . '" 
                                                                                    data-grade-id="' . $grade->id . '" 
                                                                                    data-adjusted-finals="true" 
                                                                                    ' . ($isPastSubjectList ? 'disabled' : '') . '>';

                                                                                    ///// Grade as the first option
                                                                                    echo '<option value="DEFAULT" ' . ($grade->finals_status === 'DEFAULT' ? 'selected' : '') . '>' . $formattedGrade . '</option>';

                                                                                        foreach ($statuses as $status) {
                                                                                        $selected = $grade->finals_status === $status->name ? 'selected' : '';
                                                                                        echo '<option value="' . $status->name . '" ' . $selected . '>' . $status->name . '</option>';
                                                                                    }

                                                                                

                                                                                    echo '</select>';
                                                                                }

                                                                                echo '</div>';
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
                                                            $currentColIndex = 1; 
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
                                                                        if ($assessment->type != 'Direct Bonus Grade' ) {
                                                                        echo '<th class="assessment-column">
                                                                            <span class="assessment-description"
                                                                                data-grading-period="' . $assessment->grading_period . '"
                                                                                data-type="' . $assessment->type . '"
                                                                                data-description="' . $assessment->description . '">
                                                                                ' . (!empty($assessment->activity_date) ? $assessment->activity_date : ($assessment->manual_activity_date ?? '')) . '
                                                                            </span>
                                                                            

                                                                        </th>';
                                                                        }
                                                                        
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
                                                                        //// empty th for Total Points
                                                                        if ($assessment->type != 'Direct Bonus Grade') {
                                                                        echo '<th class="assessment-column"></th>';
                                                                    }
                                                                        $currentColIndex++; 
                                                                    }
                                                                }
                                                                $subjectId = $subject->id;
                                                                    ///// empty th for grades column under 
                                                            

                                                        if ($gradingPeriod == "First Grading") {
                                                                if (strpos($subject->subject_type, 'LecLab') !== false) {
                                                                    //// for LecLab subject type
                                                                    echo '<th class="grade-column"></th>
                                                                        <th class="grade-column"></th>';
                                                                } else {
                                                                    //// for Lec and Lab type
                                                                    echo '<th class="grade-column"></th>';
                                                                }
                                                            }  elseif ($gradingPeriod == "Midterm") {
                                                                    if (strpos($subject->subject_type, 'LecLab') !== false) {
                                                                        ///// For LecLab subject type in Midterm
                                                                        echo '<th class="grade-column"></th>
                                                                            <th class="grade-column"></th>
                                                                            <th class="grade-column"></th>'; 
                                                                    
                                                                    } else {
                                                                        ///// For Lec and Lab type in Midterm
                                                                        echo '<th class="grade-column"></th>
                                                                            <th class="grade-column"></th>'; 
                                                                        
                                                                    }
                                                                } elseif ($gradingPeriod == "Finals") {
                                                                    if (strpos($subject->subject_type, 'LecLab') !== false) {
                                                                        //// For LecLab subject type in Finals
                                                                        echo '<th class="grade-column"></th>
                                                                            <th class="grade-column"></th>
                                                                            <th class="grade-column"></th>
                                                                            <th class="grade-column"></th>'; 
                                                                        if ($assessment->type == 'Direct Bonus Grade' && $assessments->where('type', 'Direct Bonus Grade')->count() > 0) {
                                                                            echo '<th class="assessment-column"></th>';
                                                                        }
                                                                    } else {
                                                                        //// For Lec and Lab type in Finals
                                                                        echo '<th class="grade-column"></th>
                                                                            <th class="grade-column"></th>
                                                                            <th class="grade-column"></th>'; 
                                                                        if ($assessment->type == 'Direct Bonus Grade' && $assessments->where('type', 'Direct Bonus Grade')->count() > 0) {
                                                                            echo '<th class="assessment-column"></th>';
                                                                        }
                                                                    }
                                                                }

                                                            echo '
                                                            <th class="grade-column">
                                                                
                                                            </th>';
                                                                $currentColIndex++;
                                                            }
                                                        @endphp
                                                    </tr>
                                                            <!----for the publish button appear below---->
                                                        <tr>
                                                        <th class="fixed-column"></th> 
                                                        <th class="fixed-column"></th> 
                                                        <th class="fixed-column"></th> 
                                                        <th class="fixed-column"></th> 
                                                        @php
                                                            $currentColIndex = 1; 
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
                                                                        if ($assessment->type != 'Direct Bonus Grade' ) {
                                                                        echo '<th class="assessment-column">
                                                                            <span class="assessment-description" style="display: none;"
                                                                                data-grading-period="' . $assessment->grading_period . '"
                                                                                data-type="' . $assessment->type . '"
                                                                                data-description="' . $assessment->description . '">
                                                                                ' . (!empty($assessment->activity_date) ? $assessment->activity_date : ($assessment->manual_activity_date ?? '')) . '
                                                                            </span>
                                                                            <button class="btn btn-sm btn-publish publish-button btn-primary" data-assessment-id="' . $assessment->id . '" data-published="' . ($assessment->published ? 'true' : 'false') . '"' . ($isPastSubjectList ? ' disabled' : '') . '>
                                                                                    ' . ($assessment->published ? 'Hide Scores' : 'Publish Scores') . '
                                                                                </button>

                                                                        </th>';
                                                                        }
                                                                        
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
                                                                        //// empty th for Total Points
                                                                        if ($assessment->type != 'Direct Bonus Grade') {
                                                                        echo '<th class="assessment-column"></th>';
                                                                    }
                                                                        $currentColIndex++; 
                                                                    }
                                                                }
                                                                $subjectId = $subject->id;
                                                                    ///// empty th for grades column under 
                                                            

                                                        if ($gradingPeriod == "First Grading") {
                                                                if (strpos($subject->subject_type, 'LecLab') !== false) {
                                                                    //// for LecLab subject type
                                                                    echo '<th class="grade-column"></th>
                                                                        <th class="grade-column"></th>';
                                                                } else {
                                                                    //// for Lec and Lab type
                                                                    echo '<th class="grade-column"></th>';
                                                                }
                                                            }  elseif ($gradingPeriod == "Midterm") {
                                                                    if (strpos($subject->subject_type, 'LecLab') !== false) {
                                                                        ///// For LecLab subject type in Midterm
                                                                        echo '<th class="grade-column"></th>
                                                                            <th class="grade-column"></th>
                                                                            <th class="grade-column"></th>'; 
                                                                    
                                                                    } else {
                                                                        ///// For Lec and Lab type in Midterm
                                                                        echo '<th class="grade-column"></th>
                                                                            <th class="grade-column"></th>'; 
                                                                        
                                                                    }
                                                                } elseif ($gradingPeriod == "Finals") {
                                                                    if (strpos($subject->subject_type, 'LecLab') !== false) {
                                                                        //// For LecLab subject type in Finals
                                                                        echo '<th class="grade-column"></th>
                                                                            <th class="grade-column"></th>
                                                                            <th class="grade-column"></th>
                                                                            <th class="grade-column"></th>'; 
                                                                        if ($assessment->type == 'Direct Bonus Grade' && $assessments->where('type', 'Direct Bonus Grade')->count() > 0) {
                                                                            echo '<th class="assessment-column"></th>';
                                                                        }
                                                                    } else {
                                                                        //// For Lec and Lab type in Finals
                                                                        echo '<th class="grade-column"></th>
                                                                            <th class="grade-column"></th>
                                                                            <th class="grade-column"></th>'; 
                                                                        if ($assessment->type == 'Direct Bonus Grade' && $assessments->where('type', 'Direct Bonus Grade')->count() > 0) {
                                                                            echo '<th class="assessment-column"></th>';
                                                                        }
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
                                    </div>
                                </div>
                                <script>
                                    window.addEventListener('load', function() {
                                      let zoomLevel = 1;
                                      const zoomTableInner = document.getElementById('zoomable-table-inner');
                                      
                                      function applyZoom() {
                                        zoomTableInner.style.transition = 'transform 0.3s ease';
                                        zoomTableInner.style.transform = `scale(${zoomLevel})`;
                                        zoomTableInner.style.transformOrigin = 'top left';
                                      }
                                      
                                      window.zoomIn = function() {
                                        zoomLevel += 0.1;
                                        applyZoom();
                                      }
                                      
                                      window.zoomOut = function() {
                                        zoomLevel = Math.max(0.7, zoomLevel - 0.1); // Adjusted zoom level
                                        applyZoom();
                                      }
                                      
                                      window.resetZoom = function() {
                                        zoomLevel = 1;
                                        applyZoom();
                                      }
                                    });
                                </script>
                                <br>

                                <a href="{{ route('generateExcelReport', ['subjectId' => $subject->id]) }}" class="btn btn-success" target="_blank">Records Report</a>
                                <a href="{{ route('generatePdfReport', ['subjectId' => $subject->id]) }}"  class="btn btn-success" target="_blank">Records Report (PDF)</a>
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
        <div class="modal-dialog modal-lg modal-lg-custom" role="document">
            <div class="modal-content">
                <form action="{{ route('assessments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="subject_code" id="subject_code" value="{{ $subject->subject_code }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="assessmentModalLabel">Add Assessment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <input type="hidden" name="assessment_id" id="assessment_id">
                    <input type="hidden" name="subject_id" id="subject_id" value="{{ $subject->id }}">
                    <input type="hidden" name="subjectType" id="subject_type" value="{{ $subject->subject_type }}">

                    <div class="modal-body modal-body-scrollable">
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
                        <button type="button" class="btn btn-primary d-none" id="saveAssessmentsBtn">Save</button>
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
                                