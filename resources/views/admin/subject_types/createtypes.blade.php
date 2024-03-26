@extends('layouts.app')

@section('content')

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
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
               
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create Class Type for Calculation</h3>
                        </div>
                        <div class="card-body">
                           
                            <form action="{{ route('subject_types.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="subject_type">Class Type:</label>
                                    <input type="text" name="subject_type" class="form-control" required>
                                    <small class="text-muted instruction-text">Example: LecLab2080</small>
                                </div>
                                <div class="form-group">
                                    <label for="lec_percentage">Lec Percentage:</label>
                                    <input type="number" name="lec_percentage" step="0.01" class="form-control" required>
                                    <small class="text-muted instruction-text">Enter as decimal (e.g., 0.2 or .2 for 20%)</small>
                                </div>
                                <div class="form-group">
                                    <label for="lab_percentage">Lab Percentage:</label>
                                    <input type="number" name="lab_percentage" step="0.01" class="form-control" required>
                                    <small class="text-muted instruction-text">Enter as decimal (e.g., 0.8 or .8 for 80%)</small>
                                </div>
                                <button type="submit" class="btn btn-success">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



@endsection