@extends('layouts.app') 

@section('content')
@php
        $header_title = "Enter Password";
    @endphp

    <div class="content-wrappers">
   
      <style>
        .container-center {
            display: flex;
            flex-direction: column;  
            align-items: center; 
            min-height: 100vh;
            padding: 20px;
            padding-top: 10vh;
        }

        .card-center {
            width: 100%;
            max-width: 400px;
            margin-bottom: 20px;  
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header, .card-body, .card-footer {
            padding: 20px;
        }

        .card-title {
            margin: 0;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
        }

        .btn-success {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }

        .btn-back {
            width: 150%;
            max-width: 100px;
            padding: 10px;
            font-size: 16px;
            margin-top: 10px;
            margin-bottom: 20px;
        }
    </style>

    <!-- Main content -->
   <section class="content">
    <div class="container-center">
        <div class="card card-center">
            <form method="post" action="{{ route('admin.confirm-password', ['id' => $userId]) }}">
                {{ csrf_field() }}
                <div class="card-header">
                    <h3 class="card-title">Password Confirmation</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="password">Enter your password to proceed:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Confirm</button>
                </div>
            </form>
        </div>
         <input type="button" onclick="window.location.href='{{ url('admin/admin/list') }}';" class="btn btn-info btn-back" value="Back" />
    </div>
</section>
  </div>
@endsection

 