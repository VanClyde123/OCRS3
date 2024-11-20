@extends('layouts.app')
   
@section('content')

     @php
        $header_title = "Import Classlist";
    @endphp
    <script src="{{ asset('resources/js/import.js') }}">
    </script>
    <div class="content-wrappers">
        <style>
        .center-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;  
            min-height: 100vh;
            padding: 20px;
            padding-top: 10vh;  
        }

        .card-centered {
            width: 100%;
            max-width: 500px;  
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header, .card-body {
            padding: 20px;
        }

        .card-header h6 {
            margin: 0;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }

        .btn-primary {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            margin-top: 10px;
        }

        .alert-info {
            margin-top: 10px;
        }

        #fileInput {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }

        .btn-primary {
            width: auto;  
            padding: 10px 20px; 
            font-size: 16px;
            margin-top: 10px;
            display: block; 
            margin: 0 auto;  
        }
    </style>
        <section class="content-header">
            <h2 class="mb-5"></h2>
        </section>
        @include('messages')
         <section class="content">
            <div class="center-container">
                <div class="card card-centered">
                    <div class="card-header">
                        <h6>Select Classlist Excel File</h6>
                    </div>

                   <div class="card-body">
                        <div class="table-responsive">
                            <form action="{{ route('teacher.list.imported-data') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input id="fileInput" type="file" name="file" accept=".xlsx,.xls">
                                <button id="importBtn" disabled type="submit" class="btn btn-primary">Import</button>
                            </form>

                                  <br>
                            @if(isset($subjectExists) && isset($importedClasslistExists))
                                <div class="alert {{ Str::endsWith($subjectExists, 'already exists') ? 'alert-danger' : 'alert-info' }}" role="alert">
                                    <strong>Subject:</strong> {{ $subjectExists }}
                                </div>
                                <div class="alert {{ Str::endsWith($importedClasslistExists, 'already exists') ? 'alert-danger' : 'alert-info' }}" role="alert">
                                    <strong>Imported Classlist:</strong> {{ $importedClasslistExists }}
                                </div>
                                
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
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