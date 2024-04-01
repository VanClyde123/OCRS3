@extends('layouts.app')

@section('content')
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
   
    <section class="content-header">
      <div class="container-fluid">
        <div >
          <div >
           <a href="{{ url('secretary/set_semester/view_semesters')}}" class="btn btn-primary">Modify Semesters</a>
          </div>
          
        </div>
      </div>
    </section>
  
  <section class="content">
      <div class="container-fluid">
        
          <!-- left column -->
          <div>
            <!-- general form elements -->
            <div class="card ">
   @include('messages')
    <form method="post" action="{{ route('semesters.setupCurrent1') }}">
        @csrf

         <div class="card-body">
            <div class="form-group">
            <label for="semester_id">Current Semester:</label>
            <select class="form-control" id="semester_id" name="semester_id" required>
               @foreach ($semesters as $semester)
            <option value="{{ $semester->id }}" {{ $semester->is_current ? 'selected' : '' }}>
                {{ $semester->semester_name }}, {{ $semester->school_year }}
            </option>
           @endforeach
            </select>
        </div>
         </div>

        </div>
          <div class="card-footer">
        <button type="submit" class="btn btn-primary">Set as Current</button>
    </div>
    </form>

    </div>
         

          </div>
         
        </div>
     
      </div>
    </section>
    
  </div>
@endsection

