@extends('layouts.app')
   
@section('content')

     @php
        $header_title = "Import Classlist";
    @endphp
    <script src="{{ asset('resources/js/import.js') }}">
    </script>
    <div class="content-wrappers">
        <section class="content-header">
            <h2 class="mb-5"></h2>
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
                        <input id="fileInput" type="file" name="file" accept=".xlsx,.xls">
                        <button id="importBtn" disabled type="submit" class="btn btn-primary">Import</button>
                    </form>
                  @if(isset($subjectExists) && isset($importedClasslistExists))
                        <div class="alert alert-info" role="alert">
                            <strong>Subject:</strong> {{ $subjectExists }}
                        </div>
                        <div class="alert alert-info" role="alert">
                            <strong>Imported Classlist:</strong> {{ $importedClasslistExists }}
                        </div>
                        <div class="alert alert-info" role="alert">
                            <strong>Student:</strong> {{ $enrolledStudentsMessage }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div id="imported-data-container">

    </div>
    <script>
        const fileInput = document.getElementById('fileInput');
        const importBtn = document.getElementById('importBtn');
        
        fileInput.addEventListener('change', () => {
          if (fileInput.files.length > 0) {
            importBtn.disabled = false; 
          } else {
            importBtn.disabled = true;
          }
        });
    </script>
@endsection