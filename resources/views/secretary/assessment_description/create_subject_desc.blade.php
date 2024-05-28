@extends('layouts.app')

@section('content')
    <div class="content-wrappers">
        <section class="content-header">
            <h2>New Subject Descriptions</h2>
            <input action="action" onclick="window.history.go(-1); return false;" type="submit" class="btn btn-info" value="Back" /> 
        </section>
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Subject Description</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('subject_descriptions.store1') }}" method="POST">
                        @csrf

                      <div class="form-group">
                            <label for="year_level">Year Level</label>
                            <select class="form-control" id="year_level" name="year_level" required>
                                <option value="" disabled selected>--- Select Year Level ---</option>
                                <option value="1">1st Year</option>
                                <option value="2">2nd Year</option>
                                <option value="3">3rd Year</option>
                                <option value="4">4th Year</option>
                                <option value="5">5th Year</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="subject_code">Subject Code</label>
                             <input type="text" class="form-control" id="subject_code" name="subject_code">
                        </div>

                        <div class="form-group">
                            <label for="subject_name">Subject Name</label>
                            <input type="text" class="form-control" id="subject_name" name="subject_name">
                        </div>
                        
                        
                        <button type="submit" class="btn btn-success">Create</button>
                    </form>
                </div>
            </div>
        </section>
    </div>

   
@endsection