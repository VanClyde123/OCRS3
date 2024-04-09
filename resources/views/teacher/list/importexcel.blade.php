@extends('layouts.app')
   
@section('content')
<script src="{{ asset('resources/js/import.js') }}"></script>

    <div class="content-wrappers">
        <section class="content-header">
            <h3>Import Classlist</h3>
        </section>
        @include('messages')
        <div class="card">
            <div class="card-header">
                <h6>Select ClassList Excel File </h6>
            </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <form action="{{ route('teacher.list.imported-data') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" >
                        <button type="submit" class="btn btn-primary">Import</button>
                    </form>
                    @if(isset($subjectExists) && isset($importedClasslistExists))
                        <p>Subject: {{ $subjectExists }}</p>
                        <p>Imported Classlist: {{ $importedClasslistExists }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div id="imported-data-container">
        
    </div>

@endsection