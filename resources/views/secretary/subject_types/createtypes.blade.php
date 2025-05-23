@extends('layouts.app')

@section('content')
@php
        $header_title = "Add New Class Type";
    @endphp
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lecPercentageInput = document.querySelector('input[name="lec_percentage"]');
            const labPercentageInput = document.querySelector('input[name="lab_percentage"]');
            
            function validatePercentage() {
                const lecPercentage = parseFloat(lecPercentageInput.value || 0);
                const labPercentage = parseFloat(labPercentageInput.value || 0);
                const totalPercentage = lecPercentage + labPercentage;
                if (lecPercentage > 0 && labPercentage > 0) {
                    if (totalPercentage > 1) {
                        alert('Total percentage exceeds 100%');
                        lecPercentageInput.value = '';
                        labPercentageInput.value = '';
                    } else if (totalPercentage < 1) {
                        alert('Total percentage is less than 100%');
                        lecPercentageInput.value = '';
                        labPercentageInput.value = '';
                    }
                }
            }
            lecPercentageInput.addEventListener('input', function() {
                if (parseFloat(this.value) > 0.99) {
                    alert('Please enter a maximum of 0.99');
                    this.value = '0.00';
                }
                validatePercentage();
            });
            labPercentageInput.addEventListener('input', function() {
                if (parseFloat(this.value) > 0.99) {
                    alert('Please enter a maximum of 0.99');
                    this.value = '0.00'; 
                }
                validatePercentage();
            });
        });
    </script>
    <style>
        .instruction-text {
            font-size: 14px; 
        }
    </style>

    <div class="content-wrappers">
        <section class="content-header">
            <h2><br></h2>
           

        </section>
          @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <section class="content">
            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">Create Class Type for Calculation</h3>
                </div>
                <div class="table-responsive">
                    <div class="card-body">
                        <form action="{{ route('subject_types.store1') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="subject_type">Class Type:</label>
                                <input type="text" name="subject_type" class="form-control" required>
                                <small class="text-muted instruction-text">Example: LecLab2080</small>
                            </div>
                            <div class="form-group">
                                <label for="lec_percentage">Lec Percentage:</label>
                                <input type="number" name="lec_percentage" min="0.01"step="0.01" class="form-control" required>
                                <small class="text-muted instruction-text">Enter as decimal (e.g., 0.2 or .2 for 20%)</small>
                            </div>
                            <div class="form-group">
                                <label for="lab_percentage">Lab Percentage:</label>
                                <input type="number" name="lab_percentage" min="0.01"step="0.01" class="form-control" required>
                                <small class="text-muted instruction-text">Enter as decimal (e.g., 0.8 or .8 for 80%)</small>
                            </div>
                            <button type="submit" class="btn btn-success">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
          <input type="button" onclick="window.location.href='{{ url('secretary/subject_types/viewtypes') }}';" class="btn btn-info" value="Back" />
    </div>
@endsection