@extends('layouts.app')

@section('content')
    <div class="content-wrappers">
        <section class="content-header">
            <h2>Create New Subject Description</h2>
            <input action="action" onclick="window.history.go(-1); return false;" type="submit" class="btn btn-info" value="Back" /> 
        </section>
        <section class="content">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <form action="{{ route('subject_descriptions.store1') }}" method="POST">
                        @csrf
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