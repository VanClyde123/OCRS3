@extends('layouts.app')

@section('content')

    <script>
        $(document).ready(function () {
            ///// get the assessment descriptions based on the selected type
            $('#assessmentType').change(function () {
                const selectedType = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: '{{ route('assessment-descriptions.fetch') }}',
                    data: {
                        type: selectedType,
                    },
                    success: function (response) {
                        const descriptions = response.descriptions;
                        updateDescriptionDropdown(descriptions, '{{ $assessment->description }}');
                    },
                    error: function (error) {
                        console.error('Error:', error);
                    },
                });
            });

            //// update the description dropdown
            function updateDescriptionDropdown(descriptions, currentDescriptionId) {
                const $descriptionDropdown = $('#assessmentDescription');
                $descriptionDropdown.empty();

                descriptions.forEach(description => {
                    const $option = $('<option>', {
                        value: description.description,
                        text: description.description,
                        selected: description.description == currentDescriptionId,
                    });
                    $descriptionDropdown.append($option);
                });
            }
            //// to initially get and update on page load
            $('#assessmentType').change();
        });
    </script>


    <div class="content-wrappers">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h2>Edit Assessment</h2>
        </section>
        <section class="content">
            <div class="card ">
            
                <form method="post" action="{{ route('instructor.updateAssessment', ['assessmentId' => $assessment->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="table-responsive">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="gradingPeriod">Grading Period</label>
                                <input type="text"  class="form-control"  name="grading_period" value="{{ $assessment->grading_period }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control" name="type" id="assessmentType" required>
                                    <!-- Hardcoded options for type -->
                                    <option value="Quiz" {{ $assessment->type === 'Quiz' ? 'selected' : '' }}>Quiz</option>
                                    <option value="OtherActivity" {{ $assessment->type === 'OtherActivity' ? 'selected' : '' }}>Other Activity</option>
                                    <option value="Exam" {{ $assessment->type === 'Exam' ? 'selected' : '' }}>Exam</option>
                                    <option value="Lab Activity" {{ $assessment->type === 'Lab Activity' ? 'selected' : '' }}>Lab Activity</option>
                                    <option value="Lab Exam" {{ $assessment->type === 'Lab Exam' ? 'selected' : '' }}>Lab Exam</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="type">Description</label>
                                <select name="description" class="form-control" id="assessmentDescription" required>
                                <!-- Leave this empty for now, it will be populated dynamically -->
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="maxPoints">Max Points</label>
                                <input type="number"  class="form-control" min="1" name="max_points" value="{{ number_format($assessment->max_points, 0) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="activityDate">Activity Date</label>
                                <input type="date"  class="form-control"  name="activity_date" value="{{ $assessment->activity_date }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit"  class="btn btn-primary">Update Assessment</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection

